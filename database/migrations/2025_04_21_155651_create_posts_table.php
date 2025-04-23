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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('editor_id')->constrained('editors')->onDelete('cascade'); // Người chỉnh sửa bài viết (đã đổi bảng)
            $table->text('title');
            $table->text('slug');
            $table->text('content');
            $table->text('status')->nullable();
            $table->text('image');
            $table->text('view_count');
            $table->text('category')->nullable();
            $table->text('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
