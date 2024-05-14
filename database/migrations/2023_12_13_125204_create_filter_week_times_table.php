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
        Schema::create('filter_week_times', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->comment("Haftada kaç gün ders istiyor ‘Haftada Bir, İki, Üç ve Fazlar");
            $table->integer('add_user_id')->comment("Bu datayı ekleyen Süper adminin id si");
            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filter_week_times');
    }
};
