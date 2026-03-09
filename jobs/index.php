<?php
/**
 * MyOMR Job Portal - Main Job Listings Page
 * 
 * @package MyOMR Job Portal
 * @version 2.0.0
 * 
 * Uses direct database queries (like test-jobs.php) for reliable job loading
 */

// Enable error reporting for development
require_once __DIR__ . '/includes/error-reporting.php';

// Include helper functions
require_once __DIR__ . '/includes/job-functions-omr.php';
require_once __DIR__ . '/includes/seo-helper.php';

// Load database connection directly (like test-jobs.php)
require_once __DIR__ . '/../core/omr-connect.php';
global $conn;

// Get filters from URL parameters - only include filters that have values
$filters = [];
if (!empty($_GET['search'])) {
    $filters['search'] = sanitizeInput($_GET['search']);
}
if (!empty($_GET['category'])) {
    $filters['category'] = sanitizeInput($_GET['category']);
}
if (!empty($_GET['location'])) {
    $filters['location'] = sanitizeInput($_GET['location']);
}
if (!empty($_GET['job_type'])) {
    $filters['job_type'] = sanitizeInput($_GET['job_type']);
}
if (!empty($_GET['salary_min'])) {
    $filters['salary_min'] = sanitizeInput($_GET['salary_min']);
}
if (!empty($_GET['salary_max'])) {
    $filters['salary_max'] = sanitizeInput($_GET['salary_max']);
}

// Pagination
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$jobs_per_page = 20;
$offset = ($current_page - 1) * $jobs_per_page;

// Get jobs using direct query (like test-jobs.php - the working approach)
$jobs = [];
$total_jobs = 0;

if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
    // Direct query to get approved jobs (same as test-jobs.php Test 5)
    $limitInt = (int)$jobs_per_page;
    $offsetInt = (int)$offset;
    
    // First get all approved jobs
    $allJobsQuery = "SELECT * FROM job_postings WHERE status = 'approved' ORDER BY featured DESC, created_at DESC";
    $allJobsResult = $conn->query($allJobsQuery);
    
    if ($allJobsResult && $allJobsResult->num_rows > 0) {
        $allJobs = $allJobsResult->fetch_all(MYSQLI_ASSOC);
        $total_jobs = count($allJobs);
        
        // Apply filters if any
        if (!empty($filters)) {
            $filteredJobs = [];
            foreach ($allJobs as $job) {
                $match = true;
                
                if (!empty($filters['category']) && $job['category'] !== $filters['category']) {
                    $match = false;
                }
                if (!empty($filters['location']) && stripos($job['location'] ?? '', $filters['location']) === false) {
                    $match = false;
                }
                if (!empty($filters['job_type']) && $job['job_type'] !== $filters['job_type']) {
                    $match = false;
                }
                if (!empty($filters['search'])) {
                    $searchMatch = (
                        stripos($job['title'] ?? '', $filters['search']) !== false ||
                        stripos($job['description'] ?? '', $filters['search']) !== false
                    );
                    // Check company name if we have employer_id
                    if (!$searchMatch && !empty($job['employer_id'])) {
                        $empQuery = "SELECT company_name FROM employers WHERE id = " . (int)$job['employer_id'];
                        $empResult = $conn->query($empQuery);
                        if ($empResult && $empRow = $empResult->fetch_assoc()) {
                            if (stripos($empRow['company_name'] ?? '', $filters['search']) !== false) {
                                $searchMatch = true;
                            }
                        }
                    }
                    if (!$searchMatch) {
                        $match = false;
                    }
                }
                
                if ($match) {
                    $filteredJobs[] = $job;
                }
            }
            $allJobs = $filteredJobs;
            $total_jobs = count($filteredJobs);
        }
        
        // Apply pagination
        $jobs = array_slice($allJobs, $offsetInt, $limitInt);
        
        // Enrich with employer and category data
        if (!empty($jobs)) {
            $jobIds = array_column($jobs, 'id');
            if (!empty($jobIds)) {
                $placeholders = implode(',', array_fill(0, count($jobIds), '?'));
                $enrichSql = "SELECT j.id, e.company_name, e.contact_person, e.email as employer_email, 
                                    e.phone as employer_phone, e.address as company_address, c.name as category_name
                             FROM job_postings j
                             LEFT JOIN employers e ON j.employer_id = e.id
                             LEFT JOIN job_categories c ON j.category = c.slug
                             WHERE j.id IN ({$placeholders})";
                
                $enrichStmt = $conn->prepare($enrichSql);
                if ($enrichStmt) {
                    $types = str_repeat('i', count($jobIds));
                    if ($enrichStmt->bind_param($types, ...$jobIds)) {
                        if ($enrichStmt->execute()) {
                            $enrichResult = $enrichStmt->get_result();
                            if ($enrichResult) {
                                $enrichData = [];
                                while ($row = $enrichResult->fetch_assoc()) {
                                    $enrichData[$row['id']] = $row;
                                }
                                
                                // Merge enrichment data
                                foreach ($jobs as &$job) {
                                    if (isset($enrichData[$job['id']])) {
                                        $job['company_name'] = $enrichData[$job['id']]['company_name'] ?? null;
                                        $job['contact_person'] = $enrichData[$job['id']]['contact_person'] ?? null;
                                        $job['employer_email'] = $enrichData[$job['id']]['employer_email'] ?? null;
                                        $job['employer_phone'] = $enrichData[$job['id']]['employer_phone'] ?? null;
                                        $job['company_address'] = $enrichData[$job['id']]['company_address'] ?? null;
                                        $job['category_name'] = $enrichData[$job['id']]['category_name'] ?? null;
                                    }
                                }
                            }
                        }
                    }
                    $enrichStmt->close();
                }
            }
        }
    } else {
        // Try fallback with LOWER/TRIM
        $fallbackQuery = "SELECT * FROM job_postings WHERE LOWER(TRIM(status)) = 'approved' ORDER BY featured DESC, created_at DESC";
        $fallbackResult = $conn->query($fallbackQuery);
        if ($fallbackResult && $fallbackResult->num_rows > 0) {
            $allJobs = $fallbackResult->fetch_all(MYSQLI_ASSOC);
            $total_jobs = count($allJobs);
            $jobs = array_slice($allJobs, $offsetInt, $limitInt);
        }
    }
}

$total_pages = ceil($total_jobs / $jobs_per_page);

// Get categories for filter dropdown
$categories = getJobCategories();

// SEO Meta (Phase 4: Covai when config loaded)
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyOMR';
$region_short = defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'OMR';
$region_full = defined('SITE_REGION') ? SITE_REGION : 'OMR Chennai';
$page_title = defined('MYCOVAI_CONFIG_LOADED') ? "Jobs in " . $region_short . " – Find Local Opportunities | " . $site_name : "Jobs in OMR Chennai - Find Local Opportunities | MyOMR";
$page_description = defined('MYCOVAI_CONFIG_LOADED') ? "Find jobs in " . $region_full . ". IT, Teaching, Healthcare & more. Apply directly to employers. Free job listings for local opportunities in " . $region_full . "." : "Find 1000+ jobs in OMR Chennai. IT, Teaching, Healthcare & more. Apply directly to employers. Free job listings for local opportunities in Old Mahabalipuram Road.";
$canonical_url = (defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in') . '/jobs/';

// Build filter URL for pagination
$filter_params = http_build_query($filters);
$base_url = "/jobs/";
if (!empty($filter_params)) {
    $base_url .= "?" . $filter_params;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $page_description; ?>">
    <meta name="keywords" content="<?php echo defined('MYCOVAI_CONFIG_LOADED') ? 'jobs in Coimbatore, Covai jobs, IT jobs Coimbatore, teaching jobs Covai, local job portal' : 'jobs in OMR Chennai, IT jobs OMR, teaching jobs OMR, healthcare jobs OMR, local job portal, Old Mahabalipuram Road jobs'; ?>">
    <link rel="canonical" href="<?php echo $canonical_url; ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo $page_title; ?>">
    <meta property="og:description" content="<?php echo $page_description; ?>">
    <meta property="og:url" content="<?php echo $canonical_url; ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://mycovai.in/My-OMR-Logo.jpg">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $page_title; ?>">
    <meta name="twitter:description" content="<?php echo $page_description; ?>">
    <meta name="twitter:image" content="https://mycovai.in/My-OMR-Logo.jpg">
    
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
    <!-- Universal Footer Styles -->
    <link rel="stylesheet" href="../components/footer.css">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "<?php echo htmlspecialchars($site_name); ?> Job Portal",
        "url": "<?php echo $canonical_url; ?>",
        "description": "<?php echo $page_description; ?>",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "<?php echo $canonical_url; ?>?search={search_term}",
            "query-input": "required name=search_term"
        }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://mycovai.in/"},
        {"@type": "ListItem", "position": 2, "name": "Jobs in <?php echo htmlspecialchars($region_short); ?>", "item": "<?php echo $canonical_url; ?>"}
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "<?php echo htmlspecialchars(defined('SITE_NAME') ? SITE_NAME : 'My OMR'); ?>",
      "url": "<?php echo defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in'; ?>/",
      "logo": "<?php echo defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in'; ?><?php echo defined('SITE_LOGO_URL') && SITE_LOGO_URL !== '' ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>",
      "sameAs": [
        "https://www.facebook.com/MyOMR.in",
        "https://www.instagram.com/myomr.in",
        "https://x.com/MyomrNews"
      ]
    }
    </script>
</head>
<body class="modern-page">

<!-- Navigation -->
<?php require_once '../components/main-nav.php'; ?>

<!-- Skip Link for Accessibility -->
<a href="#main-content" class="skip-link">Skip to main content</a>

<!-- Main Content -->
<main id="main-content">
    
    <!-- Hero Section -->
    <section class="hero-section hero-modern text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3 hero-modern-title">Find Your Dream Job in <?php echo htmlspecialchars($region_short); ?></h1>
                    <p class="lead mb-4 hero-modern-subtitle">Connect with top employers in <?php echo htmlspecialchars($region_full); ?>. Browse <?php echo number_format($total_jobs); ?>+ job opportunities across IT, Teaching, Healthcare, and more.</p>
                    
                    <!-- Search Form -->
                    <form method="GET" class="search-form" role="search" aria-label="Search jobs">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label for="search" class="form-label visually-hidden">Search jobs</label>
                                <input type="text" 
                                       id="search" 
                                       name="search" 
                                       class="form-control form-control-lg" 
                                       placeholder="Job title, company, or keywords"
                                       value="<?php echo htmlspecialchars($filters['search'] ?? ''); ?>"
                                       aria-describedby="search-help">
                                <div id="search-help" class="form-text text-white-50">e.g., Software Developer, Teacher, Nurse</div>
                            </div>
                            <div class="col-md-3">
                                <label for="location" class="form-label visually-hidden">Location</label>
                                <input type="text" 
                                       id="location" 
                                       name="location" 
                                       class="form-control form-control-lg" 
                                       placeholder="Location (<?php echo htmlspecialchars($region_short); ?>, <?php echo htmlspecialchars($region_full); ?>)"
                                       value="<?php echo htmlspecialchars($filters['location'] ?? ''); ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="category" class="form-label visually-hidden">Category</label>
                                <select id="category" name="category" class="form-select form-select-lg">
                                    <option value="">All Categories</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo htmlspecialchars($category['slug']); ?>" 
                                                <?php echo isset($filters['category']) && $filters['category'] === $category['slug'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-light btn-lg w-100" aria-label="Search jobs">
                                    <i class="fas fa-search me-1"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="card-modern text-dark bg-white bg-opacity-10 p-4 rounded h-100">
                        <h3 class="h2 mb-1 text-success"><?php echo number_format($total_jobs); ?>+</h3>
                        <p class="mb-1 text-dark fw-semibold">Active Jobs</p>
                        <small class="text-muted">Updated daily with new opportunities</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="filters-section py-4 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="h5 mb-0">Refine Your Search</h2>
                    <small class="text-muted">Showing <?php echo number_format($total_jobs); ?> jobs</small>
                </div>
                <div class="col-md-6">
                    <form method="GET" class="advanced-filters d-flex gap-2 flex-wrap">
                        <!-- Preserve existing filters -->
                        <?php foreach ($filters as $key => $value): ?>
                            <?php if ($key !== 'job_type' && !empty($value)): ?>
                                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>">
                            <?php endif; ?>
                        <?php endforeach; ?>
                        
                        <select name="job_type" class="form-select form-select-sm" aria-label="Job type filter">
                            <option value="">All Types</option>
                            <option value="full-time" <?php echo isset($filters['job_type']) && $filters['job_type'] === 'full-time' ? 'selected' : ''; ?>>Full Time</option>
                            <option value="part-time" <?php echo isset($filters['job_type']) && $filters['job_type'] === 'part-time' ? 'selected' : ''; ?>>Part Time</option>
                            <option value="contract" <?php echo isset($filters['job_type']) && $filters['job_type'] === 'contract' ? 'selected' : ''; ?>>Contract</option>
                            <option value="internship" <?php echo isset($filters['job_type']) && $filters['job_type'] === 'internship' ? 'selected' : ''; ?>>Internship</option>
                        </select>
                        
                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-filter me-1"></i> Apply
                        </button>
                        
                        <?php if (!empty($filters)): ?>
                            <a href="/jobs/" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-times me-1"></i> Clear All
                            </a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Browse by Location & Industry Section -->
    <section class="browse-landing-pages py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h3 class="h5 mb-3"><i class="fas fa-map-marker-alt text-primary me-2"></i>Browse Jobs by Location</h3>
                    <div class="row g-2">
                        <div class="col-6 col-md-6">
                            <a href="/jobs-in-perungudi-omr.php" class="btn btn-outline-primary btn-sm w-100 mb-2">Jobs in Perungudi</a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="/jobs-in-sholinganallur-omr.php" class="btn btn-outline-primary btn-sm w-100 mb-2">Jobs in Sholinganallur</a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="/jobs-in-navalur-omr.php" class="btn btn-outline-primary btn-sm w-100 mb-2">Jobs in Navalur</a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="/jobs-in-thoraipakkam-omr.php" class="btn btn-outline-primary btn-sm w-100 mb-2">Jobs in Thoraipakkam</a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="/jobs-in-kelambakkam-omr.php" class="btn btn-outline-primary btn-sm w-100 mb-2">Jobs in Kelambakkam</a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="/jobs-in-omr-chennai.php" class="btn btn-primary btn-sm w-100 mb-2">All Locations</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <h3 class="h5 mb-3"><i class="fas fa-industry text-success me-2"></i>Browse Jobs by Industry</h3>
                    <div class="row g-2">
                        <div class="col-6 col-md-6">
                            <a href="/it-jobs-omr-chennai.php" class="btn btn-outline-success btn-sm w-100 mb-2"><i class="fas fa-laptop-code me-1"></i>IT Jobs</a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="/teaching-jobs-omr-chennai.php" class="btn btn-outline-success btn-sm w-100 mb-2"><i class="fas fa-chalkboard-teacher me-1"></i>Teaching</a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="/healthcare-jobs-omr-chennai.php" class="btn btn-outline-success btn-sm w-100 mb-2"><i class="fas fa-user-md me-1"></i>Healthcare</a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="/retail-jobs-omr-chennai.php" class="btn btn-outline-success btn-sm w-100 mb-2"><i class="fas fa-shopping-bag me-1"></i>Retail</a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="/hospitality-jobs-omr-chennai.php" class="btn btn-outline-success btn-sm w-100 mb-2"><i class="fas fa-utensils me-1"></i>Hospitality</a>
                        </div>
                        <div class="col-6 col-md-6">
                            <a href="/jobs-in-omr-chennai.php" class="btn btn-success btn-sm w-100 mb-2">All Industries</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <h3 class="h5 mb-3"><i class="fas fa-briefcase text-info me-2"></i>Specialized Job Searches</h3>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="/fresher-jobs-omr-chennai.php" class="btn btn-outline-info btn-sm"><i class="fas fa-user-graduate me-1"></i>Fresher Jobs</a>
                        <a href="/experienced-jobs-omr-chennai.php" class="btn btn-outline-info btn-sm"><i class="fas fa-user-tie me-1"></i>Experienced Jobs</a>
                        <a href="/part-time-jobs-omr-chennai.php" class="btn btn-outline-warning btn-sm"><i class="fas fa-clock me-1"></i>Part-Time Jobs</a>
                        <a href="/work-from-home-jobs-omr.php" class="btn btn-outline-warning btn-sm"><i class="fas fa-home me-1"></i>Work from Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Listings -->
    <section class="job-listings-section py-5">
        <div class="container">
            
            <?php if (!empty($jobs)): ?>
                
                <!-- Results Header -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2 class="h4 mb-1">Job Opportunities</h2>
                        <p class="text-muted mb-0">
                            Showing <?php echo count($jobs); ?> of <?php echo number_format($total_jobs); ?> jobs
                            <?php if ($current_page > 1): ?>
                                - Page <?php echo $current_page; ?> of <?php echo $total_pages; ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="btn-group" role="group" aria-label="Sort options">
                            <button type="button" class="btn btn-outline-primary btn-sm active" data-sort="newest">
                                <i class="fas fa-clock me-1"></i> Newest
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" data-sort="featured">
                                <i class="fas fa-star me-1"></i> Featured
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Job Cards -->
                <div class="row" id="job-cards-container">
                    <?php foreach ($jobs as $job): ?>
                        <?php
                            $jobAddressParts = resolveJobPostalAddress($job);
                            $jobValidThrough = resolveJobValidThrough($job);
                            $jobSalarySchema = parseSalaryRangeForSchema($job['salary_range'] ?? '');
                        ?>
                        <div class="col-lg-6 mb-4" itemscope itemtype="https://schema.org/JobPosting">
                            
                            <!-- Job Card -->
                            <article class="job-card job-card-modern h-100 border rounded shadow-sm p-4 position-relative">
                                
                                <!-- Featured Badge -->
                                <?php if (!empty($job['featured'])): ?>
                                    <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-3">
                                        <i class="fas fa-star me-1"></i> Featured
                                    </span>
                                <?php endif; ?>
                                
                                <!-- Job Header -->
                                <header class="job-header mb-3">
                                    <h3 class="h5 mb-2 job-title" itemprop="title">
                                        <a href="job-detail-omr.php?id=<?php echo $job['id']; ?>" 
                                           class="text-decoration-none text-dark">
                                            <?php echo htmlspecialchars($job['title']); ?>
                                        </a>
                                    </h3>
                                    
                                    <div class="company-info mb-2 company-name">
                                        <span class="text-primary fw-semibold" itemprop="hiringOrganization" itemscope itemtype="https://schema.org/Organization">
                                            <span itemprop="name"><?php echo htmlspecialchars($job['company_name'] ?? 'Company'); ?></span>
                                            <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress" class="visually-hidden">
                                                <?php if (!empty($jobAddressParts['streetAddress'])): ?>
                                                    <meta itemprop="streetAddress" content="<?php echo htmlspecialchars($jobAddressParts['streetAddress']); ?>">
                                                <?php endif; ?>
                                                <meta itemprop="addressLocality" content="<?php echo htmlspecialchars($jobAddressParts['addressLocality']); ?>">
                                                <meta itemprop="addressRegion" content="<?php echo htmlspecialchars($jobAddressParts['addressRegion']); ?>">
                                                <meta itemprop="postalCode" content="<?php echo htmlspecialchars($jobAddressParts['postalCode']); ?>">
                                                <meta itemprop="addressCountry" content="<?php echo htmlspecialchars($jobAddressParts['addressCountry']); ?>">
                                            </span>
                                            <?php if (!empty($job['employer_email'])): ?>
                                                <meta itemprop="email" content="<?php echo htmlspecialchars($job['employer_email']); ?>">
                                            <?php endif; ?>
                                            <?php if (!empty($job['employer_phone'])): ?>
                                                <meta itemprop="telephone" content="<?php echo htmlspecialchars($job['employer_phone']); ?>">
                                            <?php endif; ?>
                                        </span>
                                        <span class="text-muted mx-2">•</span>
                                        <span class="text-muted">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <span itemprop="jobLocation" itemscope itemtype="https://schema.org/Place">
                                                <meta itemprop="name" content="<?php echo htmlspecialchars($jobAddressParts['addressLocality']); ?>">
                                                <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                                                    <?php if (!empty($jobAddressParts['streetAddress'])): ?>
                                                        <meta itemprop="streetAddress" content="<?php echo htmlspecialchars($jobAddressParts['streetAddress']); ?>">
                                                    <?php endif; ?>
                                                    <meta itemprop="addressLocality" content="<?php echo htmlspecialchars($jobAddressParts['addressLocality']); ?>">
                                                    <meta itemprop="addressRegion" content="<?php echo htmlspecialchars($jobAddressParts['addressRegion']); ?>">
                                                    <meta itemprop="postalCode" content="<?php echo htmlspecialchars($jobAddressParts['postalCode']); ?>">
                                                    <meta itemprop="addressCountry" content="<?php echo htmlspecialchars($jobAddressParts['addressCountry']); ?>">
                                                </span>
                                                <?php echo htmlspecialchars($job['location'] ?? $jobAddressParts['addressLocality']); ?>
                                            </span>
                                        </span>
                                    </div>
                                    
                                    <div class="job-meta">
                                        <span class="badge-modern badge-modern-primary">
                                            <i class="fas fa-briefcase me-1"></i>
                                            <?php echo ucfirst(str_replace('-', ' ', $job['job_type'] ?? 'Full-time')); ?>
                                        </span>
                                        <span class="badge-modern badge-modern-primary">
                                            <i class="fas fa-tag me-1"></i>
                                            <?php echo htmlspecialchars($job['category_name'] ?? $job['category'] ?? 'General'); ?>
                                        </span>
                                        <?php if (!empty($job['salary_range']) && $job['salary_range'] !== 'Not Disclosed'): ?>
                                            <span class="badge-modern badge-modern-success">
                                                <i class="fas fa-rupee-sign me-1"></i>
                                                <?php echo formatSalary($job['salary_range']); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </header>
                                
                                <!-- Job Description -->
                                <div class="job-description mb-3">
                                    <p class="text-muted mb-2" itemprop="description">
                                        <?php 
                                        $description = strip_tags($job['description'] ?? '');
                                        echo htmlspecialchars(strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description);
                                        ?>
                                    </p>
                                </div>
                                
                                <!-- Job Footer -->
                                <footer class="job-footer d-flex justify-content-between align-items-center">
                                    <div class="job-dates text-muted small">
                                        <?php if (!empty($job['created_at'])): ?>
                                            <span itemprop="datePosted" content="<?php echo date('Y-m-d', strtotime($job['created_at'])); ?>">
                                                <i class="fas fa-calendar me-1"></i>
                                                Posted <?php echo date('M j, Y', strtotime($job['created_at'])); ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if (!empty($job['application_deadline']) && $job['application_deadline'] !== '0000-00-00'): ?>
                                            <span class="ms-3">
                                                <i class="fas fa-clock me-1"></i>
                                                Apply by <?php echo date('M j, Y', strtotime($job['application_deadline'])); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="job-actions">
                                        <a href="job-detail-omr.php?id=<?php echo $job['id']; ?>" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i> View Details
                                        </a>
                                    </div>
                                </footer>
                                
                                <!-- Hidden Schema Data -->
                                <meta itemprop="employmentType" content="<?php echo ucfirst($job['job_type'] ?? 'Full-time'); ?>">
                                <?php if (!empty($jobValidThrough)): ?>
                                    <meta itemprop="validThrough" content="<?php echo $jobValidThrough; ?>">
                                <?php endif; ?>
                                <?php if ($jobSalarySchema): ?>
                                    <span itemprop="baseSalary" itemscope itemtype="https://schema.org/MonetaryAmount" class="visually-hidden">
                                        <meta itemprop="currency" content="INR">
                                        <span itemprop="value" itemscope itemtype="https://schema.org/QuantitativeValue">
                                            <?php if (isset($jobSalarySchema['value'])): ?>
                                                <meta itemprop="value" content="<?php echo $jobSalarySchema['value']; ?>">
                                            <?php else: ?>
                                                <meta itemprop="minValue" content="<?php echo $jobSalarySchema['minValue']; ?>">
                                                <meta itemprop="maxValue" content="<?php echo $jobSalarySchema['maxValue']; ?>">
                                            <?php endif; ?>
                                            <meta itemprop="unitText" content="<?php echo $jobSalarySchema['unitText']; ?>">
                                        </span>
                                    </span>
                                <?php endif; ?>
                                
                            </article>
                            
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                    <div class="row mt-5">
                        <div class="col-12">
                            <?php echo generatePagination($current_page, $total_pages, $base_url); ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                
                <!-- No Results -->
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <div class="no-results">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h3 class="h4 mb-3">No Jobs Found</h3>
                            <p class="text-muted mb-4">
                                <?php if (!empty($filters)): ?>
                                    Try adjusting your search criteria or <a href="/jobs/">browse all jobs</a>.
                                <?php else: ?>
                                    No job listings available at the moment. Check back soon for new opportunities!
                                <?php endif; ?>
                            </p>
                            <a href="/jobs/" class="btn btn-primary">
                                <i class="fas fa-refresh me-1"></i> View All Jobs
                            </a>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section bg-primary text-white py-5">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="h3 mb-3">Are You an Employer?</h2>
                    <p class="lead mb-4">Post your job openings and connect with talented professionals in <?php echo htmlspecialchars($region_short); ?>.</p>
                    <a href="employer-login-omr.php" class="btn btn-light btn-lg me-3">
                        <i class="fas fa-plus me-1"></i> Post a Job
                    </a>
                    <a href="employer-register-omr.php" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-building me-1"></i> Register as Employer
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- Footer -->
<?php require_once '../components/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="assets/job-search-omr.js"></script>
<!-- Analytics Events -->
<script src="assets/job-analytics-events.js"></script>

<!-- UN SDG Floating Badges -->
<?php include '../components/sdg-badge.php'; ?>

</body>
</html>
