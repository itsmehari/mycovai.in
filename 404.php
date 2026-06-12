<?php
http_response_code(404);
require_once __DIR__ . '/core/omr-connect.php';

$page_title = 'Page not found | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'The page you requested could not be found. Explore Coimbatore directory, jobs, events and news on MyCovai.';
$page_keywords = 'MyCovai, 404, Coimbatore directory';
$canonical_url = (defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in') . '/404.php';
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyCovai';
$region = defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'Covai';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/components/meta.php'; ?>
    <meta name="robots" content="noindex, follow">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/main.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .error-hero { background: linear-gradient(135deg, #0f5132 0%, #22c55e 100%); color: #fff; padding: 4rem 0; text-align: center; }
        .error-hero h1 { font-family: 'Fraunces', serif; font-size: 3rem; margin-bottom: 0.5rem; }
        .error-links a { display: inline-block; margin: 0.35rem; }
    </style>
    <?php include __DIR__ . '/components/analytics.php'; ?>
</head>
<body>
<?php include __DIR__ . '/components/main-nav.php'; ?>

<div class="error-hero">
    <div class="container" style="max-width: 720px;">
        <h1>404</h1>
        <p class="lead mb-0">We couldn't find that page. It may have moved during our <?php echo htmlspecialchars($region); ?> rebrand.</p>
    </div>
</div>

<div class="container py-5" style="max-width: 720px;">
    <p class="text-muted text-center mb-4">Try one of these popular sections on <?php echo htmlspecialchars($site_name); ?>:</p>
    <div class="error-links text-center">
        <a href="/" class="btn btn-success">Home</a>
        <a href="/directory/" class="btn btn-outline-success">Directory</a>
        <a href="/jobs/" class="btn btn-outline-success">Jobs</a>
        <a href="/local-events/" class="btn btn-outline-success">Events</a>
        <a href="/coimbatore-news.php" class="btn btn-outline-success">News</a>
        <a href="/contact.php" class="btn btn-outline-success">Contact</a>
    </div>
    <p class="text-center mt-4 small text-muted">If you followed an old Chennai/OMR bookmark, we've set up redirects — use the links above to find <?php echo htmlspecialchars($region); ?> content.</p>
</div>

<?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
