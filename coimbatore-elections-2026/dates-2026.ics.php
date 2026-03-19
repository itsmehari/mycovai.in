<?php
require_once __DIR__ . '/includes/bootstrap.php';

header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="tn-assembly-election-2026.ics"');

$base = ELECTIONS_2026_BASE_URL;

echo "BEGIN:VCALENDAR\r\n";
echo "VERSION:2.0\r\n";
echo "PRODID:-//MyCovai//TN Assembly Election 2026//EN\r\n";
echo "CALSCALE:GREGORIAN\r\n";

// Poll – 23 Apr 2026 (all-day)
echo "BEGIN:VEVENT\r\n";
echo "UID:tn-poll-2026@mycovai.in\r\n";
echo "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
echo "DTSTART;VALUE=DATE:20260423\r\n";
echo "DTEND;VALUE=DATE:20260424\r\n";
echo "SUMMARY:Tamil Nadu Assembly Election 2026 – Poll\r\n";
echo "DESCRIPTION:Poll day. Coimbatore and Tamil Nadu. " . $base . "\r\n";
echo "URL:" . $base . "/dates.php\r\n";
echo "END:VEVENT\r\n";

// Counting – 4 May 2026 (all-day)
echo "BEGIN:VEVENT\r\n";
echo "UID:tn-counting-2026@mycovai.in\r\n";
echo "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
echo "DTSTART;VALUE=DATE:20260504\r\n";
echo "DTEND;VALUE=DATE:20260505\r\n";
echo "SUMMARY:Tamil Nadu Assembly Election 2026 – Counting\r\n";
echo "DESCRIPTION:Counting of votes. " . $base . "\r\n";
echo "URL:" . $base . "/results-2026.php\r\n";
echo "END:VEVENT\r\n";

echo "END:VCALENDAR\r\n";
