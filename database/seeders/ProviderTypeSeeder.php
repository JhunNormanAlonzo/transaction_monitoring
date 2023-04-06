<?php

namespace Database\Seeders;

use App\Models\ProviderType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProviderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ProviderType::create([
            'type_description' => 'Government School',
            'discount_rate' => 0.00
        ]);

        ProviderType::create([
            'type_description' => 'Public School',
            'discount_rate' => 0.00
        ]);

        ProviderType::create([
            'type_description' => 'Public Terminals',
            'discount_rate' => 0.00
        ]);

        ProviderType::create([
            'type_description' => 'LGU - Prov/City Hall',
            'discount_rate' => 0.00
        ]);

        ProviderType::create([
            'type_description' => 'LGU - Park',
            'discount_rate' => 0.00
        ]);

        ProviderType::create([
            'type_description' => 'Hospital',
            'discount_rate' => 0.00
        ]);

    }
}
