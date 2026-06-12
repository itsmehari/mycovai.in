<?php
/**
 * Phase 5 legacy news cleanup verification (local, no DB).
 * Run: php dev-tools/test-phase5-legacy-news-cli.php
 */
declare(strict_types=1);

$root = dirname(__DIR__);
$failures = 0;

function phase5_ok(bool $ok, string $label): void
{
    global $failures;
    if ($ok) {
        echo "OK   $label\n";
    } else {
        echo "FAIL $label\n";
        $failures++;
    }
}

echo "Phase 5 legacy news cleanup checks\n";
echo str_repeat('-', 40) . "\n";

$allowed = [
    'article.php',
    'event-recap.php',
    'generate-sitemap.php',
    'article-sports-seo-enhancement.php',
    'news-highlights.php',
    'news-highlights-from-omr-road.php',
];

$newsDir = $root . '/local-news';
$phpFiles = glob($newsDir . '/*.php') ?: [];
$basenames = array_map('basename', $phpFiles);
sort($basenames);

$unexpected = array_diff($basenames, $allowed);
phase5_ok($unexpected === [], 'local-news/*.php only allowlisted infra files remain' . ($unexpected ? ' (extra: ' . implode(', ', $unexpected) . ')' : ''));

$omrStaticSamples = [
    'HappyStreets-OMR-Road.php',
    'Wells-Fargo-to-Close-Chennai-Office-2025.php',
    'Mylapore-Kabaleeswarar-Arubathu-Moovar-Festival-2025-Timetable-63-Naayanmar.php',
];
foreach ($omrStaticSamples as $sample) {
    phase5_ok(!is_file($newsDir . '/' . $sample), "deleted OMR static: $sample");
}

$marketing = file_get_contents($root . '/digital-marketing-landing.php') ?: '';
$userFacingBad = ['MyOMR', 'myomrCommunity', 'Perungudi', 'Sholinganallur', 'Old Mahabalipuram'];
foreach ($userFacingBad as $needle) {
    phase5_ok(stripos($marketing, $needle) === false, "digital-marketing-landing.php has no '$needle'");
}
phase5_ok(stripos($marketing, 'Coimbatore') !== false, 'digital-marketing-landing.php mentions Coimbatore');
phase5_ok(stripos($marketing, 'covai_logo_url') !== false, 'digital-marketing-landing.php uses covai_logo_url');

$stubs = ['news-highlights.php', 'news-highlights-from-omr-road.php'];
foreach ($stubs as $stub) {
    $content = file_get_contents($newsDir . '/' . $stub) ?: '';
    phase5_ok(strpos($content, 'coimbatore-news.php') !== false, "$stub redirects to coimbatore-news.php");
}

$removedLanders = [
    'listings/sell-rent-property-house-plot-omr-chennai.php',
    'listings/search-and-post-jobs-job-vacancy-employment-platform-for-omr-chennai.php',
    'listings/tutions-classes-courses-training-centers-in-omr-chennai.php',
    'listings/digital-marketing-junior-job-vacancy-cleanbios-guindy.php',
    'info/find-blo-officer.php',
    'info/process-blo-subscription.php',
    'pentahive/seo-organic-chennai-omr.php',
    'pentahive/index.php',
];
foreach ($removedLanders as $rel) {
    phase5_ok(!is_file($root . '/' . $rel), "removed legacy lander: $rel");
}

$listingsPhp = glob($root . '/listings/*.php') ?: [];
phase5_ok($listingsPhp === [], 'listings/ has no PHP files');

$htaccess = file_get_contents($root . '/.htaccess') ?: '';
phase5_ok(strpos($htaccess, 'RewriteRule ^listings/') !== false, '.htaccess redirects retired listings/');
phase5_ok(strpos($htaccess, 'RewriteRule ^pentahive') !== false, '.htaccess redirects retired pentahive/');
phase5_ok(strpos($htaccess, 'find-blo-officer') !== false, '.htaccess redirects retired BLO page');

$article = file_get_contents($newsDir . '/article.php') ?: '';
phase5_ok(strpos($article, 'process-blo-subscription') === false, 'article.php no longer uses BLO subscription handler');
phase5_ok(strpos($article, '/core/subscribe.php') !== false, 'article.php uses core/subscribe.php');

$lintFiles = [
    'digital-marketing-landing.php',
    'local-news/article.php',
    'local-news/event-recap.php',
    'local-news/news-highlights.php',
    'cgi-bin/navbar.php',
    'components/footer.php',
    'components/footer-covai.php',
];
foreach ($lintFiles as $rel) {
    $path = $root . '/' . $rel;
    $out = [];
    $code = 0;
    exec('php -l ' . escapeshellarg($path) . ' 2>&1', $out, $code);
    phase5_ok($code === 0, "php -l $rel");
}

echo str_repeat('-', 40) . "\n";
if ($failures === 0) {
    echo "ALL PASSED\n";
    exit(0);
}
echo "$failures check(s) failed\n";
exit(1);
