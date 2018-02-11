<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateLivecourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('live_name',64)->notNull()->comment('直播课程名称');
            $table->integer('stream_id')->notNull()->comment('所属直播流');
            $table->string('cover_img',120)->notNull()->default('')->comment('封面图');
            $table->string('live_desc')->notNull()->default('')->comment('直播课程描述');
            $table->integer('start_time')->notNull()->comment('直播开始时间');
            $table->integer('end_time')->notNull()->comment('直播结束时间');
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
        Schema::drop('live_course');
    }
}
