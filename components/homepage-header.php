<?php
/**
 * MyCovai Homepage Header – Shared across index and directory pages
 * Design: homepage-directone.css | Requires Fraunces + Poppins + Font Awesome
 */
if (!function_exists('covai_site_name')) {
    require_once __DIR__ . '/../core/mycovai-config.php';
}
$current_path = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
$base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\');
$logo_url = covai_logo_url();
$site_name = covai_site_name();
?>
<header class="homepage-header">
    <div class="container-xl">
        <div class="homepage-header-inner">
            <a href="/" class="homepage-logo">
                <img src="<?php echo htmlspecialchars($logo_url); ?>" alt="<?php echo htmlspecialchars($site_name); ?> logo" class="homepage-logo-img" width="40" height="40">
                <span class="logo-text"><?php echo htmlspecialchars($site_name); ?></span>
                <span class="logo-tagline">Coimbatore Directory &amp; Listing</span>
            </a>
            <button type="button" class="homepage-menu-toggle" aria-label="Toggle menu" onclick="document.querySelector('.homepage-nav').classList.toggle('active')">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="homepage-nav">
                <li><a href="/"<?php echo ($current_path === '/' || $current_path === '/index.php') ? ' class="active"' : ''; ?>>Home</a></li>
                <li><a href="/about.php"<?php echo strpos($current_path, '/about') !== false ? ' class="active"' : ''; ?>>About</a></li>
                <li><a href="/directory/index.php"<?php echo strpos($current_path, '/directory') !== false ? ' class="active"' : ''; ?>>Explore Covai</a></li>
                <li><a href="/coimbatore-news.php"<?php echo $current_path === '/coimbatore-news.php' ? ' class="active"' : ''; ?>>Covai News</a></li>
                <li><a href="/coimbatore-news.php"<?php echo ($current_path === '/coimbatore-news.php' || strpos($current_path, '/local-news/') === 0) ? ' class="active"' : ''; ?>>Blog</a></li>
                <li><a href="/contact.php"<?php echo strpos($current_path, '/contact') !== false ? ' class="active"' : ''; ?>>Contact</a></li>
            </ul>
            <div class="homepage-header-ctas">
                <a href="/jobs/employer-landing-covai.php" class="homepage-cta homepage-cta-outline">
                    <i class="fas fa-briefcase"></i> Post a Job
                </a>
                <a href="/directory/get-listed.php" class="homepage-cta">
                    <i class="fas fa-building"></i> List Your Business
                </a>
            </div>
        </div>
    </div>
</header>
