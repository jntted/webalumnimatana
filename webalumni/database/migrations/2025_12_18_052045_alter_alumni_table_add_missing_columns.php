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
        Schema::table('alumni', function (Blueprint $table) {
            if (!Schema::hasColumn('alumni', 'graduation_year')) {
                $table->string('graduation_year')->nullable();
            }
            if (!Schema::hasColumn('alumni', 'major')) {
                $table->string('major')->nullable();
            }
            if (!Schema::hasColumn('alumni', 'phone')) {
                $table->string('phone')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            if (Schema::hasColumn('alumni', 'graduation_year')) {
                $table->dropColumn('graduation_year');
            }
            if (Schema::hasColumn('alumni', 'major')) {
                $table->dropColumn('major');
            }
            if (Schema::hasColumn('alumni', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
};
