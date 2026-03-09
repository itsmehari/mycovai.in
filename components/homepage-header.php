<?php
/**
 * MyCovai Homepage Header – Shared across index and directory pages
 * Design: homepage-directone.css | Requires Fraunces + Poppins + Font Awesome
 */
$current_path = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
$base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\');
?>
<header class="homepage-header">
    <div class="container-xl">
        <div class="homepage-header-inner">
            <a href="/" class="homepage-logo">
                <span class="logo-text">MyCovai</span>
                <span class="logo-tagline">Coimbatore Directory &amp; Listing</span>
            </a>
            <button type="button" class="homepage-menu-toggle" aria-label="Toggle menu" onclick="document.querySelector('.homepage-nav').classList.toggle('active')">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="homepage-nav">
                <li><a href="/"<?php echo ($current_path === '/' || $current_path === '/index.php') ? ' class="active"' : ''; ?>>Home</a></li>
                <li><a href="/about.php"<?php echo strpos($current_path, '/about') !== false ? ' class="active"' : ''; ?>>About</a></li>
                <li><a href="/directory/index.php"<?php echo strpos($current_path, '/directory') !== false ? ' class="active"' : ''; ?>>Listing</a></li>
                <li><a href="/local-news/news-highlights.php"<?php echo strpos($current_path, '/local-news') !== false ? ' class="active"' : ''; ?>>Blog</a></li>
                <li><a href="/contact.php"<?php echo strpos($current_path, '/contact') !== false ? ' class="active"' : ''; ?>>Contact</a></li>
            </ul>
            <a href="/jobs/employer-landing-omr.php" class="homepage-cta">
                <i class="fas fa-plus"></i> Add Listing
            </a>
        </div>
    </div>
</header>
