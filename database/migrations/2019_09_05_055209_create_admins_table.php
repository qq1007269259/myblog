<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('admin_id')->comment('管理员id');
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
        Schema::create('admin_role', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('主键');
            $table->integer('admin_id')->unique()->comment('管理员id');
            $table->integer('role_id')->unique()->comment('角色id');
            $table->tinyInteger('status')->default(1)->comment('状态(1 正常 2 删除)');
            $table->timestamps();
        });
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('role_id')->comment('角色id');
            $table->integer('admin_id')->unique()->comment('管理员id');
            $table->string('rolename',100)->nullable()->comment('角色名称');
            $table->tinyInteger('status')->default(1)->comment('状态(1 正常 2 删除)');
            $table->timestamps();
        });
        Schema::create('role_pmission', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('主键');
            $table->integer('permission_id')->unique()->comment('权限id');
            $table->integer('role_id')->unique()->comment('角色id');
            $table->tinyInteger('status')->default(1)->comment('状态(1 正常 2 删除)');
            $table->timestamps();
        });
        Schema::create('pmission', function (Blueprint $table) {
            $table->bigIncrements('permission_id')->comment('权限id');
            $table->string('menu_id')->default(0)->comment('菜单id');
            $table->string('menu_name',100)->nullable()->comment('菜单名称');
            $table->string('module_name',100)->nullable()->comment('模块名称');
            $table->string('controller_name',100)->nullable()->comment('控制器名称');
            $table->string('action_name',100)->nullable()->comment('方法名称');
            $table->tinyInteger('status')->default(1)->comment('状态(1 正常 2 删除)');
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
        Schema::dropIfExists('admins');
    }
}
