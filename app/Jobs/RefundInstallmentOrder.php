<?php

namespace App\Jobs;

use App\Models\Installment;
use App\Models\InstallmentItem;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Exceptions\InternalException;

class RefundInstallmentOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->order->payment_method !== 'installment'
            || !$this->order->paid_at
            || $this->order->refund_status !== Order::REFUND_STATUS_PROCESSING) {
            return;
        }
        if(!$installment = Installment::query()->where('order_id',$this->order->id)->first()){
            return;
        }
        foreach($installment->items as $item){
            if(!$item->paid_at || in_array($item->refund_status,[
                    InstallmentItem::REFUND_STATUS_SUCCESS,
                    InstallmentItem::REFUND_STATUS_PROCESSING
                ])){
                continue;
            }
            try{
                $this->refundInstallmentItem($item);
            } catch(\Exception $e){
                \Log::warning('分期退款失败：'.$e->getMessage(),[
                    'installment_item_id' => $item->id,
                ]);
                continue;
            }
        }
        $installment->refreshRefundStatus();
    }

    public function refundInstallmentItem(InstallmentItem $item)
    {
        $refundNo = $this->order->refund_no.'_'.$item->sequence;
        switch ($item->payment_method){
            case 'wechat':
                app('wechat_pay')->refund([
                    'transaction_id' => $item->payment_no, // 这里我们使用微信订单号来退款
                    'total_fee'      => $item->total * 100, //原订单金额，单位分
                    'refund_fee'     => $item->base * 100, // 要退款的订单金额，单位分，分期付款的退款只退本金
                    'out_refund_no'  => $refundNo, // 退款订单号
                    // 微信支付的退款结果并不是实时返回的，而是通过退款回调来通知，因此这里需要配上退款回调接口地址
                    'notify_url'     => ngrok_url('installments.wechat.refund_notify'),
                ]);
                // 将还款计划退款状态改成退款中
                $item->update([
                    'refund_status' => InstallmentItem::REFUND_STATUS_PROCESSING,
                ]);
                break;
            case 'alipay':
                $ret = app('alipay')->refund([
                    'trade_no' => $item->payment_no,
                    'refund_amount' => $item->base,
                    'out_request_no' => $refundNo,
                ]);
                if ($ret->sub_code){
                    $item->update([
                        'refund_status' => InstallmentItem::REFUND_STATUS_FAILED
                    ]);
                }else{
                    $item->update([
                        'refund_status' => InstallmentItem::REFUND_STATUS_SUCCESS
                    ]);
                }
                break;
            default:
                throw new InternalException('未知订单支付方式：'.$item->payment_method);
                break;
        }
    }
}
