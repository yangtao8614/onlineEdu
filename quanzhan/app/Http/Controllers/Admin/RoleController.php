<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use App\Privilege;
use Validator;
use DB;
class RoleController extends Controller
{
    //角色列表
    public function index(){
    	$role = Role::all();
    	return view('admin.role.index',compact('role'));
    }
    //角色修改
    public function update(Request $request,Role $role){
    	if($request->isMethod('get')){
    		//显示被修改的的表单数据
    		//取出权限数据
    		//取出顶级权限
    		$privA = Privilege::where('level_name','=',0)->get();
    		//取出一级权限
    		$privB = Privilege::where('level_name','=',1)->get();
    		//取出二级权限
    		$privC = Privilege::where('level_name','=',2)->get();
    		//展示出原来的权限ID数据
    		$old_priv_ids =  explode(',',$role->priv_ids);

    		return view('admin.role.update',compact('privA','privB','privC','role','old_priv_ids'));

    	}else if($request->isMethod('post')){
    		//return ['info'=>1];
    		//完成修改的操作
    		//数据验证
    		$rules = [
    			'role_name'=>'required|unique:role,role_name,'.$role->id,
    			'priv_ids'=>'required|array',
    		];
    		$msg = [
    			'role_name.required'=>'角色名称不能为空',
    			'role_name.unique'=>'角色名称已经存在',
    			'priv_ids.required'=>'要选择所属权限',
    			'priv_ids.array'=>'权限数据不合法'
    		];
    		$validator = Validator::make($request->all(),$rules,$msg);
    		if($validator->passes()){
    			//通过数据验证
    			//$role->update($request->all());
    			//it_role表里面的数据如下；  id | role_name | priv_ids | priv_ac
    			$priv_ids  = $request->input('priv_ids');//数组格式，要转换成用逗号分隔的字符串；
    			$priv_ids = implode(',',$priv_ids);
    			//要获取priv_ac数据；
    			$priv_ac = Privilege::whereIn('id',$request->input('priv_ids'))->where('level_name','!=',0)->select(DB::raw("concat(controller_name,'-',action_name) as priv_ac"))->pluck('priv_ac')->toArray();

    			$priv_ac = implode(',', $priv_ac);

    			$res = $role->update([
    				'role_name'=>$request->input('role_name'),
    				'priv_ids'=>$priv_ids,
    				'priv_ac'=>$priv_ac
    			]);

    			if($res){
    				return ['info'=>1];
    			}else {
    				return ['info'=>0,'error'=>'入库失败'];
    			}
    		}else {
    			//未通过数据验证
    			$error = collect($validator->messages())->implode('0',',');
    			return ['info'=>0,'error'=>$error];
    		}
    	}
    }
}
