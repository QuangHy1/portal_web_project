<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ExperiencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('experiences')->insert([
            [
                'name' => '1 năm',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-09 13:17:29'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:16:29'),
            ],
            [
                'name' => '2 năm',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:16:38'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:16:51'),
            ],
            [
                'name' => '3 năm',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:16:47'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:17:23'),
            ],
            [
                'name' => '4 năm',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:17:05'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:17:05'),
            ],
            [
                'name' => 'Từ 5 năm trở lên',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:17:13'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:17:13'),
            ],
            [
                'name' => 'Không yêu cầu',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:17:13'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-23 11:17:13'),
            ],
        ]);
    }
}
