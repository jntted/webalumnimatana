<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Check the last HTTP requests logged
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

// Read last entries from log file
$logFile = storage_path('logs/laravel.log');
if (file_exists($logFile)) {
    echo "=== Last 30 lines from laravel.log ===\n";
    $lines = array_slice(file($logFile), -30);
    foreach ($lines as $line) {
        if (strpos($line, 'tracer') !== false || strpos($line, 'POST') !== false || strpos($line, 'store') !== false) {
            echo $line;
        }
    }
}

echo "\n=== Checking database migrations ===\n";
$migrations = DB::table('migrations')->orderBy('batch', 'DESC')->limit(5)->get();
foreach ($migrations as $m) {
    echo "{$m->migration} - Batch {$m->batch}\n";
}
