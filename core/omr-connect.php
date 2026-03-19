<?php
require_once __DIR__ . '/mycovai-config.php';

// Allow remote DB via env: set DB_HOST=mycovai.in (see README-REMOTE-DATABASE / docs/data-backend)
// Password default from _myomr.in repository (core/omr-connect.php)
$db_host = getenv('DB_HOST') ?: (isset($_SERVER['DB_HOST']) ? $_SERVER['DB_HOST'] : 'localhost');
$db_port = getenv('DB_PORT') ?: (isset($_SERVER['DB_PORT']) ? $_SERVER['DB_PORT'] : '3306');
$servername = $db_host . ':' . $db_port;
$username  = getenv('DB_USER') ?: (isset($_SERVER['DB_USER']) ? $_SERVER['DB_USER'] : 'metap8ok_myomr_admin');
$password  = getenv('DB_PASS') ?: (isset($_SERVER['DB_PASS']) ? $_SERVER['DB_PASS'] : 'myomr@123');
$database  = getenv('DB_NAME') ?: (isset($_SERVER['DB_NAME']) ? $_SERVER['DB_NAME'] : 'metap8ok_mycovai');

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // Log error
    error_log("Database connection failed: " . $conn->connect_error);
    
    // Show error if in development mode
    if (defined('DEVELOPMENT_MODE') && DEVELOPMENT_MODE) {
        die("Database Connection Failed: " . htmlspecialchars($conn->connect_error) . 
            "<br><br>Please check:<br>" .
            "- Database server is running<br>" .
            "- Credentials in core/omr-connect.php (or core/covai-connect.php) are correct<br>" .
            "- Database name exists<br>");
    } else {
        die("Database connection failed. Please contact administrator.");
    }
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");
?>