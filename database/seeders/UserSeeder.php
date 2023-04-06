<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Jhun Norman',
            'middlename' => 'Orata',
            'lastname' => 'Alonzo',
            'name' => 'Jhun Norman Orata Alonzo',
            'email' => 'alonzojhunnorman@gmail.com',
            'password' => bcrypt('admin123'),
            'house_no' => 'house_no',
            'barangay' => 'barangay',
            'municipality' => 'municipality',
            'province' => 'province',
            'gender' => 'male',
            'age' => 25,
            'profile' => 'default.jpg',
            'role_id' => 3
        ]);

        User::create([
            'firstname' => 'Sandra',
            'middlename' => 'A',
            'lastname' => 'Mayormita',
            'name' => 'Sandra A Mayormita',
            'email' => 'sandra@gmail.com',
            'password' => bcrypt('admin123'),
            'house_no' => '123',
            'barangay' => 'Davao',
            'municipality' => 'lallo',
            'province' => 'Davao City',
            'gender' => 'female',
            'age' => 21,
            'profile' => 'default.jpg',
            'role_id' => 1
        ]);

    }
}
