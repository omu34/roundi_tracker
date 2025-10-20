<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    // Define the default password as a constant for easy reference
    private const ADMIN_PASSWORD = 'roundi';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'email' => 'roundi_tracker@gmail.com',
            'name'  => 'Roundi',
            'phone' => '+254 724-555-020',
        ];

        User::updateOrCreate(
            ['email' => $admin['email']], // Lookup by email
            [
                'name'              => $admin['name'],
                'phone'             => $admin['phone'],
                // Apply Hash::make() to the constant
                'password'          => Hash::make(self::ADMIN_PASSWORD),
                'avatar'            => null,
                'email_verified_at' => now(),
            ]
        );

        // Optional: Add a confirmation message to the console
        $this->command->info('Admin user created/updated successfully.');
        $this->command->warn('Admin Password is: ' . self::ADMIN_PASSWORD);
    }
}
