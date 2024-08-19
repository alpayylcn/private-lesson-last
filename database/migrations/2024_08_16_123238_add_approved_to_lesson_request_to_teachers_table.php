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
        Schema::table('lesson_request_to_teachers', function (Blueprint $table) {
            $table->boolean('approved')->default(false); // Onaylanma durumunu belirten sütun ekleniyor
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_request_to_teachers', function (Blueprint $table) {
            $table->dropColumn('approved');
        });
    }
};
