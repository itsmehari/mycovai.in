<?php
/**
 * Table of contents - generated from h2/h3 in article content.
 * Requires: $article['content'] or pre-parsed $article_headings array
 */
if (empty($article['content'])) {
    return;
}
preg_match_all('/<h([23])[^>]*>([^<]+)<\/h\1>/i', $article['content'], $matches);
if (empty($matches[0])) {
    return;
}
$headings = [];
foreach ($matches[2] as $i => $text) {
    $level = (int) $matches[1][$i];
    $id = 'section-' . ($i + 1);
    $headings[] = ['level' => $level, 'text' => trim(strip_tags($text)), 'id' => $id];
}
if (count($headings) < 2) {
    return;
}
?>
<div class="article-toc">
    <h3 class="article-toc__title"><i class="fas fa-list"></i> In this article</h3>
    <ul class="article-toc__list">
        <?php foreach ($headings as $h): ?>
        <li class="article-toc__item article-toc__item--h<?php echo $h['level']; ?>">
            <a href="#<?php echo htmlspecialchars($h['id']); ?>" class="article-toc__link"><?php echo htmlspecialchars($h['text']); ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
