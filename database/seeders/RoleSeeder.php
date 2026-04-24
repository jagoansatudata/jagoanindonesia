<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample users with different roles
        $users = [
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => UserRole::USER,
                'is_admin' => false,
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => UserRole::ADMIN,
                'is_admin' => true,
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
                'role' => UserRole::SUPERADMIN,
                'is_admin' => true,
            ],
        ];

        foreach ($users as $userData) {
            // Check if user already exists
            $existingUser = User::where('email', $userData['email'])->first();
            
            if (!$existingUser) {
                User::create($userData);
                $this->command->info("Created {$userData['name']} ({$userData['email']}) with role {$userData['role']->getDisplayName()}");
            } else {
                // Update existing user to have role
                $existingUser->update([
                    'role' => $userData['role'],
                    'is_admin' => $userData['is_admin'],
                ]);
                $this->command->info("Updated {$existingUser->name} with role {$userData['role']->getDisplayName()}");
            }
        }

        // Update existing admin users to have admin role if they don't have a role yet
        User::whereNull('role')->where('is_admin', true)->update([
            'role' => UserRole::ADMIN,
        ]);

        // Update existing regular users to have user role if they don't have a role yet
        User::whereNull('role')->where('is_admin', false)->update([
            'role' => UserRole::USER,
        ]);

        $this->command->info('Role seeding completed successfully!');
    }
}
