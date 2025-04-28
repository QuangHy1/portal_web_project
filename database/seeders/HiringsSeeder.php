<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HiringsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hiringsData = [
            // Các bài đăng công việc của Employer id 1 đã đăng
            [
                'title' => 'Tuyển dụng Professional IT Support',
                'description' => 'Chuyên viên hỗ trợ kỹ thuật CNTT thực hiện các công việc xử lý sự cố, đảm bảo khả năng hoạt động ổn định cho máy tính và hệ thống mạng',
                'location_id' => 2, // Gán cứng location_id
                'employer_id' => 1, // Gán cứng employer_id
                'salary_range_id' => 5, // Gán cứng salary_range_id
                'company_id' => 1, // Gán cứng company_id
                'vacancy_id' => 2,
                'job_category_id' => 4, // Gán cứng job_category_id
                'job_type_id' => 2, // Gán cứng job_type_id
                'experience_id' => 2, // Gán cứng experience_id
                'tags' => 'Google, IT, Full Time',
                'deadline' => '2024-12-31',
                'education' => 'Đại học',
                'gender' => 'Không yêu cầu',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tuyển dụng Front-end Developer',
                'description' => 'Thiết kế giao diện website; giao diện phần mềm, ứng dụng trên nền web. Ưu tiên người có kinh nghiệm trong việc viết mã giao diện web HTML5, CSS3, jQuery.',
                'location_id' => 2,
                'employer_id' => 1,
                'salary_range_id' => 2,
                'company_id' => 1,
                'vacancy_id' => 5,
                'job_category_id' => 1,
                'job_type_id' => 2,
                'experience_id' => 2,
                'tags' => 'jQuery, HTML5, CSS3, Full Time',
                'deadline' => '2024-12-31',
                'education' => 'Đại học',
                'gender' => 'Không yêu cầu (All gender)',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Các bài đăng công việc của Employer id 2 đã đăng
            [
                'title' => 'Tuyển dụng Data Analyst',
                'description' => 'Hãy tham gia nhóm của chúng tôi với tư cách là nhà khoa học dữ liệu và làm việc trong các dự án thú vị.',
                'location_id' => 3,
                'employer_id' => 2,
                'salary_range_id' => 5,
                'company_id' => 4,
                'vacancy_id' => 1,
                'job_category_id' => 1,
                'job_type_id' => 3,
                'experience_id' => 3,
                'tags' => 'Python, Machine Learning, Data Analysis, Remote',
                'deadline' => Carbon::now()->addWeeks(6)->format('Y-m-d'),
                'education' => 'Thạc sĩ, Đại học',
                'gender' => 'Nam (male)',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tuyển dụng UX Designer',
                'description' => 'Chúng tôi đang tuyển dụng một nhà thiết kế UX để cải thiện trải nghiệm người dùng.',
                'location_id' =>3,
                'employer_id' => 2,
                'salary_range_id' => 1,
                'company_id' => 4,
                'vacancy_id' => 3,
                'job_category_id' => 1,
                'job_type_id' => 1,
                'experience_id' => 6,
                'tags' => 'UX Research, UX, Prototyping, Intern',
                'deadline' => Carbon::now()->addMonths(1)->format('Y-m-d'),
                'education' => 'Đại học',
                'gender' => 'Không yêu cầu (All gender)',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Các bài đăng công việc của Employer id 3 đã đăng
            [
                'title' => 'Tuyển dụng Marketing Manager',
                'description' => 'Hãy dẫn dắt nhóm tiếp thị của chúng tôi và thúc đẩy doanh nghiệp phát triển hơn.',
                'location_id' => 62,
                'employer_id' => 3,
                'salary_range_id' => 4,
                'company_id' => 5,
                'vacancy_id' => 1,
                'job_category_id' => 11,
                'job_type_id' => 2,
                'experience_id' => 3,
                'tags' => 'Digital Marketing, SEO, Full Time',
                'deadline' => Carbon::now()->addWeeks(8)->format('Y-m-d'),
                'education' => 'Đại học',
                'gender' => 'Nữ (female)',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tuyên dụng Kế toán (Accountant)',
                'description' => 'Chúng tôi đang tìm kiếm một kế toán viên chú trọng đến chi tiết để quản lý tài chính của chúng tôi.',
                'location_id' => 62,
                'employer_id' =>3,
                'salary_range_id' =>3,
                'company_id' => 5,
                'vacancy_id' => 2,
                'job_category_id' => 11,
                'job_type_id' => 2,
                'experience_id' => 2,
                'tags' => 'Accounting, Bank, Full Time',
                'deadline' => Carbon::now()->addWeeks(5)->format('Y-m-d'),
                'education' => 'Đại học',
                'gender' => 'Nữ (female)',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Các bài đăng công việc của Employer id 4 đã đăng
            [
                'title' => 'Tuyển dụng Điều dưỡng (Nursing)',
                'description' => 'Cùng với chúng tôi chăm sóc bệnh nhân với tấm lòng nhiệt huyết với nghề',
                'location_id' => 57,
                'employer_id' => 4,
                'salary_range_id' => 3,
                'company_id' => 7,
                'vacancy_id' => 4,
                'job_category_id' => 6,
                'job_type_id' => 5,
                'experience_id' => 6,
                'tags' => 'Nursing, Hospital, Contract',
                'deadline' => Carbon::now()->addWeeks(7)->format('Y-m-d'),
                'education' => 'Đại học',
                'gender' => 'Không yêu cầu (All gender)',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tuyển dụng Trợ lý cho bác sĩ (Physician assistant)',
                'description' => 'Quản lý hoạt động phòng khám và hỗ trợ hành chính cho bác sĩ chính.',
                'location_id' => 57,
                'employer_id' => 4,
                'salary_range_id' => 5,
                'company_id' => 7,
                'vacancy_id' => 1,
                'job_category_id' => 6,
                'job_type_id' => 5,
                'experience_id' => 4,
                'tags' => 'Physician assistant, Doctor, Contract',
                'deadline' => Carbon::now()->addMonths(1)->format('Y-m-d'),
                'education' => 'Đại học',
                'gender' => 'Không yêu cầu (All gender)',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Các bài đăng công việc của Employer id 5 đã đăng
            [
                'title' => 'Tuyền dụng Sales',
                'description' => 'Tham gia đội ngũ bán hàng của chúng tôi và đạt được mục tiêu bán hàng.',
                'location_id' => 51,
                'employer_id' => 5,
                'salary_range_id' => 3,
                'company_id' => 9,
                'vacancy_id' => 5,
                'job_category_id' => 7,
                'job_type_id' => 4,
                'experience_id' => 6,
                'tags' => 'Sales, Business Development, Part Time',
                'deadline' => Carbon::now()->addMonths(3)->format('Y-m-d'),
                'education' => 'Tốt nghiệp THPT',
                'gender' => 'Nữ (femmale)',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tuyển Chuyên gia nhân sự (Human Resources Specialist)',
                'description' => 'Hãy tham gia nhóm nhân sự của chúng tôi và hỗ trợ nhân viên.',
                'location_id' => 51,
                'employer_id' =>5,
                'salary_range_id' => 5,
                'company_id' => 9,
                'vacancy_id' => 1,
                'job_category_id' => 13,
                'job_type_id' => 2,
                'experience_id' => 3,
                'tags' => 'HR, Recruitment, Employee Relations, Full Time',
                'deadline' => Carbon::now()->addMonths(2)->format('Y-m-d'),
                'education' => 'Đại học',
                'gender' => 'Không yêu cầu (All gender)',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Các bài đăng công việc của Employer id 4 đã đăng
            [
                'title' => 'Tuyển dụng Điều dưỡng (Nursing)',
                'description' => 'Cùng với chúng tôi chăm sóc bệnh nhân với tấm lòng nhiệt huyết với nghề',
                'location_id' => 57,
                'employer_id' => 4,
                'salary_range_id' => 3,
                'company_id' => 7,
                'vacancy_id' => 4,
                'job_category_id' => 6,
                'job_type_id' => 5,
                'experience_id' => 6,
                'tags' => 'Nursing, Hospital, Contract',
                'deadline' => Carbon::now()->addWeeks(7)->format('Y-m-d'),
                'education' => 'Đại học',
                'gender' => 'Không yêu cầu (All gender)',
                'token' => Str::random(32),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('hirings')->insert($hiringsData);
    }
}
