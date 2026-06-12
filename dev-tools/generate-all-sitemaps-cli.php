<?php
/**
 * Regenerate all sitemap XML files (static + module outputs).
 * Usage: php dev-tools/generate-all-sitemaps-cli.php
 *
 * DB-backed modules need DB_HOST/DB_USER/DB_PASS/DB_NAME (or local defaults in omr-connect).
 */
declare(strict_types=1);

$root = dirname(__DIR__);
$php = PHP_BINARY;
$failures = 0;

function write_sitemap(string $path, string $xml, string $label): void
{
    global $failures;
    if ($xml === '' || (strpos($xml, '<urlset') === false && strpos($xml, '<sitemapindex') === false)) {
        echo "FAIL $label — empty or invalid XML\n";
        $failures++;
        return;
    }
    file_put_contents($path, $xml);
    $count = substr_count($xml, '<url>');
    echo "OK   $label → " . basename(dirname($path)) . '/' . basename($path) . ($count ? " ($count URLs)" : '') . "\n";
}

function run_php_script(string $php, string $script): array
{
    $cmd = escapeshellarg($php) . ' ' . escapeshellarg($script) . ' 2>&1';
    $output = [];
    exec($cmd, $output, $code);
    return [$code, implode("\n", $output)];
}

echo "Sitemap generation\n";
echo str_repeat('-', 50) . "\n";

// 1. Static hub pages
[$code, $xml] = run_php_script($php, $root . '/weblog/generate-static-sitemap.php');
if ($code !== 0) {
    echo "FAIL static hub — exit $code\n";
    $failures++;
} else {
    write_sitemap($root . '/sitemap.xml', $xml, 'static hub pages');
}

// 2. Module sitemaps
$modules = [
    'jobs' => ['script' => $root . '/jobs/generate-sitemap.php', 'out' => $root . '/jobs/sitemap.xml', 'file_writer' => true],
    'directory' => ['script' => $root . '/directory/generate-listings-sitemap.php', 'out' => $root . '/directory/sitemap.xml', 'file_writer' => false],
    'local-events' => ['script' => $root . '/local-events/generate-events-sitemap.php', 'out' => $root . '/local-events/sitemap.xml', 'file_writer' => false],
    'local-news' => ['script' => $root . '/local-news/generate-sitemap.php', 'out' => $root . '/local-news/sitemap.xml', 'file_writer' => false],
    'hostels-pgs' => ['script' => $root . '/hostels-pgs/generate-sitemap.php', 'out' => $root . '/hostels-pgs/sitemap.xml', 'file_writer' => false],
    'coworking-spaces' => ['script' => $root . '/coworking-spaces/generate-sitemap.php', 'out' => $root . '/coworking-spaces/sitemap.xml', 'file_writer' => false],
    'elections' => ['script' => $root . '/coimbatore-elections-2026/generate-sitemap.php', 'out' => $root . '/coimbatore-elections-2026/sitemap.xml', 'file_writer' => false],
];

foreach ($modules as $name => $cfg) {
    if (!is_file($cfg['script'])) {
        echo "SKIP $name — generator missing\n";
        continue;
    }
    [$code, $out] = run_php_script($php, $cfg['script']);
    if ($code !== 0) {
        echo "FAIL $name — exit $code ($out)\n";
        $failures++;
        continue;
    }
    if (!empty($cfg['file_writer']) && is_file($cfg['out'])) {
        $xml = (string) file_get_contents($cfg['out']);
    } else {
        $xml = $out;
        if ($xml !== '') {
            file_put_contents($cfg['out'], $xml);
        }
    }
    write_sitemap($cfg['out'], $xml, $name);
}

// 3. Sitemap index preview
[$code, $index] = run_php_script($php, $root . '/weblog/generate-sitemap-index.php');
if ($code !== 0) {
    echo "FAIL sitemap index — exit $code\n";
    $failures++;
} else {
    write_sitemap($root . '/sitemap-index-preview.xml', $index, 'sitemap index preview');
}

echo str_repeat('-', 50) . "\n";
echo $failures === 0 ? "All sitemaps generated.\n" : "$failures generator(s) failed.\n";
exit($failures === 0 ? 0 : 1);
