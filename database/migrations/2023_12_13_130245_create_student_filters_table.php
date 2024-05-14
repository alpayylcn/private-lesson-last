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
        Schema::create('student_filters', function (Blueprint $table) {
            $table->id();
            $table->string('student_ip',255)->comment("Öğrencinin giriş yaptığı ip adresi")->nullable();
            $table->integer('lesson_id')->comment("Dersler tablosundan gelen dersin id si")->nullable();
            $table->integer('class_id')->comment("Sınıflar tablosundan gelen sınıfın id si")->nullable();
            $table->integer('filter_lesson_location_id')->comment("Lokasyon tablosundan gelen lokasyon id si")->nullable();
            $table->integer('filter_who_id')->comment("Ders kim için tablosundan gelen who id si")->nullable();
            $table->integer('filter_week_time_id')->comment("Haftada kaç kez ders yapılacak id si")->nullable();
            $table->integer('filter_lesson_time_period_id')->comment("Ne zamana kadar ders yapılacak id si")->nullable();
            $table->integer('filter_lesson_start_time_id')->comment("Ders ne zaman başlayacak id si")->nullable();
            $table->integer('filter_type_id')->comment("Arama tipi id si")->nullable();
            $table->boolean('statu_type')->default(false)->comment("Öğrenci kayıtlı = 1, Kayıtlı değil =0 ")->nullable();
            $table->integer('student_id')->comment("Öğrenci kayıtlı ise users tablosundan id si alınacak")->nullable();
            $table->integer('student_city_id')->comment("Öğrencinin ders istediği il")->nullable();
            $table->integer('student_country_town_id')->comment("Öğrencinin ders istediği ilçe")->nullable();
            $table->integer('page_number')->comment("Öğrenci Filtreleme yaparken hangi sayfada kaldı")->nullable();
            $table->boolean('finish_type')->comment("Filtreleme işlemi tamamlandı mı? ")->nullable();
            $table->timestamps();
            $table->softDeletes()->comment("Çöp Kutusu");
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_filters');
    }
};
