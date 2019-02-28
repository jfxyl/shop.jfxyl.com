<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSku;
use Illuminate\Validation\Rule;

class SeckillOrderRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id' => [
                'required',
                Rule::exists('user_addresses','id')->where('user_id', $this->user()->id)
            ],
            'sku_id' => [
                'required',
                function($attribute,$value,$fail){
                    // 从 Redis 中读取数据
                    $stock = \Redis::get('seckill_sku_'.$value);
                    // 如果是 null 代表这个 SKU 不是秒杀商品
                    if (is_null($stock)) {
                        return $fail('该商品不存在');
                    }
                    // 判断库存
                    if ($stock < 1) {
                        return $fail('该商品已售完');
                    }
                    $sku = ProductSku::find($value);
                    if($sku->product->type !== Product::TYPE_SECKILL){
                        return $fail('商品未参与秒杀活动');
                    }
                    if($sku->product->seckill->is_before_start){
                        return $fail('秒杀未开始');
                    }
                    if($sku->product->seckill->is_after_end){
                        return $fail('秒杀已结束');
                    }
                    if($order = Order::query()
                        ->where('user_id',$this->user()->id)
                        ->whereHas('items',function($query) use ($value){
                            $query->where('product_sku_id',$value);
                        })
                        ->where(function($query){
                            $query->whereNotNull('paid_at')
                            ->orWhere('closed',false);
                        })
                        ->first()
                    ){
                        if($order->paid_at){
                            return $fail('你已经抢购该商品');
                        }
                        return $fail('你的订单中已有该商品，请前去支付');
                    }
                }
            ]
        ];
    }
}
