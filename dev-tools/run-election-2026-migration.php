<?php
/**
 * Run Elections 2026 migration: CREATE + SEED.
 * Supports remote DB via DB_HOST (and optional DB_PORT, DB_USER, DB_PASS, DB_NAME).
 * Usage: php run-election-2026-migration.php   [from repo root or dev-tools]
 *        DB_HOST=mycovai.in php dev-tools/run-election-2026-migration.php
 *
 * @see docs/data-backend/LOCAL_TO_REMOTE_DATABASE_SETUP.md
 * @see AGENTS.md – confirm target (live vs local) and get explicit user confirmation before running against live.
 */

$root = dirname(__DIR__);
require_once $root . '/core/omr-connect.php';

$dev = __DIR__;
$create = $dev . '/create-election-2026-tables.sql';
$seed = $dev . '/seed-election-2026.sql';

if (!is_readable($create)) {
    fwrite(STDERR, "Missing: create-election-2026-tables.sql\n");
    exit(1);
}
if (!is_readable($seed)) {
    fwrite(STDERR, "Missing: seed-election-2026.sql\n");
    exit(1);
}

function run_sql_file($conn, $path) {
    $sql = file_get_contents($path);
    $conn->multi_query($sql);
    do {
        if ($res = $conn->store_result()) {
            $res->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    if ($conn->errno) {
        throw new RuntimeException($conn->error);
    }
}

try {
    run_sql_file($conn, $create);
    echo "Created election_2026_candidates and election_2026_announcements.\n";
    run_sql_file($conn, $seed);
    echo "Seeded sample rows.\n";
} catch (Throwable $e) {
    fwrite(STDERR, "Error: " . $e->getMessage() . "\n");
    exit(1);
}
echo "Done.\n";
