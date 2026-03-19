<?php
/**
 * Update articles.image_path from a JSON map (slug => image_url).
 * Usage: php update-article-images.php [--dry-run]
 *        DB_HOST=mycovai.in php update-article-images.php   (apply to live)
 * With --dry-run: only print what would be updated; do not write to DB.
 */
$root = dirname(__DIR__);
$jsonFile = __DIR__ . '/article-image-urls.json';

if (!is_file($jsonFile)) {
    fwrite(STDERR, "Missing: article-image-urls.json\n");
    exit(1);
}

$map = json_decode(file_get_contents($jsonFile), true);
if (!is_array($map)) {
    fwrite(STDERR, "Invalid JSON in article-image-urls.json\n");
    exit(1);
}

$dryRun = in_array('--dry-run', $argv ?? []);

if ($dryRun) {
    echo "DRY RUN – no changes will be written.\n\n";
} else {
    require_once $root . '/core/omr-connect.php';
}

$updated = 0;
$skipped = 0;
$errors = [];

foreach ($map as $slug => $imageUrl) {
    $slug = trim($slug);
    $imageUrl = trim($imageUrl);
    if ($slug === '' || $imageUrl === '') {
        $skipped++;
        continue;
    }

    if ($dryRun) {
        echo "Would set: slug=" . $slug . " => " . $imageUrl . "\n";
        $updated++;
        continue;
    }

    $stmt = $conn->prepare('UPDATE articles SET image_path = ? WHERE slug = ?');
    if (!$stmt) {
        $errors[] = "Prepare failed for slug $slug: " . $conn->error;
        continue;
    }
    $stmt->bind_param('ss', $imageUrl, $slug);
    if (!$stmt->execute()) {
        $errors[] = "Update failed for slug $slug: " . $stmt->error;
        $stmt->close();
        continue;
    }
    if ($stmt->affected_rows > 0) {
        $updated++;
        echo "Updated: $slug\n";
    } else {
        $skipped++;
    }
    $stmt->close();
}

if (!$dryRun) {
    $conn->close();
}

if (count($errors) > 0) {
    foreach ($errors as $e) {
        fwrite(STDERR, $e . "\n");
    }
}

echo "\nDone. Updated: $updated, Skipped (no row or dry-run): $skipped.\n";
if ($dryRun && $updated > 0) {
    echo "Run without --dry-run to apply to the database (use DB_HOST=mycovai.in for live).\n";
}
