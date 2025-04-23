<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class JobCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_categories')->insert([
            [
                'name' => 'Công nghệ thông tin',
                'icon' => 'lni lni-laptop-phone fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:00:49'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 05:54:22'),
            ],
            [
                'name' => 'Truyền thông/Giải trí',
                'icon' => 'lni lni-cloud fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:17:10'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:17:10'),
            ],
            [
                'name' => 'Logistics/Vận chuyển',
                'icon' => 'lni lni-shopify fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:03'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:03'),
            ],
            [
                'name' => 'Dịch vụ kĩ thuật',
                'icon' => 'lni lni-construction fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:34'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:34'),
            ],
            [
                'name' => 'Viễn thông/Mạng máy tính',
                'icon' => 'lni lni-phone-set fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:58'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:58'),
            ],
            [
                'name' => 'Y tế/Dược',
                'icon' => 'lni lni-sthethoscope fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:19:45'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:19:45'),
            ],
            [
                'name' => 'Bảo hiểm',
                'icon' => 'lni lni-money-protection fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:20:17'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:20:17'),
            ],
            [
                'name' => 'Sản phẩm phần mềm',
                'icon' => 'lni lni-layout fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:20:36'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 05:53:42'),
            ],
            [
                'name' => 'Kinh doanh thương mại',
                'icon' => 'lni lni-briefcase fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:20:59'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:20:59'),
            ],
            [
                'name' => 'Giáo dục',
                'icon' => 'lni lni-graduation fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:21:18'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:21:18'),
            ],
            [
                'name' => 'Ngân hàng/Tài chính',
                'icon' => 'lni lni-mastercard fs-lg theme-cl',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:22:02'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:22:02'),
            ],
            [
                'name' => 'In ấn/Đóng gói',
                'icon' => 'lni lni-gallery',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-05 03:40:36'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-05 08:08:02'),
            ],
            [
                'name' => 'Tuyển dụng doanh nghiệp',
                'icon' => 'lni lni-briefcase-2',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-05 03:40:36'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-05 08:08:02'),
            ],
        ]);
    }
}
