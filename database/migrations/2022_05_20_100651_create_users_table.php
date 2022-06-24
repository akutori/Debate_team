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

            $table->bigIncrements('id');
            $table->string('name');
            
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();


            //ユーザーID
           
            
            //名前
  
            //ユーザー取得ポイント
            $table->integer('u_point')->default(0)->nullable();
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
