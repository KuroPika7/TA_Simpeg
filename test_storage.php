<?php
use Illuminate\Support\Facades\Storage;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Test Storage
try {
    Storage::disk('public')->put('test_image.txt', 'This is a test');
    echo "File created at: " . Storage::disk('public')->path('test_image.txt') . "\n";
    echo "Exists: " . (Storage::disk('public')->exists('test_image.txt') ? 'Yes' : 'No') . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
