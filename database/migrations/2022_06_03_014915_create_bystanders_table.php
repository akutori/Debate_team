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
        Schema::create('bystanders', function (Blueprint $table) {
            //傍観者ID
            $table->id('b_id');
            //ユーザーID IDを外部参照しているためunsignedBigIntegerとなっている
            $table->unsignedBigInteger('user_id');
            //ルームID IDを外部参照しているためunsignedBigIntegerとなっている
            $table->unsignedBigInteger('room_r_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bystanders');
    }
};
