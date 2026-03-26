<?php
/**
 * Execute a .sql file against the DB configured via omr-connect (use DB_HOST=mycovai.in for live).
 * Usage: DB_HOST=mycovai.in php dev-tools/run-sql-file.php [path/to/file.sql]
 */
$root = dirname(__DIR__);
$sqlFile = $argv[1] ?? ($root . '/dev-tools/sql/ADD-MANIFESTO-2026-FOUR-PARTIES-ARTICLES.sql');

if (!is_readable($sqlFile)) {
    fwrite(STDERR, "File not readable: $sqlFile\n");
    exit(1);
}

require_once $root . '/core/omr-connect.php';

$sql = file_get_contents($sqlFile);
if ($sql === false || trim($sql) === '') {
    fwrite(STDERR, "Empty or unreadable SQL.\n");
    exit(1);
}

if (!$conn->multi_query($sql)) {
    fwrite(STDERR, 'SQL error: ' . $conn->error . "\n");
    exit(1);
}

do {
    if ($result = $conn->store_result()) {
        $result->free();
    }
    if ($conn->errno) {
        fwrite(STDERR, 'SQL error: ' . $conn->error . "\n");
        exit(1);
    }
} while ($conn->more_results() && $conn->next_result());

echo "OK: executed " . basename($sqlFile) . " on " . ($conn->host_info ?? 'db') . "\n";
