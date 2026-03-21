<?php
/**
 * Lists published articles likely still on short "stub" content (same order as coimbatore-news.php).
 * Heuristic: CHAR_LENGTH(content) < threshold (longform updates are typically 12k+ chars).
 * Usage: DB_HOST=mycovai.in php list-pending-longform-stubs.php [threshold]
 */
$root = dirname(__DIR__);
chdir($root);
require_once $root . '/core/omr-connect.php';

$threshold = isset($argv[1]) && ctype_digit($argv[1]) ? (int) $argv[1] : 8000;

$sql = "SELECT slug, title, published_date, CHAR_LENGTH(content) AS content_len
        FROM articles
        WHERE status = 'published' AND slug NOT LIKE '%-tamil'
        AND CHAR_LENGTH(content) < " . (int) $threshold . "
        ORDER BY published_date DESC";

$res = $conn->query($sql);
if (!$res) {
    fwrite(STDERR, $conn->error . "\n");
    exit(1);
}

echo "Pending longform (content_chars < {$threshold}), newest first — same order as Covai News.\n\n";
$n = 0;
while ($row = $res->fetch_assoc()) {
    $n++;
    echo sprintf(
        "%2d. %s | %s | chars=%s\n   %s\n",
        $n,
        $row['published_date'],
        $row['slug'],
        $row['content_len'],
        $row['title']
    );
}
if ($n === 0) {
    echo "(none under threshold)\n";
}
$res->close();
$conn->close();
