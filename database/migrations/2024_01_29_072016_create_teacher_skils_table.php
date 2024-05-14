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
        Schema::create('teacher_skils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment("user tablosundan gelen kullanıcı id si");
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade')->comment("lessons tablosundan gelen ders id si");
            $table->string('lesson_minute')->comment("Ders süresi")->nullable();
            $table->string('lesson_face_price')->comment("Yüzyüze ders ücreti")->nullable();
            $table->string('lesson_online_price')->comment("Online ders ücreti")->nullable();

            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_skils');
    }
};
