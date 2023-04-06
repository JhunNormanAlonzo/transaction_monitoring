<?php

namespace Database\Seeders;

use App\Models\WifiSite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WifiSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WifiSite::create([
            'site_name' => 'Camalaniugan',
            'equipment' => 'Dito',
            'macaddress' => '123.142.2242',
            'area_id' => rand(1, 24)
        ]);

        WifiSite::create([
            'site_name' => 'Nueva Vizcaya',
            'equipment' => 'PLDT',
            'macaddress' => '423.192.2142',
            'area_id' => rand(1, 24)
        ]);

        WifiSite::create([
            'site_name' => 'Gonzaga',
            'equipment' => 'Smart',
            'macaddress' => '633.964.8405',
            'area_id' => rand(1, 24)
        ]);

        WifiSite::create([
            'site_name' => 'Sta Ana',
            'equipment' => 'Converge',
            'macaddress' => '950.854.7403',
            'area_id' => rand(1, 24)
        ]);

        WifiSite::create([
            'site_name' => 'Aparri',
            'equipment' => 'Data Connect',
            'macaddress' => '865.323.1021',
            'area_id' => rand(1, 24)
        ]);
    }
}
