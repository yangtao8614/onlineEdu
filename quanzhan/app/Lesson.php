<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lesson';
    protected $fillable = ['lesson_name','course_id','lesson_length','teacher_name','status','video_address','cover_img','lesson_desc'];

    //配置与课程的关系，一个课时只能属于一个课程，关系是一对一的
    public function  course(){
    	return $this->hasOne('App\Course','id','course_id');
    }
}
