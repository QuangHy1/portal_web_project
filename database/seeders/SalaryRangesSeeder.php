<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaryRangesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('salary_ranges')->insert([
            ['name' => '2 triệu VND- 3 triệu VND'],
            ['name' => '3 triệu VND- 5 triệu VND'],
            ['name' => '5 triệu VND- 8 triệu VND'],
            ['name' => '8 triệu VND- 10 triệu VND'],
            ['name' => 'Trên 10 triệu VND'],
        ]);
    }
}
