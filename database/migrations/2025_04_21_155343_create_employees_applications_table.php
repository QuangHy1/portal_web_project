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
        Schema::create('employee_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('hiring_id')->constrained('hirings')->onDelete('cascade'); // Thay job_id bằng hiring_id và tham chiếu đến bảng hirings
            $table->unsignedBigInteger('resume_id'); // Thêm dòng này nếu chưa có
            $table->foreign('resume_id')->references('id')->on('resumes')->onDelete('cascade');
            $table->text('cover_letter')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->integer('similarityScore');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees_applications');
    }
};
