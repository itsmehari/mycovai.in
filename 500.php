<?php
http_response_code(500);
require_once __DIR__ . '/core/omr-connect.php';

$page_title = 'Something went wrong | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'A temporary error occurred. Please try again or contact MyCovai support.';
$canonical_url = (defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in') . '/500.php';
$contact_email = defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'mycovai@gmail.com';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/components/meta.php'; ?>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <style>
        body { font-family: 'Poppins', sans-serif; text-align: center; padding: 4rem 1rem; }
        h1 { color: #0f5132; }
    </style>
</head>
<body>
<?php include __DIR__ . '/components/main-nav.php'; ?>
<h1>500 — Server error</h1>
<p class="lead">We're sorry — something went wrong on our side.</p>
<p><a href="/" class="btn btn-success">Back to home</a>
   <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>" class="btn btn-outline-success">Email support</a></p>
<?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
