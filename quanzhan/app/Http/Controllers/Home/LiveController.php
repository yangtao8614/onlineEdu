<?php

namespace App\Http\Controllers\Home;

use App\Lesson;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LiveController extends Controller
{
    //
    public function detail(Request $request)
    {
        //1.接受数据获取直播流信息
        $id = $request->input('id');
        //2.查询直播流信息
        $lesson = Lesson::where('id', $id)->first();

        //3.拼接拉流地址
        //$pullVideo = "rtmp://pili-live-rtmp.php.sk-school.com/201801140002/".$stream->stream_name;
        $pullVideo = $lesson->video_address;
//    dd($pullVideo);
        //2.传递给视图
        return view('home.live.detail', compact('pullVideo'));
    }
}
