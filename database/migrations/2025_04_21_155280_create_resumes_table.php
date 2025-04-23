<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('file_path'); // Đường dẫn đến file CV (ví dụ: trên server hoặc cloud storage)
            $table->string('file_name'); // Tên gốc của file
            $table->string('file_type'); // Loại file (ví dụ: 'pdf', 'docx')
            $table->string('title')->nullable(); // Tiêu đề hoặc mô tả ngắn gọn cho CV (ví dụ: "CV chính", "CV cho vị trí Dev")
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
