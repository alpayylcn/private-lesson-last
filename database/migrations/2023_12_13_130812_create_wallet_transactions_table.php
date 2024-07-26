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
            $table->foreignId('wallet_id')->constrained('wallets')->onDelete('cascade')->comment("cüzdan id si ");
            $table->decimal('amount', 10, 2)->comment("harcanan miktar");
            $table->integer('currency_id')->comment("Para birimi  ");
            $table->foreignId('reason_id')->constrained('reasons')->onDelete('cascade')->comment("harcama sebebi ");
            $table->string('transaction_type')->nullable(); // "yükleme" veya "harcama" // "expenditure" veya "income"
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

