<?php

namespace Database\Seeders;

use App\Models\AccessCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessCode::create([
            'load_type_id' => 2,
            'voucher_code' => '92249-31282',
            'duration_mins' => 60,
            'created_user_id' => 1
        ]);

        AccessCode::create([
            'load_type_id' => 2,
            'voucher_code' => '64469-85233',
            'duration_mins' => 60,
            'created_user_id' => 1
        ]);

        AccessCode::create([
            'load_type_id' => 2,
            'voucher_code' => '80604-42196',
            'duration_mins' => 60,
            'created_user_id' => 1
        ]);

        AccessCode::factory(100)->create();
    }
}
