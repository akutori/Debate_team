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
        Schema::create('rooms', function (Blueprint $table) {
            //ルームID
            $table->id('r_id')->comment('ルームID');
            //カラム名:title_id 参照カラム:t_id 参照テーブル:title
            $table->unsignedBigInteger('title_id');
            $table->foreign('title_id')->references('t_id')->on('titles');
            //日時
            $table->date('r_day')->nullable()->comment('日時');
            //傍観者数
            $table->integer('r_sum')->default(0)->comment('傍観者合計数');
            //肯定投票数
            $table->integer('r_positive')->default(0)->comment('肯定側投票数');
            //否定投票数
            $table->integer('r_denial')->default(0)->comment('否定側投票数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
