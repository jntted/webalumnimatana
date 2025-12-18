#!/bin/bash

cd "/c/laragon/www/webalumni/webalumni"

# Test TracerStudy model to see the table structure
php artisan tinker <<'EOF'
use App\Models\TracerStudy;
use App\Models\Alumni;

// Check database schema
$columns = \DB::select("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'webalumni' AND TABLE_NAME = 'tracer_studies'");
echo "=== TracerStudy Table Columns ===\n";
foreach ($columns as $col) {
    echo "{$col->COLUMN_NAME}: {$col->DATA_TYPE}\n";
}

// Check existing records
echo "\n=== Existing TracerStudy Records ===\n";
$tracers = TracerStudy::all();
echo "Total records: " . $tracers->count() . "\n";
foreach ($tracers as $tracer) {
    echo "Alumni ID: {$tracer->alumni_id}, Status: {$tracer->status}\n";
}

// Check Alumni records
echo "\n=== Alumni Records ===\n";
$alumni = Alumni::limit(3)->get();
foreach ($alumni as $a) {
    echo "User ID: {$a->user_id}, Name: {$a->name}\n";
}

exit();
EOF
