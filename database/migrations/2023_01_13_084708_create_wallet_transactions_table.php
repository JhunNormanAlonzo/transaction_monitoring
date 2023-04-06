<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('access_provider_id');
            $table->integer('wallet_transaction_type_id');
            $table->integer('load_type_id')->nullable();
            $table->dateTime('trans_date')->useCurrent();
            $table->text('trans_reference');
            $table->string('trans_cpnumber')->nullable();
            $table->string('trans_amount');
            $table->text('remarks')->nullable();
            $table->integer('user_id');
            $table->integer('approval_user_id')->nullable();
            $table->uuid('uid')->default(DB::raw('(UUID())'));
            $table->dateTime('approved_at')->nullable();
            $table->string('trans_status')->default('pending');
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
        Schema::dropIfExists('wallet_transactions');
    }
};
