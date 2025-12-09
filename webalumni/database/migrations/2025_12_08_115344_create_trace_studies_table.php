<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tracer_studies', function (Blueprint $table) {
            $table->id();
            
            // Referensi ke tabel Alumni (yang PK-nya adalah user_id)
            $table->foreignId('alumni_id')
                  ->constrained('alumni', 'user_id') 
                  ->onDelete('cascade');
            
            $table->date('survey_date')->useCurrent();

            // Data Pekerjaan
            $table->enum('status', [
                'bekerja_full_time',
                'bekerja_part_time',
                'wiraswasta',
                'lanjut_pendidikan',
                'tidak_kerja_sedang_cari',
                'belum_memungkinkan_kerja'
            ])->nullable();
            
            $table->string('current_company')->nullable()->comment('Jika bekerja');
            $table->string('current_position')->nullable()->comment('Jika bekerja');

            // Data Historis
            $table->enum('funding_source', [
                'biaya_sendiri',
                'beasiswa_adik',
                'beasiswa_bidikmisi',
                'beasiswa_ppa',
                'beasiswa_afirmasi',
                'beasiswa_swasta',
                'lainnya'
            ])->nullable();

            // Skala Likert (1-5)
            $table->tinyInteger('f21_perkuliahan')->nullable()->comment('Skala 1-5');
            $table->tinyInteger('f22_demonstrasi')->nullable()->comment('Skala 1-5');
            $table->tinyInteger('f23_riset_project')->nullable()->comment('Skala 1-5');
            $table->tinyInteger('f24_magang')->nullable()->comment('Skala 1-5');
            $table->tinyInteger('f25_praktikum')->nullable()->comment('Skala 1-5');
            $table->tinyInteger('f26_kerja_lapangan')->nullable()->comment('Skala 1-5');
            $table->tinyInteger('f27_diskusi')->nullable()->comment('Skala 1-5');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tracer_studies');
    }
};
