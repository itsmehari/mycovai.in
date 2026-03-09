<?php
/**
 * MyCovai site branding and configuration
 * Single source for site name, domain, region, and contact.
 * Include this file early (e.g. after core/covai-connect.php or core/omr-connect.php).
 *
 * @see docs/MYCOVAI-NEXT-STEPS-PLAN.md Phase 1
 */

if (!defined('MYCOVAI_CONFIG_LOADED')) {
    define('MYCOVAI_CONFIG_LOADED', true);

    // --- Site identity ---
    define('SITE_NAME', 'MyCovai');
    define('SITE_TAGLINE', 'Coimbatore Directory & Listings');
    define('SITE_REGION', 'Coimbatore');
    define('SITE_REGION_SHORT', 'Covai');

    // --- URLs (no trailing slash) ---
    define('SITE_DOMAIN', 'https://mycovai.in');
    define('SITE_CANONICAL_BASE', SITE_DOMAIN);

    // --- Contact ---
    define('CONTACT_EMAIL', 'mycovai@gmail.com');
    define('CONTACT_PHONE', '9445088028');
    define('CONTACT_PHONE_FULL', '+91 94450 88028');

    // --- Optional: social (empty = not set) ---
    define('SOCIAL_FACEBOOK', '');
    define('SOCIAL_INSTAGRAM', '');
    define('SOCIAL_TWITTER', '');
    define('SOCIAL_WHATSAPP', 'https://wa.me/919445088028');
    define('SOCIAL_YOUTUBE', '');

    // --- Default SEO (used when a page does not set its own) ---
    define('SITE_DEFAULT_TITLE', SITE_NAME . ' – ' . SITE_TAGLINE . ' | Explore ' . SITE_REGION_SHORT);
    define('SITE_DEFAULT_DESCRIPTION', 'Your local directory for ' . SITE_REGION . '. Find schools, restaurants, jobs, events, hostels, coworking spaces and more in ' . SITE_REGION_SHORT . '.');
    define('SITE_DEFAULT_KEYWORDS', 'Coimbatore, Covai, MyCovai, directory, listings, local business, schools, jobs, events, hostels, coworking, RS Puram, Gandhipuram, Tamil Nadu');
    define('SITE_OG_SITE_NAME', SITE_NAME . ' – ' . SITE_REGION . ' Directory');

    // --- Optional: logo URL (relative or absolute), empty = no default image ---
    // Legacy: My-OMR-Logo.jpg used until MyCovai logo is added at /assets/img/mycovai-logo.png
    define('SITE_LOGO_URL', '/My-OMR-Logo.jpg');

    // --- Analytics (Phase 2) ---
    define('GA_MEASUREMENT_ID', 'G-2FZCJC1JZH');

    // --- MyCovai directory table names (covai_* only, no omr_*) ---
    define('COVAI_TABLES', [
        'schools'            => 'covai_schools',
        'banks'              => 'covai_banks',
        'hospitals'          => 'covai_hospitals',
        'restaurants'        => 'covai_restaurants',
        'atms'               => 'covai_atms',
        'parks'              => 'covai_parks',
        'industries'         => 'covai_industries',
        'it_companies'       => 'covai_it_companies',
        'it_companies_feat'  => 'covai_it_companies_featured',
        'gov_offices'        => 'covai_gov_offices',
        'government_offices' => 'covai_gov_offices',
        'it_parks'           => 'covai_it_parks',
        'it_parks_feat'      => 'covai_it_parks_featured',
    ]);

    /**
     * Get MyCovai directory table name.
     * @param string $type e.g. 'schools', 'banks', 'government-offices', 'it-parks'
     * @return string Table name
     */
    if (!function_exists('covai_table')) {
        function covai_table($type) {
            $key = str_replace(['-', ' '], '_', $type);
            $tables = defined('COVAI_TABLES') ? COVAI_TABLES : [];
            if (isset($tables[$key])) return $tables[$key];
            return 'covai_' . preg_replace('/_+/', '_', $key);
        }
    }

    // --- Coimbatore localities (for filters, badges, related links) ---
    define('COIMBATORE_LOCALITIES', [
        'RS Puram', 'Gandhipuram', 'Peelamedu', 'Saibaba Colony', 'Race Course', 'Ukkadam', 'Sungam',
        'Saravanampatti', 'Kovaipudur', 'Tatabad', 'Avinashi Road', 'Trichy Road', 'Sitra', 'Kuniyamuthur',
        'Vadavalli', 'Thudiyalur', 'Vilankurichi', 'Brookefields', 'Singanallur'
    ]);

    // --- List of Areas (Phase 5.1) – use in dropdowns/filters when config loaded ---
    define('SITE_AREAS', [
        'All of Coimbatore',
        'RS Puram',
        'Gandhipuram',
        'Saibaba Colony',
        'Peelamedu',
        'Race Course',
        'Ukkadam',
        'Sungam',
        'Saravanampatti',
        'Kovaipudur',
        'Tatabad',
        'Avinashi Road',
        'Trichy Road',
        'Sitra',
        'Kuniyamuthur',
    ]);
}
