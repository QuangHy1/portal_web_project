<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeApplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('employee_applications')->insert([
            [
                'employee_id' => 1,
                'hiring_id' => 7,  // Nursing
                'resume_id' => 1,   // Replace with a valid resume_id for employee 1 (or null if applicable)
                'cover_letter' => 'Tôi cảm thấy mình đủ điều kiện để apply vào công việc này. Hãy xem qua CV của tôi nhé, tôi đợi cuộc phỏng vấn giữa chuúng ta.',
                'status' => 'pending',
                'similarityScore' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'hiring_id' => 3,  // Replace with a valid hiring_id
                'resume_id' => 3,   // Replace with a valid resume_id for employee 2 (or null if applicable)
                'cover_letter' => 'Tôi nghĩ CV của mình sẽ đáp ứng được nhu cầu công việc này. Tôi mong sẽ có một buổi phỏng vấn sớm nhất. Trân trọng.',
                'status' => 'pending',
                'similarityScore' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'hiring_id' => 2,  // Replace with a valid hiring_id
                'resume_id' => 4,   // Replace with a valid resume_id for employee 3 (or null if applicable)
                'cover_letter' => 'Với kĩ năng lập trình hiện tại, tôi tự tin có thể pass qua mọi bài kiểm tra phỏng vẫn, hãy cho tôi cơ hội.',
                'status' => 'pending',
                'similarityScore' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5,
                'hiring_id' => 5,  // Replace with a valid hiring_id
                'resume_id' => 6,   // Replace with a valid resume_id for employee 3 (or null if applicable)
                'cover_letter' => 'Tôi đã rất chăm chỉ để có thể làm công việc quản lí dự án ở mọi công việc. Xin hãy đọc qua CV của tôi nhé !',
                'status' => 'pending',
                'similarityScore' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
