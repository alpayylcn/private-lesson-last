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
        Schema::create('filter_lesson_locations', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->comment("Dersin, öğrenci evinde mi öğretmen evinde mi yoksa online mi yapılacağı");
            $table->string('teacher_title',255)->comment("Öğretmen Profilinde Gösterilecek Başlık");
            $table->integer('add_user_id')->comment("Lokasyon bilgisini ekleyen Süper adminin id si");
            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filter_lesson_locations');
    }
};
