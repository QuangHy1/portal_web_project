<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('recipient_id');
            $table->boolean('is_read')->default(false);
            $table->text('body')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();

            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->index('conversation_id');
            $table->index('sender_id');
            $table->index('recipient_id');

            // Tương tự, sender và recipient có thể là Employee hoặc Employer.
            // Quản lý mối quan hệ ở tầng ứng dụng hoặc sử dụng polymorphic relations.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
