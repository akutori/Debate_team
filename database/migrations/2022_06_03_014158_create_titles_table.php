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
        Schema::create('titles', function (Blueprint $table) {
            //お題ID
            $table->id('t_id')->comment('お題ID');
            //お題名
            $table->string('t_name')->comment('お題名');
            //foreignIdを使用してcategoryのIDを外部参照している
            //$table->foreignId('category_id')->constrained('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titles');
    }
};
