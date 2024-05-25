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
        Schema::create('step_option_titles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('step_questions')->onDelete('cascade');
            $table->string('title');
            $table->string('teacher_title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('step_option_titles');
    }
};
