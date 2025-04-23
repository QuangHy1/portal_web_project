<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User (role_id = 1)
        DB::table('users')->insert([
            'username' => 'admin1',
            'email' => 'leequanghuy21k3@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('huy123'), // Mật khẩu là "huy123"
            'role_id' => 1,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Editor Users (role_id = 2)
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'username' => 'editor' . $i,
                'email' => 'editor' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('huy123'), // Mật khẩu là "huy123"
                'role_id' => 2,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Employer Users (role_id = 3)
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'username' => 'employer' . $i,
                'email' => 'employer' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('huy123'), // Mật khẩu là "huy123"
                'role_id' => 3,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Employee Users (role_id = 4)
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'username' => 'employee' . $i,
                'email' => 'employee' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('huy123'), // Mật khẩu là "huy123"
                'role_id' => 4,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
