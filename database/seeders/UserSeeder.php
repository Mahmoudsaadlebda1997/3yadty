<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@3yadaty.com',
            'user_type' => 'ADMIN',
            'password' => Hash::make('12345678'),
        ]);
    }
}
