<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_balances', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('addressID')->unsigned();
            $table->decimal('usd', 16, 6)->unsigned()->nullable();
            $table->decimal('azn', 16, 6)->unsigned()->nullable();
            $table->decimal('btc', 16, 6)->unsigned()->nullable();
            $table->decimal('eth', 16, 6)->unsigned()->nullable();
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
        Schema::dropIfExists('deposit_balances');
    }
}
