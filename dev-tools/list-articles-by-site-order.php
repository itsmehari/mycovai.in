<?php
/**
 * Lists published articles in the same order as coimbatore-news.php (ORDER BY published_date DESC).
 * Usage: DB_HOST=mycovai.in php list-articles-by-site-order.php [limit]
 */
$root = dirname(__DIR__);
chdir($root);
require_once $root . '/core/omr-connect.php';

$limit = isset($argv[1]) && ctype_digit($argv[1]) ? (int) $argv[1] : 30;
$sql = "SELECT slug, title, published_date, CHAR_LENGTH(content) AS content_len
        FROM articles
        WHERE status = 'published' AND slug NOT LIKE '%-tamil'
        ORDER BY published_date DESC
        LIMIT " . (int) $limit;

$res = $conn->query($sql);
if (!$res) {
    fwrite(STDERR, $conn->error . "\n");
    exit(1);
}

echo "Order matches coimbatore-news.php (newest first).\n\n";
$n = 0;
while ($row = $res->fetch_assoc()) {
    $n++;
    echo sprintf(
        "%2d. %s | %s | content_chars=%s\n",
        $n,
        $row['published_date'],
        $row['slug'],
        $row['content_len']
    );
}
$res->close();
$conn->close();
