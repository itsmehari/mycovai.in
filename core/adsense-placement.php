<?php
/**
 * AdSense placement allow/deny rules for mycovai.in
 *
 * @see components/adsense.php
 */

if (!function_exists('covai_adsense_uri_denied')) {
    /**
     * URI path patterns where display ads must not appear.
     */
    function covai_adsense_uri_denied($uri = null) {
        if ($uri === null) {
            $uri = isset($_SERVER['REQUEST_URI']) ? (string) $_SERVER['REQUEST_URI'] : '';
        }
        $path = parse_url($uri, PHP_URL_PATH);
        if (!is_string($path) || $path === '') {
            $path = '/';
        }
        $path = strtolower($path);

        $denied_patterns = [
            '#/jobs/employer-#',
            '#/jobs/post-job#',
            '#/jobs/process-#',
            '#/jobs/application-submitted#',
            '#/jobs/job-posted-success#',
            '#/jobs/edit-#',
            '#/jobs/my-posted-jobs#',
            '#/jobs/view-applications#',
            '#/jobs/update-application#',
            '#/jobs/admin/#',
            '#/admin/#',
            '#/local-events/admin/#',
            '#/local-events/post-event#',
            '#/local-events/process-event#',
        ];

        foreach ($denied_patterns as $pattern) {
            if (preg_match($pattern, $path)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('covai_adsense_allowed')) {
    /**
     * Whether AdSense units may render on the current request.
     *
     * @param array<string,mixed> $context Optional overrides: uri, slot_id
     */
    function covai_adsense_allowed(array $context = []) {
        if (!defined('ADSENSE_ENABLED') || !ADSENSE_ENABLED) {
            return false;
        }
        if (!defined('ADSENSE_CLIENT_ID') || ADSENSE_CLIENT_ID === '') {
            return false;
        }

        $uri = isset($context['uri']) ? (string) $context['uri'] : null;
        if (covai_adsense_uri_denied($uri)) {
            return false;
        }

        $slot_id = isset($context['slot_id']) ? (string) $context['slot_id'] : '';
        if ($slot_id !== '' && defined('ADSENSE_SLOT_UNITS') && is_array(ADSENSE_SLOT_UNITS)) {
            if (!array_key_exists($slot_id, ADSENSE_SLOT_UNITS)) {
                return false;
            }
            $unit = ADSENSE_SLOT_UNITS[$slot_id];
            if ($unit === '' || $unit === null) {
                return false;
            }
        }

        return true;
    }
}
