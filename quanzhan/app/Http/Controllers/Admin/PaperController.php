<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Paper;
class PaperController extends Controller
{
    //试卷列表
    public function index(){
    	$paper =  Paper::all();
    	return view('admin.paper.index',compact('paper'));
    }
}
