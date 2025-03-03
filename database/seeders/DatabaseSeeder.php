<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'User 1',
                'email' => 'user1@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
