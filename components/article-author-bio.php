<?php
/**
 * Author bio card - shows when author field is populated.
 * Requires: $article (with 'author')
 */
$author = trim($article['author'] ?? '');
if (empty($author)) {
    return;
}
$initial = mb_strtoupper(mb_substr($author, 0, 1));
?>
<div class="article-author-bio">
    <div class="article-author-bio__avatar" aria-hidden="true"><?php echo htmlspecialchars($initial); ?></div>
    <div>
        <p class="article-author-bio__name"><?php echo htmlspecialchars($author); ?></p>
        <p class="article-author-bio__role"><?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?> Contributor</p>
    </div>
</div>
