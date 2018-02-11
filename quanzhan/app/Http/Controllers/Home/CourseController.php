<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
class CourseController extends Controller
{
    //课程的详情页面
    public function detail(Request $request,Course $course){
    	return view('home.course.detail',compact('course'));
    }
}
