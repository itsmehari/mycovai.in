<?php
/**
 * Generate slug-wise UPDATE SQL for editorial upgrades.
 * Reads HTML content from files, outputs UPDATE statements.
 *
 * Usage: php dev-tools/generate-article-update-sql.php [batch-dir]
 *   batch-dir: e.g. "batch-01" or "database/editorial-upgrades/batch-01"
 *   Reads *.html from that dir; filename (without .html) = slug.
 *
 * Alternative: php dev-tools/generate-article-update-sql.php --slug=xxx --content=path/to/file.html --summary="..."
 *
 * Output: SQL to stdout or to database/editorial-upgrades/generated/{batch}-update.sql
 */
$root = dirname(__DIR__);
chdir($root);

function escape_sql($s) {
    return str_replace(["\\", "'", "\r", "\n"], ["\\\\", "''", "\\r", "\\n"], $s);
}

$batchDir = $argv[1] ?? null;
$slug = null;
$contentPath = null;
$summary = null;

foreach (array_slice($argv, 1) as $arg) {
    if (strpos($arg, '--slug=') === 0) {
        $slug = substr($arg, 7);
    } elseif (strpos($arg, '--content=') === 0) {
        $contentPath = substr($arg, 10);
    } elseif (strpos($arg, '--summary=') === 0) {
        $summary = substr($arg, 10);
    }
}

$updates = [];

if ($slug !== null && $contentPath !== null && $summary !== null) {
    $content = file_get_contents($contentPath);
    if ($content === false) {
        fwrite(STDERR, "Cannot read: $contentPath\n");
        exit(1);
    }
    $content = trim($content);
    $updates[] = ['slug' => $slug, 'content' => $content, 'summary' => $summary];
} elseif ($batchDir !== null) {
    $base = $root . '/' . ltrim($batchDir, '/');
    if (!is_dir($base)) {
        $base = $root . '/database/editorial-upgrades/' . $batchDir;
    }
    if (!is_dir($base)) {
        fwrite(STDERR, "Batch dir not found: $batchDir\n");
        exit(1);
    }
    $files = glob($base . '/*.html');
    foreach ($files as $f) {
        $slug = basename($f, '.html');
        $content = trim(file_get_contents($f));
        $summaryPath = dirname($f) . '/' . $slug . '.summary.txt';
        $summary = is_file($summaryPath)
            ? trim(file_get_contents($summaryPath))
            : mb_substr(strip_tags($content), 0, 155);
        $updates[] = ['slug' => $slug, 'content' => $content, 'summary' => $summary];
    }
} else {
    fwrite(STDERR, "Usage: php generate-article-update-sql.php batch-01\n");
    fwrite(STDERR, "   or: php generate-article-update-sql.php --slug=xxx --content=file.html --summary=\"...\"\n");
    exit(1);
}

if (empty($updates)) {
    fwrite(STDERR, "No articles to process.\n");
    exit(1);
}

$sql = "-- Editorial upgrade: " . count($updates) . " article(s)\n";
$sql .= "-- Generated: " . date('Y-m-d H:i') . "\n";
$sql .= "-- Backup articles before running.\n\n";
$sql .= "SET NAMES utf8mb4;\n\n";

foreach ($updates as $u) {
    $slugEsc = addslashes($u['slug']);
    $contentEsc = escape_sql($u['content']);
    $summaryEsc = escape_sql($u['summary']);
    $sql .= "UPDATE articles SET content = '" . $contentEsc . "', summary = '" . $summaryEsc . "', updated_at = NOW() WHERE slug = '" . $slugEsc . "';\n\n";
}

$outDir = $root . '/database/editorial-upgrades/generated';
if (!is_dir($outDir)) {
    mkdir($outDir, 0755, true);
}
$batchName = $batchDir ? basename($batchDir) : 'single';
$outFile = $outDir . '/' . $batchName . '-update.sql';
file_put_contents($outFile, $sql);
echo "Written: $outFile\n";
echo count($updates) . " UPDATE(s)\n";
