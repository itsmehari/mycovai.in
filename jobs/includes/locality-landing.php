<?php
/**
 * Bootstrap for Coimbatore locality job landing pages.
 *
 * Expected variables before include:
 *   $locality_name       - Display name (e.g. "RS Puram")
 *   $locality_slug       - URL slug file stem (e.g. "rs-puram")
 *   $locality_keywords   - Comma-separated SEO keywords
 *   $locality_blurb      - Short area description for content section
 */

require_once __DIR__ . '/error-reporting.php';
require_once __DIR__ . '/job-functions-covai.php';
require_once __DIR__ . '/../../core/omr-connect.php';

global $conn;

$location = $locality_name;
$location_jobs = [];
$location_job_count = 0;

$like_escaped = $conn instanceof mysqli
    ? $conn->real_escape_string($locality_name)
    : str_replace(['%', '_'], ['\\%', '\\_'], $locality_name);

if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
    $locationQuery = "SELECT j.*, e.company_name
                     FROM job_postings j
                     LEFT JOIN employers e ON j.employer_id = e.id
                     WHERE j.status = 'approved'
                     AND j.location LIKE '%{$like_escaped}%'
                     ORDER BY j.featured DESC, j.created_at DESC
                     LIMIT 12";
    $locationResult = $conn->query($locationQuery);
    if ($locationResult && $locationResult->num_rows > 0) {
        $location_jobs = $locationResult->fetch_all(MYSQLI_ASSOC);
    }

    $countQuery = "SELECT COUNT(*) as total FROM job_postings
                   WHERE status = 'approved'
                   AND location LIKE '%{$like_escaped}%'";
    $countResult = $conn->query($countQuery);
    if ($countResult) {
        $row = $countResult->fetch_assoc();
        $location_job_count = (int) ($row['total'] ?? 0);
    }
}

$base = defined('SITE_CANONICAL_BASE') ? rtrim(SITE_CANONICAL_BASE, '/') : 'https://mycovai.in';
$canonical_url = $base . '/jobs-in-' . $locality_slug . '.php';

$page_title = "Jobs in {$locality_name}, Coimbatore - Local Opportunities | MyCovai";
$page_description = "Find jobs in {$locality_name}, Coimbatore. IT, teaching, healthcare, retail and more. Free listings on MyCovai — apply directly to local employers.";
$page_keywords = $locality_keywords ?? "jobs in {$locality_name}, {$locality_name} jobs Coimbatore, Covai jobs";
$location_name = $locality_name;
$location_description = $locality_blurb ?? "Find local job opportunities in {$locality_name}, Coimbatore without a long commute.";
$hero_title = "Jobs in {$locality_name}, Coimbatore";
$hero_subtitle = "Discover job openings in and around {$locality_name}. Work closer to home in Covai.";
$breadcrumb_name = "Jobs in {$locality_name}";

require_once __DIR__ . '/landing-page-template.php';
