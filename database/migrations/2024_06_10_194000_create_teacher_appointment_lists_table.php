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
        Schema::create('teacher_appointment_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade')->comment("Öğrencinin randevu istediği Öğretmen");
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade')->nullable()->comment("Randevu isteyen kayıtlı öğrenci");
            $table->foreignId('unregistered_student_id')->constrained('unregistered_student')->onDelete('cascade')->nullable()->comment("Randevu isteyen kayıtsız öğrenci");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_appointment_lists');
    }
};
