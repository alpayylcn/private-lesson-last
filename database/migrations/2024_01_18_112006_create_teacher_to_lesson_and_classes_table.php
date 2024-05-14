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
        Schema::create('teacher_to_lesson_and_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment("user tablosundan gelen kullanıcı id si");
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade')->comment("Dersler tablosundan gelen dersin id si")->nullable();
            $table->integer('class_id')->comment("Sınıflar tablosundan gelen sınıfın id si")->nullable();
            $table->integer('teacher_lesson_location_id')->comment("Lokasyon tablosundan gelen lokasyon id si")->nullable();
            
            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_to_lesson_and_classes');
    }
};
