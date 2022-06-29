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
            //履歴ID
            $table->id('rh_id')->comment('履歴ID');
            //タイトルID 外部参照(title)->column(t_id)
            $table->foreignId('title_id')->constrained('title');
            //ルームID 外部参照(room)->column(r_id)
            $table->foreignId('room_id')->constrained('room');
            //日付
            $table->date('rh_day')->comment('ディベートの日付');
            //人数
            $table->integer('rh_sum')->comment('参加した人数');
            //勝ち負けフラグ
            $table->boolean('rh_win')->comment('勝敗');
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
