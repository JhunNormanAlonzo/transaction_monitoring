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
        Schema::create('wallet_transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('trans_description');
            $table->string('trans_type');
            $table->boolean('approval')->default(1);
            $table->boolean('ewalletrans')->default(1);
            $table->boolean('providertag')->default(1);
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
        Schema::dropIfExists('wallet_transaction_types');
    }
};
