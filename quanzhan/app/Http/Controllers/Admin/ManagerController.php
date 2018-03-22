<?php

namespace App\Http\Controllers\Admin;

use App\Manager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use Validator;
use Auth;
class ManagerController extends Controller
{

    public function index()
    {
        $manager = Manager::all();
//        dd($manager);
        return view('admin.manager.index', compact('manager'));

    }
    //显示登录页面
    public function login(){
    	return view('admin.manager.login');
    }

    //登录验证的方法
    public function login_check(Request $request){
    	//做数据验证，验证用户名不能为空，密码不能为空，验证码正确
    	//captcha 该验证规则是验证验证码是否正确的。
    	$rules = [
    		'username'=>'required|min:2',
    		'password'=>'required|size:6',
    		'code'=>'required|size:4|captcha'
    	];
    	$msg = [
    		'username.required'=>'用户名不能为空',
    		'username.min'=>'用户名最少是2个字符',
    		'password.required'=>'密码不能为空',
    		'password.size'=>'密码长度必须为6位',
    		'code.required'=>'验证码不能为空',
    		'code.captcha'=>'验证码输入不正确'
    	];
    	$validator = Validator::make($request->all(),$rules,$msg);
    	if($validator->passes()){
    			//通过验证了，验证用户名和密码是否正确
    			//Auth::guard('admin');中的admin是config/auth.php配置文件里面配置的验证入口的名称；
    			$res = Auth::guard('admin')->attempt($request->only(['username','password']),$request->has('online'));//返回结果是布尔值，该Auth::guard('admin')->attempt(用户名和密码数组,布尔值是否保存登录状态)验证用户名和密码是否输入正确的。
    			if($res){
    				return redirect('admin/index');
    			}else {
    				return back()->withErrors(['msg'=>'用户名或密码错误']);
    			}
    			//
    	}else {
    		//未通过的
    		return redirect('admin/login')->withErrors($validator);
    	}
    }

    //退出登录的方法；
    public function logout(){
    	Auth::guard('admin')->logout();
    	return redirect('admin/login');
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            //展示表单
            //取出课时数据
            $role = Role::all();
            return view('admin.manager.add', compact('role'));
        } else if ($request->isMethod('post')) {
            //接收提交的表单，完成入库的。
            //数据验证，
            //定义验证规则
            $data = $request->all();
//            return ['data'=>$data];
            $rules = [
                'username' => 'required',
                'password' => 'required',
            ];
            //定义错误提示
            $msg = [
                'username.required' => '用户名不能为空',
                'password.required' => '密码不能为空'

            ];
            $validator = Validator::make($data, $rules, $msg);//返回一个对象
            if ($validator->passes()) {
                //通过验证,入库操作；
                //DB::table('lesson')->insert();
                $data['password'] = bcrypt($data['password']);
                $res = Manager::create($data);//返回值添加的当前记录封装的对象
                if ($res) {
                    return ['info' => 1];
                } else {
                    return ['info' => 0, 'error' => '入库失败'];
                }
            } else {
                //未通过验证
                //$error =  $validator->messages();//调用对象的messages()方法，输出错误提示;
                $error = collect($validator->messages())->implode('0', ',');
                return ['info' => 0, 'error' => $error];
            }
        }
    }
}
