<?php
/**
 * Featured News Links – Editor's picks in card-style grid
 * Requires: core/omr-connect.php, articles table
 */
if (!defined('FEATURED_NEWS_LINKS')) {
    define('FEATURED_NEWS_LINKS', true);
}
$featured_articles = [];
if (file_exists(__DIR__ . '/../core/omr-connect.php')) {
    require_once __DIR__ . '/../core/omr-connect.php';
    $sql = "SELECT id, title, slug, summary, image_path, published_date 
            FROM articles 
            WHERE status = 'published' 
            AND slug NOT LIKE '%-tamil' 
            AND (is_featured = 1 OR is_featured = true) 
            ORDER BY published_date DESC 
            LIMIT 6";
    $res = isset($conn) ? $conn->query($sql) : null;
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $featured_articles[] = $row;
        }
    }
}
?>
<link rel="stylesheet" href="/assets/css/featured-news-links.css">
<section class="featured-news-section" aria-labelledby="featured-news-heading">
    <h2 id="featured-news-heading" class="featured-news-heading">Editor's picks</h2>
    <div class="featured-news-grid">
        <?php if (!empty($featured_articles)): ?>
            <?php foreach ($featured_articles as $art): ?>
                <?php
                $img = $art['image_path'] ?? null;
                $img_url = '';
                if ($img) {
                    $img_url = (strpos($img, 'http://') === 0 || strpos($img, 'https://') === 0)
                        ? $img
                        : 'https://mycovai.in' . (strpos($img, '/') === 0 ? '' : '/') . $img;
                } else {
                    $img_url = 'https://mycovai.in/My-OMR-Logo.jpg';
                }
                ?>
                <a href="/local-news/<?php echo htmlspecialchars($art['slug']); ?>" class="featured-news-card">
                    <div class="featured-news-card-image">
                        <img src="<?php echo htmlspecialchars($img_url); ?>" alt="<?php echo htmlspecialchars($art['title']); ?>" loading="lazy">
                    </div>
                    <div class="featured-news-card-body">
                        <h3 class="featured-news-card-title"><?php echo htmlspecialchars($art['title']); ?></h3>
                        <?php if (!empty($art['summary'])): ?>
                            <p class="featured-news-card-summary"><?php echo htmlspecialchars(mb_substr($art['summary'], 0, 100)); ?><?php echo mb_strlen($art['summary']) > 100 ? '…' : ''; ?></p>
                        <?php endif; ?>
                        <span class="featured-news-card-date"><?php echo $art['published_date'] ? date('M d, Y', strtotime($art['published_date'])) : ''; ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="featured-news-empty">No editor's picks available.</p>
        <?php endif; ?>
    </div>
</section>
