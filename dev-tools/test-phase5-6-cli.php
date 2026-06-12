<?php
/**
 * Phases 5–6 verification (local, no DB required for most checks).
 * Run: php dev-tools/test-phase5-6-cli.php
 */
declare(strict_types=1);

$root = dirname(__DIR__);
$failures = 0;

function p56_ok(bool $ok, string $label): void
{
    global $failures;
    echo ($ok ? 'OK   ' : 'FAIL ') . "$label\n";
    if (!$ok) {
        $failures++;
    }
}

echo "Phases 5–6 checks\n";
echo str_repeat('-', 40) . "\n";

$countsPhp = file_get_contents($root . '/core/homepage-listing-counts.php') ?: '';
p56_ok(strpos($countsPhp, 'logs/cache/homepage-listing-counts.json') !== false, 'homepage counts use file cache');
p56_ok(is_dir($root . '/logs/cache'), 'logs/cache directory exists');

$removedJobs = [
    'jobs-in-omr-chennai.php',
    'jobs-in-perungudi-omr.php',
    'it-jobs-omr-chennai.php',
    'weblog/experienced-jobs-omr-chennai.php',
];
foreach ($removedJobs as $rel) {
    p56_ok(!is_file($root . '/' . $rel), "removed OMR job lander: $rel");
}

$htaccess = file_get_contents($root . '/.htaccess') ?: '';
p56_ok(strpos($htaccess, 'weblog/experienced-jobs-omr-chennai') !== false, '.htaccess redirects weblog OMR job landers');
p56_ok(strpos($htaccess, '/directory/it-parks.php') !== false, '.htaccess it-parks → directory/it-parks.php');

$docs = [
    'docs/deployment/MYCOVAI-DEPLOYMENT-NOTES.md',
    'docs/inbox/CONTENT-EDITOR-PLAYBOOK.md',
    'docs/inbox/E2E-TEST-CHECKLIST.md',
];
foreach ($docs as $rel) {
    p56_ok(is_file($root . '/' . $rel), "doc exists: $rel");
}

passthru('php ' . escapeshellarg($root . '/dev-tools/audit-sitemap-cli.php'), $auditCode);
if (is_file($root . '/.cursor/LIVE-SYSTEM-MAP.md')) {
    p56_ok(true, 'LIVE-SYSTEM-MAP.md exists');
}
if (is_file($root . '/.cursor/maintenance/LEGACY-MYOMR-AUDIT.md')) {
    p56_ok(true, 'LEGACY-MYOMR-AUDIT.md exists');
}
if ($auditCode !== 0) {
    $failures++;
    echo "FAIL audit-sitemap-cli.php exited $auditCode\n";
}

$lint = ['core/homepage-listing-counts.php', 'index.php', 'weblog/generate-sitemap-index.php'];
foreach ($lint as $rel) {
    $out = [];
    $code = 0;
    exec('php -l ' . escapeshellarg($root . '/' . $rel) . ' 2>&1', $out, $code);
    p56_ok($code === 0, "php -l $rel");
}

echo str_repeat('-', 40) . "\n";
if ($failures === 0) {
    echo "ALL PASSED\n";
    exit(0);
}
echo "$failures check(s) failed\n";
exit(1);
