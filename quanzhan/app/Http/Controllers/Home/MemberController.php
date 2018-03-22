<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
class MemberController extends Controller
{
    //前台会员登录的
    public function login(){
    	return view('home.member.login');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('get')){
            return view('home.member.register');
        }else if($request->isMethod('pots')){
            echo 1;
        }
    }

    //完成登录的验证
    public function login_check(Request $request){
    	//数据验证功能
    	$rules = [
    		'username'=>'required|min:2',
    		'password'=>'required|between:6,12'
    	];
    	$msg = [
    		'username.required'=>'会员名称不能为空',
    		'username.min'=>'会员名称至少是2个字符',
    		'password.required'=>'密码不能为空',
    		'password.between'=>'密码长度6到12位之间'
    	];
    	$validator = Validator::make($request->all(),$rules,$msg);

    	if($validator->passes()){
    		//通过验证
    		$res = Auth::guard('home')->attempt($request->only(['username','password']),$request->has('remember'));

    		if($res){
    			//登录成功；
    			return redirect('/');
    		}else {
    			//登录失败（用户名或密码错误）
    			return back()->withErrors(['msg'=>'用户名或密码错误']);
    		}
    	}else {
    		return back()->withErrors($validator);
    	}
    }
}
