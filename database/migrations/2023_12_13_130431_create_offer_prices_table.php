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
        Schema::create('offer_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('offer_id')->comment("öğretmenin öğrenci için verdiği teklifler tablosundan çekilecek  ");
            $table->decimal('price', 10, 2)->default(0.00)->comment("Teklifler için süper adminin belirlediği fiyat");
            $table->integer('currency_id')->comment("Para birimi  ");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_prices');
    }
};
