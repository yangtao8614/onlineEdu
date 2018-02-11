<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
class IndexController extends Controller
{
    //首页展示
    public function index(){
    	//取出课程数据
    	$course = Course::with('lesson')->get();
    	return view('home.index.index',compact('course'));
    }
}
