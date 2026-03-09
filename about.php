<?php
require_once __DIR__ . '/core/omr-connect.php';

$page_title = defined('SITE_NAME') ? 'About ' . SITE_NAME . ' | ' . SITE_REGION . ' Community Portal' : 'About MyCovai | Coimbatore Community Portal';
$page_description = 'About MyCovai – Your local community portal for Coimbatore. Discover our vision, what we do, and how we connect Covai with news, events, listings and civic resources.';
$page_keywords = 'About MyCovai, Coimbatore, Covai, community portal, local directory, Coimbatore news, Covai listings';
$canonical_url = (defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in') . '/about.php';

$contact_email = defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'mycovai@gmail.com';
$contact_phone = defined('CONTACT_PHONE_FULL') ? CONTACT_PHONE_FULL : '+91 94450 88028';
$contact_phone_raw = defined('CONTACT_PHONE') ? CONTACT_PHONE : '9445088028';
$region = defined('SITE_REGION') ? SITE_REGION : 'Coimbatore';
$region_short = defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'Covai';
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyCovai';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/components/meta.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;1,9..144,400&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
    <style>
        :root { --covai-primary: #0f5132; --covai-secondary: #22c55e; --covai-light: #f0fdf4; }
        body { font-family: 'Poppins', sans-serif; color: #333; }
        .hero-section { background: linear-gradient(135deg, #0f5132 0%, #22c55e 100%); color: white; padding: 80px 0 60px; text-align: center; }
        .hero-section h1 { font-family: 'Fraunces', serif; font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; }
        .section-title { font-family: 'Fraunces', serif; color: var(--covai-primary); font-size: 2rem; font-weight: 700; text-align: center; margin-bottom: 2rem; padding-bottom: 0.75rem; border-bottom: 3px solid var(--covai-secondary); }
        .section-padding { padding: 3rem 0; }
        .vision-card, .service-card { background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.08); transition: transform 0.3s ease; height: 100%; }
        .vision-card:hover, .service-card:hover { transform: translateY(-4px); box-shadow: 0 8px 12px rgba(0,0,0,0.12); }
        .icon-box { width: 64px; height: 64px; background: linear-gradient(135deg, #0f5132 0%, #22c55e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
        .icon-box i { font-size: 1.75rem; color: white; }
        .stats-box { background: var(--covai-light); border-left: 4px solid var(--covai-primary); padding: 1.25rem; border-radius: 8px; margin-bottom: 1rem; }
        .area-tag { display: inline-block; background: var(--covai-light); color: var(--covai-primary); padding: 6px 14px; margin: 4px; border-radius: 20px; font-size: 0.9rem; border: 2px solid var(--covai-secondary); }
        .cta-section { background: linear-gradient(135deg, #0f5132 0%, #22c55e 100%); color: white; padding: 3rem 0; text-align: center; }
        .btn-covai { background: white; color: var(--covai-primary); padding: 12px 32px; font-weight: 600; border-radius: 30px; border: none; transition: all 0.3s ease; text-decoration: none; display: inline-block; }
        .btn-covai:hover { transform: translateY(-2px); color: white; background: #14532d; }
        .social-links a { display: inline-block; width: 44px; height: 44px; background: var(--covai-primary); color: white; text-align: center; line-height: 44px; border-radius: 50%; margin: 0 6px; transition: all 0.3s ease; }
        .social-links a:hover { background: var(--covai-secondary); transform: translateY(-3px); }
    </style>
    <?php include __DIR__ . '/components/analytics.php'; ?>
</head>
<body>

<?php include __DIR__ . '/components/main-nav.php'; ?>

<div class="hero-section">
    <div class="container" style="max-width: 1280px;">
        <h1>About <?php echo htmlspecialchars($site_name); ?></h1>
        <p class="lead mb-0">Your local community portal connecting <?php echo htmlspecialchars($region); ?> residents with news, events, listings and happenings.</p>
    </div>
</div>

<section class="section-padding" style="background: #f8f9fa;">
    <div class="container" style="max-width: 1280px;">
        <h2 class="section-title">Our Vision & Mission</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="vision-card">
                    <div class="icon-box"><i class="fas fa-eye"></i></div>
                    <h3 class="h5 text-primary">Our Vision</h3>
                    <p class="mb-0">To become the most trusted local community platform for <?php echo htmlspecialchars($region); ?>, empowering residents with timely information, connecting neighbours, and fostering growth through shared experiences and resources in Covai.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="vision-card">
                    <div class="icon-box"><i class="fas fa-bullseye"></i></div>
                    <h3 class="h5 text-primary">Our Mission</h3>
                    <p class="mb-0">Create an active, engaged community in <?php echo htmlspecialchars($region); ?> by providing local news, events, business listings, and civic resources while promoting collective action on issues affecting our locality.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 1280px;">
        <h2 class="section-title">What We Do</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon-box"><i class="fas fa-newspaper"></i></div>
                    <h4 class="h5 text-primary">Local News & Updates</h4>
                    <p class="mb-0 small">Stay informed with news, events and happenings relevant to <?php echo htmlspecialchars($region_short); ?> residents and businesses.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon-box"><i class="fas fa-building"></i></div>
                    <h4 class="h5 text-primary">Business Directory</h4>
                    <p class="mb-0 small">Discover local businesses, schools, restaurants, banks, hospitals and more in <?php echo htmlspecialchars($region); ?>.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="icon-box"><i class="fas fa-briefcase"></i></div>
                    <h4 class="h5 text-primary">Jobs & Listings</h4>
                    <p class="mb-0 small">Find jobs, property listings, hostels, coworking spaces and community events in Covai.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding" style="background: var(--covai-light);">
    <div class="container" style="max-width: 1280px;">
        <h2 class="section-title">Areas We Cover</h2>
        <p class="text-center mb-4">We focus on <?php echo htmlspecialchars($region); ?> and its neighbourhoods, including:</p>
        <div class="text-center">
            <span class="area-tag">RS Puram</span>
            <span class="area-tag">Gandhipuram</span>
            <span class="area-tag">Saibaba Colony</span>
            <span class="area-tag">Peelamedu</span>
            <span class="area-tag">Race Course</span>
            <span class="area-tag">Ukkadam</span>
            <span class="area-tag">Sungam</span>
            <span class="area-tag">Saravanampatti</span>
            <span class="area-tag">Kovaipudur</span>
            <span class="area-tag">Tatabad</span>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container" style="max-width: 1280px;">
        <h2 class="h3 mb-3">Join Our Community</h2>
        <p class="lead mb-4">Be part of the <?php echo htmlspecialchars($region_short); ?> community. Share news, discover events and connect with neighbours.</p>
        <div class="mb-4">
            <a href="/directory/" class="btn-covai me-2">Explore Directory</a>
            <a href="/contact.php" class="btn-covai" style="background: transparent; border: 2px solid white; color: white;">Contact Us</a>
        </div>
        <?php if (defined('SOCIAL_FACEBOOK') && SOCIAL_FACEBOOK !== '' || defined('SOCIAL_INSTAGRAM') && SOCIAL_INSTAGRAM !== '' || defined('SOCIAL_WHATSAPP') && SOCIAL_WHATSAPP !== '') { ?>
        <div class="social-links">
            <?php if (defined('SOCIAL_FACEBOOK') && SOCIAL_FACEBOOK !== '') { ?><a href="<?php echo htmlspecialchars(SOCIAL_FACEBOOK); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a><?php } ?>
            <?php if (defined('SOCIAL_INSTAGRAM') && SOCIAL_INSTAGRAM !== '') { ?><a href="<?php echo htmlspecialchars(SOCIAL_INSTAGRAM); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a><?php } ?>
            <?php if (defined('SOCIAL_WHATSAPP') && SOCIAL_WHATSAPP !== '') { ?><a href="<?php echo htmlspecialchars(SOCIAL_WHATSAPP); ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a><?php } ?>
        </div>
        <?php } ?>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 1280px;">
        <h2 class="section-title">Get In Touch</h2>
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <p class="lead">Have a tip, event to share, or want to contribute? Reach out to the <?php echo htmlspecialchars($site_name); ?> team.</p>
                <p class="mb-2"><i class="fas fa-envelope text-primary me-2"></i><a href="mailto:<?php echo htmlspecialchars($contact_email); ?>"><?php echo htmlspecialchars($contact_email); ?></a></p>
                <p class="mb-0"><i class="fas fa-phone text-primary me-2"></i><a href="tel:+91<?php echo htmlspecialchars(preg_replace('/\D/', '', $contact_phone_raw)); ?>"><?php echo htmlspecialchars($contact_phone); ?></a></p>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
