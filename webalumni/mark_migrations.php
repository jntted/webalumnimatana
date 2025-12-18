<?php

// Mark pending migrations as ran without executing them

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$pendingMigrations = [
    '2025_12_16_180121_create_study_programs_table',
    '2025_12_16_180123_create_students_table',
    '2025_12_16_180236_create_profiles_table',
    '2025_12_16_180259_create_education_history_table',
    '2025_12_16_180307_create_work_experience_table',
    '2025_12_16_180316_create_tracer_studies_table',
    '2025_12_16_180324_create_forum_posts_table',
    '2025_12_16_185153_create_lecturers_table',
    '2025_12_16_205141_create_teacher_table',
    '2025_12_18_120000_improve_tracer_studies_table'
];

echo "Marking pending migrations as ran...\n";

foreach ($pendingMigrations as $migration) {
    // Check if migration exists in migrations table
    $exists = DB::table('migrations')->where('migration', $migration)->exists();
    
    if (!$exists) {
        // Insert as batch 12 (next batch)
        DB::table('migrations')->insert([
            'migration' => $migration,
            'batch' => 12
        ]);
        echo "✓ Marked as ran: $migration\n";
    } else {
        echo "⚠ Already marked: $migration\n";
    }
}

echo "\n✓ Done! All pending migrations marked as ran.\n";
echo "\nVerifying status...\n";

// Show current migration status
$status = DB::table('migrations')
    ->where('batch', '>=', 11)
    ->orderBy('batch')
    ->get();

foreach ($status as $row) {
    echo "{$row->migration} - Batch {$row->batch}\n";
}
