<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PageHomeItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('page_home_items')->insert([
            [
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-05-04 04:17:21'),
                'heading' => 'Tìm Kiếm<span class="theme-cl">Sự Nghiệp Tuyệt Vời</span> Bắt đầu tại đây !',
                'description' => 'Khám phá công việc mơ ước của bạn khắp Việt Nam hơn hàng ngàn danh sách việc làm. Đây có thể là khởi đầu cho một điều gì đó tuyệt vời cho sự nghiệp của bạn.',
                'image' => 'homepage_1682926346.png',
                'job_placeholder' => 'Tiêu đề, Từ khóa hay tên doanh nghiệp',
                'job_button' => 'Tìm Ngay',
                'location_placeholder' => 'Vị Trí',
                'category_placeholder' => 'Việc Làm',
                'job_category_heading' => 'Danh Mục Hàng Đầu',
                'job_category_description' => 'Danh Mục Công Việc Phổ Biến',
                'job_category_status' => 'Show',
            ],
        ]);
    }
}
