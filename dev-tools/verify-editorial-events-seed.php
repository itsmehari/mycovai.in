<?php
if (PHP_SAPI !== 'cli') {
    exit;
}
require __DIR__ . '/../core/omr-connect.php';
if ($conn->connect_errno) {
    fwrite(STDERR, $conn->connect_error . "\n");
    exit(1);
}
$slugs = [
    'coimbatore-maasi-mahotsavam-2026',
    'vihansa-2026-sri-ramakrishna-institute-of-technology',
    'holi-celebration-coimbatore-gandhipuram-mar-2026',
    'hackxelerate-26-kpr-iet-coimbatore',
    'ncraet-coimbatore-april-2026',
];
$in = "'" . implode("','", array_map([$conn, 'real_escape_string'], $slugs)) . "'";
$res = $conn->query("SELECT id, slug, status, featured FROM event_listings WHERE slug IN ($in) ORDER BY id");
if (!$res) {
    fwrite(STDERR, $conn->error . "\n");
    exit(1);
}
$n = 0;
while ($row = $res->fetch_assoc()) {
    echo $row['id'] . "\t" . $row['slug'] . "\t" . $row['status'] . "\tfeatured=" . $row['featured'] . "\n";
    $n++;
}
echo "Rows: $n (expected " . count($slugs) . ")\n";
