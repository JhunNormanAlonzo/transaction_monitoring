<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AccessProvider;
use App\Models\ProviderType;
use App\Models\Region;
use App\Models\WifiSite;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProviderTypeSeeder::class,
            LoadTypeSeeder::class,
            WalletTransactionTypeSeeder::class,
//            AccessProviderSeeder::class,
//            AccessCodeSeeder::class,
            RegionSeeder::class,
            AreaSeeder::class,
            WifiSiteSeeder::class,
        ]);
    }
}
