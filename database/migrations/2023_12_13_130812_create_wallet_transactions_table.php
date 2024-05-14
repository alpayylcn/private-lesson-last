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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('wallet_transaction_type_id')->comment("Hareket türü; kredi yükleme , doping harcama");
            $table->enum('type',['add','spent'])->default('add')->comment("yükleme mi, harcama mı olduğunu belirtir ");
            $table->integer('relation_id')->comment("eğer yükleme type ı varsa  wallet_added_money tablosunun id sini alacak, harcama varsa wallet_movements tablosunun id sini alacak");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
