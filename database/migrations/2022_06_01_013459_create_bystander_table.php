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
        Schema::create('bystander', function (Blueprint $table) {
            //傍観者ID
            $table->id('b_id')->primary();
            //ユーザーID
            $table->foreign('u_id')->on('users')->references('u_id');
            //ルームID
            $table->foreign('r_id')->on('room')->references('r_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bystander');
    }
};
