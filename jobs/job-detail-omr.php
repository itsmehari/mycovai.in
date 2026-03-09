<?php
/**
 * MyOMR Job Portal - Job Detail Page
 * Individual job listing view with application form
 * 
 * @package MyOMR Job Portal
 * @version 1.0.0
 */

// Enable error reporting for development
require_once __DIR__ . '/includes/error-reporting.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include helper functions
require_once __DIR__ . '/includes/job-functions-omr.php';
require_once __DIR__ . '/includes/seo-helper.php';

// Load database connection directly (like test-jobs.php)
require_once __DIR__ . '/../core/omr-connect.php';
global $conn;

// Verify connection
if (!isset($conn) || !$conn instanceof mysqli || $conn->connect_error) {
    header("HTTP/1.0 500 Internal Server Error");
    echo "<h1>500 - Database Error</h1>";
    echo "<p>Database connection failed. Please try again later.</p>";
    exit;
}

// Get job ID from URL
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($job_id <= 0) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Job Not Found</h1>";
    echo "<p>Invalid job ID.</p>";
    exit;
}

// Get job details using direct query (like test-jobs.php)
$job = null;

// Try direct query first
$directQuery = "SELECT j.*, e.company_name, e.contact_person, e.email as employer_email, 
                       e.phone as employer_phone, e.address as company_address,
                       c.name as category_name
                FROM job_postings j
                LEFT JOIN employers e ON j.employer_id = e.id
                LEFT JOIN job_categories c ON j.category = c.slug
                WHERE j.id = {$job_id} AND j.status = 'approved'";

$directResult = $conn->query($directQuery);

if ($directResult && $directResult->num_rows > 0) {
    $job = $directResult->fetch_assoc();
} else {
    // Fallback: Try without status check (maybe it's pending but we still want to show it)
    $fallbackQuery = "SELECT j.*, e.company_name, e.contact_person, e.email as employer_email, 
                             e.phone as employer_phone, e.address as company_address,
                             c.name as category_name
                      FROM job_postings j
                      LEFT JOIN employers e ON j.employer_id = e.id
                      LEFT JOIN job_categories c ON j.category = c.slug
                      WHERE j.id = {$job_id}";
    
    $fallbackResult = $conn->query($fallbackQuery);
    if ($fallbackResult && $fallbackResult->num_rows > 0) {
        $job = $fallbackResult->fetch_assoc();
    } else {
        // Last fallback: Try with LOWER(TRIM(status)) check
        $lastQuery = "SELECT j.*, e.company_name, e.contact_person, e.email as employer_email, 
                             e.phone as employer_phone, e.address as company_address,
                             c.name as category_name
                      FROM job_postings j
                      LEFT JOIN employers e ON j.employer_id = e.id
                      LEFT JOIN job_categories c ON j.category = c.slug
                      WHERE j.id = {$job_id} AND LOWER(TRIM(j.status)) = 'approved'";
        
        $lastResult = $conn->query($lastQuery);
        if ($lastResult && $lastResult->num_rows > 0) {
            $job = $lastResult->fetch_assoc();
        }
    }
}

if (!$job) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Job Not Found</h1>";
    echo "<p>The job you're looking for doesn't exist or has been removed.</p>";
    exit;
}

// Increment view count
incrementJobViews($job_id);

// Get related jobs
$related_jobs = getRelatedJobs($job_id, $job['category'], 3);

// SEO Meta
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyOMR';
$page_title = htmlspecialchars($job['title']) . " in " . htmlspecialchars($job['location']) . " | " . $site_name;
$clean_description = trim(strip_tags($job['description']));
$page_description = strlen($clean_description) > 155
    ? substr($clean_description, 0, 155) . '...'
    : $clean_description;
$canonical_url = "https://mycovai.in/jobs/job-detail-omr.php?id=" . $job_id;
$og_image = "https://mycovai.in/My-OMR-Logo.jpg";

// Check if user already applied (by email in session or cookie)
$already_applied = false;
if (isset($_COOKIE['applicant_email'])) {
    $already_applied = hasUserApplied($job_id, $_COOKIE['applicant_email']);
}

$application_errors = $_SESSION['application_errors'] ?? [];
unset($_SESSION['application_errors']);

$form_data = $_SESSION['application_form_data'] ?? [];
if (empty($application_errors)) {
    unset($_SESSION['application_form_data']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $page_description; ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($job['title']); ?>, <?php echo htmlspecialchars($job['location']); ?>, jobs in <?php echo htmlspecialchars(defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'OMR'); ?>">
    <link rel="canonical" href="<?php echo $canonical_url; ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($job['title']); ?>">
    <meta property="og:description" content="<?php echo $page_description; ?>">
    <meta property="og:url" content="<?php echo $canonical_url; ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo $og_image; ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($job['title']); ?>">
    <meta name="twitter:description" content="<?php echo $page_description; ?>">
    <meta name="twitter:image" content="<?php echo $og_image; ?>">
    
    <!-- Google Analytics -->
    <?php include '../components/analytics.php'; ?>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Poppins + Core tokens -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/core.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/job-listings-omr.css">
    <link rel="stylesheet" href="assets/omr-jobs-unified-design.css">
    <link rel="stylesheet" href="../components/footer.css">
    
    <!-- Structured Data -->
    <?php echo generateJobPostingSchema($job); ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://mycovai.in/"},
        {"@type": "ListItem", "position": 2, "name": "Jobs in <?php echo htmlspecialchars(defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'OMR'); ?>", "item": "<?php echo defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in'; ?>/jobs/"},
        {"@type": "ListItem", "position": 3, "name": <?php echo json_encode($job['title']); ?>, "item": <?php echo json_encode($canonical_url); ?>}
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "<?php echo htmlspecialchars($site_name); ?>",
      "url": "<?php echo defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in'; ?>/",
      "logo": "<?php echo defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in'; ?><?php echo defined('SITE_LOGO_URL') && SITE_LOGO_URL !== '' ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>",
      "sameAs": [
        "https://www.facebook.com/MyOMR.in",
        "https://www.instagram.com/myomr.in",
        "https://x.com/MyomrNews"
      ]
    }
    </script>
    
    <style>
        .job-header-section {
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
        .job-header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .company-logo {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .job-info-badge {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            display: inline-block;
            margin-right: 1rem;
            margin-bottom: 0.5rem;
        }
        .job-content-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .job-content-section h2 {
            color: #008552;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e5e7eb;
        }
        .breadcrumb {
            background: #f3f4f6;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .breadcrumb-item a {
            color: #008552;
            text-decoration: none;
        }
        .breadcrumb-item a:hover {
            text-decoration: underline;
        }
        .apply-btn-container {
            position: sticky;
            top: 20px;
        }
        .apply-btn-container .btn {
            width: 100%;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
        }
        .info-box {
            background: #e7f5e7;
            border-left: 4px solid #22c55e;
            padding: 1.5rem;
            border-radius: 5px;
            margin: 1.5rem 0;
        }
        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 1.5rem;
            border-radius: 5px;
            margin: 1.5rem 0;
        }
        .related-jobs .job-card {
            margin-bottom: 1rem;
        }
        @media (max-width: 768px) {
            .apply-btn-container {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: white;
                padding: 1rem;
                box-shadow: 0 -2px 8px rgba(0,0,0,0.1);
                z-index: 1000;
            }
        }
    </style>
</head>
<body class="modern-page">

<!-- Navigation -->
<?php require_once '../components/main-nav.php'; ?>

<!-- Skip Link -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<!-- Breadcrumb -->
<div class="breadcrumb-container">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="index.php">Jobs in <?php echo htmlspecialchars(defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'OMR'); ?></a></li>
                <li class="breadcrumb-item"><a href="#"><?php echo htmlspecialchars($job['category_name'] ?? $job['category']); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($job['title']); ?></li>
            </ol>
        </nav>
    </div>
</div>

<!-- Job Header -->
<section class="job-header-section hero-modern">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="company-logo">
                    <i class="fas fa-building"></i>
                </div>
                <h1><?php echo htmlspecialchars($job['title']); ?></h1>
                <h2 class="h4 mb-4"><?php echo htmlspecialchars($job['company_name']); ?></h2>
                
                <div class="job-meta">
                    <span class="job-info-badge">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <?php echo htmlspecialchars($job['location']); ?>
                    </span>
                    <span class="job-info-badge">
                        <i class="fas fa-briefcase me-2"></i>
                        <?php echo htmlspecialchars($job['job_type']); ?>
                    </span>
                    <?php if ($job['salary_range'] && $job['salary_range'] !== 'Not Disclosed'): ?>
                    <span class="job-info-badge">
                        <i class="fas fa-rupee-sign me-2"></i>
                        <?php echo formatSalary($job['salary_range']); ?>
                    </span>
                    <?php endif; ?>
                    <span class="job-info-badge">
                        <i class="fas fa-users me-2"></i>
                        <?php echo $job['views']; ?> views
                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="apply-btn-container">
                    <?php if ($already_applied): ?>
                        <button class="btn btn-success btn-lg" disabled>
                            <i class="fas fa-check me-2"></i>Already Applied
                        </button>
                        <p class="text-center mt-2 mb-0 small">You've already submitted an application</p>
                    <?php else: ?>
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#applyModal">
                            <i class="fas fa-paper-plane me-2"></i>Apply Now
                        </button>
                        <p class="text-center mt-2 mb-0 small">Quick apply in seconds</p>
                    <?php endif; ?>
                    <hr class="my-3">
                    <div class="text-center">
                        <small class="text-white-50 d-block mb-2">Share this job</small>
                        <button class="btn btn-sm btn-outline-light me-2" onclick="shareOnWhatsApp()">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-light" onclick="shareOnLinkedIn()">
                            <i class="fab fa-linkedin"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<main id="main-content">
    <div class="container">
        <div class="row">
            <!-- Job Content -->
            <div class="col-lg-8">

                <?php if (!empty($application_errors)): ?>
                <div class="alert alert-danger shadow-sm" role="alert">
                    <h4 class="alert-heading mb-2"><i class="fas fa-triangle-exclamation me-2"></i>We couldn't submit your application</h4>
                    <ul class="mb-0 ps-3">
                        <?php foreach ($application_errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- Job Description -->
                <div class="job-content-section">
                    <h2><i class="fas fa-file-alt me-2"></i>Job Description</h2>
                    <div class="job-description">
                        <?php echo nl2br(htmlspecialchars($job['description'])); ?>
                    </div>
                </div>
                
                <!-- Requirements -->
                <?php if (!empty($job['requirements'])): ?>
                <div class="job-content-section">
                    <h2><i class="fas fa-clipboard-check me-2"></i>Requirements</h2>
                    <div class="job-requirements">
                        <?php echo nl2br(htmlspecialchars($job['requirements'])); ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Benefits -->
                <?php if (!empty($job['benefits'])): ?>
                <div class="job-content-section">
                    <h2><i class="fas fa-star me-2"></i>Benefits & Perks</h2>
                    <div class="job-benefits">
                        <?php echo nl2br(htmlspecialchars($job['benefits'])); ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Application Deadline -->
                <?php if ($job['application_deadline']): ?>
                <div class="warning-box">
                    <h5><i class="fas fa-clock me-2"></i>Application Deadline</h5>
                    <p class="mb-0">Apply before <strong><?php echo date('F j, Y', strtotime($job['application_deadline'])); ?></strong></p>
                </div>
                <?php endif; ?>
                
                <!-- Important Information -->
                <div class="info-box">
                    <h5><i class="fas fa-info-circle me-2"></i>Important Information</h5>
                    <ul class="mb-0">
                        <li>This is a direct application to the employer</li>
                        <li>Make sure your contact information is accurate</li>
                        <li>The employer will contact you directly if selected</li>
                        <li>Please follow up if you don't hear back within 2 weeks</li>
                    </ul>
                </div>
                
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                
                <!-- Apply Now (Mobile) -->
                <?php if (!$already_applied): ?>
                <div class="apply-btn-container d-block d-lg-none mb-4">
                    <button class="btn btn-primary btn-lg w-100" data-bs-toggle="modal" data-bs-target="#applyModal">
                        <i class="fas fa-paper-plane me-2"></i>Apply Now
                    </button>
                </div>
                <?php endif; ?>
                
                <!-- Company Information -->
                <div class="job-content-section">
                    <h3 class="h5 mb-3"><i class="fas fa-building me-2"></i>About the Company</h3>
                    <p class="fw-semibold"><?php echo htmlspecialchars($job['company_name']); ?></p>
                    
                    <?php if (!empty($job['address'])): ?>
                    <p class="text-muted mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <?php echo htmlspecialchars($job['address']); ?>
                    </p>
                    <?php endif; ?>
                    
                    <p class="text-muted mb-2">
                        <i class="fas fa-envelope me-2"></i>
                        <?php echo htmlspecialchars($job['employer_email']); ?>
                    </p>
                    
                    <?php if (!empty($job['employer_phone'])): ?>
                    <p class="text-muted mb-0">
                        <i class="fas fa-phone me-2"></i>
                        <?php echo htmlspecialchars($job['employer_phone']); ?>
                    </p>
                    <?php endif; ?>
                </div>
                
                <!-- Job Details -->
                <div class="job-content-section">
                    <h3 class="h5 mb-3"><i class="fas fa-info-circle me-2"></i>Job Details</h3>
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-muted">Category:</td>
                            <td class="fw-semibold"><?php echo htmlspecialchars($job['category_name'] ?? $job['category']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Type:</td>
                            <td class="fw-semibold"><?php echo htmlspecialchars($job['job_type']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Location:</td>
                            <td class="fw-semibold"><?php echo htmlspecialchars($job['location']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Posted:</td>
                            <td class="fw-semibold"><?php echo date('M j, Y', strtotime($job['created_at'])); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Salary:</td>
                            <td class="fw-semibold"><?php echo formatSalary($job['salary_range']); ?></td>
                        </tr>
                    </table>
                </div>
                
                <!-- Share Buttons -->
                <div class="job-content-section">
                    <h3 class="h5 mb-3"><i class="fas fa-share-alt me-2"></i>Share This Job</h3>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success" onclick="shareOnWhatsApp()">
                            <i class="fab fa-whatsapp me-2"></i>Share on WhatsApp
                        </button>
                        <button class="btn btn-outline-primary" onclick="shareOnLinkedIn()">
                            <i class="fab fa-linkedin me-2"></i>Share on LinkedIn
                        </button>
                        <button class="btn btn-outline-secondary" onclick="shareViaEmail()">
                            <i class="fas fa-envelope me-2"></i>Share via Email
                        </button>
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Related Jobs -->
        <?php if (!empty($related_jobs)): ?>
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="h3 mb-4"><i class="fas fa-briefcase me-2"></i>Related Jobs</h2>
                
                <div class="row related-jobs">
                    <?php foreach ($related_jobs as $related): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="job-card h-100">
                            <h4 class="h6 mb-2">
                                <a href="job-detail-omr.php?id=<?php echo $related['id']; ?>">
                                    <?php echo htmlspecialchars($related['title']); ?>
                                </a>
                            </h4>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-building me-1"></i>
                                <?php echo htmlspecialchars($related['company_name']); ?>
                            </p>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                <?php echo htmlspecialchars($related['location']); ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Browse All Jobs
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
    </div>
</main>

<!-- Apply Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyModalLabel">
                    <i class="fas fa-paper-plane me-2"></i>Apply for <?php echo htmlspecialchars($job['title']); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="process-application-omr.php" method="POST" id="applyForm">
                <div class="modal-body">
                    <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">

                    <div id="applyFormErrors" class="alert alert-danger d-none" role="alert" tabindex="-1"></div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="applicant_name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="applicant_name" name="applicant_name" value="<?php echo htmlspecialchars($form_data['applicant_name'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="applicant_email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="applicant_email" name="applicant_email" value="<?php echo htmlspecialchars($form_data['applicant_email'] ?? ($_COOKIE['applicant_email'] ?? '')); ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="applicant_phone" class="form-label">Phone Number *</label>
                        <input type="tel" class="form-control" id="applicant_phone" name="applicant_phone" value="<?php echo htmlspecialchars($form_data['applicant_phone'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="experience_years" class="form-label">Years of Experience</label>
                        <input type="number" class="form-control" id="experience_years" name="experience_years" min="0" max="50" value="<?php echo htmlspecialchars(isset($form_data['experience_years']) ? (string)$form_data['experience_years'] : ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="cover_letter" class="form-label">Cover Letter (Optional)</label>
                        <textarea class="form-control" id="cover_letter" name="cover_letter" rows="4" placeholder="Tell us why you're a good fit for this position..."><?php echo htmlspecialchars($form_data['cover_letter'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        The employer will receive your application and contact you directly if interested.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<?php require_once '../components/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Analytics Events -->
<script src="assets/job-analytics-events.js"></script>

<script>
function shareOnWhatsApp() {
    const text = "Check out this job: <?php echo htmlspecialchars($job['title']); ?> - <?php echo htmlspecialchars($job['company_name']); ?>";
    const url = window.location.href;
    window.open(`https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`, '_blank');
}

function shareOnLinkedIn() {
    const url = window.location.href;
    window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`, '_blank');
}

function shareViaEmail() {
    const subject = "Job Opportunity: <?php echo htmlspecialchars($job['title']); ?>";
    const body = `Check out this job opportunity:\n\n<?php echo htmlspecialchars($job['title']); ?>\n<?php echo htmlspecialchars($job['company_name']); ?>\n\n${window.location.href}`;
    window.location.href = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
}

// Client-side validation for apply form
(function() {
    const applyForm = document.getElementById('applyForm');
    const errorContainer = document.getElementById('applyFormErrors');

    if (!applyForm || !errorContainer) {
        return;
    }

    const phonePattern = /^(\+91)?[0-9]{10}$/;

    applyForm.addEventListener('submit', function(e) {
        const errors = [];
        const nameInput = applyForm.querySelector('#applicant_name');
        const emailInput = applyForm.querySelector('#applicant_email');
        const phoneInput = applyForm.querySelector('#applicant_phone');
        const experienceInput = applyForm.querySelector('#experience_years');

        if (!nameInput.value.trim()) {
            errors.push('Please enter your full name.');
        }

        if (!emailInput.value.trim()) {
            errors.push('Please enter your email address.');
        } else if (!emailInput.checkValidity()) {
            errors.push('Please enter a valid email address.');
        }

        if (!phoneInput.value.trim()) {
            errors.push('Please enter your phone number.');
        } else if (!phonePattern.test(phoneInput.value.trim())) {
            errors.push('Phone number should be 10 digits (optionally prefixed with +91).');
        }

        if (experienceInput.value && (parseInt(experienceInput.value, 10) < 0 || parseInt(experienceInput.value, 10) > 50)) {
            errors.push('Experience should be between 0 and 50 years.');
        }

        if (errors.length > 0) {
            e.preventDefault();
            errorContainer.classList.remove('d-none');
            errorContainer.innerHTML = '<ul class="mb-0 ps-3"><li>' + errors.join('</li><li>') + '</li></ul>';
            errorContainer.focus();
        } else {
            errorContainer.classList.add('d-none');
            errorContainer.innerHTML = '';
        }
    });
})();
</script>

</body>
</html>

