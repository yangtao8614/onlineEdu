<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tools\Cart;
use App\Order;
use EchoBool\AlipayLaravel\Facades\Alipay;
use DB;
class OrderController extends Controller
{
    //下订单
    public function add(){
    	//把购物车里面的数据添加到it_order和it_order_coruse表里面。
    	$cart = new Cart();
    	$info = $cart->getCartInfo();
    	$total = $cart->getNumberPrice();
	    $order_sn = uniqid().rand(1000,9999);
	   //入库it_order表
		$res =  Order::create([
			'order_sn'=>$order_sn,
			'stu_id'=>100,
			'total_price'=>$total['price'],
		]);
		//入库it_order_course表；
		/*
			id int primary key auto_increment,
        order_id int(11) NOT NULL COMMENT '订单id',
        course_id int(11) NOT NULL COMMENT '课程id',
        course_price decimal(7,2) NOT NULL COMMENT '课程价格'
		*/
		foreach($info as $v){
			 DB::table('order_course')->insert([
			 	'order_id'=>$res->id,
			 	'course_id'=>$v['course_id'],
			 	'course_price'=>$v['course_price']
			 ]);
		}
       //入库完成；
		//清空购物车
		$cart->delall();
		//启动支付宝支付了
		//商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $order_sn;
        //订单名称，必填
        $subject = '锁贸通任务ID448';
        //付款金额，必填
        $total_amount = 0.01;
        //商品描述，可空
        $body = 'macbook pro2';
        $enable_pay_channels = 'pcredit';

        $customData = json_encode(['model_name' => 'ewrwe', 'id' => 121]);//自定义参数
        $response = Alipay::tradePagePay($subject, $body, $out_trade_no, $total_amount, $customData,$enable_pay_channels);
        //输出表单
        return $response['redirect_url'];

    }
    //支付宝完成后的页面；
    public function done(){
    	$out_trade_no = $_GET['out_trade_no'];//订单的 order_sn;
    	$total_amount = $_GET['total_amount'];
    	Order::where('order_sn',$out_trade_no)->update([
    		'pay_status'=>1,
    		'pay_time'=>time(),
    		'pay_money'=>$total_amount
    	]);

    }
}
