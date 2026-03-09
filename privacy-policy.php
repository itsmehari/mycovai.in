<?php
require_once __DIR__ . '/core/omr-connect.php';
$page_title = 'Privacy Policy – ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
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
</head>
<body>
    <?php include __DIR__ . '/components/main-nav.php'; ?>
    <main style="max-width: 800px; margin: 2rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <h1>Privacy Policy</h1>
        <p><strong>Effective Date:</strong> 01-01-2025<br>
        <strong>Website:</strong> <a href="<?php echo htmlspecialchars($site_domain); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($site_domain); ?></a></p>
        <h2>1. Introduction</h2>
        <p>At <?php echo htmlspecialchars($site_name); ?>, we value your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, disclose, and protect the information you provide while using our platform.</p>
        <h2>2. Information We Collect</h2>
        <p>We collect the following types of information:</p>
        <ul>
            <li><strong>Personal Information:</strong> Name, email address, phone number, and location, when you fill out forms, subscribe to newsletters, or apply for jobs.</li>
            <li><strong>Usage Data:</strong> Information about your browser, device, IP address, and how you interact with our website (via cookies or analytics tools).</li>
        </ul>
        <h2>3. How We Use Your Information</h2>
        <p>We use the information to:</p>
        <ul>
            <li>Provide and improve our listing, search, and notification services.</li>
            <li>Connect you with local service providers or job opportunities.</li>
            <li>Send relevant updates or newsletters if subscribed.</li>
            <li>Respond to your queries and provide customer support.</li>
            <li>Comply with legal obligations.</li>
        </ul>
        <h2>4. Cookies and Tracking Technologies</h2>
        <p>We use cookies to:</p>
        <ul>
            <li>Enhance user experience by remembering preferences.</li>
            <li>Measure website performance and user engagement (e.g., Google Analytics).</li>
        </ul>
        <p>You can manage cookie preferences via your browser settings.</p>
        <h2>5. Data Sharing and Disclosure</h2>
        <p>We do not sell or rent your personal information. We may share it with:</p>
        <ul>
            <li>Trusted service providers who assist in operating the site (e.g., hosting, analytics).</li>
            <li>Employers or service providers listed on <?php echo htmlspecialchars($site_name); ?> (only when you initiate contact or submit applications).</li>
            <li>Legal authorities if required to comply with laws.</li>
        </ul>
        <h2>6. Data Security</h2>
        <p>We take security seriously and implement HTTPS encryption, access controls, and secure data storage.</p>
        <h2>7. Your Rights</h2>
        <p>You have the right to access, update, or delete your personal data, withdraw consent for communications, and request information about how your data is processed. To exercise these rights, contact us at <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>"><?php echo htmlspecialchars($contact_email); ?></a>.</p>
        <h2>8. Children's Privacy</h2>
        <p>Our services are not directed at children under 18. We do not knowingly collect personal data from minors without parental consent.</p>
        <h2>9. Policy Updates</h2>
        <p>We may revise this Privacy Policy periodically. Changes will be posted here with an updated "Effective Date."</p>
        <h2>10. Contact Us</h2>
        <p>For any questions or concerns about this Privacy Policy, contact:</p>
        <ul>
            <li><strong><?php echo htmlspecialchars($site_name); ?> Team</strong></li>
            <li>Email: <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>"><?php echo htmlspecialchars($contact_email); ?></a></li>
            <li>Website: <a href="<?php echo htmlspecialchars($site_domain); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($site_domain); ?></a></li>
        </ul>
    </main>
    <?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
