<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Paper;
use App\Question;
use Validator;
class QuestionController extends Controller
{
    //试题列表
    public function index(Request $request,Paper $paper){
    	$question =  Question::where('paper_id',$paper->id)->get();
    	return view('admin.question.index',compact('question','paper'));
    }

    //添加试题
    public function add(Request $request,Paper $paper){
    	if($request->isMethod('get')){
    		//展示表单
    		return view('admin.question.add',compact('paper'));
    	}else if($request->isMethod('post')){
    		//数据验证；
    		$rules = [
    			'question_name'=>'required',
    			'question_score'=>'required|integer',
    			'question_type'=>'required',
    			'option_a'=>'required',
    			'option_b'=>'required',
    			'option_c'=>'required',
    			'option_d'=>'required',
    			'question_answer'=>'required|array'
    		];

    		$msg = [
    			'question_name.required'=>'试题名称不能为空',
    			'question_score.required'=>'试题的分值不能为空',
    			'question_type.required'=>'要选择试题类型',
    			'option_a.required'=>'选项A不能为空',
    			'option_b.required'=>'选项B不能为空',
    			'option_c.required'=>'选项C不能为空',
    			'option_d.required'=>'选项D不能为空',
    			'question_answer.required'=>'答案不能为空'
    		];
    		$validator = Validator::make($request->all(),$rules,$msg);
    		if($validator->passes()){
    			$data = $request->all();
    			$data['paper_id'] = $paper->id;
    			$data['question_answer']=array_sum($request->input('question_answer'));
    			$res = Question::create($data);
    			if($res){
    				return ['info'=>1];
    			}else {
    				return ['info'=>0,'error'=>'入库失败'];
    			}
    		}else {
    			$error = collect($validator->messages())->implode('0',',');
    			return ['info'=>0];
    		}
    	}
    }
}
