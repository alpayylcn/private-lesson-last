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
        Schema::table('lesson_requests', function (Blueprint $table) {
            $table->unsignedInteger('approval_count')->default(0)->after('approved_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_requests', function (Blueprint $table) {
            $table->dropColumn('approval_count');
        });
    }
};
