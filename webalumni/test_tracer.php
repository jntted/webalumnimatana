<?php

// Simple test to check TracerStudy table and model

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\TracerStudy;
use App\Models\Alumni;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== TracerStudy Table Check ===\n";
echo "Table exists: " . (Schema::hasTable('tracer_studies') ? 'YES' : 'NO') . "\n";

if (Schema::hasTable('tracer_studies')) {
    $columns = Schema::getColumnListing('tracer_studies');
    echo "Columns: " . implode(', ', $columns) . "\n";
}

echo "\n=== TracerStudy Model Fillable ===\n";
$model = new TracerStudy();
echo "Fillable: " . implode(', ', $model->getFillable()) . "\n";

echo "\n=== Existing Records ===\n";
$count = TracerStudy::count();
echo "Total tracer_studies: $count\n";
if ($count > 0) {
    $first = TracerStudy::first();
    echo "First record: ";
    print_r($first->toArray());
}

echo "\n=== Alumni Count ===\n";
$alumniCount = Alumni::count();
echo "Total alumni: $alumniCount\n";
if ($alumniCount > 0) {
    $alumni = Alumni::first();
    echo "First alumni: User ID = {$alumni->user_id}, Name = {$alumni->name}\n";
}

echo "\n=== Table Structure (MySQL) ===\n";
$tableStructure = DB::select("DESCRIBE webalumni.tracer_studies");
foreach ($tableStructure as $col) {
    echo "{$col->Field}: {$col->Type}\n";
}

echo "\n✓ Test completed\n";
