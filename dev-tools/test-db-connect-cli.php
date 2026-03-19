<?php
/**
 * CLI-only database connectivity test.
 * Usage: php dev-tools/test-db-connect-cli.php [--config=omr|remote]
 * From project root. No $_SERVER dependency.
 */

$baseDir = dirname(__DIR__);
chdir($baseDir);

echo "=== Database connectivity test ===\n\n";

// Which config to use
$config = 'omr';
foreach ($argv as $arg) {
    if (strpos($arg, '--config=') === 0) {
        $config = trim(substr($arg, 9));
        break;
    }
}

if ($config === 'remote') {
    echo "Config: remote (dev-tools/config-remote.php)\n";
    if (!file_exists($baseDir . '/dev-tools/config-remote.php')) {
        echo "FAIL: config-remote.php not found.\n";
        exit(1);
    }
    define('DEV_TOOLS_ACCESS', true);
    $_SERVER['SERVER_NAME'] = 'localhost';
    $_SERVER['SERVER_ADDR'] = '127.0.0.1';
    $_SERVER['HTTP_HOST'] = 'localhost';
    require $baseDir . '/dev-tools/config-remote.php';
    $conn = $GLOBALS['dev_conn'] ?? null;
    $label = 'Remote (SSH tunnel 3307)';
} else {
    echo "Config: main (core/omr-connect.php)\n";
    if (!file_exists($baseDir . '/core/omr-connect.php')) {
        echo "FAIL: core/omr-connect.php not found.\n";
        exit(1);
    }
    require $baseDir . '/core/omr-connect.php';
    $label = 'Main (localhost:3306 / production)';
}

echo "Connection target: {$label}\n";

if (!$conn || $conn->connect_error) {
    echo "Result: FAIL\n";
    echo "Error: " . ($conn ? $conn->connect_error : 'No connection object') . "\n";
    if ($conn && $conn->connect_errno) {
        echo "Errno: " . $conn->connect_errno . "\n";
    }
    exit(1);
}

echo "Result: OK\n";
echo "Server: " . $conn->server_info . "\n";
echo "Host: " . $conn->host_info . "\n";
echo "Charset: " . $conn->character_set_name() . "\n";

// Simple query test
$r = $conn->query("SELECT 1 AS one");
if ($r && $r->fetch_assoc()['one'] == 1) {
    echo "Query test: OK\n";
} else {
    echo "Query test: FAIL\n";
    exit(1);
}

$conn->close();
echo "\nDone.\n";
exit(0);
