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
        Schema::create('editors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->constrained('locations')->onDelete('set null');
            $table->string('full_name');
            $table->date('date_of_birth')->nullable(); // Ngày sinh
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // Giới tính
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable(); // ảnh đại diện
            $table->unsignedInteger('post_count')->default(0);   // số bài viết
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editors');
    }
};
