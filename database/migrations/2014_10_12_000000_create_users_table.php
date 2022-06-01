<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //ユーザーID
            $table->id('u_id')->primary();
            //パスワード
            $table->string('u_pass',15);
            //名前
            $table->string('u_name',10);
            //ユーザー取得ポイント
            $table->integer('u_point',5)->default(0)->nullable();
            //管理者フラグ 1が管理者
            $table->boolean('u_op')->default(0)->nullable();
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
};
