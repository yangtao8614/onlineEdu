<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Stream;
use Validator;
class StreamController extends Controller
{
    //直播流列表
    public function index(){
    	//取出直播流数据
    	$stream  =  Stream::all();
    	return view('admin.stream.index',compact('stream'));

    }
    //添加直播流
    public function add(Request $request){
    	if($request->isMethod('get')){
    		return view('admin.stream.add');
    	}else if($request->isMethod('post')){
    		//数据验证，
    		$rules = [
    			'stream_name'=>'required|unique:stream,stream_name'
    		];

    		$msg = [
    			'stream_name.required'=>'直播流名称不能为空',
    			'stream_name.unique'=>'直播流名称已经存在',
    		];

    		$validator = Validator::make($request->all(),$rules,$msg);
    		if($validator->passes()){
    			//通过验证
    			//(1)把直播流数据同步到七牛云里面，
    		    /*
    		    	POST /v2/hubs/<Hub>/streams
					Host: pili.qiniuapi.com
					Authorization: <QiniuToken>
					Content-Type: application/json
					{
					    "key": "<StreamTitle>"
					}

    		    */
    		    $method = 'POST';//请求方式；
    		    $space = 'zhibo0001';//直播空间名称
    		    $path = '/v2/hubs/'.$space.'/streams';//请求的路径
    		    $host = 'pili.qiniuapi.com';
    		    $contentType = 'application/json';
    		    $body = json_encode([
    		    	'key'=>$request->input('stream_name')
    		    ]);
    		    //根据请求包，我们要制作鉴权信息(用于验证请求包在传输中是否被篡改)；
    		    //Authorization: <QiniuToken>
    		    //生成签名字符串；
    		    $data = "$method $path\nHost: $host\nContent-Type: $contentType\n\n$body";
    		   	$ak =  config('filesystems.disks.qiniu.access_key');
    			$sk =  config('filesystems.disks.qiniu.secret_key');
    		    $qiniu = new  \Qiniu\Auth($ak,$sk);//创建一个对象
    		    $token =  "Qiniu ".$qiniu->sign($data);//根据加密字符串生成鉴权消息；
    		    //利用GuzzleHttp发送请求表
    		    $cli = new \GuzzleHttp\Client();
				$res = $cli->request($method,$host.$path,[
				    'headers'=>[
				        'Authorization'=>$token,
				        'Content-Type'=>'application/json',
				        'Accept-Encoding'=>'gzip',
				        'Content-Length'=>strlen($body),
				        'User-Agent'=>'pili-sdk-go/v2 go1.6 darwin/amd64',
				    	],
			    	'body'=>$body,
				]);
    			//(2)直播流数据入库
    			Stream::create($request->all());
    			return ['info'=>1];
    		}else {
    			//未通过验证
    			$error = collect($validator->messages())->implode('0',',');
    			return ['info'=>0,'error'=>$error];

    		}
    	}
    }
}
