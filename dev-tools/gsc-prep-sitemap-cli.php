<?php
/**
 * Pre-flight check before Google Search Console sitemap resubmit.
 * Usage: php dev-tools/gsc-prep-sitemap-cli.php [--live]
 *
 * --live  Also fetch https://mycovai.in/* (production). Default: local generator only.
 */
declare(strict_types=1);

$root = dirname(__DIR__);
$checkLive = in_array('--live', $argv ?? [], true);
$failures = 0;

function gsc_ok(bool $ok, string $label): void
{
    global $failures;
    echo ($ok ? 'OK   ' : 'FAIL ') . "$label\n";
    if (!$ok) {
        $failures++;
    }
}

function fetch_status(string $url): array
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 5,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_NOBODY => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_USERAGENT => 'MyCovai-GSC-Prep/1.0',
    ]);
    curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $final = (string) curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    return [$code, $final];
}

function extract_sitemap_locs(string $xml): array
{
    $locs = [];
    if (preg_match_all('#<loc>([^<]+)</loc>#', $xml, $m)) {
        $locs = $m[1];
    }
    return $locs;
}

echo "GSC sitemap pre-flight\n";
echo str_repeat('-', 55) . "\n";

// 1. Local generator audit
passthru('php ' . escapeshellarg($root . '/dev-tools/audit-sitemap-cli.php'), $auditCode);
if ($auditCode !== 0) {
    $failures++;
    echo "FAIL local audit-sitemap-cli.php exit $auditCode\n";
}

// 2. Local index XML (subprocess avoids header() warnings)
$localIndex = (string) shell_exec(escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($root . '/weblog/generate-sitemap-index.php') . ' 2>nul');
$localLocs = extract_sitemap_locs($localIndex);
gsc_ok($localIndex !== '' && strpos($localIndex, '<sitemapindex') !== false, 'local sitemap index generates');
gsc_ok(stripos($localIndex, 'pentahive') === false, 'local index has no pentahive');
gsc_ok(stripos($localIndex, 'election-blo-details') === false, 'local index has no election-blo-details');
gsc_ok(in_array('https://mycovai.in/pages-sitemap.xml', $localLocs, true), 'local index includes pages-sitemap.xml');

$badPatterns = ['pentahive', 'election-blo', 'omr-listings', 'myomr.in', 'perungudi', 'jobs-in-omr'];
foreach ($badPatterns as $bad) {
    gsc_ok(stripos($localIndex, $bad) === false, "local index has no '$bad'");
}

// 3. robots.txt
$robots = file_get_contents($root . '/robots.txt') ?: '';
gsc_ok(strpos($robots, 'Sitemap: https://mycovai.in/sitemap.xml') !== false, 'robots.txt declares sitemap');

// 4. Live checks (optional)
if ($checkLive) {
    echo str_repeat('-', 55) . "\n";
    echo "Live production checks (mycovai.in)\n";
    echo str_repeat('-', 55) . "\n";

    [$code, $final] = fetch_status('https://mycovai.in/sitemap.xml');
    gsc_ok($code === 200, "live /sitemap.xml returns 200 (got $code)");

    $liveBody = '';
    if ($code === 200) {
        $liveBody = (string) file_get_contents('https://mycovai.in/sitemap.xml');
        foreach (['pentahive', 'election-blo-details'] as $dead) {
            if (stripos($liveBody, $dead) !== false) {
                gsc_ok(false, "LIVE index still lists '$dead' — deploy weblog/generate-sitemap-index.php");
            }
        }
        if (stripos($liveBody, 'pages-sitemap.xml') === false) {
            gsc_ok(false, 'LIVE index missing pages-sitemap.xml — deploy .htaccess + generators');
        }
        foreach (extract_sitemap_locs($liveBody) as $sub) {
            [$subCode] = fetch_status($sub);
            gsc_ok($subCode === 200, "live sub-sitemap $sub → $subCode");
        }
    }

    [$robotsCode] = fetch_status('https://mycovai.in/robots.txt');
    gsc_ok($robotsCode === 200, "live robots.txt returns 200 (got $robotsCode)");
}

echo str_repeat('-', 55) . "\n";
echo "GSC manual steps (after deploy passes --live):\n";
echo "  1. Open https://search.google.com/search-console/sitemaps\n";
echo "  2. Property: https://mycovai.in/\n";
echo "  3. Remove stale sitemap entries if any (pentahive, election-blo-details).\n";
echo "  4. Submit: sitemap.xml\n";
echo "  5. URL Inspection → Request indexing: /, /directory/, /jobs/, /coimbatore-news.php\n";
echo "  6. Do NOT use Remove URLs on pages that have 301 redirects.\n";
echo str_repeat('-', 55) . "\n";
exit($failures === 0 ? 0 : 1);
