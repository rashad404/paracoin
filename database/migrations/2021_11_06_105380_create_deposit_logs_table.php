<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_logs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('address', 20);
            $table->decimal('usdAmount', 16, 6)->unsigned();
            $table->decimal('coinAmount', 16, 6)->unsigned();
            $table->string('note', 100)->nullable();
            $table->string('method', 100)->nullable();
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
        Schema::dropIfExists('deposit_logs');
    }
}
