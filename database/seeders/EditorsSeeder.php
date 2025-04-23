<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EditorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy id của các users với role_id = 2, tức là editor được qui định trong bảng roles
        $editorUserIds = DB::table('users')
            ->where('role_id', 2)
            ->pluck('id')
            ->toArray();

        DB::table('editors')->insert([
            [
                'user_id' => $editorUserIds[0], // Gán user_id đầu tiên
                'location_id' => 11,
                'full_name' => 'Khang Nguyễn',
                'date_of_birth' => Carbon::createFromDate(2003, 1, 03)->format('Y-m-d'),
                'gender' => 'male',
                'phone' => '0909505222',
                'address' => '21/22 Tây Hải, Vình Nguyên',
                'bio' => 'Làm việc tại vị trí Editor được 2 năm kinh nghiệm',
                'avatar' => 'editor1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $editorUserIds[1], // Gán user_id thứ hai
                'location_id' => 16,
                'full_name' => 'Bảo Trâm',
                'date_of_birth' => Carbon::createFromDate(2003, 5, 15)->format('Y-m-d'),
                'gender' => 'female',
                'phone' => '0909521552',
                'address' => '86 Yết Kiêu, Cầu Đá',
                'bio' => 'Chuyên mọi vị trí, chuyên Editor 5 năm',
                'avatar' => 'editor2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $editorUserIds[2], // Gán user_id thứ ba
                'location_id' => 53,
                'full_name' => 'Đạt Phan',
                'date_of_birth' => Carbon::createFromDate(2003, 1, 01)->format('Y-m-d'),
                'gender' => 'male',
                'phone' => '0901254642',
                'address' => '82/21/2 Lương Định Của, Vĩnh Ngọc',
                'bio' => 'Siêu máy tính Vĩnh Ngọc, chuyên EDITOR gần 3 năm',
                'avatar' => 'editor3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $editorUserIds[3], // Gán user_id thứ tư
                'location_id' => 36,
                'full_name' => 'Anh Kha ',
                'date_of_birth' => Carbon::createFromDate(2003, 12, 24)->format('Y-m-d'),
                'gender' => 'male',
                'phone' => '0359239295',
                'address' => '99/2 Cửa Bé, Vĩnh Trường',
                'bio' => 'Đam mê làm app nhưng thích làm Editor, có kinh nghiệm trên 3 năm cho vị trí Editor',
                'avatar' => 'editor4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $editorUserIds[4], // Gán user_id thứ năm
                'location_id' => 1,
                'full_name' => 'Cao Mỹ Lệ',
                'date_of_birth' => Carbon::createFromDate(1992, 5, 05)->format('Y-m-d'),
                'gender' => 'female',
                'phone' => '0356969696',
                'address' => '69/96 Hồng Lâu Mộng',
                'bio' => '22 tuổi nhưng vị trí nào cũng trải 2 năm, Editor với kinh nghiệm 10 năm',
                'avatar' => 'editor5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
