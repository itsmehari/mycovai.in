<?php
require_once __DIR__ . '/core/omr-connect.php';
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyCovai';
$site_domain = defined('SITE_DOMAIN') ? SITE_DOMAIN : 'https://mycovai.in';
$contact_email = defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'mycovai@gmail.com';
$required_text = defined('AMAZON_ASSOCIATE_DISCLOSURE_TEXT')
    ? AMAZON_ASSOCIATE_DISCLOSURE_TEXT
    : 'As an Amazon Associate, I earn from qualifying purchases.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Disclosure - <?php echo htmlspecialchars($site_name); ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <?php include __DIR__ . '/components/main-nav.php'; ?>
    <main style="max-width: 900px; margin: 2rem auto; padding: 2rem; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <h1>Affiliate Disclosure</h1>
        <p>
            <?php echo htmlspecialchars($site_name); ?> may include affiliate links on selected pages.
            If you click an affiliate link and complete a purchase, we may earn a commission at no extra cost to you.
        </p>

        <h2>Amazon Associates Program</h2>
        <p><strong><?php echo htmlspecialchars($required_text); ?></strong></p>

        <h2>How affiliate links are used</h2>
        <ul>
            <li>Affiliate units are shown in clearly labeled ad/affiliate slots.</li>
            <li>Editorial integrity is maintained; affiliate links do not change our local news coverage.</li>
            <li>We avoid placing affiliate links in sensitive/admin-only workflows.</li>
        </ul>

        <h2>Questions</h2>
        <p>
            For questions about this disclosure, contact us at
            <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>"><?php echo htmlspecialchars($contact_email); ?></a>.
        </p>
        <p>
            Website: <a href="<?php echo htmlspecialchars($site_domain); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($site_domain); ?></a>
        </p>
    </main>
    <?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
