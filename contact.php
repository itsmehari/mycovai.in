<?php
require_once __DIR__ . '/core/omr-connect.php';

$page_title = defined('SITE_NAME') ? 'Contact ' . SITE_NAME . ' | ' . SITE_REGION : 'Contact MyCovai | Coimbatore';
$page_description = 'Get in touch with the MyCovai team. Send your feedback, suggestions or enquiries about Coimbatore directory, listings and community.';
$page_keywords = 'Contact MyCovai, Coimbatore contact, Covai directory feedback';
$canonical_url = (defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in') . '/contact.php';

$contact_email = defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'mycovai@gmail.com';
$contact_phone = defined('CONTACT_PHONE_FULL') ? CONTACT_PHONE_FULL : '+91 94450 88028';
$contact_phone_raw = defined('CONTACT_PHONE') ? CONTACT_PHONE : '9445088028';
$region = defined('SITE_REGION') ? SITE_REGION : 'Coimbatore';
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyCovai';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/components/meta.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .contact-hero { background: linear-gradient(135deg, #0f5132 0%, #22c55e 100%); color: white; padding: 3rem 0; text-align: center; }
        .contact-hero h1 { font-family: 'Fraunces', serif; font-size: 2rem; }
        .contact-card { border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 1.5rem; }
    </style>
    <?php include __DIR__ . '/components/analytics.php'; ?>
</head>
<body>

<?php include __DIR__ . '/components/main-nav.php'; ?>

<div class="contact-hero">
    <div class="container" style="max-width: 1280px;">
        <h1>Contact <?php echo htmlspecialchars($site_name); ?></h1>
        <p class="lead mb-0">We'd love to hear from you. Get in touch for enquiries, suggestions or to share news and events in <?php echo htmlspecialchars($region); ?>.</p>
    </div>
</div>

<main class="container py-5" style="max-width: 1280px;">
    <div class="row g-4 justify-content-center">
        <div class="col-md-6">
            <div class="contact-card">
                <h2 class="h5 text-primary mb-3"><i class="fas fa-envelope me-2"></i>Email</h2>
                <p class="mb-0"><a href="mailto:<?php echo htmlspecialchars($contact_email); ?>"><?php echo htmlspecialchars($contact_email); ?></a></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="contact-card">
                <h2 class="h5 text-primary mb-3"><i class="fas fa-phone me-2"></i>Phone</h2>
                <p class="mb-0"><a href="tel:+91<?php echo htmlspecialchars(preg_replace('/\D/', '', $contact_phone_raw)); ?>"><?php echo htmlspecialchars($contact_phone); ?></a></p>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-8 mx-auto">
            <p class="text-center text-muted">For listing updates, event submissions, or general feedback about the <?php echo htmlspecialchars($region); ?> directory, please email us at <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>"><?php echo htmlspecialchars($contact_email); ?></a>.</p>
        </div>
    </div>
</main>

<?php include __DIR__ . '/components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
