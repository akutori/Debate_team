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
            $table->id('r_id');
            //お題ID IDを外部参照しているためunsignedBigIntegerとなっている
            $table->unsignedBigInteger('title_t_id');
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
        Schema::dropIfExists('rooms');
    }
};
