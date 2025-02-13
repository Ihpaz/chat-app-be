<?php

namespace Database\Seeders;

use App\Models\Auth\User;
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
            'name' => 'admin',
            'email' => 'ihfazm2@gmail.com',
            'nickname' => 'admin',
            'password' => Hash::make('password123'), // Change to a secure password
            'role_id' => 1,
        ]);
    }
}
