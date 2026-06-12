<?php
/**
 * Phase 4 branding / nav smoke tests (no database required).
 *
 * Usage: php dev-tools/test-phase4-branding-cli.php
 */
$root = dirname(__DIR__);
chdir($root);

$failures = 0;

function phase4_ok(bool $cond, string $message): void
{
    if ($cond) {
        echo "OK   {$message}\n";
        return;
    }
    echo "FAIL {$message}\n";
    global $failures;
    $failures++;
}

echo "=== Phase 4 branding tests ===\n\n";

$lintFiles = [
    'core/mycovai-config.php',
    'core/site-branding.php',
    'components/homepage-header.php',
    'components/main-nav.php',
    'components/organization-schema.php',
    'components/meta.php',
    'core/action-links.php',
    'components/action-buttons.php',
    'dev-tools/test-phase4-branding-cli.php',
];

echo "-- PHP syntax --\n";
foreach ($lintFiles as $rel) {
    $path = $root . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rel);
    exec('php -l ' . escapeshellarg($path) . ' 2>&1', $out, $code);
    phase4_ok($code === 0, "syntax {$rel}");
}

echo "\n-- Config & logo --\n";
require $root . '/core/mycovai-config.php';
phase4_ok(defined('SITE_NAME') && SITE_NAME === 'MyCovai', 'SITE_NAME is MyCovai');
phase4_ok(function_exists('covai_logo_url'), 'covai_logo_url() exists');
$logoPath = $root . covai_logo_url();
phase4_ok(is_file($logoPath), 'logo file exists at ' . covai_logo_url());
phase4_ok(SITE_LOGO_URL === '/assets/img/mycovai-logo.svg', 'SITE_LOGO_URL points to new SVG');

echo "\n-- Key component content --\n";
$checks = [
    'components/homepage-header.php' => [
        'must' => ['/directory/get-listed.php', '/jobs/employer-landing-covai.php', 'List Your Business', 'Post a Job'],
        'must_not' => ['MyOMR', 'Add Listing'],
    ],
    'components/main-nav.php' => [
        'must' => ['/jobs/', '/coimbatore-news.php', '/directory/get-listed.php', 'mycovai-logo.svg'],
        'must_not' => ['news-highlights-from-omr-road', 'sell-rent-property-house-plot-omr-chennai', 'MyOMR'],
    ],
    'core/action-links.php' => [
        'must' => ['/directory/get-listed.php', '/jobs/', '/coimbatore-news.php'],
        'must_not' => ['post-business-ad-omr', 'add-business-directory-omr', 'MyOMR'],
    ],
    'components/action-buttons.php' => [
        'must' => ['/directory/get-listed.php', '/jobs/', '/coimbatore-news.php'],
        'must_not' => ['tutions-classes-courses-training-centers-in-omr', 'MyOMR'],
    ],
    'components/organization-schema.php' => [
        'must' => ['covai_site_name', 'covai_logo_url'],
        'must_not' => ["'MyOMR'", 'myomrCommunity'],
    ],
    'hostels-pgs/add-property.php' => [
        'must' => ['MyCovai', 'Coimbatore'],
        'must_not' => ['MyOMR', 'OMR Chennai'],
    ],
    'coworking-spaces/add-space.php' => [
        'must' => ['MyCovai', 'Coimbatore'],
        'must_not' => ['MyOMR', 'OMR Chennai'],
    ],
];

foreach ($checks as $rel => $rules) {
    $content = file_get_contents($root . '/' . str_replace('/', DIRECTORY_SEPARATOR, $rel));
    foreach ($rules['must'] as $needle) {
        phase4_ok(stripos($content, $needle) !== false, "{$rel} contains “{$needle}”");
    }
    foreach ($rules['must_not'] as $needle) {
        phase4_ok(stripos($content, $needle) === false, "{$rel} does not contain “{$needle}”");
    }
}

echo "\n-- Render smoke (homepage header) --\n";
ob_start();
$_SERVER['REQUEST_URI'] = '/';
include $root . '/components/homepage-header.php';
$headerHtml = ob_get_clean();
phase4_ok(stripos($headerHtml, 'MyCovai') !== false, 'homepage-header renders MyCovai');
phase4_ok(stripos($headerHtml, 'get-listed.php') !== false, 'homepage-header renders get-listed CTA');
phase4_ok(stripos($headerHtml, 'mycovai-logo.svg') !== false, 'homepage-header renders logo');

echo "\n=== Result: " . ($failures === 0 ? 'ALL PASSED' : "{$failures} FAILED") . " ===\n";
exit($failures > 0 ? 1 : 0);
