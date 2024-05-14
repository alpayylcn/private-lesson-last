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
        Schema::create('step_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('step_questions')->comment("Adımlarda öğrencilere sorulacak sorular");
            $table->integer('option_id')->comment("Öğrenci sorularına göre çekilecek opsiyonlar");
            $table->string('model_type',255)->default('Lesson')->comment("opsiyonun hangi modele ait olduğunu belirtir.");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('step_options');
    }
};
