<?php
/**
 * IT Jobs in Coimbatore - SEO Landing Page
 */

require_once __DIR__ . '/jobs/includes/error-reporting.php';
require_once __DIR__ . '/jobs/includes/job-functions-covai.php';
require_once __DIR__ . '/core/omr-connect.php';
global $conn;

$category = 'it';
$category_jobs = [];
$category_job_count = 0;

if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
    $categoryQuery = "SELECT j.*, e.company_name
                     FROM job_postings j
                     LEFT JOIN employers e ON j.employer_id = e.id
                     WHERE j.status = 'approved'
                     AND (j.category = 'it' OR j.category LIKE '%it%' OR j.title LIKE '%software%' OR j.title LIKE '%developer%' OR j.title LIKE '%engineer%')
                     ORDER BY j.featured DESC, j.created_at DESC
                     LIMIT 12";
    $categoryResult = $conn->query($categoryQuery);
    if ($categoryResult && $categoryResult->num_rows > 0) {
        $category_jobs = $categoryResult->fetch_all(MYSQLI_ASSOC);
    }

    $countQuery = "SELECT COUNT(*) as total FROM job_postings
                   WHERE status = 'approved'
                   AND (category = 'it' OR category LIKE '%it%' OR title LIKE '%software%' OR title LIKE '%developer%' OR title LIKE '%engineer%')";
    $countResult = $conn->query($countQuery);
    if ($countResult) {
        $row = $countResult->fetch_assoc();
        $category_job_count = (int) ($row['total'] ?? 0);
    }
}

$base = defined('SITE_CANONICAL_BASE') ? rtrim(SITE_CANONICAL_BASE, '/') : 'https://mycovai.in';
$page_title = 'IT Jobs in Coimbatore - Software Developer & Engineer Roles | MyCovai';
$page_description = 'Find IT jobs in Coimbatore. Software developer, engineer, data analyst, and tech positions across Covai. Free listings — apply directly to employers.';
$canonical_url = $base . '/it-jobs-coimbatore.php';
$page_keywords = 'IT jobs Coimbatore, software developer jobs Covai, engineer jobs Coimbatore, tech jobs Tamil Nadu';
$hero_title = 'IT Jobs in Coimbatore';
$hero_subtitle = 'Software developer, engineer, analyst, and tech roles with Coimbatore employers and IT parks.';
$breadcrumb_name = 'IT Jobs';
$content_section = '<h2 class="h3 mb-4">IT Jobs in Coimbatore</h2>
<p class="lead text-muted">Coimbatore has a growing technology sector with IT parks, product companies, and service firms across Peelamedu, Saravanampatti, and the city centre. Find your next IT role in Covai.</p>
<h3 class="h5 mt-4 mb-3">Popular IT job roles:</h3>
<ul class="list-unstyled">
    <li><i class="fas fa-check text-success me-2"></i> Software Developer / Engineer</li>
    <li><i class="fas fa-check text-success me-2"></i> Data Analyst / Data Scientist</li>
    <li><i class="fas fa-check text-success me-2"></i> Full Stack Developer</li>
    <li><i class="fas fa-check text-success me-2"></i> UI/UX Designer</li>
    <li><i class="fas fa-check text-success me-2"></i> QA / Testing Engineer</li>
    <li><i class="fas fa-check text-success me-2"></i> DevOps Engineer</li>
    <li><i class="fas fa-check text-success me-2"></i> Business Analyst</li>
    <li><i class="fas fa-check text-success me-2"></i> Project Manager</li>
</ul>';

$location_jobs = $category_jobs;
$location_job_count = $category_job_count;
$filter_url = '/jobs/?category=it';

require_once __DIR__ . '/jobs/includes/landing-page-template.php';
