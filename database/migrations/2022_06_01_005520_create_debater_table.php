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
        Schema::create('debater', function (Blueprint $table) {
            //討論ID
            $table->id('d_id')->primary();
            //ルームID
            $table->foreign('r_id')->on('room')->references('r_id');
            //ユーザーID
            $table->foreign('u_id')->on('users')->references('u_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debater');
    }
};
