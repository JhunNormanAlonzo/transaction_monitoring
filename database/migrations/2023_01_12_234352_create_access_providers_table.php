<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_providers', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->string('account_address');
            $table->string('phone_number');
            $table->string('provider_type');
            $table->string('date_started');
            $table->text('map_location')->nullable();
            $table->integer('area_id');
            $table->integer('user_id');
            $table->integer('wifi_site_id')->nullable();
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
        Schema::dropIfExists('access_providers');
    }
};
