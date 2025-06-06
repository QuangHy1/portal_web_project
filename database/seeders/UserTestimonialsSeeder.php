<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('user_testimonials')->insert([
            [
                'employee_id' => 2,  // Replace with a valid employee_id
                'designation' => 'Phân tích dữ liệu (Data Analyst)',
                'company' => 'Infoundation Software',
                'image' => 'rksKNNARB8ZGzkC4e5dE16l5WtR7LnV1GMyDM41j.jpg',  // Replace with actual path
                'testimonial' => 'Cổng thông tin việc làm này thật tuyệt vời, tôi đã may mắn tìm thấy công việc ở đây.',
                'isFeatured' => 'yes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,  // Replace with a valid employee_id
                'designation' => 'Front-end Developer',
                'company' => 'Google',
                'image' => 'Y6zhurTYyVEV1pyc9Zo9onQjPv3Yf3n1bWp7droa.png', // Replace with actual path
                'testimonial' => 'Tôi không thể tin được có một ngày mình sẽ có việc làm ở Google,đặc biệt là qua cổng thông tin việc làm này. Rất biết ơn !!',
                'isFeatured' => 'yes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5,  // Replace with a valid employee_id
                'designation' => 'Quản lý dự án (Project Manager)',
                'company' => 'Vietcombank',
                'image' => 'AiW5y8M3EQUZsgkBGNevmtXu2oxUTXHIeiG4B6Rb.png',  // Replace with actual path
                'testimonial' => 'Job Portal như đã cứu lấy tôi vào lúc tôi thất nghiệp. Tôi cảm ơn vì đã tìm thấy cổng thông tin này đúng lúc.',
                'isFeatured' => 'yes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,  // Replace with a valid employee_id
                'designation' => 'Điều dưỡng',
                'company' => 'Vinmec',
                'image' => 'B0TxkeAEkjuuQsinGfxjT2MrB9DIai0tWMyNbb7l.jpg',  // Replace with actual path
                'testimonial' => 'Thật tuyệt vời khi có được công việc trên một trang web. Cái giá đánh đổi quá rẻ !!',
                'isFeatured' => 'yes',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
