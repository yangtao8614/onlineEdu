<?php

namespace App\Http\Controllers\Admin;

use App\Profession;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfessionController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            //展示列表
            $profession = Profession::all();
//            dd($profession);
            return view('admin.profession.index', compact('profession'));

        }
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            //展示表单
            //取出课时数据
            $profession = Profession::all();
            return view('admin.profession.add', compact('profession'));
        } else if ($request->isMethod('post')) {
            //接收提交的表单，完成入库的。
            //数据验证，
            //定义验证规则
            $rules = [
                'profession_name' => 'required',
                'profession_desc' => 'required|min:5'
            ];
            //定义错误提示
            $msg = [
                'profession_name.required' => '专业名称不能为空',
                'profession_desc.min' => '专业描述至少大于5个字符'

            ];
            $validator = Validator::make($request->all(), $rules, $msg);//返回一个对象
            if ($validator->passes()) {
                //通过验证,入库操作；
                //DB::table('lesson')->insert();
                $res = Profession::create($request->all());//返回值添加的当前记录封装的对象
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

