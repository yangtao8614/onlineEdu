<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2017/6/26
 * Time: 下午5:21
 */

return [
    //应用ID,您的APPID。
    'app_id' => "2016090800463288",//

    //商户私钥 不能用pkcs8.pem中的密钥！！！！！
    'merchant_private_key' => "MIIEowIBAAKCAQEAvWUq2JAEW5vXtZYGuw2HJbE/HmxJIrOdhFXo8bMww5fVBOZbazinoytkrsxAjjtrOM0kQNPqKGIoO4nTmPRsmHP7e4ogV/P9wNhA400Wlbxy5BH7SfnpuAlNZkVYo3Hz8mhTiqwwyTczChvd9tZIDFJ4UYlgvpaig5Z8uqN+yIY9hJgQuWwSUd8JskHnw0VCjfGrmhS+0xArEJkd62UrwjpZPFbhj+OyZqZkkXQpDw4p98Hgm2eUblyQUZ7qrSVa1vrNjpe0k+sO2MKw9Ei7ZSe3YLV+fcZKHgifN1GIHDlkK3XcvBC64bHihFUrshF1JMFjOvt+L+bn9lq5QvOctQIDAQABAoIBADJDlDBvYEizvnbZvyWLfI+bT8YSNQK5qpdBeZYT2WA/fnBTdnWpTow2av0dBhD5YgZsIy/1TdKz4juS445XaC65sUdjLBxLi8/PVME+Zz0MC23N++PxKH8IMPtwcgrGplhyKaHG+xebx7bqGGl3Cx4CER6KmBtcvPqxSJ773xz2VeM/bqNGxugQidXrLbVOQ3NOeKG6lU+nRWfZwH/x9HntdXKT6uw/UyMGz5sOSPuozHEYld6lu7Ysr5dGezJZvmEhJyVynKx7zVuwfEVOVdppY1BtTilZjdngLEX/iQCCLQFXVehh6tUPRz/k1dUrwKTC/IZPOkeTFOR682VpUMECgYEA9o6TLci+8TrIYp8clQvqvcWeTwI1kfppFa4A+D/3r0xN4BfBek/50Sfyi7twUQSXUGd5ZHUQEVepdVDfW5mJEkPth4jvxD5QQd7LvgZfdFuTZXqEBnkVPpheXs9aOaNPhuFKFYYODafObYccIW/Q48Embg2YiT3Qnbn/19tLgjECgYEAxKYjAJoy2EAWfgDV78kei0thgdQJwWHwWgfd5K1KTXdLIzNe0cuANapa2Wl3mteGyeAK6u7YDwi9lqs7e3WQO6N/1rnnMol+zu1ABvbhceMK6VOWU5SKUUgkHn31WVV/gCDZ2dlNAJPkEhPuq9MLexU4PHCyvMwX1+EDjpuO/cUCgYBdmtlzq2Aak1eaYY/nYiPXslwc4NjXt/sHWQ1TMm3lZpG2Py6cMhrE9maV+C53A8gypWYn5m2YN/DE8lQqIYsxnQpjx3BHz+SGbYBqf17j/RRjlXTkRDn1jsFdO1mkwkSiD4whycgyFQBBAueCJkJnBWCCrbS4ffhiuUfRepcbMQKBgGCUY9543P3eQ+2whWHV+f1ZkVMNC5mBe2UMNguInFR9gVaRdUE+XAJ/X00mAkr3DUj6kwIdOdnwZgSopncVHzhbLX8NIKJuauxAE1EYUVL4ujQsDEmSS3huIOck36n3Vr5b5AKdObdN6xaB2Zdj+GCD5HGyu+YDqrYo2fFhLxItAoGBAKR9QzEK0b3mrT65wHNunNWL2KYOWCeWPW+H7ClrOMk/yF5g3yRh1kYXGbeXVcrXijWCttjoiRllkzbz/mmGjGWmdmUDVJAmsEz6szKG1d8LmsA8O5hoLn0lpRVYpLzm8jMRs2k6oHUxIG/7fEPlpVb4+YfpIxUgb6FnNFMdzWDj",

    //异步通知地址(发送的post请求，用于完成业务逻辑，比如修改订单状态)
    'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",

    //同步跳转（发送的get请求,支付宝支付完成后，返回到商户的页面）
    'return_url' => "http://www.quanzhan.com/order/done",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type' => "RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvWUq2JAEW5vXtZYGuw2HJbE/HmxJIrOdhFXo8bMww5fVBOZbazinoytkrsxAjjtrOM0kQNPqKGIoO4nTmPRsmHP7e4ogV/P9wNhA400Wlbxy5BH7SfnpuAlNZkVYo3Hz8mhTiqwwyTczChvd9tZIDFJ4UYlgvpaig5Z8uqN+yIY9hJgQuWwSUd8JskHnw0VCjfGrmhS+0xArEJkd62UrwjpZPFbhj+OyZqZkkXQpDw4p98Hgm2eUblyQUZ7qrSVa1vrNjpe0k+sO2MKw9Ei7ZSe3YLV+fcZKHgifN1GIHDlkK3XcvBC64bHihFUrshF1JMFjOvt+L+bn9lq5QvOctQIDAQAB",

    //支付时提交方式 true 为表单提交方式成功后跳转到return_url,
    //false 时为Curl方式 返回支付宝支付页面址址 自己跳转上去 支付成功不会跳转到return_url上， 我也不知道为什么，有人发现可以跳转请告诉 我一下 谢谢
    // email: 40281612@qq.com
    'trade_pay_type' => true,
];