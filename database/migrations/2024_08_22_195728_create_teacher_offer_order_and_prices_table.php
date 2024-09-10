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
        Schema::create('teacher_offer_order_and_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('offer_order')->comment('Kaçıncı teklif'); // Teklif sırası
            $table->unsignedDecimal('offer_price', 10, 2)->comment('teklif ücreti'); // Teklif ücreti
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_offer_order_and_prices');
    }
};
