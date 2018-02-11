<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	DB::table('course')->insert([

       		[
       			'course_name'=>'PHP核心编程',
       			'profession_id'=>1,
       			'course_price'=>12.34,
       			'course_desc'=>'非常经典的课程'
       		],
       		[
       			'course_name'=>'LInux环境安装',
       			'profession_id'=>2,
       			'course_price'=>4512.34,
       			'course_desc'=>'非常经典的课程'
       		],
       		[
       			'course_name'=>'PHP文件上传',
       			'profession_id'=>3,
       			'course_price'=>6712.34,
       			'course_desc'=>'非常经典的课程'
       		],

       	]);
    }
}
