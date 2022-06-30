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
        Schema::table('chats', function (Blueprint $table) {
            //

            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('r_id')->on('rooms');
            //カラム名:category_id 参照カラム:c_id 参照テーブル:category
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('c_id')->on('categories');
            //カラム名:title_id 参照カラム:t_id 参照テーブル:title
            $table->unsignedBigInteger('title_id');
            $table->foreign('title_id')->references('t_id')->on('titles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            //
        });
    }
};
