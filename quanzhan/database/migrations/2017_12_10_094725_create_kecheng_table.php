<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKechengTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建专业表
        Schema::create('profession', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profession_name',32)->notNull()->comment('专业名称');
            $table->string('cover_img',120)->notNull()->default('')->comment('封面图');
            $table->string('profession_desc')->notNull()->default('')->comment('描述');
            $table->timestamps();
        });
        //创建课程表
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_name',32)->notNull()->comment('课程名称');
            $table->integer('profession_id')->notNull()->comment('课程所属专业的id');
            $table->decimal('course_price',9,2)->notNull()->default(0)->comment('课程的价格');
            $table->string('cover_img',120)->notNull()->default('')->comment('封面图');
            $table->string('course_desc')->notNull()->default('')->comment('课程描述');
            $table->timestamps();
        });
        //创建课时表
        Schema::create('lesson', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lesson_name',32)->notNull()->comment('课时名称');
            $table->integer('course_id')->notNull()->comment('课时所属课程的id');
            $table->integer('lesson_length')->notNull()->default(10)->comment('课时的时长');
            $table->string('cover_img',120)->notNull()->default('')->comment('封面图');
            $table->string('video_address',120)->notNull()->default('')->comment('视频的地址');
            $table->string('teacher_name',32)->notNull()->default('')->comment('讲师描述');
            $table->string('lesson_desc')->notNull()->default('')->comment('课时描述');
            $table->integer('status')->notNull()->default(1)->comment('状态0停用1开启');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profession');
        Schema::drop('course');
        Schema::drop('lesson');
    }
}
