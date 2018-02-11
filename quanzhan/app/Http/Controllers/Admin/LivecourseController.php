<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Stream;
use App\Livecourse;
use Validator;
class LivecourseController extends Controller
{
    //直播课程列表
    public function index(){
    	//取出直播课程
    	$livecourse =  Livecourse::with('stream')->get();
    	return view('admin.livecourse.index',compact('livecourse'));

    }

    //添加直播课程
    public function add(Request $request){
    	if($request->isMethod('get')){
    		//展示出表单
    		//取出直播流数据
    		$stream = Stream::all();
    		return view('admin.livecourse.add',compact('stream'));
    	}else if($request->isMethod('post')){
    		//数据验证
    		$rules = [
    			'live_name'=>'required',
    			'stream_id'=>'required|integer',
    			'live_desc'=>'required|min:5',
    			'start_time'=>'required',
    			'end_time'=>'required'
    		];
    		$msg = [
    			'live_name.required'=>'直播课程名称不能为空',
    			'stream_id.required'=>'要选择所属直播流',
    			'stream_id.integer'=>'所属直播流不合法',
    			'live_desc.required'=>'描述不能为空',
    			'live_desc.min'=>'描述的字符不能少于5个字符',
    			'start_time'=>'开始时间不能为空',
    			'end_time'=>'结束时间不能为空'
    		];
    		$validator = Validator::make($request->all(),$rules,$msg);
    		if($validator->passes()){
    			//通过验证
    			//Livecourse::create($request->all());
    			$data = $request->all();
    			$data['start_time']= strtotime($request->input('start_time'));
    			$data['end_time']= strtotime($request->input('end_time'));
    			$res = Livecourse::create($data);
    			if($res){
    				return ['info'=>1];
    			}else {
    				return ['info'=>0,'error'=>'入库失败'];
    			}
    		}else {
    			//未通过验证
    			$error = collect($validator->messages())->implode('0',',');
    			return ['info'=>1,'error'=>$error];
    		}
    	}
    }
    //生成推流地址
    public function getPush(Request $request,Livecourse $livecourse,Stream $stream){
        //生成推流地址；
        /*
    rtmp://pili-publish.www.hanguophp.cn/zhibo0001/php1?e=1513219821&token=BItXyIvCVoNgi7yIa0CEy0iZlfUqBWnDmLTTmVtQ:E7tOOdvQ6ibvJ7G7EUAtvVXVRSM=

        */
        $host = 'rtmp://pili-publish.www.hanguophp.cn';//推流地址的域名
        $space =  'zhibo0001';//直播空间名称
        //获取直播流名称
        $stream_name = $stream->stream_name;
        //获取直播课程的过期时间
        $end_time = $livecourse->end_time;
        //path = "/<Hub>/<StreamKey>?e=<ExpireAt>"
        $path =  '/'.$space.'/'.$stream_name.'?e='.$end_time;
        //生成推流凭证；
        $ak =  config('filesystems.disks.qiniu.access_key');
        $sk =  config('filesystems.disks.qiniu.secret_key');
        $qiniu  =  new \Qiniu\Auth($ak,$sk);//调用七牛云的功能包
        $token = $qiniu->sign($path);//生成推流凭证
        //生成推流地址
        $url = $host.$path.'&token='.$token;
        //加载一个视图文件，用于显示推流地址
        return view('admin.livecourse.getPush',compact('url'));

    }
}
