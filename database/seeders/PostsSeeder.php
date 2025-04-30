<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('posts')->insert([
            [
                'editor_id' => 1,  // Thay thế bằng editor_id hợp lệ
                'title' => 'Tương lai của Trí tuệ nhân tạo trong Phát triển Phần mềm',
                'slug' => 'tuong-lai-cua-tri-tue-nhan-tao-trong-phat-trien-phan-mem',
                'content' => 'Trí tuệ nhân tạo đang nhanh chóng thay đổi diện mạo của phát triển phần mềm. Bài viết này khám phá các xu hướng mới nhất và dự đoán tương lai...',
                'status' => 'published',
                'image' => 'X2B4oAgM5PfixWNCiB92WIGaV0nF8VxO8qd2lTVG.jpg',  // Thay thế bằng đường dẫn thực tế
                'view_count' => '1250',
                'category' => 'Công Nghệ Thông Tin',
                'tags' => 'AI, Phát triển Phần mềm, Công nghệ, IT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'editor_id' => 2,  // Thay thế bằng editor_id hợp lệ
                'title' => 'Làm chủ các Phương pháp Agile để Thành công của Dự án',
                'slug' => 'lam-chu-cac-phuong-phap-agile',
                'content' => 'Các phương pháp Agile đã trở thành thiết yếu để quản lý các dự án phần mềm một cách hiệu quả. Hướng dẫn này cung cấp các mẹo và thực tiễn tốt nhất...',
                'status' => 'published',
                'image' => 'OPtPJcQmBjKW9rHrkkJvdY4EUsmJAIEpqxCG9JG8.jpg',  // Thay thế bằng đường dẫn thực tế
                'view_count' => '890',
                'category' => 'Công Nghệ Thông Tin',
                'tags' => 'Agile, Quản lý Dự án, Phát triển Phần mềm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'editor_id' => 3,  // Thay thế bằng editor_id hợp lệ
                'title' => 'Xu hướng Thương mại điện tử Định hình Tương lai của Bán lẻ',
                'slug' => 'xu-huong-thuong-mai-dien-tu-ban-le',
                'content' => 'Ngành thương mại điện tử liên tục phát triển. Bài viết này xem xét các xu hướng chính đang thay đổi cách chúng ta mua sắm và kinh doanh...',
                'status' => 'published',
                'image' => 'wJf6YtWsG96vJ3fKk2XG4cWiVgyLnv7ojjdk1pww.jpg',  // Thay thế bằng đường dẫn thực tế
                'view_count' => '1500',
                'category' => 'Kinh Doanh Thương Mại',
                'tags' => 'Thương mại điện tử, Bán lẻ, Kinh doanh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'editor_id' => 4,  // Thay thế bằng editor_id hợp lệ
                'title' => 'Những tiến bộ trong Công nghệ Y tế và Nghề nghiệp Chăm sóc Sức khỏe',
                'slug' => 'cong-nghe-y-te-nghe-nghiep-cham-soc-suc-khoe',
                'content' => 'Công nghệ đang cách mạng hóa ngành chăm sóc sức khỏe. Bài đăng này khám phá những tiến bộ mới nhất và các cơ hội nghề nghiệp mới nổi cho các chuyên gia y tế...',
                'status' => 'published',
                'image' => 'v1FrMSrDLCIAhsFRecDu3a5axyGauHH1E2i4enmQ.jpg',  // Thay thế bằng đường dẫn thực tế
                'view_count' => '620',
                'category' => 'Y Học',
                'tags' => 'Chăm sóc Sức khỏe, Công nghệ Y tế, Nghề nghiệp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'editor_id' => 5,  // Thay thế bằng editor_id hợp lệ
                'title' => 'Điều hướng Bối cảnh Biến động của Tài chính và Ngân hàng',
                'slug' => 'dieu-huong-boi-canh-tai-chinh-ngan-hang',
                'content' => 'Lĩnh vực tài chính và ngân hàng đang đối mặt với những thách thức và cơ hội chưa từng có. Bài viết này cung cấp thông tin chi tiết về các xu hướng hiện tại và con đường sự nghiệp...',
                'status' => 'published',
                'image' => '69yerDACkc89LXZZQwjgtVYgH29qKi1wMd1qDanM.jpg',  // Thay thế bằng đường dẫn thực tế
                'view_count' => '980',
                'category' => 'Tài Chính/Ngân Hàng',
                'tags' => 'Tài chính, Ngân hàng, Đầu tư',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
