<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->decimal('currentBalance', 16, 6)->unsigned();
            $table->decimal('totalDeposited', 16, 6)->unsigned();
            $table->decimal('totalWithdrawn', 16, 6)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}
