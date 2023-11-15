<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->decimal('maxSupply',16,6)->unsigned();
            $table->decimal('reservedSupply',16,6)->unsigned();
            $table->decimal('availableSupply',16,6)->unsigned();
            $table->decimal('circulatingSupply',16,6)->unsigned();
            $table->integer('marketCap')->length(11)->unsigned();
            $table->decimal('currentPrice',16,6)->unsigned();
            $table->decimal('initialPrice',16,6)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
