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
        Schema::create('invoice_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address',1000)->comment("Tam adres bilgisi");
            $table->string('zip_code',255)->comment("Posta kodu");
            $table->string('city',255)->comment("Şehir");
            $table->string('country_town',255)->comment("İlçe");
            $table->string('state',255)->comment("Mahalle");
            $table->string('contact_name',255)->comment("Fatura Kimin Adına Olacak");
            $table->string('phone',255)->comment("Telefon numarası");
            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_addresses');
    }
};
