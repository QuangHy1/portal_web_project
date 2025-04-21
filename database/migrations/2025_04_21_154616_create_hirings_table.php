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
        Schema::create('hirings', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('salary_range_id')->nullable()->constrained('salary_ranges')->onDelete('set null');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('set null');
            $table->foreignId('vacancy_id')->nullable()->constrained('vacancies')->onDelete('set null');
            $table->foreignId('job_category_id')->constrained('job_categories')->onDelete('cascade');
            $table->foreignId('job_type_id')->constrained('job_types')->onDelete('cascade');
            $table->foreignId('experience_id')->constrained('experiences')->onDelete('cascade');
            $table->text('tags')->nullable();
            $table->string('deadline');
            $table->string('education');
            $table->string('gender');
            $table->string('isfeatured')->default('no');
            $table->string('isBoosted')->default('no');
            $table->string('status')->default('active');
            $table->string('token');
            $table->timestamps();

            // Lưu ý: Cột 'location', 'salary', 'category', 'type', 'experiance'
            // sẽ được thay thế bằng các cột khóa ngoại tương ứng.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hirings');
    }
};
