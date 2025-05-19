<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Get the IDs of the first 5 users with role_id = 3 (employers)
        $employerUserIds = DB::table('users')
            ->where('role_id', 3)
            ->pluck('id')
            ->toArray();

        DB::table('employers')->insert([
            [
                'user_id' => $employerUserIds[0],
                'company_id' => 1,
                'location_id' => 2,
                'industry_id' => 1,
                'firstname' => 'Thế',
                'lastname' => 'Hiển',
                'phone' => '0359294238',
                'address' => '365/5/1 Dương Quảng Hàm, Quận Gò Vấp',
                'gender' => 'male',
                'date_of_birth' => Carbon::createFromDate(1980, 5, 10)->format('Y-m-d'),
                    'about' => 'HR giàu kinh nghiệm với niềm đam mê thu hút nhân tài.',
                'hours_monday' => '9:00 AM - 5:00 PM',
                'hours_tuesday' => '9:00 AM - 5:00 PM',
                'hours_wednesday' => '9:00 AM - 5:00 PM',
                'hours_thursday' => '9:00 AM - 5:00 PM',
                'hours_friday' => '9:00 AM - 5:00 PM',
                'hours_saturday' => 'Nghỉ',
                'hours_sunday' => 'Nghỉ',
                'facebook' => 'facebook.com/thehien',
                'instagram' => 'instagram.com/thehien',
                'github' => 'github.com/thehien',
                'token' => Str::random(32),
                'isverified' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $employerUserIds[1],
                'company_id' => 4,
                'location_id' =>3 ,
                'industry_id' =>8,
                'firstname' => 'Mỹ',
                'lastname' => 'Tâm',
                'phone' => '0876543210',
                'address' => '84 Cao Bá Quát',
                'gender' => 'female',
                'date_of_birth' => Carbon::createFromDate(1985, 8, 20)->format('Y-m-d'),
                'about' => 'Nhà tuyển dụng tài năng chuyên về các vị trí công nghệ.',
                'hours_monday' => '8:00 AM - 4:00 PM',
                'hours_tuesday' => '8:00 AM - 4:00 PM',
                'hours_wednesday' => '8:00 AM - 4:00 PM',
                'hours_thursday' => '8:00 AM - 4:00 PM',
                'hours_friday' => '8:00 AM - 4:00 PM',
                'hours_saturday' => 'Nghỉ',
                'hours_sunday' => 'Nghỉ',
                'facebook' => 'facebook.com/mytam',
                'instagram' => 'instagram.com/mytam',
                'github' => 'github.com/mytam',
                'token' => Str::random(32),
                'isverified' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $employerUserIds[2],
                'company_id' => 5,
                'location_id' => 62,
                'industry_id' => 7,
                'firstname' => 'David',
                'lastname' => 'Lee',
                'phone' => '0582392492',
                'address' => '6/6/1 Hàng Thong',
                'gender' => 'male',
                'date_of_birth' => Carbon::createFromDate(1975, 12, 1)->format('Y-m-d'),
                'about' => 'Giám đốc nhân sự cấp cao có nhiều kinh nghiệm trong phát triển tổ chức.',
                'hours_monday' => '9:30 AM - 5:30 PM',
                'hours_tuesday' => '9:30 AM - 5:30 PM',
                'hours_wednesday' => '9:30 AM - 5:30 PM',
                'hours_thursday' => '9:30 AM - 5:30 PM',
                'hours_friday' => '9:30 AM - 5:30 PM',
                'hours_saturday' => '10:00 AM - 2:00 PM',
                'hours_sunday' => 'Nghỉ',
                'facebook' => 'facebook.com/davidlee',
                'instagram' => 'instagram.com/davidlee',
                'github' => 'github.com/davidlee',
                'token' => Str::random(32),
                'isverified' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $employerUserIds[3],
                'company_id' => 7,
                'location_id' => 57,
                'industry_id' => 2,
                'firstname' => 'Phương',
                'lastname' => 'Anh',
                'phone' => '0350205235',
                'address' => '23 Lý Thái Tổ',
                'gender' => 'female',
                'date_of_birth' => Carbon::createFromDate(1992, 3, 15)->format('Y-m-d'),
                'about' => 'Chuyên gia nhân sự chuyên sâu về quan hệ nhân viên.',
                'hours_monday' => '8:30 AM - 4:30 PM',
                'hours_tuesday' => '8:30 AM - 4:30 PM',
                'hours_wednesday' => '8:30 AM - 4:30 PM',
                'hours_thursday' => '8:30 AM - 4:30 PM',
                'hours_friday' => '8:30 AM - 4:30 PM',
                'hours_saturday' => 'Nghỉ',
                'hours_sunday' => 'Nghỉ',
                'facebook' => 'facebook.com/phuonganh',
                'instagram' => 'instagram.com/phuonganh',
                'github' => 'github.com/phuonganh',
                'token' => Str::random(32),
                'isverified' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $employerUserIds[4],
                'company_id' => 9,
                'location_id' => 51,
                'industry_id' => 11,
                'firstname' => 'Tống Minh',
                'lastname' => 'Tân',
                'phone' => '0249394293',
                'address' => '77 Đinh Tiên Hoàng',
                'gender' => 'male',
                'date_of_birth' => Carbon::createFromDate(1988, 7, 22)->format('Y-m-d'),
                'about' => 'Quản lý tuyển dụng có mạng lưới quan hệ chặt chẽ trong ngành bảo hiểm.',
                'hours_monday' => '9:00 AM - 6:00 PM',
                'hours_tuesday' => '9:00 AM - 6:00 PM',
                'hours_wednesday' => '9:00 AM - 6:00 PM',
                'hours_thursday' => '9:00 AM - 6:00 PM',
                'hours_friday' => '9:00 AM - 6:00 PM',
                'hours_saturday' => '10:00 AM - 4:00 PM',
                'hours_sunday' => 'Nghỉ',
                'facebook' => 'facebook.com/minhtan',
                'instagram' => 'instagram.com/minhtan',
                'github' => 'github.com/minhtan',
                'token' => Str::random(32),
                'isverified' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
