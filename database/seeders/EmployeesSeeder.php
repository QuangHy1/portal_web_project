<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Lấy id của các employees với role_id = 4, tức là employees được qui định trong bảng roles
        $employeeUserIds = DB::table('users')
            ->where('role_id', 4)
            ->pluck('id')
            ->toArray();
        DB::table('employees')->insert([
            [
                'user_id' => $employeeUserIds[0],
                'location_id' => 4,
                'firstname' => 'Thu',
                'lastname' => 'Hương',
                'designation' => 'Điều Dưỡng',
                'photo' => 'employee1.jpg',
                'website' => 'thuhuong.com',
                'token' => Str::random(32),
                'phone' => '0901231123',
                'address' => '21/03 Trần Hưng Đạo',
                'gender' => 'female',
                'date_of_birth' => Carbon::createFromDate(1999, 10, 30)->format('Y-m-d'),
                'bio' => 'Luôn trách nhiệm trong công việc, có kinh nghiệm 2 năm ở vị trí Điêu Dưỡng',
                'facebook' => 'facebook.com/thuhuong',
                'instagram' => 'instagram.com/thuhuong',
                'github' => 'github.com/thuhuong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $employeeUserIds[1],
                'location_id' => 12,
                'firstname' => 'Trịnh Trần',
                'lastname' => 'Phương Tuấn',
                'designation' => 'Phân tích dữ liệu (Data Analyst)',
                'photo' => 'employee2.jpg',
                'website' => 'phuongtuan.net',
                'token' => Str::random(32),
                'phone' => '0909555555',
                'address' => '23 Võ Thị Sáu',
                'gender' => 'male',
                'date_of_birth' => Carbon::createFromDate(1997, 4, 14)->format('Y-m-d'),
                'bio' => 'Nhu cầu lương 7tr/tháng, 2tr xài, 5tr nuôi con.',
                'facebook' => 'facebook.com/phuongtuan',
                'instagram' => 'instagram.com/phuongtuan',
                'github' => 'github.com/phuongtuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $employeeUserIds[2],
                'location_id' => 1,
                'firstname' => 'Lê',
                'lastname' => 'Chuyên',
                'designation' => 'Lập trình viên web (Web Developer)',
                'photo' => 'employee3.jpg',
                'website' => 'lechuyen.org',
                'token' => Str::random(32),
                'phone' => '0931122334',
                'address' => '789 Nguyễn Trãi, Quận 2',
                'gender' => 'male',
                'date_of_birth' => Carbon::createFromDate(1997, 11, 10)->format('Y-m-d'),
                'bio' => 'Nhà phát triển web sáng tạo có chuyên môn về phát triển front-end và back-end.',
                'facebook' => 'facebook.com/lechuyen',
                'instagram' => 'instagram.com/lechuyen',
                'github' => 'github.com/lechuyen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $employeeUserIds[3],
                'location_id' => 2,
                'firstname' => 'Phạm',
                'lastname' => 'Quỳnh Anh',
                'designation' => 'Thiết kế trạng thái người dùng (UI/UX Designer)',
                'photo' => 'employee4.jpg',
                'website' => 'quynhanh.com',
                'token' => Str::random(32),
                'phone' => '0912345678',
                'address' => '246 Võ Văn Ký, Quận Bình Thạnh',
                'gender' => 'female',
                'date_of_birth' => Carbon::createFromDate(1996, 6, 25)->format('Y-m-d'),
                'bio' => 'Nhà thiết kế UI/UX lấy người dùng làm trung tâm, tập trung vào việc tạo ra những trải nghiệm trực quan và hấp dẫn.',
                'facebook' => 'facebook.com/quynhanh',
                'instagram' => 'instagram.com/quynhanh',
                'github' => 'github.com/quynhanh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $employeeUserIds[4],
                'location_id' => 31,
                'firstname' => 'Tuyết',
                'lastname' => 'Trinh',
                'designation' => 'Quản lý dự án (Project Manager)',
                'photo' => 'employee5.jpg',
                'website' => 'tuyettrinh.net',
                'token' => Str::random(32),
                'phone' => '0987136687',
                'address' => '21/1 Tây Hải, Vĩnh Nguyên',
                'gender' => 'female',
                'date_of_birth' => Carbon::createFromDate(2000, 10, 5)->format('Y-m-d'),
                'bio' => 'Có kinh nghiệm 3 năm ở trị trí quản lý dự án, đam mê cosplay',
                'facebook' => 'facebook.com/tuyettrinh',
                'instagram' => 'instagram.com/tuyettrinh',
                'github' => 'github.com/tuyettrinh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
