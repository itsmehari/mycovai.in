<?php
/**
 * Scan live PHP/HTML for MyOMR / OMR legacy strings (excludes docs, archive, dev-tools).
 * Usage: php dev-tools/audit-legacy-myomr-cli.php
 */
declare(strict_types=1);

$root = dirname(__DIR__);
$patterns = ['myomr.in', 'MyOMR', 'My OMR', 'Old Mahabalipuram', 'OMR Chennai', 'myomrCommunity'];
$skipDirs = ['_archive', 'docs', 'dev-tools', '.cursor', 'node_modules', '.git', 'free-ads-chennai'];
$allowlist = [
    'core/ad-registry.php',           // inactive sister-site ad slot (myomr.in link intentional)
    'core/admin-config.php',          // MYOMR_* backward-compat constant aliases
    'core/app-secrets.php',
    'core/env.php',                   // MYOMR_ENV legacy env var
    'core/omr-connect.php',           // DB username contains myomr_ prefix
    'database/build-mycovai-structure-only.php',
    'local-news/article-sports-seo-enhancement.php',
];
$extensions = ['php', 'html'];

$hits = [];

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if (!$file->isFile()) {
        continue;
    }
    $ext = strtolower($file->getExtension());
    if (!in_array($ext, $extensions, true)) {
        continue;
    }
    $rel = str_replace('\\', '/', substr($file->getPathname(), strlen($root) + 1));
    if (in_array($rel, $allowlist, true)) {
        continue;
    }
    foreach ($skipDirs as $skip) {
        if (strpos($rel, $skip . '/') === 0 || $rel === $skip) {
            continue 2;
        }
    }
    $content = file_get_contents($file->getPathname()) ?: '';
    $matched = [];
    foreach ($patterns as $p) {
        if (stripos($content, $p) !== false) {
            $matched[] = $p;
        }
    }
    if ($matched !== []) {
        $hits[$rel] = $matched;
    }
}

uksort($hits, static fn ($a, $b) => count($hits[$b]) <=> count($hits[$a]));

echo "Legacy MyOMR audit — " . count($hits) . " files with matches\n";
echo str_repeat('-', 50) . "\n";

$limit = 30;
$i = 0;
foreach ($hits as $rel => $matched) {
    if ($i++ >= $limit) {
        echo "... and " . (count($hits) - $limit) . " more\n";
        break;
    }
    echo $rel . "\n  → " . implode(', ', $matched) . "\n";
}

echo str_repeat('-', 50) . "\n";
echo "Allowlist: " . implode(', ', $allowlist) . "\n";
echo "Full list: .cursor/maintenance/LEGACY-MYOMR-AUDIT.md\n";
exit(count($hits) === 0 ? 0 : 0);
