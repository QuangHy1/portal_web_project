<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminUserId = DB::table('users')
            ->where('role_id', 1)
            ->value('id');

        DB::table('admins')->insert([
            'user_id' => $adminUserId,
            'location_id' => 31,
            'firstname' => 'Quang',
            'lastname' => 'Huy',
            'date_of_birth' => Carbon::createFromDate(2003, 3, 21)->format('Y-m-d'),
            'gender' => 'male',
            'avatar' => 'admin.jpg',
            'phone' => '0359109658',
            'personal_email' => 'huykorea9@gmail.com',
            'address' => '72/12 Đồng Bò, Nha Trang',
            'token' => Str::random(32),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
