<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'description' => 'this is admin role'
        ]);

        Role::create([
            'name' => 'access provider',
            'description' => 'access provider'
        ]);

        Role::create([
            'name' => 'superadmin',
            'description' => 'Super Admin'
        ]);
    }
}
