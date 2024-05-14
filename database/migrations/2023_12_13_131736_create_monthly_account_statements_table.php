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
        Schema::create('monthly_account_statements', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment("Hareket Kime Ait");
            $table->decimal('total_spent_money', 10, 2)->default(0.00)->comment("Yapılan toplam harcama");
            $table->decimal('total_added_money', 10, 2)->default(0.00)->comment("Eklenen toplam kredi");
            $table->string('daily',255)->comment("Gün");
            $table->string('mounth',255)->comment("Ay");
            $table->string('year',255)->comment("Yıl");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_account_stattements');
    }
};
