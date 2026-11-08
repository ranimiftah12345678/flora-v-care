<?php

$files = [
    'app/Http/Controllers/Admin/MaterialController.php',
    'app/Http/Controllers/Admin/VideoController.php',
];

foreach ($files as $file) {
    $lines = file($file);
    echo "== {$file}\n";
    foreach ($lines as $index => $line) {
        echo ($index + 1).': '.bin2hex(substr($line, 0, 40))."\n";
    }
}
