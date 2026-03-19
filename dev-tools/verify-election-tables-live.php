<?php
/**
 * Verify Elections 2026 tables exist and report row counts.
 * Usage: php verify-election-tables-live.php
 *        DB_HOST=mycovai.in php dev-tools/verify-election-tables-live.php
 */

$root = dirname(__DIR__);
require_once $root . '/core/omr-connect.php';

$tables = ['election_2026_candidates', 'election_2026_announcements'];

foreach ($tables as $table) {
    $res = $conn->query("SELECT COUNT(*) AS c FROM `" . $conn->real_escape_string($table) . "`");
    if (!$res) {
        echo $table . ": NOT FOUND or error (" . $conn->error . ")\n";
        continue;
    }
    $row = $res->fetch_assoc();
    echo $table . ": " . (int) $row['c'] . " rows\n";
    $res->free();
}
echo "Done.\n";
