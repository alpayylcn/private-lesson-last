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
        Schema::create('step_questions', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->comment("Adımlarda öğrencilere sorulacak sorular");
            $table->integer('rank')->comment("Sorunun kaçıncı adımda çıkacağı");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('step_questions');
    }
};
