<?php

namespace Database\Seeders;

use App\Models\LoadType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LoadType::create([
            'load_name' => 'LOAD 5 - 30mins',
            'load_credits' => 30,
            'comments' => 'test',
        ]);

        LoadType::create([
            'load_name' => 'LOAD 10 - 1hr',
            'load_credits' => 60,
            'comments' => 'test',
        ]);

        LoadType::create([
            'load_name' => 'LOAD 50 - 10hrs',
            'load_credits' => 600,
            'comments' => 'test',
        ]);

        LoadType::create([
            'load_name' => 'LOAD 100 - 24hrs',
            'load_credits' => 1440,
            'comments' => 'test',
        ]);
    }
}
