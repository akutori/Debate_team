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
        Schema::create('debaters', function (Blueprint $table) {
            //討論ID
            $table->id('d_id')->comment('討論ID');
            //カラム名:room_id 参照カラム:r_id 参照テーブル:room
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('r_id')->on('rooms');

            //foreignIdを使用してuserテーブルのIDを取得している
            $table->foreignId('user_id')->constrained('users');

            //賛否フラグ 0が賛成
            $table->boolean('d_pd')->comment('賛否フラグ 0が賛成');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debaters');
    }
};
