<?php
/**
 * Article report form handler.
 * Sends report to myomrnews@gmail.com with article URL and user comments.
 */

require_once __DIR__ . '/../core/email.php';

$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/coimbatore-news.php';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_article'])) {
    if (!empty($_POST['website'])) {
        header('Location: ' . $redirect_url . '?reported=1');
        exit;
    }

    $article_url = trim($_POST['article_url'] ?? '');
    $article_title = trim($_POST['article_title'] ?? '');
    $comment = trim($_POST['comment'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);

    if (empty($comment) || strlen($comment) < 10) {
        header('Location: ' . $redirect_url . '?report_error=1&reason=short');
        exit;
    }

    $to = 'myomrnews@gmail.com';
    $subject = 'Article Report: ' . (mb_strlen($article_title) > 50 ? mb_substr($article_title, 0, 50) . '...' : $article_title);

    $body = '<h2>Article Report / Inconsistency Report</h2>';
    $body .= '<p><strong>Article URL:</strong> <a href="' . htmlspecialchars($article_url) . '">' . htmlspecialchars($article_url) . '</a></p>';
    if (!empty($article_title)) {
        $body .= '<p><strong>Article Title:</strong> ' . htmlspecialchars($article_title) . '</p>';
    }
    $body .= '<p><strong>Comment:</strong></p><p>' . nl2br(htmlspecialchars($comment)) . '</p>';
    if (!empty($email)) {
        $body .= '<p><strong>Reporter Email:</strong> ' . htmlspecialchars($email) . '</p>';
    }
    $body .= '<p><strong>Submitted:</strong> ' . date('Y-m-d H:i:s') . '</p>';

    $htmlBody = renderEmailTemplate('Article Report - MyCovai', $body);

    if (sendEmail($to, $subject, $htmlBody, 'no-reply@mycovai.in', 'MyCovai Article Report')) {
        $success = true;
    }
}

$sep = (strpos($redirect_url, '?') !== false) ? '&' : '?';
header('Location: ' . $redirect_url . $sep . ($success ? 'reported=1' : 'report_error=1'));
exit;
