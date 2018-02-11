<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
class IndexController extends Controller
{
    //后台首页的
    public function index(){
    	//取出权限数据
    	//思路：获取登录用户的id,根据该id,获取角色priv_ids数据，再根据priv_ids获取privilege表里面的权限数据；
    	//(1)获取管理员的id
    	$id = Auth::guard('admin')->user()->id;
    	//var_dump($id);exit;
    	//(2)获取角色表里面的priv_ids字段里面的信息；
    	$info =  DB::table("manager as m")->join("role as r",'m.role_id','=','r.id')->where('m.id',$id)->select('priv_ids')->first();//返回一个对象，
    	
    	//echo $priv_ids;exit;
    	try{
    		$priv_ids = $info->priv_ids;
    		//正常的管理员，取出正常的权限数据
    		$priv_ids  =  explode(',', $priv_ids);
    		$privA = DB::table('privilege')->whereIn('id',$priv_ids)->where('level_name',0)->get();
    		$privB = DB::table('privilege')->whereIn('id',$priv_ids)->where('level_name',1)->get();

    	}catch(\Exception $e){
    		if($id==1){
    			//超级管理员
    			$privA = DB::table('privilege')->where('level_name',0)->get();
    			$privB = DB::table('privilege')->where('level_name',1)->get();

    		}else {
    			//未分配角色的管理员
    			$privA=[];
    			$privB=[];
    		}
    	}
    	//dd($privA);
    	//加载视图
    	return view('admin.index.index',compact('privA','privB'));
    }
    //加载welcome的视图的方法
    public function welcome(){
    	return view('admin.index.welcome');
    }
}
