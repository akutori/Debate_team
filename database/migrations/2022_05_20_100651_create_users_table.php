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
            $table->bigIncrements('id');
            //名前
            $table->string('name');
            //userパスワード
            $table->string('password');
            //ログイン維持のために必要なトークン
            $table->rememberToken();
            //作成と更新の記録
            $table->timestamps();
            //ユーザー取得ポイント
            $table->integer('u_point')->default(0)->nullable()->comment('ユーザー取得ポイント');
            //管理者フラグ 1が管理者
            $table->boolean('u_op')->default(0)->nullable()->comment('管理者フラグ 1が管理者');
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
