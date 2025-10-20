<?php

namespace Database\Seeders;

use App\Models\ImpactVideo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Roundi',
            'email' => 'roundi_tracker@gmail.com',
            'phone' => '+254 724-555-020',
            'password' => Hash::make('password'), // ⚠️ replace with env('ADMIN_PASSWORD') in production
        ]);

        $this->call([
           AdminUserSeeder::class,
        ]);
    }
}
