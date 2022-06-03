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
            $table->id('rh_id');
            $table->unsignedBigInteger('t_id');
            $table->unsignedBigInteger('r_id');
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
        Schema::dropIfExists('roomhistories');
    }
};
