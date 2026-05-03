<?php

echo "<pre>";
echo "Attempting to fix permissions...\n";

$paths = [
    'storage',
    'storage/framework',
    'storage/framework/views',
    'storage/framework/cache',
    'storage/framework/sessions',
    'bootstrap/cache',
];

foreach ($paths as $path) {
    $fullPath = __DIR__ . '/../' . $path;
    if (is_dir($fullPath)) {
        chmod($fullPath, 0777);
        echo "chmod 777 $path\n";
    }
}

echo "\nExecuting shell commands...\n";
$output = [];
$retval = null;

exec('chmod -R 777 ../storage ../bootstrap/cache 2>&1', $output, $retval);
echo "chmod -R 777: " . implode("\n", $output) . " (code: $retval)\n";

$output = [];
exec('php ../artisan view:clear 2>&1', $output, $retval);
echo "artisan view:clear: " . implode("\n", $output) . " (code: $retval)\n";

$output = [];
exec('php ../artisan cache:clear 2>&1', $output, $retval);
echo "artisan cache:clear: " . implode("\n", $output) . " (code: $retval)\n";

echo "\nDone.";
