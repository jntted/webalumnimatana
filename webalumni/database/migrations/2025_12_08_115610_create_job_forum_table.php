<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Job Vacancies
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); // Siapa yang post
            $table->string('title');
            $table->string('company_name')->nullable();
            $table->string('location')->nullable();
            
            $table->enum('type', [
                'full_time', 'part_time', 'internship', 'contract', 'freelance'
            ])->nullable();
            
            $table->text('description')->nullable();
            $table->string('application_url')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            
            $table->timestamp('created_at')->useCurrent();
        });

        // 2. Forum Posts
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->text('content');
            $table->string('image_url')->nullable()->comment('Foto jalan-jalan atau kegiatan');
            
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('forum_posts');
        Schema::dropIfExists('job_vacancies');
    }
};
