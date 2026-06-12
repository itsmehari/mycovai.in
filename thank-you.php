<?php
require_once __DIR__ . '/core/omr-connect.php';
$home = defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in';
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyCovai';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you | <?php echo htmlspecialchars($site_name); ?></title>
    <meta name="robots" content="noindex, follow">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>body { text-align: center; padding: 4rem 1rem; font-family: system-ui, sans-serif; }</style>
</head>
<body>
    <h1 class="text-success">Thank you for subscribing!</h1>
    <p class="lead">We've added you to the <?php echo htmlspecialchars($site_name); ?> mailing list.</p>
    <p>
        <a href="<?php echo htmlspecialchars($home); ?>/" class="btn btn-success me-2">Go to homepage</a>
        <a href="#" onclick="history.back(); return false;" class="btn btn-outline-secondary">Go back</a>
    </p>
</body>
</html>
