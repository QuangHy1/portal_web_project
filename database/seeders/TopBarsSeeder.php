<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopBarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('top_bars')->insert([
            'topbar_contact' => '0359109999',
            'topbar_center_text' => 'Giảm giá 10% cho dịch vụ...',
            'isHidden' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
