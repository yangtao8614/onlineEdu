<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Privilege;
class DemoController extends Controller
{
    //
    public function demo(){
        $a = [1,4,200,100];
        echo array_sum($a);
        //echo 5&7;
        /*$action = \Route::current()->getActionName();
        list($controller_name,$action_name)=explode('@', $action);
        echo ltrim(str_replace('Controller','',strrchr($controller_name,'\\')),'\\');*/
       /* echo '<hr>';
        echo $action_name;*/
        //echo str_repeat('---',10);
        //nihao();

        //取出一列数据
       /* $data = Privilege::pluck('priv_name')->toArray();
        echo '<pre>';
        print_r($data);*/
        //echo time();
    	/* $method = 'POST';//请求方式；
    		    $space = 'zhibo0001';//直播空间名称
    		    $path = '/v2/hubs/'.$space.'/streams';//请求的路径
    		    $host = 'pili.qiniuapi.com';
    		    $contentType = 'application/json';
    		    $body = json_encode([
    		    	'key'=>'php3'
    		    ]);
    		    //根据请求包，我们要制作鉴权信息(用于验证请求包在传输中是否被篡改)；
    		    //Authorization: <QiniuToken>
    		    //生成签名字符串；
    		    $data = "$method $path\nHost: $host\nContent-Type: $contentType\n\n$body";
    		   	$ak =  config('filesystems.disks.qiniu.access_key');
    			$sk =  config('filesystems.disks.qiniu.secret_key');
    		    $qiniu = new   \Qiniu\Auth($ak,$sk);//创建一个对象
    		    $token =  "Qiniu ".$qiniu->sign($data);//根据加密字符串生成鉴权消息；
    		    echo $token;*/
    	//获取配置文件里面的内容；
    	//可以使用config函数
    	/*$ak =  config('filesystems.disks.qiniu.access_key');
    	$sk =  config('filesystems.disks.qiniu.secret_key');
    	echo $ak.'-----------'.$sk;*/

    	/*$arr = [
			    ['account_id' => 1, 'product' => 'Desk'],
			    ['account_id' => 2, 'product' => 'Chair'],
			];
		echo  collect($arr)->implode('product',',');  //Desk,Chair*/

		/*$arr = [
			'one'=>['name'=>'宋江'],
			'two'=>['name'=>'李逵'],
			['name'=>'张飞']

		];
		echo collect($arr)->implode('name','---');*/
		/*$arr = [
			['李白','12'],
			['王昭君','18'],
			['李莫愁','20']
		];
		echo collect($arr)->implode(0,',');*/
    }
}
