<?php
/**
 * Remove specific articles by title (exact match).
 * Run: php remove-articles-by-title.php
 *      DB_HOST=mycovai.in php remove-articles-by-title.php  [live]
 */
$root = dirname(__DIR__);
require_once $root . '/core/omr-connect.php';

$titles_to_remove = [
    'Social welfare dept in Coimbatore to train students as informers to prevent child marriages',
    'Scrap 6% yearly tax hike: Coimbatore mayor writes to govt',
    'Coimbatore forest rangers arrest four for selling elephant tusk, leopard claws and teeth',
    'Coimbatore police bust drug racket, seven arrested',
    'Open dumping of waste persists in Coimbatore despite corporation warning',
    'Coimbatore Mayor to request State government to reconsider property tax increase',
    'Coimbatore airport new integrated terminal to be four times bigger',
    'Centre to commence Coimbatore airport expansion in five months, complete by 2028',
    'Tenders called for interim expansion of Coimbatore airport at Rs 10.92 crore',
    'Final land plan schedule for Coimbatore Metro to be completed within two months',
];

$stmt = $conn->prepare('DELETE FROM articles WHERE title = ?');
if (!$stmt) {
    fwrite(STDERR, "Prepare failed: " . $conn->error . "\n");
    exit(1);
}

$deleted = 0;
foreach ($titles_to_remove as $title) {
    $stmt->bind_param('s', $title);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $deleted++;
        echo "Deleted: " . substr($title, 0, 60) . (strlen($title) > 60 ? '...' : '') . "\n";
    }
}
$stmt->close();
$conn->close();

echo "\nDone. Deleted: $deleted of " . count($titles_to_remove) . ".\n";
