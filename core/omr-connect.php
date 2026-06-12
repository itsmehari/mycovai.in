<?php
require_once __DIR__ . '/env.php';
require_once __DIR__ . '/mycovai-config.php';

$db_host = omr_env_var('DB_HOST', 'localhost');
$db_port = omr_env_var('DB_PORT', '3306');
$username = omr_env_var('DB_USER', omr_is_production() ? '' : 'metap8ok_myomr_admin');
$password = omr_env_var('DB_PASS', omr_is_production() ? '' : 'myomr@123');
$database = omr_env_var('DB_NAME', omr_is_production() ? '' : 'metap8ok_mycovai');

$secretsFile = __DIR__ . '/db-secrets.local.php';
if (is_file($secretsFile)) {
    $secrets = require $secretsFile;
    if (is_array($secrets)) {
        $db_host = (string) ($secrets['DB_HOST'] ?? $db_host);
        $db_port = (string) ($secrets['DB_PORT'] ?? $db_port);
        $username = (string) ($secrets['DB_USER'] ?? $username);
        $password = (string) ($secrets['DB_PASS'] ?? $password);
        $database = (string) ($secrets['DB_NAME'] ?? $database);
    }
}

$servername = $db_host . ':' . $db_port;

if (omr_is_production() && ($username === '' || $password === '' || $database === '')) {
    error_log('MyCovai DB credentials missing: set DB_USER/DB_PASS/DB_NAME via cPanel env or core/db-secrets.local.php');
}

$conn = null;
try {
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        error_log('Database connection failed: ' . $conn->connect_error);
        $conn = null;
    } else {
        $conn->set_charset('utf8mb4');
    }
} catch (mysqli_sql_exception $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    $conn = null;
}

if (!$conn) {
    if (defined('DEVELOPMENT_MODE') && DEVELOPMENT_MODE) {
        die('Database Connection Failed. Check DB_HOST / credentials.');
    }
    die('Database connection failed. Please contact administrator.');
}
