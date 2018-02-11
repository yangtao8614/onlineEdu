<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Privilege;
use Validator;
class PrivilegeController extends Controller
{
    //权限列表
    public function index(){
    	//取出权限数据
    	$data =  Privilege::all()->toArray();//返回的是集合对象，需要转换成数组
    	$priv =  getForamt($data);
    	//echo '<pre>';
    	//print_r($priv);
    	return view('admin.privilege.index',compact('priv'));
    }

    //添加权限
    public function add(Request $request){
    	if($request->isMethod('get')){
    		//展示表单的
    		//取出上一级的权限(条件levle_name!=2)
    		$data = Privilege::where("level_name",'!=',2)->get()->toArray();
    		$priv =  getForamt($data);
    		return view('admin.privilege.add',compact('priv'));
    	}else if($request->isMethod('post')){
    		$rules = [
    			'priv_name'=>'required',
    			'parent_id'=>'required',
    			'level_name'=>'required'
    		];
    		$msg = [
    			'priv_name.required'=>'权限名称不能为空',
    			'parent_id.required'=>'父级权限不能为空',
    			'level_name.required'=>'权限级别不能为空'
    		];
    		$validator = Validator::make($request->all(),$rules,$msg);
    		if($validator->passes()){
    			//通过验证
    			$res = Privilege::create($request->all());
    			if($res){
    				return ['info'=>1];
    			}else {
    				return ['info'=>0,'error'=>'入库失败'];
    			}
    		}else {
    			//未通过验证
    			$error = collect($validator->messages())->implode('0',',');
    			return ['info'=>0,'error'=>$error];
    		}
    	}
    }
}
