<?php

return [
    'alipay' => [
        'app_id'         => '2016091700533052',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsySphuoXcgz4puzbHnNU4SEtq3BbjDxeaizwgo2LSwF/wKoO8/rzseLy+tHXrgOKhOXNynC2ewGsoHta++L7tnft3GI4OvU2EEnbb7PMXQItziYqNozplJp+cG9qzjLnUeAI55Qgsirb5Wj72ffDIfApYdO2Mz6rc2P+A6znBl+8e8zD6X17ftA+gXmyGKcNxx1kS9Qc+TJQpOx6YeKCykIDpSTy47SDPeETF7w1zqthVERm9zZMXM7rJCnYdvl7mOGzlaUapzkpc6NljrHgeKaXdst4aZzWdYnrIww6wdbHcpTEZQLDGBd/WjxLkT7d8Ox4qIKJ1ogpTps/hp1sXQIDAQAB',
        'private_key'    => 'MIIEowIBAAKCAQEAyW2mkgdGTi/Ubg67+stNtlEj3UnIKDnaW8npKy3o43H0KimKxjXWFJr5sS067vGby/MuQwHg6Ht4fjAK+e11RkOZmKsqeCpIi9kRaG5YgKDPBOPhZJxzabrbjSwkGqt/+7MIh7xmfjv9mRD81+TRxLy1FA8PQyFGq7O67+mmymhsJKIfJKHcVIQHN/BEtZZCSI9kaBt4hh/TCPGX1xl7+w6WDq+NPb0rt6BAwxdc5rkdyDO6MI0GIrof0oWQX3uVmYElXYyujAbXESX3/UXCHTai0lOisOZb2fbmKoJ0yQDmz1swn6GscehmEmTfNvp1H2c0GL19Iv2Q+B0zDYyeuQIDAQABAoIBAH5A4mUpdiHPzQDm72B1SdJ67VXoxzKfgISD/Eh6UD0v0fETdM5kNDlaIiOxy/y1KAgf9uE9LjHKIm5FwruA4T8XZBDTSJ1lM2+ksUqZz5NgOCJCi6Y6ggTFgJPuFPs6f8/OGgyqRDvfckcc5L6Vx/3eokleXxyeoONClmuGMmsvB8LYt7RvPxVuCIo5D2Bxy2whpzD2/7neagdfGli6ndbslHyCmcaMpu4d3BFZ+nuDL2RsLbblF26R/tZxLLbE2UY7WXfl0aYrm0L9+9aiFtKynjB67PrksPo7DOT3umCMSIggiLaGuR6tz/NKyYqR27KPlDtK03HiAywFotnVWwECgYEA6W2pxHnaWmczMGQ1ngxrSevOim5HJJYrkr95AUjJK3WIMS+3Aw/PKlXZOa2Xg21+wsHra9ORxrkMAZrAFtkJ73p+fzX/xJTD+xCuYh7XyB8MICxrL24rvLi84T5w/2jLeT27iJmjohk9u2DRPVJvoEq3k8zZOyQUXVk0Y8cWOVECgYEA3OfZ8DdxcisOUYjSiOMeW3osofiLXwmUU/564h1CJttjMvhtoCve1v/OBNU4x8C2KxCuH9pdfNaFKisO1MZv9BorntFdnZLRU9cg4UkF4Tv3bU1+RaF4ebgkRlvHrNbc3ShFP8Exrm1p3979wkp6Nw7F8cTPyYNuvEB9JuBONOkCgYAxa3E80puC9kRlI2Iiovh3/v+MWUqgmVaCTB1fQzysAcciurphYJB4oxJJXtIsFht3Oj0QaAt96iF7mXq/m5W56NItNo5+3Qwc9GwnA+alTMVxblYHBakm3GnIukKMIHCrq4Evq290WymxqQ7Dj9doNUlmdkErfzj8hm1MDpNK8QKBgQCJnL09UayQTJYc4LkWoTV2EwPe2rAnwhXuxSbT2RoujpibVfskvm+RS8WRaSp39WsGJNvz59o5PIG0JSKWFhAD5pGp3A8PbDiOnANVlGHfT7XxF0dEJTShzr56Pg6Dc04fT0jkUHuch3hfB9DYygCcb82LsOkoRYIkL6BHKZBOkQKBgD7mhzJnSTqA5dskobIgpSXfCPYYxM0q/P2isDBh+ztfW2kaMIQDooYOr2L61dyFsPP1YGL1PQendgK1N4l8NJ3t7OrjGNySscTsOq4FgMmKdZYYGIplVnkkjCelY1Kn6NJq0IOUQthqZ2aI90Cm3mccLgAakRoh10e/ZyeBxyvX',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];
