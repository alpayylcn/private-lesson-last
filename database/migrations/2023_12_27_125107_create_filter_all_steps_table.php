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
        Schema::create('filter_all_steps', function (Blueprint $table) {
            $table->id(); 
            $table->integer('step')->comment("Filtreleme adım numarası");
            $table->foreignId('step_question_id')->constrained('step_questions')->comment("bu adımda öğrenciye sorulacak soru id si");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filter_all_steps');
    }
};
