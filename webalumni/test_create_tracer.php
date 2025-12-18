<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\TracerStudy;
use App\Models\Alumni;
use Illuminate\Support\Facades\DB;

echo "=== Testing TracerStudy Model ===\n\n";

// Get first alumni
$alumni = Alumni::first();

if (!$alumni) {
    echo "❌ No alumni found in database!\n";
    exit;
}

echo "Found Alumni: ID={$alumni->user_id}, Name={$alumni->name}\n\n";

// Try to create a tracer study record
echo "Attempting to create TracerStudy record...\n";

$data = [
    'alumni_id' => $alumni->user_id,
    'survey_date' => now()->toDateString(),
    'status' => 'bekerja_full_time',
    'current_company' => 'Test Company',
    'current_position' => 'Test Position',
    'funding_source' => 'biaya_sendiri',
    'f21_perkuliahan' => 5,
    'f22_demonstrasi' => 4,
    'f23_riset_project' => 4,
    'f24_magang' => 5,
    'f25_praktikum' => 3,
    'f26_kerja_lapangan' => 4,
    'f27_diskusi' => 5,
];

try {
    $tracer = TracerStudy::create($data);
    echo "✓ SUCCESS! Created record with ID: {$tracer->id}\n";
    echo "Data: " . json_encode($tracer->toArray(), JSON_PRETTY_PRINT) . "\n";
} catch (\Exception $e) {
    echo "❌ ERROR creating record:\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}

// Check what's in the table now
echo "\n=== Current TracerStudy Records ===\n";
$records = TracerStudy::all();
echo "Total: " . $records->count() . "\n";
foreach ($records as $rec) {
    echo "- Alumni ID: {$rec->alumni_id}, Status: {$rec->status}\n";
}
