<?php
/**
 * Archive past event_listings (scheduled/ongoing → archived) when end time has passed.
 * Run via cPanel cron, e.g. daily:
 *   php /home/USER/public_html/local-events/cron-archive-past-events.php
 */
if (php_sapi_name() !== 'cli') {
    header('Content-Type: text/plain; charset=utf-8');
    http_response_code(403);
    echo "CLI only. Example: php local-events/cron-archive-past-events.php\n";
    exit(1);
}

require_once __DIR__ . '/includes/error-reporting.php';
require_once __DIR__ . '/../core/omr-connect.php';
require_once __DIR__ . '/includes/event-functions-covai.php';

$n = archivePastEventListings();
echo 'archivePastEventListings: ' . (int)$n . " row(s) updated\n";
