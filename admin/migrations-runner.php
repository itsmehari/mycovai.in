<?php
require_once __DIR__ . '/_bootstrap.php';
requireAdmin();
requireRole(['super_admin']);

$expected = getenv('MYCOVAI_MIGRATIONS_SECRET') ?: '';
$secret = (string) ($_GET['secret'] ?? '');

if ($expected === '' || !hash_equals($expected, $secret)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Forbidden. Set MYCOVAI_MIGRATIONS_SECRET in cPanel and pass ?secret= on the URL.\n";
    exit;
}

$migrations = [
    __DIR__ . '/../dev-tools/migrations/run_2025_10_31_add_it_company_profile_fields.php',
    __DIR__ . '/../dev-tools/migrations/run_2025_10_31_add_hospital_profile_fields.php',
    __DIR__ . '/../dev-tools/migrations/run_2025_10_31_add_banks_schools_profile_fields.php',
];

header('Content-Type: text/plain; charset=utf-8');
foreach ($migrations as $mig) {
    if (!file_exists($mig)) {
        echo basename($mig) . "\tmissing\n";
        continue;
    }
    try {
        include $mig;
        echo basename($mig) . "\tok\n";
    } catch (Throwable $e) {
        echo basename($mig) . "\terror:" . $e->getMessage() . "\n";
    }
}
