<?php
/**
 * Article tags - clickable pills linking to /local-news/?tag=xyz
 * Requires: $article (with 'tags' field - comma-separated)
 */
$tags_raw = $article['tags'] ?? '';
if (empty(trim($tags_raw))) {
    return;
}
$tags = array_filter(array_map('trim', explode(',', $tags_raw)));
if (empty($tags)) {
    return;
}
?>
<div class="article-tags-section">
    <span class="article-tags-section__title">Topics:</span>
    <div class="article-tags-list">
        <?php foreach ($tags as $tag): ?>
        <a href="/coimbatore-news.php?tag=<?php echo urlencode($tag); ?>" class="article-tag"><?php echo htmlspecialchars($tag); ?></a>
        <?php endforeach; ?>
    </div>
</div>
