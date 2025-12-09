<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Education History
        Schema::create('education_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('institution_name')->nullable();
            $table->string('degree')->nullable()->comment('S1, S2, S3, SMA, dll');
            $table->string('field_of_study')->nullable();
            $table->integer('start_year')->nullable();
            $table->integer('end_year')->nullable()->comment('Null jika masih menempuh');
            $table->text('description')->nullable();
        });

        // 2. Work Experience
        Schema::create('work_experience', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('location')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable()->comment('Null jika pekerjaan saat ini');
            $table->boolean('is_current')->default(false);
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_experience');
        Schema::dropIfExists('education_history');
    }
};
