<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            [
                    'name' => 'Khởi Đầu',
                    'price' => 300,
                    'duration' => 5,
                    'duration_type' => 'day',
                    'jobs_count' => 10,
                    'featured_count' => 2,
                    'photos_count' => 2,
                    'videos_count' => 2,
                    'created_at' =>  now(),
                    'updated_at' => now(),
            ],
                [
                    'name' => 'Premium',
                    'price' => 800,
                    'duration' => 30,
                    'duration_type' => 'day',
                    'jobs_count' => 50,
                    'featured_count' => 10,
                    'photos_count' => 5,
                    'videos_count' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                    ],
        ]
        );
    }
}
