<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Stream;
class VideoController extends Controller
{
    //进入直播间的
    public function play(Request $request,Stream $stream){
    	//生成拉流地址、
    	//rtmp://<RTMPPlayDomain>/<Hub>/<StreamKey>
    	 $host =  'pili-live-rtmp.www.hanguophp.cn';
    	 $space =  'zhibo0001';//直播空间名称
    	 $stream_name = $stream->stream_name;//获取直播流的名称；
    	 //生成拉流地址
    	 $url = 'rtmp://'.$host.'/'.$space.'/'.$stream_name;
    	 return view('home.video.play',compact('url'));

    }
}
