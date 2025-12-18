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
        // Add timestamps and unique constraint if not exists
        Schema::table('tracer_studies', function (Blueprint $table) {
            // Check if alumni_id column doesn't have unique constraint
            // Note: This migration ensures the table has proper structure
            if (!Schema::hasColumn('tracer_studies', 'created_at')) {
                $table->timestamps();
            }
            
            // Add unique constraint on alumni_id if not exists (one tracer study per alumni)
            // We'll handle this in the code instead of unique constraint
            // to allow updates without conflicts
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracer_studies', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
