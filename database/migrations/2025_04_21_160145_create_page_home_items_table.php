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
        Schema::create('page_home_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('heading');
            $table->text('description')->nullable();
            $table->text('image');
            $table->text('job_placeholder');
            $table->text('job_button');
            $table->text('location_placeholder');
            $table->text('category_placeholder');
            $table->text('job_category_heading');
            $table->text('job_category_description')->nullable();
            $table->text('job_category_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_home_items');
    }
};
