<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployerIdAndExpiresAtToBoostedJobsTable extends Migration
{
    public function up()
    {
        Schema::table('boosted_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('employer_id')->after('hiring_id');
            $table->dateTime('expires_at')->nullable()->after('boosted_at');

            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('boosted_jobs', function (Blueprint $table) {
            $table->dropForeign(['employer_id']);
            $table->dropColumn(['employer_id', 'expires_at']);
        });
    }
}
