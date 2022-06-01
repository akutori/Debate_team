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
        Schema::create('room', function (Blueprint $table) {
            //ルームID
            $table->id('r_id')->primary();
            //お題ID
            $table->foreign('t_id')->on('title')->references('t_id');
            //日時
            $table->date('r_day')->nullable();
            //傍観者数
            $table->integer('r_sum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room');
    }
};
