<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_type_id')->unsigned()->nullable();
            $table->dateTime('entry_date', 6)->nullable();
            $table->double('debit',8, 2)->nullable();
            $table->double('credit',8, 2)->nullable();
            $table->integer('cash_box_id')->unsigned()->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('financial_entries');
    }
}
