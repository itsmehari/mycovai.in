<?php
/**
 * EN/TA language switch for local-news/article.php
 * Requires: $covai_show_tamil_link, $covai_show_english_link (bool),
 *           $covai_pair_english_slug, $covai_pair_tamil_slug (strings for URLs)
 */
if (empty($covai_show_tamil_link) && empty($covai_show_english_link)) {
    return;
}
?>
<div class="article-lang-banner" role="region" aria-label="Article language versions">
<?php if (!empty($covai_show_tamil_link)): ?>
    <div class="article-lang-banner__panel article-lang-banner__panel--tamil">
        <p class="article-lang-banner__text">
            <i class="fas fa-language" aria-hidden="true"></i> This article is also available in Tamil
        </p>
        <a href="/local-news/<?php echo htmlspecialchars($covai_pair_tamil_slug, ENT_QUOTES, 'UTF-8'); ?>"
           class="article-lang-banner__btn article-lang-banner__btn--tamil">
            <i class="fas fa-book" aria-hidden="true"></i> தமிழில் படிக்க
        </a>
    </div>
<?php elseif (!empty($covai_show_english_link)): ?>
    <div class="article-lang-banner__panel article-lang-banner__panel--english">
        <p class="article-lang-banner__text">
            <i class="fas fa-language" aria-hidden="true"></i> This article is also available in English
        </p>
        <a href="/local-news/<?php echo htmlspecialchars($covai_pair_english_slug, ENT_QUOTES, 'UTF-8'); ?>"
           class="article-lang-banner__btn article-lang-banner__btn--english">
            <i class="fas fa-book" aria-hidden="true"></i> Read in English
        </a>
    </div>
<?php endif; ?>
</div>
