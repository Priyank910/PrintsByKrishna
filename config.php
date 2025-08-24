<?php
// config.php
// --- Database + App Config ---
session_start();

// Update these to match your MySQL setup
define('DB_HOST', 'localhost');
define('DB_NAME', 'printsbykrishna');
define('DB_USER', 'root');
define('DB_PASS', '');

// Simple admin auth (very basic). Change this!
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'admin123');

try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
}

function base_url() {
    // Works whether the site is at / or /PrintsByKrishna/ (or any folder)
    $doc = str_replace('\\','/', realpath($_SERVER['DOCUMENT_ROOT']));
    $root = str_replace('\\','/', realpath(__DIR__)); // folder where config.php lives (project root)
    $path = '/' . trim(str_replace($doc, '', $root), '/') . '/';
    return ($path === '//') ? '/' : $path; // normalize when installed at /
}


function cart_count() {
    return isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
}
?>
