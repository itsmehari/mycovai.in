<?php
/**
 * Read-only CLI: COUNT(*) and duplicate groups for MyCovai directory tables.
 * Usage: php dev-tools/directory-duplicate-report.php
 * Live:  DB_HOST=mycovai.in php dev-tools/directory-duplicate-report.php
 *
 * @see docs/data-backend/DIRECTORY-DEDUPE-POLICY.md
 */
declare(strict_types=1);

$root = dirname(__DIR__);
require_once $root . '/core/omr-connect.php';

if (!function_exists('covai_table')) {
    require_once $root . '/core/mycovai-config.php';
}

/** @var mysqli $conn */

function table_ok(mysqli $conn, string $table): bool {
    $t = $conn->real_escape_string($table);
    $r = $conn->query("SHOW TABLES LIKE '$t'");
    return $r && $r->num_rows > 0;
}

function print_dupes(mysqli $conn, string $label, string $table, string $sql): void {
    echo "\n=== $label ($table) ===\n";
    if (!table_ok($conn, $table)) {
        echo "(table missing)\n";
        return;
    }
    $res = $conn->query($sql);
    if (!$res) {
        echo 'Query error: ' . $conn->error . "\n";
        return;
    }
    $n = 0;
    while ($row = $res->fetch_assoc()) {
        $n++;
        echo json_encode($row, JSON_UNESCAPED_UNICODE) . "\n";
    }
    if ($n === 0) {
        echo "(no duplicate groups)\n";
    }
}

$reports = [
    [
        'it companies — same name + address',
        covai_table('it-companies'),
        "SELECT LOWER(TRIM(company_name)) AS name_key, LOWER(TRIM(COALESCE(address,''))) AS addr_key,
                COUNT(*) AS cnt, GROUP_CONCAT(slno ORDER BY slno) AS slnos
         FROM `" . covai_table('it-companies') . "`
         GROUP BY name_key, addr_key HAVING cnt > 1 LIMIT 200",
    ],
    [
        'it companies — same name only',
        covai_table('it-companies'),
        "SELECT LOWER(TRIM(company_name)) AS name_key, COUNT(*) AS cnt, GROUP_CONCAT(slno ORDER BY slno) AS slnos
         FROM `" . covai_table('it-companies') . "`
         GROUP BY name_key HAVING cnt > 1 LIMIT 200",
    ],
    [
        'industries — same name + address',
        covai_table('industries'),
        "SELECT LOWER(TRIM(industry_name)) AS name_key, LOWER(TRIM(COALESCE(address,''))) AS addr_key,
                COUNT(*) AS cnt, GROUP_CONCAT(slno ORDER BY slno) AS slnos
         FROM `" . covai_table('industries') . "`
         GROUP BY name_key, addr_key HAVING cnt > 1 LIMIT 200",
    ],
    [
        'industries — same name only',
        covai_table('industries'),
        "SELECT LOWER(TRIM(industry_name)) AS name_key, COUNT(*) AS cnt, GROUP_CONCAT(slno ORDER BY slno) AS slnos
         FROM `" . covai_table('industries') . "`
         GROUP BY name_key HAVING cnt > 1 LIMIT 200",
    ],
    [
        'schools — same name + address',
        covai_table('schools'),
        "SELECT LOWER(TRIM(schoolname)) AS name_key, LOWER(TRIM(COALESCE(address,''))) AS addr_key,
                COUNT(*) AS cnt, GROUP_CONCAT(slno ORDER BY slno) AS slnos
         FROM `" . covai_table('schools') . "`
         GROUP BY name_key, addr_key HAVING cnt > 1 LIMIT 200",
    ],
    [
        'banks — same name + address',
        covai_table('banks'),
        "SELECT LOWER(TRIM(bankname)) AS name_key, LOWER(TRIM(COALESCE(address,''))) AS addr_key,
                COUNT(*) AS cnt, GROUP_CONCAT(slno ORDER BY slno) AS slnos
         FROM `" . covai_table('banks') . "`
         GROUP BY name_key, addr_key HAVING cnt > 1 LIMIT 200",
    ],
];

$countTypes = [
    'it-companies'       => 'IT companies',
    'industries'         => 'Industries',
    'schools'            => 'Schools',
    'hospitals'          => 'Hospitals',
    'banks'              => 'Banks',
    'atms'               => 'ATMs',
    'parks'              => 'Parks',
    'government-offices' => 'Government offices',
    'restaurants'        => 'Restaurants',
];

echo "MyCovai directory duplicate audit\n";
$dbRow = $conn->query('SELECT DATABASE() AS d');
$dbName = ($dbRow && ($r = $dbRow->fetch_assoc())) ? $r['d'] : '?';
echo "Database: $dbName\n";
echo "Host: " . getenv('DB_HOST') . "\n\n";

echo "--- Row counts ---\n";
foreach ($countTypes as $typeKey => $label) {
    $tbl = covai_table($typeKey);
    if (!table_ok($conn, $tbl)) {
        echo "$label ($tbl): (missing)\n";
        continue;
    }
    $sql = "SELECT COUNT(*) AS c FROM `$tbl`";
    $r = $conn->query($sql);
    $c = $r ? (int)$r->fetch_assoc()['c'] : -1;
    echo "$label ($tbl): $c\n";
}

foreach ($reports as [$label, $table, $sql]) {
    print_dupes($conn, $label, $table, $sql);
}

echo "\nDone.\n";
