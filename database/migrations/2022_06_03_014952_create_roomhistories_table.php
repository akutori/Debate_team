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
        Schema::create('roomhistories', function (Blueprint $table) {
            //履歴ID
            $table->id('rh_id')->comment('履歴ID');
            //カラム名:title_id 参照カラム:t_id 参照テーブル:title
            $table->unsignedBigInteger('title_id');
            $table->foreign('title_id')->references('t_id')->on('titles');
            //カラム名:room_id 参照カラム:r_id 参照テーブル:room
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('r_id')->on('rooms');
            //日付
            $table->date('rh_day')->comment('ディベートの日付');
            //人数
            $table->integer('rh_sum')->comment('参加した人数');
            //勝ち負けフラグ
            $table->boolean('rh_win')->comment('勝敗');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roomhistories');
    }
};
