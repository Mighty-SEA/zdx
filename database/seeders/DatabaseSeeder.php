<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            CreateAdminUserSeeder::class,
            NotificationSeeder::class,
            SettingsSeeder::class,
            HomeContentSeeder::class,
            CompanySettingsSeeder::class,
            ServicesSeeder::class,
            PartnerSeeder::class,
            TrackingApiSettingsSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Tambahkan CommoditySeeder
        $this->call(CommoditySeeder::class);
        
        // Tambahkan ZdxTrackingDummySeeder
        // $this->call(ZdxTrackingDummySeeder::class);
    }
}