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
        Schema::create('unregistered_students', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable()->comment("Kayıtsız Öğrencinin adı");
            $table->string('surname',255)->nullable()->comment("Kayıtsız Öğrencinin soyadı");
            $table->string('mail',255)->nullable()->comment("Kayıtsız Öğrencinin mail adresi");
            $table->string('phone')->nullable()->comment("Kayıtsız Öğrencinin telefon numarası");
            $table->string('student_ip')->nullable()->comment("Kayıtsız Öğrencinin giriş ip si");
            $table->string('session_id')->nullable()->comment("Kayıtsız Öğrencinin session id si");
            
            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unregistered_students');
    }
};
