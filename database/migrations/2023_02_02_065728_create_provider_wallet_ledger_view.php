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
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }

    private function createView() : string{
        return "CREATE OR REPLACE VIEW provider_wallet_ledger AS
                SELECT
                wt.access_provider_id AS access_provider_id,
                wt.trans_date AS trans_date,
                wtt.trans_description AS trans_description,
                lt.load_name AS load_name,
                wt.trans_reference AS reference,
                wt.trans_cpnumber AS cellphone,
                IF(wtt.trans_type = 'CREDIT', wt.trans_amount, 0 - wt.trans_amount) AS amount,
                wt.remarks AS remarks,
                wt.trans_status AS `status`,
                u.name AS encoded_by,
                ua.name AS approved_by
                FROM wallet_transactions wt
                JOIN wallet_transaction_types wtt
                ON wt.wallet_transaction_type_id = wtt.id
                LEFT JOIN load_types lt
                ON wt.load_type_id = lt.id
                LEFT JOIN users u
                ON u.id = wt.user_id
                LEFT JOIN users ua
                ON ua.id = wt.approval_user_id
                ORDER BY wt.trans_date DESC
        ";
    }

    private function dropView() : string {
        return "
            DROP VIEW IF EXISTS `provider_wallet_ledger`
        ";
    }
};
