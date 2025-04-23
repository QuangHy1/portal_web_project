<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class JobTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_types')->insert([
            [
                'name' => 'Thưc tập (Internship)',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-09 13:01:47'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-09 13:02:51'),
            ],
            [
                'name' => 'Toàn thời gian (Full Time)',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-06 14:03:56'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-06 14:03:56'),
            ],
            [
                'name' => 'Từ xa (Remote)',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-06 14:04:06'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-06 14:04:06'),
            ],
            [
                'name' => 'Bán thơi gian (Part Time)',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-06 14:04:12'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-06 14:04:12'),
            ],
            [
                'name' => 'Theo hợp đồng (Contract)',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-06 14:04:18'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-06 14:04:18'),
            ],
        ]);
    }
}
