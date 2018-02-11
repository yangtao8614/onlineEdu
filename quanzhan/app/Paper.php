<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $table = 'paper';
    public $timestamps = false;
    //配置与课程的关系，一套试卷属于一个课程，所以是一对一的关系；
    public function course(){
    	return $this->hasOne('App\Course','id','course_id');
    }
}
