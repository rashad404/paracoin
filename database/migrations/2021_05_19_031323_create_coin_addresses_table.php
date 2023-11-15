<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_addresses', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('address', 20)->unique();
            $table->string('password', 256);
            $table->decimal('balance', 16, 6)->unsigned()->default(0);
            $table->string('name', 30)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('phone', 15)->nullable();
            $table->tinyInteger('status')->unsigned()->default('1');
            $table->integer('time')->unsigned();
            $table->integer('update_time')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_addresses');
    }
}
