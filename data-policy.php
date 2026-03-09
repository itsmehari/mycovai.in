<?php
require_once __DIR__ . '/core/omr-connect.php';
$page_title = 'Data Policy – ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$contact_email = defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'mycovai@gmail.com';
$site_domain = defined('SITE_DOMAIN') ? SITE_DOMAIN : 'https://mycovai.in';
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyCovai';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
    <style>
        .policy-container { max-width: 900px; margin: 2rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        .policy-container h1 { color: #14532d; font-size: 2.2rem; margin-bottom: 1rem; }
        .policy-container h2 { color: #22c55e; font-size: 1.3rem; margin-top: 1.5rem; }
        .policy-container ul { margin-left: 1.5rem; }
        .policy-container p, .policy-container li { color: #333; line-height: 1.7; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/components/main-nav.php'; ?>
    <main class="policy-container">
        <h1>Data Policy</h1>
        <p><strong>Effective Date:</strong> 01-01-2025</p>
        <h2>1. Purpose</h2>
        <p>This Data Policy outlines how <?php echo htmlspecialchars($site_name); ?> collects, uses, stores, and protects your data in compliance with applicable laws and best practices.</p>
        <h2>2. Data Collection</h2>
        <ul>
            <li>We collect only the data necessary to provide our services, such as contact details, listing information, and analytics data.</li>
            <li>Data is collected through forms, cookies, and third-party integrations (e.g., analytics).</li>
        </ul>
        <h2>3. Data Usage</h2>
        <ul>
            <li>Data is used to deliver services, improve user experience, and communicate important updates.</li>
            <li>We do not sell or rent your data to third parties.</li>
        </ul>
        <h2>4. Data Storage and Security</h2>
        <ul>
            <li>All data is stored securely using industry-standard encryption and access controls.</li>
            <li>We regularly review our security practices to protect your information.</li>
        </ul>
        <h2>5. Data Sharing</h2>
        <ul>
            <li>Data may be shared with trusted partners only as necessary to provide services (e.g., hosting, analytics).</li>
            <li>We comply with all legal requirements for data disclosure.</li>
        </ul>
        <h2>6. User Rights</h2>
        <ul>
            <li>You may request access, correction, or deletion of your data at any time by contacting us at <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>"><?php echo htmlspecialchars($contact_email); ?></a>.</li>
            <li>You may opt out of marketing communications at any time.</li>
        </ul>
        <h2>7. Policy Updates</h2>
        <p>This policy may be updated periodically. Please review this page for the latest information.</p>
        <h2>8. Contact</h2>
        <ul>
            <li><strong><?php echo htmlspecialchars($site_name); ?> Team</strong></li>
            <li>Email: <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>"><?php echo htmlspecialchars($contact_email); ?></a></li>
            <li>Website: <a href="<?php echo htmlspecialchars($site_domain); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($site_domain); ?></a></li>
        </ul>
    </main>
    <?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
