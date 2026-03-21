<?php
if (!isset($baseUrl)) {
    $baseUrl = rtrim((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
}
$siteRoot = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
?>
<link rel="stylesheet" href="/components/footer-fat.css">
<!-- Footer – MyCovai / Coimbatore -->
<footer class="footer-section fat-footer">
    <div class="container">
        <!-- Pre-footer subscribe band -->
        <section class="fat-footer-prefooter" aria-label="Newsletter signup">
            <div class="fat-footer-prefooter-inner">
                <span class="prefooter-label">Newsletter</span>
                <h3>Get the latest from Covai</h3>
                <p>Events, listings and local updates—once in a while, in your inbox.</p>
                <form class="subscribe-form" action="<?php echo htmlspecialchars($siteRoot . 'core/subscribe.php'); ?>" method="POST">
                    <input type="email" name="email" placeholder="you@email.com" required aria-label="Email address">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </section>

        <div class="footer-cta pt-5 pb-5">
            <div class="row">
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                        <div class="cta-text">
                            <h4>Find us</h4>
                            <span>Coimbatore, Tamil Nadu</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-phone" aria-hidden="true"></i>
                        <div class="cta-text">
                            <h4>Call us</h4>
                            <span>9445088028</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="far fa-envelope-open" aria-hidden="true"></i>
                        <div class="cta-text">
                            <h4>Mail us</h4>
                            <span><?php echo defined('CONTACT_EMAIL') ? htmlspecialchars(CONTACT_EMAIL) : 'mycovai@gmail.com'; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-content pt-5 pb-5">
            <div class="row">
                <!-- Column 1: About, socials, subscribe -->
                <div class="col-xl-4 col-lg-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="<?php echo $baseUrl; ?>index.php">MyCovai</a>
                        </div>
                        <div class="footer-text">
                            <p>Your local directory for Coimbatore. Find schools, restaurants, jobs, events, hostels and coworking spaces in Covai. Add your listing and connect with the community.</p>
                        </div>
                        <div class="footer-social-icon">
                            <span>Follow us</span>
                            <a href="<?php echo (defined('SOCIAL_FACEBOOK') && SOCIAL_FACEBOOK !== '') ? htmlspecialchars(SOCIAL_FACEBOOK) : '#'; ?>" aria-label="Facebook"><i class="fab fa-facebook-f facebook-bg"></i></a>
                            <a href="<?php echo (defined('SOCIAL_TWITTER') && SOCIAL_TWITTER !== '') ? htmlspecialchars(SOCIAL_TWITTER) : '#'; ?>" aria-label="Twitter"><i class="fab fa-twitter twitter-bg"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram instagram-bg"></i></a>
                        </div>
                        <div class="footer-widget-heading"><h3>Stay updated</h3></div>
                        <div class="footer-text mb-25">
                            <p>Optional: get updates here too.</p>
                        </div>
                        <div class="subscribe-form">
                            <form action="<?php echo htmlspecialchars($siteRoot . 'core/subscribe.php'); ?>" method="POST">
                                <input type="email" name="email" placeholder="Email" required aria-label="Email for newsletter">
                                <button type="submit"><i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Column 2: Useful Links -->
                <div class="col-xl-2 col-lg-2 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading"><h3>Useful Links</h3></div>
                        <ul>
                            <li><a href="<?php echo $baseUrl; ?>index.php">Home</a></li>
                            <li><a href="<?php echo $baseUrl; ?>directory/index.php">Explore Covai</a></li>
                            <li><a href="<?php echo $baseUrl; ?>directory/emergency-civic-directory.php">Emergency Directory</a></li>
                            <li><a href="<?php echo $baseUrl; ?>coimbatore-news.php">Covai News</a></li>
                            <li><a href="<?php echo $baseUrl; ?>coimbatore-elections-2026/">Elections 2026</a></li>
                            <li><a href="<?php echo $baseUrl; ?>contact.php">Contact us</a></li>
                            <li><a href="<?php echo $baseUrl; ?>local-news/">Latest News</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Column 3: Explore -->
                <div class="col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading"><h3>Explore</h3></div>
                        <ul>
                            <li><a href="<?php echo $baseUrl; ?>jobs/">Jobs in Covai</a></li>
                            <li><a href="<?php echo $baseUrl; ?>local-events/">Events</a></li>
                            <li><a href="<?php echo $baseUrl; ?>hostels-pgs/">Hostels &amp; PGs</a></li>
                            <li><a href="<?php echo $baseUrl; ?>coworking-spaces/">Coworking Spaces</a></li>
                            <li><a href="<?php echo $baseUrl; ?>coimbatore-elections-2026/">Elections 2026</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Column 4: Listings -->
                <div class="col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading"><h3>Listings</h3></div>
                        <ul>
                            <li><a href="<?php echo $baseUrl; ?>directory/schools.php">Schools</a></li>
                            <li><a href="<?php echo $baseUrl; ?>directory/restaurants.php">Restaurants</a></li>
                            <li><a href="<?php echo $baseUrl; ?>directory/hospitals.php">Hospitals</a></li>
                            <li><a href="<?php echo $baseUrl; ?>directory/banks.php">Banks</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                        <div class="copyright-text">
                            <p>Copyright &copy; <?php echo date('Y'); ?>, All rights reserved <a href="<?php echo $baseUrl; ?>">MyCovai</a></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 text-center text-lg-right">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="<?php echo $baseUrl; ?>terms-and-conditions.php">Terms</a></li>
                                <li><a href="<?php echo $baseUrl; ?>privacy-policy.php">Privacy</a></li>
                                <li><a href="<?php echo $baseUrl; ?>webmaster-contact.php">Contact Webmaster</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="https://wa.me/919445088028" class="float" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp"><i class="fab fa-whatsapp my-float"></i></a>
