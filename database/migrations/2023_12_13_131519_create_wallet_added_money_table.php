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
        Schema::create('wallet_added_money', function (Blueprint $table) {
            $table->id();
            $table->integer('wallet_id')->comment("Eklenen kredinin hangi cüzdana ait olduğu");
            $table->integer('add_user_id')->comment("Kredinin kim tarafından eklendiği");
            $table->decimal('price', 10, 2)->default(0.00)->comment("Yapılan harcama");
            $table->integer('currency_id')->comment("Para birimi  ");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_added_money');
    }
};
