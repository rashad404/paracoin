<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinStatsArchives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_stats_archives', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('period')->index();
            $table->decimal('price', 16, 6)->default(0);
            $table->decimal('marketCap', 12, 2)->default(0);
            $table->integer('circulatingSupply')->unsigned()->default(0);
            $table->integer('dailyVolume')->unsigned()->default(0);
            $table->integer('monthlyVolume')->unsigned()->default(0);
            $table->integer('totalAddresses')->unsigned()->default(0);
            $table->integer('activeAddresses')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_stats_archives');
    }
}
