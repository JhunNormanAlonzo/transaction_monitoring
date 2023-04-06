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
        Schema::create('access_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('load_type_id')->nullable();
            $table->integer('wallet_transaction_id')->nullable();
            $table->string('voucher_code')->nullable();
            $table->integer('down_kbps')->nullable();
            $table->integer('up_kbps')->nullable();
            $table->integer('quota_bytes')->nullable();
            $table->integer('duration_mins')->nullable();
            $table->dateTime('loaded_at')->nullable();
            $table->string('status')->nullable();
            $table->tinyText('notes')->nullable();
            $table->integer('created_user_id')->nullable();
            $table->integer('loaded_user_id')->nullable();
            $table->integer('import_log_id')->nullable();
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
        Schema::dropIfExists('access_codes');
    }
};
