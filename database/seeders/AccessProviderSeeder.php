<?php

namespace Database\Seeders;

use App\Models\AccessProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessProvider::create([
            'account_name' => 'JastineCompany',
            'account_address' => 'Cagayan',
            'phone_number' => '09123456789',
            'provider_type' => '2',
            'date_started' => '2023-01-14',
            'map_location' => '123123123123123',
            'area_id' => '1',
            'user_id' => 2,
        ]);

    }
}
