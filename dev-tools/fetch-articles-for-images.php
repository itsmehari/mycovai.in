<?php
/**
 * Fetch published articles (id, slug, title, summary, category) for image assignment.
 * Usage: php fetch-articles-for-images.php [--json]
 *        DB_HOST=mycovai.in php fetch-articles-for-images.php --json   (remote)
 * Output: JSON array to stdout (or human-readable if no --json).
 */
$root = dirname(__DIR__);
require_once $root . '/core/omr-connect.php';

$json = in_array('--json', $argv ?? []);

$sql = "SELECT id, slug, title, summary, category 
        FROM articles 
        WHERE status = 'published' 
        AND (slug IS NULL OR slug NOT LIKE '%-tamil') 
        ORDER BY published_date DESC";
$result = $conn->query($sql);
if (!$result) {
    fwrite(STDERR, "Query failed: " . $conn->error . "\n");
    exit(1);
}

$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}
$result->free();
$conn->close();

if ($json) {
    echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
    foreach ($rows as $r) {
        echo $r['id'] . "\t" . $r['slug'] . "\t" . substr($r['title'], 0, 60) . "\n";
    }
    echo "Total: " . count($rows) . " articles\n";
}
