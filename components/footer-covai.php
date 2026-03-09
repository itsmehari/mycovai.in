<?php
if (!isset($baseUrl)) {
    $baseUrl = rtrim((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
}
?>
<!-- Footer – MyCovai / Coimbatore -->
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
                            <span>mycovai@gmail.com</span>
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
                            <a href="<?php echo $baseUrl; ?>index.php"><span style="font-family: 'Fraunces', serif; font-weight: 600; font-size: 1.5rem; color: #B8522E;">MyCovai</span></a>
                        </div>
                        <div class="footer-text">
                            <p>Your local directory for Coimbatore. Find schools, restaurants, jobs, events, hostels and coworking spaces in Covai. Add your listing and connect with the community.</p>
                        </div>
                        <div class="footer-social-icon">
                            <span>Follow us</span>
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f facebook-bg"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter twitter-bg"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram instagram-bg"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading"><h3>Useful Links</h3></div>
                        <ul>
                            <li><a href="<?php echo $baseUrl; ?>index.php">Home</a></li>
                            <li><a href="<?php echo $baseUrl; ?>directory/index.php">Explore Covai</a></li>
                            <li><a href="<?php echo $baseUrl; ?>contact.php">Contact us</a></li>
                            <li><a href="<?php echo $baseUrl; ?>local-news/">Latest News</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading"><h3>Explore</h3></div>
                        <ul>
                            <li><a href="<?php echo $baseUrl; ?>jobs/">Jobs in Covai</a></li>
                            <li><a href="<?php echo $baseUrl; ?>local-events/">Events</a></li>
                            <li><a href="<?php echo $baseUrl; ?>hostels-pgs/">Hostels &amp; PGs</a></li>
                            <li><a href="<?php echo $baseUrl; ?>coworking-spaces/">Coworking Spaces</a></li>
                        </ul>
                    </div>
                </div>
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
                <div class="col-xl-2 col-lg-2 col-md-6 mb-50">
                    <div class="footer-widget">
                        <div class="footer-widget-heading"><h3>Subscribe</h3></div>
                        <div class="footer-text mb-25">
                            <p>Get Covai updates in your inbox.</p>
                        </div>
                        <div class="subscribe-form">
                            <form action="<?php echo $baseUrl; ?>core/subscribe.php" method="POST">
                                <input type="email" name="email" placeholder="Email" required>
                                <button type="submit"><i class="fab fa-telegram-plane"></i></button>
                            </form>
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
                            <p>Copyright &copy; <?php echo date('Y'); ?>, All rights reserved <a href="<?php echo $baseUrl; ?>">MyCovai</a></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
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
