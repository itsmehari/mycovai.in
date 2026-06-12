<?php
/**
 * Audit static sitemap.xml and sitemap index for OMR legacy URLs.
 * Usage: php dev-tools/audit-sitemap-cli.php
 */
declare(strict_types=1);

$root = dirname(__DIR__);
$failures = 0;

function audit_ok(bool $ok, string $label): void
{
    global $failures;
    echo ($ok ? 'OK   ' : 'FAIL ') . "$label\n";
    if (!$ok) {
        $failures++;
    }
}

$badPatterns = [
    'omr-listings',
    'omr-local-job-listings',
    'pentahive',
    'find-blo-officer',
    'perungudi',
    'sholinganallur',
    'jobs-in-omr',
    'it-jobs-omr',
    'news-highlights-from-omr',
    'pallikaranai-marsh',
    'report-civic-issue-omr',
    'citizens-charter-old-mahabali',
];

$requiredPatterns = [
    'https://mycovai.in/coimbatore-news.php',
    'https://mycovai.in/directory/',
    'https://mycovai.in/jobs/',
    'https://mycovai.in/jobs-in-coimbatore.php',
];

echo "Sitemap audit\n";
echo str_repeat('-', 40) . "\n";

$sitemap = file_get_contents($root . '/sitemap.xml') ?: '';
foreach ($badPatterns as $bad) {
    audit_ok(stripos($sitemap, $bad) === false, "sitemap.xml has no '$bad'");
}
foreach ($requiredPatterns as $req) {
    audit_ok(strpos($sitemap, $req) !== false, "sitemap.xml includes '$req'");
}

$index = file_get_contents($root . '/weblog/generate-sitemap-index.php') ?: '';
audit_ok(stripos($index, 'pentahive') === false, 'sitemap index generator has no pentahive');
audit_ok(stripos($index, 'election-blo-details') === false, 'sitemap index generator has no election-blo-details');
foreach ([
    '/pages-sitemap.xml',
    '/local-events/sitemap.xml',
    '/directory/sitemap.xml',
    '/jobs/sitemap.xml',
    '/local-news/sitemap.xml',
    '/coimbatore-elections-2026/sitemap.xml',
] as $sub) {
    audit_ok(strpos($index, $sub) !== false, "sitemap index includes '$sub'");
}

echo str_repeat('-', 40) . "\n";
exit($failures === 0 ? 0 : 1);
