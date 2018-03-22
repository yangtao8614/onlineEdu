<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\Course;
use Validator;
use Storage;

class LessonController extends Controller
{
    //课时列表
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            //展示列表
            $lesson = Lesson::all();
//            dd($lesson->course);
            return view('admin.lesson.index', compact('lesson'));

        } else if ($request->isMethod('post')) {
            //ajax的请求
            //接收传递的start和length
            $offset = $request->input('start');//接收偏移量
            $limit = $request->input('length');//接收每页显示的记录数

            //接收排序的数据
            /*
                    order[0][column]:5
`					order[0][dir]:asc
                    columns[5][data]:teacher_name

            */
            $column = $request->input("order.0.column");
            $order = $request->input('columns.' . $column . '.data');//获取排序的字段
            $orderway = $request->input('order.0.dir');//获取排序的方式
            //接收条件数据
            $datemin = $request->input('datemin');
            $datemax = $request->input('datemax');
            $lesson_name = $request->input('title');

            $data = Lesson::offset($offset)->
            limit($limit)->
            with(['course' => function ($m) {
                $m->with('profession');
            }])->
            where('lesson_name', 'like', "%$lesson_name%")->
            where(function ($query) use ($datemin, $datemax) {
                if ($datemin != '') {
                    $query->where('created_at', '>=', $datemin);
                }
                if ($datemax != '') {
                    $query->where('created_at', '<=', $datemax . ' 23:59:59');
                }
            })->
            orderBy($order, $orderway)->
            get();


            //获取总的记录数
            $count = Lesson::count();
            //根据条件过滤后的总记录数

            $countFiltered = Lesson::where('lesson_name', 'like', "%$lesson_name%")->
            where(function ($query) use ($datemin, $datemax) {
                if ($datemin != '') {
                    $query->where('created_at', '>=', $datemin);
                }
                if ($datemax != '') {
                    $query->where('created_at', '<=', $datemax . ' 23:59:59');
                }
            })->count();
            $info = [
                'draw' => $request->get('draw'),
                'recordsTotal' => $count,
                'recordsFiltered' => $countFiltered,
                'data' => $data,
            ];
            return $info;
        }
    }

    //课时的停用与开启
    public function status(Request $request, Lesson $lesson)
    {
        //$lesson   =    Lesson::find($id);
        //接收状态值,
        $status = $request->input('status');
        $res = $lesson->update(['status' => $status]);
        if ($res) {
            return ['info' => 1];
        } else {
            return ['info' => 0];
        }
    }

    //添加课时的
    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            //展示表单
            //取出课时数据
            $course = Course::all();
            return view('admin.lesson.add', compact('course'));
        } else if ($request->isMethod('post')) {
            //接收提交的表单，完成入库的。
            //数据验证，
            //定义验证规则
            $rules = [
                'lesson_name' => 'required',
                'course_id' => 'required|integer',
                'lesson_length' => 'required|integer',
                'teacher_name' => 'required',
                'status' => 'required|boolean',
                'lesson_desc' => 'required|min:5'
            ];
            //定义错误提示
            $msg = [
                'lesson_name.required' => '课时名称不能为空',
                'course_id.required' => '所属课程不能为空',
                'course_id.integer' => '所属课程数据有误',
                'lesson_length.required' => '课时时长不能为空',
                'lesson_length.integer' => '课时时长数据有误',
                'teacher_name.required' => '讲师名称不能为空',
                'status.required' => '要选择课时的状态',
                'status.boolean' => '状态数据有误',
                'lesson_desc.required' => '课时描述不能为空',
                'lesson_desc.min' => '课时描述至少大于5个字符'

            ];
            $validator = Validator::make($request->all(), $rules, $msg);//返回一个对象
            if ($validator->passes()) {
                //通过验证,入库操作；
                //DB::table('lesson')->insert();
                $res = Lesson::create($request->all());//返回值添加的当前记录封装的对象
                if ($res) {
                    return ['info' => 1];
                } else {
                    return ['info' => 0, 'error' => '入库失败'];
                }
            } else {
                //未通过验证
                //$error =  $validator->messages();//调用对象的messages()方法，输出错误提示;
                $error = collect($validator->messages())->implode('0', ',');
                return ['info' => 0, 'error' => $error];
            }
        }
    }

    //完成上传图片
    public function upimage(Request $request)
    {
        //获取上传的文件
        //$file = $request->file('文件域的名称');
        $file = $request->file('file');
        //$file->isValid() 方法，是判断文件是否上传成功
        if ($file->isValid()) {
            //处理文件了，
            //$file->store('子路径'，存储驱动器的名称);
            //如下的upload是存储驱动的名称，定位的目录是public/uploads目录
            //如下的image是upload存储驱动里面的子目录
            $filename = $file->store('image', 'upload');//返回上传的文件名称
            //return '/uploads/'.$filename;
            //返回一个数组
            return ['info' => '/uploads/' . $filename];
        }
    }

    //完成上传视频
    public function upvideo(Request $request)
    {
        //获取上传的文件
        //$file = $request->file('文件域的名称');
        $file = $request->file('file');
        //$file->isValid() 方法，是判断文件是否上传成功
        if ($file->isValid()) {
            //处理文件了，
            //$file->store('子路径'，存储驱动器的名称);
            //如下的upload是存储驱动的名称，定位的目录是public/uploads目录
            //如下的image是upload存储驱动里面的子目录
            $filename = $file->store('video', 'upload');//返回上传的文件名称
            //return '/uploads/'.$filename;
            //返回一个数组
            return ['info' => '/uploads/' . $filename];
        }
    }

    //播放视频
    public function play(Request $request, Lesson $lesson)
    {
        //$lesson =  Lesson::find(id);
        //加载视图
        return view('admin.lesson.play', compact('lesson'));
    }

    //修改课时的方法
    public function update(Request $request, Lesson $lesson)
    {
        if ($request->isMethod('get')) {
            //显示修改的表单
            //取出课程数据
            $course = Course::all();
            return view('admin.lesson.update', compact('lesson', 'course'));
        } else if ($request->isMethod('post')) {
            //数据验证，通过后完成修改
            //unique:lesson,lesson_name  验证规则中的lesson是表名，lesson_name是表里面的字段，
            //下面的$lesson->id是一个id,表示验证唯一性时排出掉自己；
            $rules = [
                'lesson_name' => 'required|unique:lesson,lesson_name,' . $lesson->id,
                'course_id' => 'required|integer',
                'lesson_length' => 'required|integer',
                'teacher_name' => 'required',
                'status' => 'required|boolean',
                'lesson_desc' => 'required|min:5'
            ];
            //定义错误提示
            $msg = [
                'lesson_name.required' => '课时名称不能为空',
                'lesson_name.unique' => '课时名称已经存在',
                'course_id.required' => '所属课程不能为空',
                'course_id.integer' => '所属课程数据有误',
                'lesson_length.required' => '课时时长不能为空',
                'lesson_length.integer' => '课时时长数据有误',
                'teacher_name.required' => '讲师名称不能为空',
                'status.required' => '要选择课时的状态',
                'status.boolean' => '状态数据有误',
                'lesson_desc.required' => '课时描述不能为空',
                'lesson_desc.min' => '课时描述至少大于5个字符'

            ];
            $validator = Validator::make($request->all(), $rules, $msg);
            if ($validator->passes()) {
                //通过验证；
                //取出旧的图片路径
                $old_cover_img = $lesson->cover_img;
                //接收新的图片路径
                $new_cover_img = $request->input('cover_img');
                if ($old_cover_img != $new_cover_img) {
                    //开始删除了，
                    if ($old_cover_img != '') {
                        //开始删除了
                        $old_cover_img = str_replace('/uploads/', '', $old_cover_img);
                        Storage::disk('upload')->delete($old_cover_img);
                        //注意：  Storage::disk('upload')已经定位到public目录下面的uploads目录里面。所以要把路径中的uploads给去掉；
                        //注意：   /uploads/image/9a01ab067202bd73f6b7ee8babae271b.jpeg
                    }
                }
                //取出旧的视频路径
                $old_video_address = $lesson->video_address;
                //接收新的图片路径
                $new_video_address = $request->input('video_address');
                if ($old_video_address != $new_video_address) {
                    //开始删除了，
                    if ($old_video_address != '') {
                        //开始删除了
                        $old_video_address = str_replace('/uploads/', '', $old_video_address);
                        Storage::disk('upload')->delete($old_video_address);
                        //注意：  Storage::disk('upload')已经定位到public目录下面的uploads目录里面。所以要把路径中的uploads给去掉；
                        //注意：   /uploads/image/9a01ab067202bd73f6b7ee8babae271b.jpeg
                    }
                }
                $res = $lesson->update($request->all());
                if ($res) {
                    return ['info' => 1];
                } else {
                    return ['info' => 0, 'error' => '修改入库失败'];
                }

            } else {
                $error = collect($validator->messages())->implode('0', ',');
                return ['info' => 0, 'error' => $error];
            }

        }
    }

    //删除课时的方法
    public function del(Request $request, Lesson $lesson)
    {
        //取出旧的图片
        $old_cover_img = $lesson->cover_img;
        if ($old_cover_img != '') {
            $old_cover_img = str_replace('/uploads/', '', $old_cover_img);
            Storage::disk('upload')->delete($old_cover_img);
        }
        //取出旧的视频
        $old_video_address = $lesson->video_address;
        if ($old_video_address != '') {
            $old_video_address = str_replace('/uploads/', '', $old_video_address);
            Storage::disk('upload')->delete($old_video_address);
        }
        $res = $lesson->delete();
        if ($res) {
            return ['info' => 1];
        } else {
            return ['info' => 0];
        }
    }

    //批量删除操作
    public function datadel(Request $request)
    {
        //接收传递的id,
        $ids = $request->input('ids');//传递的是一个数组；
        //在laravel里面whereIn的条件直接是数组即可，
        Lesson::whereIn('id', $ids)->get()->each(function ($item) {
            //$item是一个参数，就是集合里面的对象（或者说是一行数据）
            //删除图片附件
            $old_cover_img = $item->cover_img;
            if ($old_cover_img != '') {
                $old_cover_img = str_replace('/uploads/', '', $old_cover_img);
                Storage::disk('upload')->delete($old_cover_img);
            }
            //删除视频附件
            //取出旧的视频
            $old_video_address = $item->video_address;
            if ($old_video_address != '') {
                $old_video_address = str_replace('/uploads/', '', $old_video_address);
                Storage::disk('upload')->delete($old_video_address);
            }
            $item->delete();
        });
        return ['info' => 1];

    }
}
