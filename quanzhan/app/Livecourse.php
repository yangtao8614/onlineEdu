<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livecourse extends Model
{
    protected $table = 'live_course';
    protected $fillable = ['live_name','stream_id','live_desc','cover_img','start_time','end_time'];
    //配置与直播流的关系，一个直播课程属于一个直播流是一对一的关系
    public function stream(){
    	return $this->hasOne('App\Stream','id','stream_id');
    }

    //写一个是否进入直播间的方法；
    public function is_play_by_time(){
    	$time = time();//当前的时间戳；
    	if($time>=$this->start_time  &&  $time<$this->end_time){
    			return 1;
    	}
    	return 0;
    }
}
