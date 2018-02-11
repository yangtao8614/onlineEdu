<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',32)->notNull()->comment('管理员名称');
            $table->string('password')->notNull()->comment('密码');
            $table->string('email')->notNull()->comment('邮箱');
            $table->string('city',12)->notNull()->comment('城市');
            $table->string('address',32)->notNull()->comment('地址');
            $table->string('logo',100)->notNull()->comment('头像');
            $table->string('intro')->notNull()->comment('格言');
            $table->string('company')->notNull()->comment('公司名称');
            $table->string('phone')->notNull()->comment('电话');
            $table->integer('role_id')->notNull()->comment('所属角色');
            //$table->rememberToken();会自动生成remember_token字段；
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
        Schema::drop('manager');
    }
}
