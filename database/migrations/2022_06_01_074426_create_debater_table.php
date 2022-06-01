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
            $table->id('d_id');
            //ルームID IDを外部参照しているためunsignedBigIntegerとなっている
            $table->unsignedBigInteger('r_id');
            //ユーザーID IDを外部参照しているためunsignedBigIntegerとなっている
            $table->unsignedBigInteger('u_id');
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
