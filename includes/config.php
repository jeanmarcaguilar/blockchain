<?php
define('BC_SITE_NAME', 'BlockCart');
define('BC_TAGLINE', 'Blockchain-Based E-Commerce');
define('BC_VERSION', '1.0.0');

// Auto-detect the app URL base path from the web document root.
function bc_normalize_path($path) {
    $real = realpath($path) ?: $path;
    return str_replace('\\', '/', rtrim($real, '/\\'));
}
function bc_base_from_script() {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    if (!$scriptName) {
        return '';
    }
    $scriptName = str_replace('\\', '/', $scriptName);
    $segments = explode('/', trim($scriptName, '/'));
    $appRootName = basename(bc_normalize_path(__DIR__ . '/..'));
    $index = array_search($appRootName, $segments, true);
    if ($index === false) {
        return '';
    }
    return '/' . implode('/', array_slice($segments, 0, $index + 1));
}
$documentRoot = bc_normalize_path($_SERVER['DOCUMENT_ROOT'] ?? '');
$appRoot = bc_normalize_path(__DIR__ . '/..');
$basePath = '';
if ($documentRoot && $appRoot && str_starts_with($appRoot, $documentRoot)) {
    $basePath = '/' . trim(substr($appRoot, strlen($documentRoot)), '/');
} else {
    $basePath = bc_base_from_script();
}
if ($basePath === '/' || $basePath === '') {
    $basePath = '';
}
define('BC_BASE', $basePath);

function bc_asset($path) { return BC_BASE . '/assets/' . ltrim($path, '/'); }
function bc_url($path = '') { return BC_BASE . '/' . ltrim($path, '/'); }
