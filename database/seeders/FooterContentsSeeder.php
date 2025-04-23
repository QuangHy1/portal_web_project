<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('footer_contents')->insert([
            'address' => 'Đại học Nha Trang',
            'phone' => '0359106666',
            'email' => 'huy.lq.63cntt@ntu.edu.vn',
            'facebook' => '#',
            'twitter' => '#',
            'instagram' => '#',
            'linkedin' => '#',
            'youtube' => '#',
            'copyright_text' => '© 2025 JobPortal. All rights reserved.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
