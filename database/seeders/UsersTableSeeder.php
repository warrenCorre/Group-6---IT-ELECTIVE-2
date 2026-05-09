<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // admin
        User::create([
            'name'          => 'Team Manager',
            'email'         => 'admin@team.com',
            'password'      => Hash::make('admin123'),
            'role'          => 'Admin',
            'age'           => 28,
            'bio'           => 'Team administrator with 5+ years of experience in project management.',
            'profile_photo' => null,
        ]);

        // warren
        User::create([
            'name'          => 'Warren Corre',
            'email'         => 'warren@groupni.com',
            'password'      => Hash::make('warren123'),
            'role'          => 'Developer',
            'age'           => 20,
            'bio'           => 'Backend & API architect. Loves optimizing queries and python.',
            'profile_photo' => null,
        ]);

        // che
        User::create([
            'name'          => 'Cherry Ann Cagoco',
            'email'         => 'cherry@groupni.com',
            'password'      => Hash::make('cherry123'),
            'role'          => 'Designer',
            'age'           => 20,
            'bio'           => 'UI/UX with figma, creates intuitive & accessible design systems.',
            'profile_photo' => null,
        ]);

        // alang
        User::create([
            'name'          => 'Ageneth Balahay',
            'email'         => 'ageneth@groupni.com',
            'password'      => Hash::make('alang123'),
            'role'          => 'QA Tester',
            'age'           => 20,
            'bio'           => 'Automation & regression. ensures zero-bug releases, cypress pro.',
            'profile_photo' => null,
        ]);

        // angel
        User::create([
            'name'          => 'Angel Mae Quinlog',
            'email'         => 'angel@groupni.com',
            'password'      => Hash::make('angel123'),
            'role'          => 'Project Manager',
            'age'           => 20,
            'bio'           => 'Agile coach, keeps team aligned and deliverables on track.',
            'profile_photo' => null,
        ]);
    }
}