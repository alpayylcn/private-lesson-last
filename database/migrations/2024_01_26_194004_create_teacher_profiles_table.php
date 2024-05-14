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
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment("user tablosundan gelen kullanıcı id si");
            $table->string('teacher_short_info')->comment("Öğretmen kısa bilgi")->nullable();
            $table->string('teacher_about')->comment("Öğretmen hakkında uzun açıklama")->nullable();
            $table->string('teacher_facility')->comment("Öğretmenin sunduğu imkanlar")->nullable();
            $table->string('teacher_why_lesson')->comment("Öğretmenin neden özel ders verdiği")->nullable();
            $table->string('teacher_experience')->comment("Öğretmenin tecrübeleri")->nullable();
            $table->string('teacher_bring')->comment("Size ne kazandırabilirim ")->nullable();
            $table->string('teacher_about_me')->comment("Hakkımda bilmeniz gerekenler")->nullable();
            $table->string('teacher_lesson_process')->comment("Dersleri nasıl işlerim")->nullable();
            $table->string('teacher_advices')->comment("Ders alacaklara tavsiyeler")->nullable();
            $table->string('teacher_video_link')->comment("kısa tanıtım videosu")->nullable();
            $table->boolean('video_check')->comment("video var mı?")->nullable();
            $table->string('teacher_university')->comment("Mezun olduğu üniveriste")->nullable();
            $table->string('teacher_experience_year')->comment("Öğretmenin tecrübe yılı")->nullable();
            $table->boolean('university_check')->comment("üniversite ve tecrübe yılı yayın onayı")->nullable();
            
            
            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_profiles');
    }
};
