<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ResumesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('resumes')->insert([
            [
                'employee_id' => 1,
                'file_path' => 'path/to/employee1_cv1.pdf',
                'file_name' => 'employee1_cv1.pdf',
                'file_type' => 'application/pdf',
                'title' => 'CV dành cho Điều Dưỡng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 1,
                'file_path' => 'path/to/employee1_cv2.docx',
                'file_name' => 'employee1_cv2.docx',
                'file_type' => 'application/msword',
                'title' => 'CV dành cho Y Tá',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'file_path' => 'path/to/employee2_cv.pdf',
                'file_name' => 'employee2_cv.pdf',
                'file_type' => 'application/pdf',
                'title' => 'CV dành cho Phân Tích Dữ Liệu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'file_path' => 'path/to/employee3_cv1.pdf',
                'file_name' => 'employee3_cv1.pdf',
                'file_type' => 'application/pdf',
                'title' => 'CV dành cho làm Web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 3,
                'file_path' => 'path/to/employee3_cv2.docx',
                'file_name' => 'employee3_cv2.docx',
                'file_type' => 'application/msword',
                'title' => 'CV dành cho Phần Mềm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 5,
                'file_path' => 'path/to/employee5_cv1.pdf',
                'file_name' => 'employee5_cv1.pdf',
                'file_type' => 'application/pdf',
                'title' => 'CV dành cho Manager Job',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
