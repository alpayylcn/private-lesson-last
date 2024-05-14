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
        Schema::create('teacher_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment("user tablosundan gelen kullanıcı id si");
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('mail')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->comment("İl")->nullable();
            $table->string('county')->comment("İlçe")->nullable();
            $table->string('district')->comment("Mahalle")->nullable();
            $table->string('photo')->comment("fotoğraf yolu")->nullable();
            
            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_details');
    }
};
