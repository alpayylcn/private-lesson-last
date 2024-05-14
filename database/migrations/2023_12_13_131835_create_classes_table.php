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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->comment("Öğrencinin sınıfı ‘1,2,3… TYT, LGS …’ bu sütunda tutuluyor");
            $table->integer('add_user_id')->comment("Sınıf bilgisini ekleyen Süper adminin id si");
            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
