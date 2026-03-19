<?php
/**
 * Report article / report inconsistencies form.
 * On submit sends to process-article-report.php, emails myomrnews@gmail.com.
 *
 * Required: $article_url, $article_slug (or title for context)
 */
if (empty($article_url)) {
    return;
}
$report_success = isset($_GET['reported']) && $_GET['reported'] == '1';
$report_error = isset($_GET['report_error']);
?>
<section class="article-report-section" id="report-article" aria-label="Report article">
    <h3 class="article-report-section__title"><i class="fas fa-flag"></i> Report this article or inconsistencies</h3>
    <p class="article-report-section__desc">Found an error or have feedback? Let us know and we'll review it.</p>

    <?php if ($report_success): ?>
    <div class="article-report-alert article-report-alert--success">
        <i class="fas fa-check-circle"></i> Thank you. Your report has been submitted and we'll look into it.
    </div>
    <?php elseif ($report_error): ?>
    <div class="article-report-alert article-report-alert--error">
        <i class="fas fa-exclamation-circle"></i> Sorry, there was an error. Please try again or email us directly.
    </div>
    <?php endif; ?>

    <form method="POST" action="/info/process-article-report.php" class="article-report-form">
        <input type="hidden" name="article_url" value="<?php echo htmlspecialchars($article_url); ?>">
        <input type="hidden" name="article_title" value="<?php echo htmlspecialchars($article_title ?? ''); ?>">
        <input type="text" name="website" style="position:absolute;left:-9999px;" tabindex="-1" autocomplete="off" aria-hidden="true">

        <div class="article-report-form__group">
            <label for="report_comment">Your comments <span class="required">*</span></label>
            <textarea id="report_comment" name="comment" required rows="4" maxlength="2000" placeholder="Describe the issue: factual error, typo, outdated info, etc."></textarea>
        </div>
        <div class="article-report-form__group">
            <label for="report_email">Your email (optional, for follow-up)</label>
            <input type="email" id="report_email" name="email" placeholder="your@email.com">
        </div>
        <button type="submit" name="report_article" class="article-report-form__submit">
            <i class="fas fa-paper-plane"></i> Submit report
        </button>
    </form>
</section>
