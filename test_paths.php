<?php
require_once __DIR__ . '/includes/config.php';
file_put_contents('path_debug.txt', "DOCUMENT_ROOT: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'empty') . "\n" .
    "__DIR__: " . __DIR__ . "\n" .
    "BC_BASE: " . BC_BASE . "\n" .
    "bc_asset: " . bc_asset('css/main.css') . "\n");
echo "OK";
