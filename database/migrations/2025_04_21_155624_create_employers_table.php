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
        Schema::dropIfExists('employers');
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->constrained('locations')->onDelete('set null');
            $table->string('employer_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('token')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('industry')->nullable();
            $table->string('founded')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('about')->nullable();
            $table->string('hours_monday')->nullable();
            $table->string('hours_tuesday')->nullable();
            $table->string('hours_wednesday')->nullable();
            $table->string('hours_thursday')->nullable();
            $table->string('hours_friday')->nullable();
            $table->string('hours_saturday')->nullable();
            $table->string('hours_sunday')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('github')->nullable();
            $table->timestamps();
            $table->boolean('isverified')->default(false);
            $table->string('isSuspended', 100)->default('no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
