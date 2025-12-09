<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
    {
        // 1. Table Students
        Schema::create('students', function (Blueprint $table) {
            $table->foreignId('user_id')->primary()->constrained('users')->onDelete('cascade');
            $table->string('nim')->unique()->nullable();
            $table->foreignId('study_program_id')->nullable()->constrained('study_programs')->onDelete('set null');
            $table->integer('entry_year')->nullable();
            $table->integer('current_semester')->nullable();
        });

        // 2. Table Lecturers
        Schema::create('lecturers', function (Blueprint $table) {
            $table->foreignId('user_id')->primary()->constrained('users')->onDelete('cascade');
            $table->string('nidn')->unique()->nullable(); // NIDN
            // Homebase prodi
            $table->foreignId('department_id')->nullable()->constrained('study_programs')->onDelete('set null');
            $table->string('expertise')->nullable()->comment('Bidang keahlian');
        });

        // 3. Table Alumni
        Schema::create('alumni', function (Blueprint $table) {
            $table->foreignId('user_id')->primary()->constrained('users')->onDelete('cascade');
            $table->string('nim')->unique()->nullable(); // NIM saat mahasiswa
            $table->integer('graduation_year')->nullable();
            $table->foreignId('study_program_id')->nullable()->constrained('study_programs')->onDelete('set null');
            $table->string('nik')->nullable()->comment('Data sensitif untuk tracer');
            $table->string('npwp')->nullable()->comment('Data sensitif untuk tracer');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alumni');
        Schema::dropIfExists('lecturers');
        Schema::dropIfExists('students');
    }
};
