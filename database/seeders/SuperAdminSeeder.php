<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Check if super admin already exists to avoid duplicates
        if (!User::where('email', 'superadmin@group6.com')->exists()) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@group6.com',
                'password' => Hash::make('SuperAdminPassword123!'), // Use direct string instead of env()
                'role' => 'Admin',
                'is_super_admin' => true,
            ]);
            
            $this->command->info('Super Admin created successfully!');
        } else {
            $this->command->info('Super Admin already exists.');
        }
    }
}