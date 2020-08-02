<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250)->nullable();
            $table->double('open_balance',8, 2)->nullable();
            $table->dateTime('balance_start_date', 6)->nullable();
            $table->double('current_balance',8, 2)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_boxes');
    }
}
