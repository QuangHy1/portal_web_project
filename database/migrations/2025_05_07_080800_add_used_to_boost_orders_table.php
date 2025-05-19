<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('boost_orders', function (Blueprint $table) {
            $table->unsignedInteger('used')->default(0)->after('package_id'); // hoặc sau cột phù hợp khác
        });
    }

    public function down(): void
    {
        Schema::table('boost_orders', function (Blueprint $table) {
            $table->dropColumn('used');
        });
    }
};
