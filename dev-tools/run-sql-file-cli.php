<?php
/**
 * CLI: apply a .sql file via mysqli (multi_query). Uses core/omr-connect.php credentials.
 * Usage: DB_HOST=mycovai.in php run-sql-file-cli.php ../database/seed-covai-events-2026-q1-editorial.sql
 */
if (PHP_SAPI !== 'cli') {
    exit('CLI only');
}
$file = $argv[1] ?? '';
if ($file === '' || !is_readable($file)) {
    fwrite(STDERR, "Usage: php run-sql-file-cli.php path/to/file.sql\n");
    exit(1);
}
require __DIR__ . '/../core/omr-connect.php';
if ($conn->connect_errno) {
    fwrite(STDERR, $conn->connect_error . "\n");
    exit(1);
}
$sql = file_get_contents($file);
if ($sql === false) {
    fwrite(STDERR, "Could not read file.\n");
    exit(1);
}
if (!$conn->multi_query($sql)) {
    fwrite(STDERR, $conn->error . "\n");
    exit(1);
}
do {
    if ($res = $conn->store_result()) {
        $res->free();
    }
} while ($conn->more_results() && $conn->next_result());

echo "Applied: {$file}\n";
