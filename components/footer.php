<?php
if (defined('MYCOVAI_CONFIG_LOADED')) {
    include __DIR__ . '/footer-covai.php';
    return;
}
if (!isset($baseUrl)) {
    $baseUrl = rtrim((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
}
?>
<!--footer section begins -->
<footer class="footer-section">
        <div class="container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="cta-text">
                                <h4>Find us</h4>
                                <span>Coimbatore, Tamil Nadu</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-phone"></i>
                            <div class="cta-text">
                                <h4>Call us</h4>
                                <span>9445088028</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="far fa-envelope-open"></i>
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
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a href="<?php echo $baseUrl; ?>index.html"><img src="<?php echo $baseUrl; ?>My-OMR-Idhu-Namma-OMR-Logo.jpg" class="img-fluid" alt="My-Omr-Idhu-Namma-OMR-Logo" width="100"></a>
                            </div>
                            <div class="footer-text">
                                <p>Your local news portal and community website for Coimbatore. We present you with news, events and happenings in and around Covai. Areas covered include RS Puram, Gandhipuram, Saibaba Colony, Peelamedu, Race Course, and more.</p>
                            </div>
                            <div class="footer-social-icon">
                                <span>Follow us</span>
                                <a href="<?php echo (defined('SOCIAL_FACEBOOK') && SOCIAL_FACEBOOK !== '') ? htmlspecialchars(SOCIAL_FACEBOOK) : '#'; ?>" aria-label="Facebook"><i class="fab fa-facebook-f facebook-bg"></i></a>
                                <a href="<?php echo (defined('SOCIAL_TWITTER') && SOCIAL_TWITTER !== '') ? htmlspecialchars(SOCIAL_TWITTER) : '#'; ?>" aria-label="Twitter"><i class="fab fa-twitter twitter-bg"></i></a>
                                <a href="#"><i class="fab fa-instagram instagram-bg"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Useful Links</h3>
                            </div>
                            <ul>
                                <li><a href="<?php echo $baseUrl; ?>index.php">Home</a></li>
                                <li><a href="<?php echo $baseUrl; ?>covai-directory-list.php">Coimbatore Directory</a></li>
                                <li><a href="<?php echo $baseUrl; ?>contact.php">Contact us</a></li>
                                <li><a href="<?php echo $baseUrl; ?>local-news/">Latest News</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Jobs by Location</h3>
                            </div>
                            <ul>
                                <li><a href="<?php echo $baseUrl; ?>jobs/">Jobs in Coimbatore</a></li>
                                <li><a href="<?php echo $baseUrl; ?>jobs/?locality=rs-puram">Jobs in RS Puram</a></li>
                                <li><a href="<?php echo $baseUrl; ?>jobs/?locality=gandhipuram">Jobs in Gandhipuram</a></li>
                                <li><a href="<?php echo $baseUrl; ?>jobs/?locality=peelamedu">Jobs in Peelamedu</a></li>
                                <li><a href="<?php echo $baseUrl; ?>jobs/?locality=saravanampatti">Jobs in Saravanampatti</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Jobs by Industry</h3>
                            </div>
                            <ul>
                                <li><a href="<?php echo $baseUrl; ?>jobs/">IT Jobs in Covai</a></li>
                                <li><a href="<?php echo $baseUrl; ?>jobs/">Teaching Jobs</a></li>
                                <li><a href="<?php echo $baseUrl; ?>jobs/">Healthcare Jobs</a></li>
                                <li><a href="<?php echo $baseUrl; ?>jobs/">Retail Jobs</a></li>
                                <li><a href="<?php echo $baseUrl; ?>jobs/">Hospitality Jobs</a></li>
                                <li><a href="<?php echo $baseUrl; ?>jobs/">Fresher Jobs</a></li>
                                <li><a href="<?php echo $baseUrl; ?>jobs/">Part-Time Jobs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Subscribe</h3>
                            </div>
                            <div class="footer-text mb-25">
                                <p>Don't miss to subscribe to our new feeds, kindly fill the form below.</p>
                            </div>
                            <div class="subscribe-form">
                                <form action="#">
                                    <input type="text" placeholder="Email Address">
                                    <button><i class="fab fa-telegram-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                        <div class="copyright-text">
                            <p>Copyright &copy; <?php echo date('Y'); ?>, All rights reserved <a href="https://mycovai.in/"><?php echo defined('SITE_NAME') ? htmlspecialchars(SITE_NAME) : 'MyCovai'; ?></a></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="<?php echo $baseUrl; ?>terms-and-conditions.php">Terms</a></li>
                                <li><a href="<?php echo $baseUrl; ?>privacy-policy.php">Privacy</a></li>
                                <li><a href="<?php echo $baseUrl; ?>data-policy.php">Policy</a></li>
                                <li><a href="<?php echo $baseUrl; ?>webmaster-contact.php">Contact Webmaster</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--footer section ends -->
