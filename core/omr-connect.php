<?php
require_once __DIR__ . '/env.php';
require_once __DIR__ . '/mycovai-config.php';

$db_host = omr_env_var('DB_HOST', 'localhost');
$db_port = omr_env_var('DB_PORT', '3306');
$servername = $db_host . ':' . $db_port;
$username = omr_env_var('DB_USER', omr_is_production() ? '' : 'metap8ok_myomr_admin');
$password = omr_env_var('DB_PASS', omr_is_production() ? '' : 'myomr@123');
$database = omr_env_var('DB_NAME', omr_is_production() ? '' : 'metap8ok_mycovai');

if (omr_is_production() && ($username === '' || $password === '' || $database === '')) {
    error_log('MyCovai DB credentials missing: set DB_USER, DB_PASS, DB_NAME via server environment.');
}

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    error_log('Database connection failed: ' . $conn->connect_error);

    if (defined('DEVELOPMENT_MODE') && DEVELOPMENT_MODE) {
        die('Database Connection Failed: ' . htmlspecialchars($conn->connect_error));
    }
    die('Database connection failed. Please contact administrator.');
}

$conn->set_charset('utf8mb4');
