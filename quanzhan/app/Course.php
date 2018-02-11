<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    protected $fillable = ['course_name','profession_id','course_price','course_desc','cover_img'];
    //配置与专业的关系，一个课程只能属于 一个专业，所以是一对一的关系
    public function profession(){
    	return $this->hasOne('App\Profession','id','profession_id');
    }
    //配置与课时的关系，一个课程里面有多个课时，所以是一对多的关系；
    public function lesson(){
    	return $this->hasMany('App\Lesson','course_id','id');
    }
}
