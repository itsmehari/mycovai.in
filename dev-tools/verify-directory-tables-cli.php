<?php
/**
 * Verify directory listing tables match homepage counts (covai_* vs legacy omr_*).
 *
 * Usage: DB_HOST=mycovai.in php dev-tools/verify-directory-tables-cli.php
 */
$baseDir = dirname(__DIR__);
chdir($baseDir);

require $baseDir . '/core/omr-connect.php';
require_once $baseDir . '/core/mycovai-config.php';

$categories = require $baseDir . '/core/homepage-directory-categories.php';
$counts = require $baseDir . '/core/homepage-listing-counts.php';

echo "Directory table verification\n";
echo "Database: {$database}\n\n";
echo str_pad('Category', 22) . str_pad('Table', 28) . str_pad('Count', 8) . "Status\n";
echo str_repeat('-', 72) . "\n";

$issues = 0;
foreach ($categories as $key => $meta) {
    $table = null;
    if ($key === 'hostels-pgs') {
        $table = 'hostels_pgs';
    } elseif ($key === 'coworking-spaces') {
        $table = 'coworking_spaces';
    } elseif (function_exists('covai_table')) {
        $table = covai_table($key);
    }

    if (!$table) {
        echo str_pad($key, 22) . str_pad('-', 28) . str_pad('-', 8) . "SKIP (no table map)\n";
        continue;
    }

    $r = @$conn->query('SELECT COUNT(*) AS c FROM `' . $conn->real_escape_string($table) . '`');
    $live = ($r && ($row = $r->fetch_assoc())) ? (int) $row['c'] : -1;
    $expected = (int) ($counts[$key] ?? -1);

    $status = 'OK';
    if ($live < 0) {
        $status = 'MISSING TABLE';
        $issues++;
    } elseif ($live !== $expected) {
        $status = 'COUNT MISMATCH';
        $issues++;
    }

    if (stripos($table, 'omr') !== false && stripos($table, 'covai') === false) {
        $status = 'LEGACY TABLE';
        $issues++;
    }

    echo str_pad($key, 22) . str_pad($table, 28) . str_pad((string) $live, 8) . $status . "\n";
}

echo str_repeat('-', 72) . "\n";
echo $issues === 0 ? "All checks passed.\n" : "{$issues} issue(s) found — review counts or migrate omr_* tables.\n";

$conn->close();
exit($issues > 0 ? 1 : 0);
