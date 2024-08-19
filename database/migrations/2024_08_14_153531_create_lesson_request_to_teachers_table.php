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
        Schema::create('lesson_request_to_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_request_id')->constrained('lesson_requests')->onDelete('cascade')->comment("lesson_requests tablosundan alınan id");
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade')->comment("users tablosundan öğretmen id si");
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_request_to_teachers');
    }
};
