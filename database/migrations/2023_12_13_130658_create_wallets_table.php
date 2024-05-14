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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->comment("Cüzdanın Adı");
            $table->integer('user_id')->comment("Cüzdan sahibi, User tablosundan çekilecek");
            $table->decimal('balance', 10, 2)->default(0.00)->comment("cüzdanda bulunan bakiye");
            $table->integer('currency_id')->comment("Para birimi  ");
            $table->boolean('is_active')->default(true)->comment("Cüzdanın aktif pasif ola durumu ");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
