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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->comment("Para birimleri TL, DOLAR, EURO vs.");
            $table->string('code',255)->comment("TRY vs.");
            $table->string('icon',255)->comment("Para birimleri simgeleri ₺, $, € vs.");
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
        Schema::dropIfExists('currencies');
    }
};
