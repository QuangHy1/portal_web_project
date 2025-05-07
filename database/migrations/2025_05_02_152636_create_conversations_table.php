<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('recipient_id');
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();

            $table->index('sender_id');
            $table->index('recipient_id');

            // Dựa trên logic, sender và recipient có thể là Employee hoặc Employer.
            // Do đó, có lẽ không nên tạo foreign key trực tiếp ở đây,
            // mà quản lý mối quan hệ ở tầng ứng dụng hoặc sử dụng polymorphic relations.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
