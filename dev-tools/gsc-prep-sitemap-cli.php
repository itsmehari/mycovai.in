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

function fetch_redirect(string $url): array
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_NOBODY => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_USERAGENT => 'MyCovai-GSC-Prep/1.0',
    ]);
    curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $loc = (string) curl_getinfo($ch, CURLINFO_REDIRECT_URL);
    curl_close($ch);
    return [$code, $loc];
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
            $subBody = $subCode === 200 ? (string) @file_get_contents($sub) : '';
            $urlCount = substr_count($subBody, '<url>');
            $label = "live sub-sitemap $sub → $subCode";
            if ($subCode === 200) {
                $label .= " ($urlCount URLs)";
                gsc_ok($urlCount > 0, "$label — empty child sitemap");
            } else {
                gsc_ok(false, $label);
            }
        }
    }

    [$robotsCode] = fetch_status('https://mycovai.in/robots.txt');
    gsc_ok($robotsCode === 200, "live robots.txt returns 200 (got $robotsCode)");

    echo str_repeat('-', 55) . "\n";
    echo "Live redirect checks (retired OMR URLs)\n";
    echo str_repeat('-', 55) . "\n";
    $redirectChecks = [
        ['https://mycovai.in/pentahive/', 301, 'mycovai.in/'],
        ['https://mycovai.in/listings/schools', 301, 'directory'],
        ['https://mycovai.in/jobs-in-omr-chennai.php', 301, 'coimbatore'],
        ['https://mycovai.in/events/', 301, 'local-events'],
        ['https://mycovai.in/info/onboarding/getting-started.php', 301, 'discover'],
        ['https://mycovai.in/info/onboarding/overview.php', 301, 'discover/overview'],
        ['https://mycovai.in/omr-listings/schools.php', 301, 'directory'],
    ];
    foreach ($redirectChecks as [$url, $expectCode, $locNeedle]) {
        [$code, $loc] = fetch_redirect($url);
        $ok = $code === $expectCode && stripos($loc, $locNeedle) !== false;
        gsc_ok($ok, "redirect $url → $locNeedle ($code)");
    }

    [$jobsCode] = fetch_status('https://mycovai.in/jobs/sitemap.xml');
    $jobsBody = $jobsCode === 200 ? (string) @file_get_contents('https://mycovai.in/jobs/sitemap.xml') : '';
    gsc_ok($jobsCode === 200 && strpos($jobsBody, '<urlset') !== false, 'live jobs sitemap returns valid XML');

    $indexUrls = [
        'https://mycovai.in/',
        'https://mycovai.in/directory/',
        'https://mycovai.in/jobs/',
        'https://mycovai.in/coimbatore-news.php',
    ];
    echo str_repeat('-', 55) . "\n";
    echo "Priority pages for GSC indexing request\n";
    echo str_repeat('-', 55) . "\n";
    foreach ($indexUrls as $url) {
        [$code] = fetch_status($url);
        gsc_ok($code === 200, "index candidate $url → $code");
    }
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
