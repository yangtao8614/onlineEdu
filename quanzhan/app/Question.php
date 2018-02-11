<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table = 'question';
    public $timestamps = false;
    protected $fillable = ['question_name','paper_id','question_type','question_score','option_a','option_b','option_c','option_d','question_answer'];
    //定义一个静态的数组，用于显示数字与答案的对应关系；
    public static $question_answer=[
   				 '1'=>'A',
   				 '2'=>'B',
   				 '3'=>'AB',
   				 '4'=>'C',
   				 '5'=>'AC',
   				 '6'=>'BC',
   				 '7'=>'ABC',
   				 '8'=>'D',
   				 '9'=>'AD',
   				 '10'=>'BD',
   				 '11'=>'ABD',
   				 '12'=>'CD',
   				 '13'=>'ACD',
   				 '14'=>'BCD',
   				 '15'=>'ABCD'
    ];
    //判断得分情况的；
    //参数就是提交的答案；
    public function exam_result($result){
    	//根据公式来吧
    	//取出正确的答案；
    	$answer = $this->question_answer;
    	if((($answer&$result)==$answer) &&  (($answer&$result)==$result)){
    			//完全正确
    			$data['answer_score']=$this->question_score;
    			$data['right_wrong']='正确';
    	}else if(  ($answer&$result)==$result    ){
    			//半对
    			$data['answer_score']=1;
    			$data['right_wrong']='半对';
    	}else {
    			$data['answer_score']=0;
    			$data['right_wrong']='错误';
    	}
    	return $data;
    }

    //建立一个答案模型的关系，针对某一个学员来说，一道题只有一个答案；
    //试题表与答案表是一对一的关系；
    public function answer(){
    	return $this->hasOne('App\Answer','question_id','id');
    }
}
