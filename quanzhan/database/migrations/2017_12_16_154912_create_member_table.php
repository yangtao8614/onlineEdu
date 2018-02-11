<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',32)->notNull()->comment('会员名称');
            $table->string('password')->notNull()->comment('密码');
            $table->string('email')->notNull()->comment('邮箱');
            $table->string('city',12)->notNull()->comment('城市');
            $table->string('address',32)->notNull()->comment('地址');
            $table->string('logo',100)->notNull()->comment('头像');
            $table->string('intro')->notNull()->comment('格言');
            $table->string('company')->notNull()->comment('公司名称');
            $table->string('phone')->notNull()->comment('电话');
            $table->rememberToken();//会自动生成remember_token字段；
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
        Schema::drop('member');
    }
}
