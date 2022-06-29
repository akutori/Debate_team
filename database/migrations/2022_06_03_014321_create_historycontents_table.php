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
        Schema::create('historycontents', function (Blueprint $table) {
            //履歴ID
            $table->id('hc_id')->comment('履歴ID');
            //履歴内容
            $table->string('hc_contents')->nullable()->comment('履歴内容');
            //履歴内容ID
            $table->integer('hc_co_id')->comment('履歴内容ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historycontents');
    }
};
