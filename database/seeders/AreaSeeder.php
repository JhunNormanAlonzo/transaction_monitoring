<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'name' => 'Pagadian',
            'region_id' => 1
        ]);

        Area::create([
            'name' => 'Cagayan Main',
            'region_id' => 2
        ]);

        Area::create([
            'name' => 'Bukidnon Main',
            'region_id' => 2
        ]);



        Area::create([
            'name' => 'Iligan Main',
            'region_id' => 2
        ]);


        Area::create([
            'name' => 'Gingoog Main',
            'region_id' => 2
        ]);


        Area::create([
            'name' => 'Camiguin Central',
            'region_id' => 2
        ]);


        Area::create([
            'name' => 'Naawan Main',
            'region_id' => 2
        ]);

        Area::create([
            'name' => 'Sugbongcogon Central',
            'region_id' => 2
        ]);

        Area::create([
            'name' => 'Davao North',
            'region_id' => 3
        ]);

        Area::create([
            'name' => 'Davao South',
            'region_id' => 3
        ]);

        Area::create([
            'name' => 'Davao Central',
            'region_id' => 3
        ]);

        Area::create([
            'name' => 'Digos Main',
            'region_id' => 3
        ]);


        Area::create([
            'name' => 'Tagum Central',
            'region_id' => 3
        ]);

        Area::create([
            'name' => 'Malita Central',
            'region_id' => 3
        ]);


        Area::create([
            'name' => 'Davao Oriental',
            'region_id' => 3
        ]);

        Area::create([
            'name' => 'Gensan Main',
            'region_id' => 4
        ]);

        Area::create([
            'name' => 'Butuan Main',
            'region_id' => 5
        ]);

        Area::create([
            'name' => 'Cabadbaran Main',
            'region_id' => 5
        ]);

        Area::create([
            'name' => 'Nasipit Main',
            'region_id' => 5
        ]);
        Area::create([
            'name' => 'San franz',
            'region_id' => 5
        ]);

        Area::create([
            'name' => 'Trento',
            'region_id' => 5
        ]);

        Area::create([
            'name' => 'Surigao',
            'region_id' => 5
        ]);

        Area::create([
            'name' => 'Bayugan',
            'region_id' => 5
        ]);

        Area::create([
            'name' => 'Tandag City',
            'region_id' => 5
        ]);

    }
}
