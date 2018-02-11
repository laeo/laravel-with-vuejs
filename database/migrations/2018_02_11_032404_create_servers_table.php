<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('type'); //服务器类型
            $table->string('primary_ip'); //主IP
            $table->string('internal_iface'); //内网万兆交换机接口
            $table->string('subnet_mask'); //子网掩码
            $table->string('gateway'); //网关
            $table->string('secondary_ip'); //副IP
            $table->string('username'); //用户名
            $table->string('password'); //密码
            $table->string('internal_ip'); //内网IP
            $table->string('ipmi_address'); //IPMI地址
            $table->string('ipmi_username');
            $table->string('ipmi_password');
            $table->string('internal_socket'); //内网插口
            $table->string('external_socket'); //外网插口
            $table->unsignedInteger('price')->default(0); //费用，单位分
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
        Schema::dropIfExists('servers');
    }
}
