<?php
/**
 * Deploy sprint — pre-flight (local) and post-flight (live) checks.
 *
 *   php dev-tools/deploy-sprint-cli.php pre
 *   php dev-tools/deploy-sprint-cli.php post
 */
declare(strict_types=1);

$root = dirname(__DIR__);
$mode = $argv[1] ?? 'pre';
$failures = 0;

function sprint_ok(bool $ok, string $label): void
{
    global $failures;
    echo ($ok ? 'OK   ' : 'FAIL ') . "$label\n";
    if (!$ok) {
        $failures++;
    }
}

function run_cmd(string $cmd): int
{
    passthru($cmd, $code);
    return (int) $code;
}

function probe(string $url, int $expectCode, ?string $expectLocationContains = null): bool
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_TIMEOUT => 25,
        CURLOPT_NOBODY => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_USERAGENT => 'MyCovai-DeploySprint/1.0',
    ]);
    curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $loc = (string) curl_getinfo($ch, CURLINFO_REDIRECT_URL);
    curl_close($ch);
    if ($code !== $expectCode) {
        return false;
    }
    if ($expectLocationContains !== null && stripos($loc, $expectLocationContains) === false) {
        return false;
    }
    return true;
}

echo "Deploy sprint — $mode\n";
echo str_repeat('=', 55) . "\n";

if ($mode === 'pre') {
    $scripts = [
        'audit-sitemap-cli.php' => true,
        'test-phase5-6-cli.php' => true,
        'test-phase4-branding-cli.php' => false, // hostels/coworking OMR copy pending safe rebrand
    ];
    foreach ($scripts as $s => $required) {
        $path = $root . '/dev-tools/' . $s;
        if (!is_file($path)) {
            sprint_ok(false, "missing $s");
            continue;
        }
        $code = run_cmd('php ' . escapeshellarg($path));
        if ($required) {
            sprint_ok($code === 0, "$s exit $code");
        } else {
            echo ($code === 0 ? 'OK   ' : 'WARN ') . "$s exit $code (non-blocking)\n";
        }
    }

    $mustExist = [
        '.htaccess',
        '404.php',
        '500.php',
        'thank-you.php',
        'weblog/generate-sitemap-index.php',
        'weblog/generate-static-sitemap.php',
        'dev-tools/gsc-prep-sitemap-cli.php',
    ];
    foreach ($mustExist as $rel) {
        sprint_ok(is_file($root . '/' . $rel), "exists $rel");
    }

    $mustNotExist = [
        'weblog/create-tables-remote.php',
        'pentahive',
        'events/index.php',
        'free-ads-chennai',
        'test-website',
        'election-blo-details',
        'omr-election-blo',
    ];
    foreach ($mustNotExist as $rel) {
        sprint_ok(!file_exists($root . '/' . $rel), "removed $rel");
    }

    $ht = file_get_contents($root . '/.htaccess') ?: '';
    foreach ([
        'pages-sitemap',
        'pentahive',
        'jobs-in-omr-chennai',
        'ErrorDocument 404 /404.php',
        'free-ads-chennai',
    ] as $needle) {
        sprint_ok(stripos($ht, $needle) !== false, ".htaccess contains '$needle'");
    }
} elseif ($mode === 'post') {
    $redirects = [
        ['https://mycovai.in/pentahive/', 301, '/'],
        ['https://mycovai.in/listings/schools', 301, '/directory'],
        ['https://mycovai.in/jobs-in-omr-chennai.php', 301, 'coimbatore'],
        ['https://mycovai.in/events/', 301, 'local-events'],
        ['https://mycovai.in/info/onboarding/getting-started.php', 301, 'discover'],
        ['https://mycovai.in/free-ads-chennai/', 301, '/'],
    ];
    foreach ($redirects as [$url, $code, $loc]) {
        sprint_ok(probe($url, $code, $loc), "redirect $url → $loc");
    }

    $pages = [
        ['https://mycovai.in/', 200, null],
        ['https://mycovai.in/404.php', 404, null],
        ['https://mycovai.in/thank-you.php', 200, null],
        ['https://mycovai.in/coimbatore-news.php', 200, null],
        ['https://mycovai.in/database/', 403, null],
    ];
    foreach ($pages as [$url, $code]) {
        sprint_ok(probe($url, $code, null), "$url → $code");
    }

    sprint_ok(!probe('https://mycovai.in/weblog/create-tables-remote.php', 200, null), 'create-tables-remote not 200');

    $code = run_cmd('php ' . escapeshellarg($root . '/dev-tools/gsc-prep-sitemap-cli.php') . ' --live');
    sprint_ok($code === 0, 'gsc-prep-sitemap-cli.php --live');
} else {
    fwrite(STDERR, "Usage: php dev-tools/deploy-sprint-cli.php pre|post\n");
    exit(2);
}

echo str_repeat('=', 55) . "\n";
exit($failures === 0 ? 0 : 1);
