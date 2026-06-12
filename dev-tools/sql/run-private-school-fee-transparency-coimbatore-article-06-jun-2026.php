<?php
/**
 * Publish private school fee transparency article (Coimbatore / Covai).
 *
 * Run (local):  php dev-tools/sql/run-private-school-fee-transparency-coimbatore-article-06-jun-2026.php
 * Run (live):   DB_HOST=mycovai.in php dev-tools/sql/run-private-school-fee-transparency-coimbatore-article-06-jun-2026.php
 */
$root = dirname(__DIR__, 2);
require_once $root . '/core/omr-connect.php';
require_once __DIR__ . '/fee-transparency-article-covai-body.php';

$published_date = '2026-06-06 11:30:00';
$author = 'MyCovai Editorial Team';
$category = 'Education';
$image_path = 'https://mycovai.in/images/TN-Education-Minister-Directs-Pvt-Schools-on-Fee-Transparency.png';
$is_featured = 1;
$status = 'published';

$article = [
    'slug'    => 'private-school-owners-ready-to-comply-coimbatore-fee-transparency',
    'title'   => 'Private School Owners Ready to Comply? Coimbatore Parents Watch Tamil Nadu\'s Fee Transparency Order',
    'summary' => 'Tamil Nadu has ordered private schools to display approved fee structures publicly. The move began from a Coimbatore RTI case and now matters directly to parents across Coimbatore.',
    'tags'    => 'Coimbatore private school fees, Tamil Nadu school fee transparency, Covai school admissions, private school fees Coimbatore, CBSE school fees Tamil Nadu, school fee structure Coimbatore',
    'content' => fee_transparency_article_html(),
];

$check = $conn->prepare('SELECT id FROM articles WHERE slug = ? LIMIT 1');
$check->bind_param('s', $article['slug']);
$check->execute();
$existing = $check->get_result()->fetch_assoc();
$check->close();

if ($existing) {
    $stmt = $conn->prepare(
        'UPDATE articles SET title = ?, summary = ?, content = ?, published_date = ?, author = ?, category = ?, tags = ?, image_path = ?, is_featured = ?, status = ?, updated_at = NOW() WHERE slug = ?'
    );
    $stmt->bind_param(
        'ssssssssiss',
        $article['title'],
        $article['summary'],
        $article['content'],
        $published_date,
        $author,
        $category,
        $article['tags'],
        $image_path,
        $is_featured,
        $status,
        $article['slug']
    );
    if ($stmt->execute()) {
        echo "Updated article id {$existing['id']}: {$article['slug']}\n";
    } else {
        fwrite(STDERR, 'Update failed: ' . $stmt->error . "\n");
        exit(1);
    }
    $stmt->close();
} else {
    $stmt = $conn->prepare(
        'INSERT INTO articles (title, slug, summary, content, published_date, author, category, tags, image_path, is_featured, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())'
    );
    $stmt->bind_param(
        'sssssssssis',
        $article['title'],
        $article['slug'],
        $article['summary'],
        $article['content'],
        $published_date,
        $author,
        $category,
        $article['tags'],
        $image_path,
        $is_featured,
        $status
    );
    if ($stmt->execute()) {
        echo "Inserted article id {$conn->insert_id}: {$article['slug']}\n";
    } else {
        fwrite(STDERR, 'Insert failed: ' . $stmt->error . "\n");
        exit(1);
    }
    $stmt->close();
}

echo "Canonical: https://mycovai.in/local-news/{$article['slug']}\n";
$conn->close();
echo "Done.\n";
