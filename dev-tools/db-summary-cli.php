<?php
/**
 * Output database summary: all tables and row counts.
 * Usage: DB_HOST=mycovai.in php dev-tools/db-summary-cli.php
 * From project root.
 */
$baseDir = dirname(__DIR__);
chdir($baseDir);

require $baseDir . '/core/omr-connect.php';

$db = $database;
$result = $conn->query("SHOW TABLES");
if (!$result) {
    fwrite(STDERR, "Error: " . $conn->error . "\n");
    exit(1);
}

$tables = [];
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}

echo "Database: {$db}\n";
echo "Tables: " . count($tables) . "\n\n";
echo str_pad("Table", 50) . "Rows\n";
echo str_repeat("-", 60) . "\n";

$total = 0;
foreach ($tables as $table) {
    $r = $conn->query("SELECT COUNT(*) AS c FROM `" . $conn->real_escape_string($table) . "`");
    $count = $r ? (int) $r->fetch_assoc()['c'] : 0;
    $total += $count;
    echo str_pad($table, 50) . $count . "\n";
}

echo str_repeat("-", 60) . "\n";
echo str_pad("Total rows (all tables)", 50) . $total . "\n";
$conn->close();
