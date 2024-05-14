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
        Schema::create('filter_whos', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->comment("Ders kimin için olacak ‘Kendim İçin, Öğrencim İçin, Diğer");
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
        Schema::dropIfExists('filter_whos');
    }
};
