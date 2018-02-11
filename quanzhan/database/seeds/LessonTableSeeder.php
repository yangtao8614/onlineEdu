<?php

use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //填充lesson表里面的数据
        DB::table('lesson')->insert([
        	[
        		'lesson_name'=>'PHP文件上传',
        		'course_id'=>1,
        		'lesson_length'=>20,
        		'teacher_name'=>'李白',
        		'lesson_desc'=>'非常经典的课程'
        	],
        	[
        		'lesson_name'=>'PHP数组',
        		'course_id'=>2,
        		'lesson_length'=>30,
        		'teacher_name'=>'刘备',
        		'lesson_desc'=>'非常经典的课程'
        	],
        	[
        		'lesson_name'=>'ajax的前生今世',
        		'course_id'=>1,
        		'lesson_length'=>10,
        		'teacher_name'=>'曹操',
        		'lesson_desc'=>'非常经典的课程'
        	],
        	[
        		'lesson_name'=>'linux的环境安装',
        		'course_id'=>1,
        		'lesson_length'=>15,
        		'teacher_name'=>'李逵',
        		'lesson_desc'=>'非常经典的课程'
        	],

        ]);
    }
}
