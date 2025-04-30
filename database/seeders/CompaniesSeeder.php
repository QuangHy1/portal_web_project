<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'Google',
                'description' => 'Công ty công nghệ hàng đầu thế giới.',
                'website' => 'https://www.google.com',
                'logo' => '1745981742_google.png',
                'location' => 'California, USA',
                'company_email' => 'contact@google.com',
            ],
            [
                'name' => 'Microsoft',
                'description' => 'Tập đoàn phần mềm lớn nhất thế giới.',
                'website' => 'https://www.microsoft.com',
                'logo' => 'microsoft.png',
                'location' => 'Washington, USA',
                'company_email' => 'hr@microsoft.com',
            ],
            [
                'name' => 'SweetSoft Company',
                'description' => 'Công ty cổ phần Sweet Soft',
                'website' => 'https://www.sweetsoft.vn/',
                'logo' => 'sweetsoft.jpg',
                'location' => 'Ho Chi Minh, Viet Nam',
                'company_email' => 'info@sweetsoft.vn',
            ],
            [
                'name' => 'Infoundation Software',
                'description' => 'Công ty phần mềm Infoundation Software',
                'website' => 'https://infounđdation.com/en',
                'logo' => 'home.png',
                'location' => 'Ha Noi, Viet Nam',
                'company_email' => 'info@infoundation.vn',
            ],
            [
                'name' => 'Vietcombank',
                'description' => 'Ngân hàng thương mại cổ phần Ngoại thương Việt Nam',
                'website' => 'https://www.vietcombank.com.vn/',
                'logo' => 'vietcombank.png',
                'location' => 'Viet Nam',
                'company_email' => 'tuyendung@vietcombank.com.vn',
            ],
            [
                'name' => 'Techcombank',
                'description' => 'Ngân hàng Thương mại cổ phần Kỹ Thương Việt Nam',
                'website' => 'https://techcombank.com/',
                'logo' => 'techcombank.png',
                'location' => 'Viet Nam',
                'company_email' => 'tuyendung@teechcombank.com.vn',
            ],
            [
                'name' => 'Vinmec',
                'description' => 'Dịch vụ y tế thuộc tập đoàn VinGroup.',
                'website' => 'https://www.vinmec.com/vie/',
                'logo' => 'vinmec.png',
                'location' => 'Nha Trang, Viet Nam',
                'company_email' => 'recruit@vinmec.com',
            ],
            [
                'name' => 'Tam Tri HOSPITAL',
                'description' => 'Bệnh Viện Đa Khoa Tâm Trí',
                'website' => 'https://bvtamtrinhatrang.com.vn/',
                'logo' => 'tamtri.png',
                'location' => 'Nha Trang, Viet Nam',
                'company_email' => 'recruit@tamtrihospital.com',
            ],
            [
                'name' => 'Manulife',
                'description' => 'Công ty bảo hiểm hàng đầu Viet Nam.',
                'website' => 'https://www.manulife.com.vn/',
                'logo' => 'manulife.png',
                'location' => 'Huế, Viet Nam',
                'company_email' => 'careers@manulife.com.vn',
            ],
            [
                'name' => 'Prudential',
                'description' => 'Công ty bảo hiểm nhân thọ Prudential uy tín.',
                'website' => 'https://www.prudential.com.vn/vi/',
                'logo' => 'prudential.png',
                'location' => 'London, England',
                'company_email' => 'info@prudential.com.vn',
            ],
        ]);
    }
}
