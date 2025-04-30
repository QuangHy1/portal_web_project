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
                'icon' => 'bx bx-desktop',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:00:49'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 05:54:22'),
            ],
            [
                'name' => 'Truyền thông/Giải trí',
                'icon' => 'bx bxl-deezer',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:17:10'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:17:10'),
            ],
            [
                'name' => 'Logistics/Vận chuyển',
                'icon' => 'bx bxs-car-garage',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:03'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:03'),
            ],
            [
                'name' => 'Dịch vụ kĩ thuật',
                'icon' => 'bx bx-wrench',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:34'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:34'),
            ],
            [
                'name' => 'Viễn thông/Mạng máy tính',
                'icon' => 'bx bx-wifi',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:58'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:18:58'),
            ],
            [
                'name' => 'Y tế/Dược',
                'icon' => 'bx bx-injection',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:19:45'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:19:45'),
            ],
            [
                'name' => 'Bảo hiểm',
                'icon' => 'bx bx-check-shield',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:20:17'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:20:17'),
            ],
            [
                'name' => 'Sản phẩm phần mềm',
                'icon' => 'bx bxs-devices',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:20:36'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 05:53:42'),
            ],
            [
                'name' => 'Kinh doanh thương mại',
                'icon' => 'bx bx-store-alt',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:20:59'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:20:59'),
            ],
            [
                'name' => 'Giáo dục',
                'icon' => 'bx bxs-graduation',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:21:18'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:21:18'),
            ],
            [
                'name' => 'Ngân hàng/Tài chính',
                'icon' => 'bx bxs-bank',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:22:02'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-04 04:22:02'),
            ],
            [
                'name' => 'In ấn/Đóng gói',
                'icon' => 'bx bxs-package',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-05 03:40:36'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-05 08:08:02'),
            ],
            [
                'name' => 'Tuyển dụng doanh nghiệp',
                'icon' => 'bx bx-briefcase',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-05 03:40:36'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-03-05 08:08:02'),
            ],
        ]);
    }
}
