<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\Tools\Cart;
class CartController extends Controller
{
    //添加到购物车
    public function  add(Request $request,Course $course){
    	//使用购物车类；根据购物车类中的add方法组合一个数组。
    	$data = [
    		'course_id'=>$course->id,
    		'course_name'=>$course->course_name,
    		'course_price'=>$course->course_price
    	];
    	$cart = new Cart();
    	$cart->add($data);//把课程添加到购物车
    	return view('home.cart.add',compact('course'));


    }
    //购物车列表页面
    public function index(){
    	//获取购物车里面的数据
    	$cart = new Cart();
    	//$cart->delall();
    	//获得购物车的商品数量和总价格
    	$total = $cart->getNumberPrice();
    	//返回购物车的商品信息，Array格式返回
    	$info =  $cart->getCartInfo();
    	//dd($info)
    	return view('home.cart.index',compact('info','total'));
    }
}
