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
        Schema::create('debaters', function (Blueprint $table) {
            //討論ID
            $table->id('d_id')->comment('討論ID');
            //foreignIdを使用してroomテーブルのIDを取得している
            $table->foreignId('room_id')->constrained('room');
            //ルームID IDを外部参照しているためunsignedBigIntegerとなっている
            //$table->unsignedBigInteger('room_r_id');

            //foreignIdを使用してuserテーブルのIDを取得している
            $table->foreignId('user_id')->constrained('user');
            //ユーザーID IDを外部参照しているためunsignedBigIntegerとなっている
            //$table->unsignedBigInteger('user_id');

            //賛否フラグ 0が賛成
            $table->boolean('d_pd')->comment('賛否フラグ 0が賛成');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debaters');
    }
};
