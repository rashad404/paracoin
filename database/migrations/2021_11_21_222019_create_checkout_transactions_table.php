<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_transactions', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('to', 20);
            $table->string('from', 20)->nullable();
            $table->decimal('amount', 16, 6)->unsigned();
            $table->string('orderToken', 32);
            $table->boolean('customAmount')->default(false);
            $table->string('info', 100)->nullable();
            $table->string('extraData', 100)->nullable();
            $table->boolean('completed')->default(false);
            $table->integer('time')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout_transactions');
    }
}
