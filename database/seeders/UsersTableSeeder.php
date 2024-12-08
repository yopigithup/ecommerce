<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            // Admin
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('111'),  // Corrected from 'passward' to 'password'
                'role' => 'Admin',
                'status' => 'active',
            ],

            // User
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('111'),  // Corrected from 'passward' to 'password'
                'role' => 'User',
                'status' => 'active',
            ]
        ]);
    }
}
