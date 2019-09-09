<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique()->nullable()->comment('用户名');
            $table->string('nickname',100)->nullable()->comment('昵称');
            $table->tinyInteger('sex')->default(0)->comment('性别(1 男 2 女 0 保密)');
            $table->char('phone', 12)->unique()->nullable()->comment('手机');
            $table->string('email',100)->unique()->nullable()->comment('邮箱');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('photo')->nullable()->comment('头像');
            $table->string('password')->comment('密码');
            $table->text('desc')->nullable()->comment('简介/歇后语');
            $table->ipAddress('ipaddr')->nullable()->comment('ip地址');
            $table->tinyInteger('status')->default(1)->comment('状态(1 正常 2 冻结)');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
