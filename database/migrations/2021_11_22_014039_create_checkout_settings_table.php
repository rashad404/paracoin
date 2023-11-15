<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_settings', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('privateToken')->nullable();
            $table->string('resultUrl')->nullable();
            $table->string('callbackUrl')->nullable();
            $table->boolean('debugMode')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout_settings');
    }
}
