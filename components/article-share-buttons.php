<?php
/**
 * Share this article buttons - social media friendly.
 * Uses native share URLs; no JS SDK required.
 *
 * Required: $article_url, $article_title
 * Optional: $article_summary (for email body)
 */
if (empty($article_url) || empty($article_title)) {
    return;
}
$summary = isset($article_summary) ? $article_summary : $article_title;
$encoded_url = rawurlencode($article_url);
$encoded_title = rawurlencode($article_title);
$encoded_summary = rawurlencode(substr(strip_tags($summary), 0, 200));
$share_text = $encoded_title . '%20' . $encoded_url;
?>
<section class="article-share-section" id="share-article" aria-label="Share this article">
    <h3 class="article-share-section__title"><i class="fas fa-share-alt"></i> Share this article</h3>
    <div class="article-share-buttons">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encoded_url; ?>" target="_blank" rel="noopener noreferrer" class="article-share-btn article-share-btn--facebook" title="Share on Facebook" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo $encoded_url; ?>&text=<?php echo $encoded_title; ?>" target="_blank" rel="noopener noreferrer" class="article-share-btn article-share-btn--twitter" title="Share on X (Twitter)" aria-label="Share on X"><i class="fab fa-x-twitter"></i></a>
        <a href="https://wa.me/?text=<?php echo $share_text; ?>" target="_blank" rel="noopener noreferrer" class="article-share-btn article-share-btn--whatsapp" title="Share on WhatsApp" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $encoded_url; ?>&title=<?php echo $encoded_title; ?>&summary=<?php echo $encoded_summary; ?>" target="_blank" rel="noopener noreferrer" class="article-share-btn article-share-btn--linkedin" title="Share on LinkedIn" aria-label="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        <a href="https://t.me/share/url?url=<?php echo $encoded_url; ?>&text=<?php echo $encoded_title; ?>" target="_blank" rel="noopener noreferrer" class="article-share-btn article-share-btn--telegram" title="Share on Telegram" aria-label="Share on Telegram"><i class="fab fa-telegram-plane"></i></a>
        <a href="mailto:?subject=<?php echo $encoded_title; ?>&body=<?php echo $encoded_url; ?>" class="article-share-btn article-share-btn--email" title="Share via Email" aria-label="Share via Email"><i class="fas fa-envelope"></i></a>
        <button type="button" class="article-share-btn article-share-btn--copy" id="article-copy-link-btn" title="Copy link" aria-label="Copy link"><i class="fas fa-link"></i><span class="article-share-btn__label">Copy</span></button>
        <button type="button" class="article-share-btn article-share-btn--native" id="article-native-share-btn" title="Share" aria-label="Share (native)" style="display:none;"><i class="fas fa-share-nodes"></i><span class="article-share-btn__label">Share</span></button>
    </div>
</section>
