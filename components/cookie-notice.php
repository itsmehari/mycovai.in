<?php
/**
 * Lightweight cookie consent banner (phase 1).
 * Stores acceptance in localStorage; structured for future Google Consent Mode v2 wiring.
 */
$cookie_privacy_url = (defined('SITE_CANONICAL_BASE') ? rtrim(SITE_CANONICAL_BASE, '/') : 'https://mycovai.in') . '/privacy-policy.php';
?>
<div id="covai-cookie-notice" class="covai-cookie-notice" role="dialog" aria-label="Cookie notice" aria-live="polite" hidden>
    <div class="covai-cookie-notice__inner">
        <p class="covai-cookie-notice__text">
            We use cookies for analytics, site functionality, and advertising.
            See our <a href="<?php echo htmlspecialchars($cookie_privacy_url); ?>">Privacy Policy</a> for details.
        </p>
        <button type="button" id="covai-cookie-accept" class="covai-cookie-notice__btn">Accept</button>
    </div>
</div>
<link rel="stylesheet" href="/assets/css/cookie-notice.css">
<script defer src="/assets/js/cookie-notice.js"></script>
