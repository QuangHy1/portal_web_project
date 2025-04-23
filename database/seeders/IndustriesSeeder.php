<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('industries')->insert([
            [
                'name' => 'Công Nghệ Thông Tin',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-01 13:24:33'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:30:41'),
            ],
            [
                'name' => 'Chăm Sóc Sức Khỏe',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:30:49'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:30:49'),
            ],
            [
                'name' => 'Quốc Phòng An Ninh',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:30:57'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:30:57'),
            ],
            [
                'name' => 'Công Nghiệp Ô Tô',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:05'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:05'),
            ],
            [
                'name' => 'Hàng tiêu dùng',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:17'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:17'),
            ],
            [
                'name' => 'Du Lịch Lữ Hành',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:24'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:24'),
            ],
            [
                'name' => 'Tài Chính Ngân Hàng',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:31'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:31'),
            ],
            [
                'name' => 'Viễn Thông',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:36'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:36'),
            ],
            [
                'name' => 'Phương Tiện Truyền Thông',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:44'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:31:44'),
            ],
            [
                'name' => 'Phần Mềm Máy Tính',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:32:03'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:32:03'),
            ],
            [
                'name' => 'Bảo Hiểm',
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:32:54'),
                'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-02 02:32:54'),
            ],
        ]);
    }
}
