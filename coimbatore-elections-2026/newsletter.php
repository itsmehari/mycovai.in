<?php
require_once __DIR__ . '/includes/bootstrap.php';

$base = ELECTIONS_2026_BASE_URL;
$canonical_url = $base . '/newsletter.php';
$page_title = 'Newsletter – Coimbatore Elections 2026 | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'Subscribe for election reminders and updates for Tamil Nadu Assembly election 2026 in Coimbatore.';
$page_keywords = 'election newsletter, Coimbatore election updates, subscribe';
$og_title = $page_title;
$og_description = $page_description;
$og_url = $canonical_url;
$twitter_title = $page_title;
$twitter_description = $page_description;
$breadcrumbs = [
    [get_canonical_base() . '/', 'Home'],
    [$base . '/', 'Elections 2026'],
    [$canonical_url, 'Newsletter'],
];

$source_page = 'coimbatore-elections-2026';
$thank_you = false;
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $honeypot = isset($_POST['website']) ? trim($_POST['website']) : '';
    if ($honeypot !== '') {
        $thank_you = true;
    } else {
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $file = ROOT_PATH . '/weblog/subscribers-elections-2026.txt';
            $line = $email . "\t" . $source_page . "\t" . date('Y-m-d H:i:s') . "\n";
            if (@file_put_contents($file, $line, FILE_APPEND | LOCK_EX) !== false) {
                $thank_you = true;
            } else {
                $error_msg = 'Subscription could not be saved. Please try again.';
            }
        } else {
            $error_msg = 'Please enter a valid email address.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ROOT_PATH . '/components/meta.php'; ?>
    <?php include ROOT_PATH . '/components/head-resources.php'; ?>
    <?php include ROOT_PATH . '/components/analytics.php'; ?>
</head>
<body>
<a href="#main-content" class="visually-hidden-focusable skip-link">Skip to main content</a>
<?php include ROOT_PATH . '/components/main-nav.php'; ?>
<main id="main-content" class="container py-5">
    <h1>Newsletter</h1>
    <?php if ($thank_you): ?>
    <div class="alert alert-success">Thank you for subscribing. We'll send election reminders and updates.</div>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">Back to Elections 2026</a></p>
    <?php else: ?>
    <p class="lead">Get election reminders and updates for Coimbatore 2026.</p>
    <?php if ($error_msg): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error_msg); ?></div>
    <?php endif; ?>
    <form method="post" action="" class="mb-4">
        <div class="mb-3">
            <label for="newsletter-email" class="form-label">Email</label>
            <input type="email" id="newsletter-email" name="email" class="form-control" required placeholder="you@email.com">
        </div>
        <div class="mb-3 visually-hidden" aria-hidden="true">
            <label for="newsletter-website">Website</label>
            <input type="text" id="newsletter-website" name="website" tabindex="-1" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary">Subscribe</button>
    </form>
    <p><a href="<?php echo htmlspecialchars($base); ?>/">← Back to Elections 2026</a></p>
    <?php endif; ?>
</main>
<?php include ROOT_PATH . '/components/footer.php'; ?>
</body>
</html>
