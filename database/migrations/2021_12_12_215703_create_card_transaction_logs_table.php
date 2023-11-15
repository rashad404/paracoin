<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardTransactionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_transaction_logs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->integer('addressID')->unsigned();
            $table->decimal('amount', 10, 2)->unsigned();
            $table->string('uniquePaymentID', 100)->nullable();
            $table->string('token', 100)->nullable();
            $table->string('type', 100)->nullable();
            $table->json('response')->nullable();
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
        Schema::dropIfExists('card_transaction_logs');
    }
}
