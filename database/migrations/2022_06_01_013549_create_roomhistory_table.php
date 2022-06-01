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
        Schema::create('roomhistory', function (Blueprint $table) {
            $table->id('rh_id')->primary();
            $table->foreign('t_id')->on('title')->references('t_id');
            $table->foreign('r_id')->on('room')->references('r_id');
            $table->date('rh_day');
            $table->integer('rh_sum');
            $table->boolean('rh_win');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roomhistory');
    }
};
