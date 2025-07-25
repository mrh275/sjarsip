<?php

namespace Database\Seeders;

use App\Models\Arsip;
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

        User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => Hash::make('password'), // Use bcrypt for hashing
            'role' => 1, // Assuming 1 is the role for admin
        ]);

        User::create([
            'username' => 'staf',
            'name' => 'Staf',
            'password' => Hash::make('staf'), // Use bcrypt for hashing
            'role' => 2, // Assuming 1 is the role for admin
        ]);

        // Arsip::factory(100)->create();
    }
}
