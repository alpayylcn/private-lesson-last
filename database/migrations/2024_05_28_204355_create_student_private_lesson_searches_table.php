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
        Schema::create('student_private_lesson_searches', function (Blueprint $table) {
            $table->id();
            $table->string('student_ip',255)->comment("Öğrencinin giriş yaptığı ip adresi")->nullable();
            $table->string('session_id',)->comment("Öğrenciye verilen session")->nullable();
            $table->integer('step_question_id')->comment("Hangi filtreleme adımı")->nullable();
            $table->integer('step_option_id')->comment("Filtreleme adımında verdiği cevap")->nullable();
            $table->boolean('statu_type')->default(false)->comment("Öğrenci kayıtlı = 1, Kayıtlı değil =0 ")->nullable();
            $table->integer('student_id')->comment("Öğrenci kayıtlı ise users tablosundan id si alınacak")->nullable();
            $table->integer('student_city_id')->comment("Öğrencinin ders istediği il")->nullable();
            $table->integer('student_country_town_id')->comment("Öğrencinin ders istediği ilçe")->nullable();
            $table->integer('page_number')->comment("Öğrenci Filtreleme yaparken hangi sayfada kaldı")->nullable();
            $table->boolean('finish_type')->comment("Filtreleme işlemi tamamlandı mı? ")->nullable();
            $table->softDeletes()->comment("Çöp Kutusu");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_private_lesson_searches');
    }
};
