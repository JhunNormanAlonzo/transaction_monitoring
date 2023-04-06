<?php

namespace Database\Seeders;

use App\Models\WalletTransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletTransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WalletTransactionType::create([
            'trans_description' => 'WALLET RELOAD - CASH',
            'trans_type' => 'CREDIT',
            'approval' => 1,
            'ewalletrans' => 1,
            'providertag' => 1
        ]);

        WalletTransactionType::create([
            'trans_description' => 'WALLET RELOAD - GCASH',
            'trans_type' => 'CREDIT',
            'approval' => 1,
            'ewalletrans' => 1,
            'providertag' => 1
        ]);

        WalletTransactionType::create([
            'trans_description' => 'WALLET RELOAD - BANK DEPOSIT',
            'trans_type' => 'CREDIT',
            'approval' => 1,
            'ewalletrans' => 1,
            'providertag' => 1
        ]);

        WalletTransactionType::create([
            'trans_description' => 'E-LOAD',
            'trans_type' => 'DEBIT',
            'approval' => 1,
            'ewalletrans' => 0,
            'providertag' => 1
        ]);

        WalletTransactionType::create([
            'trans_description' => 'DM - CHARGES',
            'trans_type' => 'DEBIT',
            'approval' => 1,
            'ewalletrans' => 0,
            'providertag' => 0
        ]);

        WalletTransactionType::create([
            'trans_description' => 'CM - REBATES',
            'trans_type' => 'CREDIT',
            'approval' => 1,
            'ewalletrans' => 0,
            'providertag' => 0
        ]);


    }
}
