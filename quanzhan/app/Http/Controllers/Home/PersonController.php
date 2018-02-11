<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Livecourse;
use App\Paper;
use App\Question;
use DB;
class PersonController extends Controller
{
    //展示直播课程的
    public function livecourse(){
    	//取出直播课程，
    	$livecourse = Livecourse::all();//返回值是一个集合对象；
    	/*结构如下；
			[
					对象1
						对象1->live_name  对象1->stream_id  对象1->start_time  .........
					对象2
					对象3
			]

			思路：就是在每个对象里面，添加一个属性，比如是access  如果该值等于1，则表示能进入直播间，如果为0则表示禁止进入直播间（已经结束或未开始）
		*/
		$livecourse->each(function($item){
			//向对象里面，添加一个属性；
			$item->access = $item->is_play_by_time();
		});
		//dd($livecourse);
    	return view('home.person.livecourse',compact('livecourse'));

    }
    //展示试卷
    public function paper(){
    	$paper = Paper::all();
    	return view('home.person.paper',compact('paper'));
    }
    //取出试题的方法；
    public function exam(Request $request,Paper $paper){
    	//根据条件取出试题
    	//(1)取出单选试题
    	$radio =  Question::where('paper_id',$paper->id)->where('question_type',1)->get();
    	//(2)取出复选试题
    	$checkbox=  Question::where('paper_id',$paper->id)->where('question_type',2)->get();
    	return view('home.person.exam',compact('radio','checkbox','paper'));
    }

    //接收试题数据
    public function answer(Request $request,Paper $paper){
    	$data = $request->input('answer_');
    	foreach($data as $k=>$v){
    		$info = Question::find($k);//获取试题的一条记录（一个对象）
    		$res = $info->exam_result(array_sum($v));
    		DB::table('answer')->insertGetId([
    			'paper_id'=>$paper->id,
    			'question_id'=>$k,
    			'stu_id'=>100,
    			'answer_result'=>array_sum($v),
    			'answer_score'=>$res['answer_score'],
    			'right_wrong'=>$res['right_wrong'],
    		]);
    	}
    	//入库完成啦
    	//展示答题结果的一个页面；
    	return redirect('person/result');
    }

    public function result(){
    	//取出数据
    	//取出单选题以及答案数据
    	$radio = Question::where('paper_id',1)->where('question_type',1)->with(['answer'=>function($m){
    			$m->where('stu_id',100);
    	}])->get();
    	//取出多选题以及答案数据
    	$checkbox = Question::where('paper_id',1)->where('question_type',2)->with(['answer'=>function($m){
    			$m->where('stu_id',100);
    	}])->get();
    	return view('home.person.result',compact('radio','checkbox'));
    
    }
}
