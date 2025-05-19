<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoostedJobsTable extends Migration
{
    public function up()
    {
        Schema::create('boosted_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hiring_id');
            $table->unsignedBigInteger('boost_order_id');
            $table->timestamp('boosted_at')->nullable();
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('hiring_id')->references('id')->on('hirings')->onDelete('cascade');
            $table->foreign('boost_order_id')->references('id')->on('boost_orders')->onDelete('cascade');

            $table->unique('hiring_id'); // Một tin chỉ được boost 1 lần tại một thời điểm
        });
    }

    public function down()
    {
        Schema::dropIfExists('boosted_jobs');
    }
}

