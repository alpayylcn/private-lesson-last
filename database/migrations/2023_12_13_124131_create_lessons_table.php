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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->comment("Öğrencinin alabileceği tüm dersler ‘Türkçe, Matematik vs.’ bu sütunda tutuluyor.");
            $table->foreignId('add_user_id')->constrained('users')->comment("Ders bilgisini ekleyen Süper adminin id si");
            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");
            //$table->foreignId('add_user_id')->constrained('users')->onDelete('cascade')->comment("bu sütün ne işe yarıyor yaz? ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
