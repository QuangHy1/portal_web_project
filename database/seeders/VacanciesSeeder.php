<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacanciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Slot còn trống để tuyển
     */
    public function run(): void
    {
        //
        DB::table('vacancies')->insert([
            ['name' => '1'],
            ['name' => '2'],
            ['name' => '3'],
            ['name' => '4'],
            ['name' => '5+'],
            ['name' => 'Không yêu cầu'],
        ]);
    }
}
