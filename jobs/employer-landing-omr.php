<?php
/**
 * Employer Landing Page - Options after clicking "List a job"
 * Shows: Post New Job, Go to Dashboard options
 */
// Enable error reporting for development
require_once __DIR__ . '/includes/error-reporting.php';
require_once __DIR__ . '/../core/omr-connect.php';
require_once __DIR__ . '/includes/employer-auth.php';

// Check if employer is logged in
$isLoggedIn = isEmployerLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Portal – <?php echo htmlspecialchars(defined('SITE_NAME') ? SITE_NAME : 'MyOMR'); ?> Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/job-listings-omr.css">
    <link rel="stylesheet" href="assets/omr-jobs-unified-design.css">
    
    <!-- Google Analytics -->
    <?php include '../components/analytics.php'; ?>
    
    <style>
        .option-card {
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            height: 100%;
        }
        .option-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
        }
        .option-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="modern-page">

<?php require_once __DIR__ . '/../components/main-nav.php'; ?>

<section class="hero-modern py-5">
    <div class="container">
        <div class="text-center text-white">
            <h1 class="hero-modern-title mb-3">Employer Portal</h1>
            <p class="hero-modern-subtitle mb-0">
                <?php if ($isLoggedIn): ?>
                    Welcome back, <?php echo htmlspecialchars($_SESSION['employer_company'] ?? 'Employer'); ?>!
                <?php else: ?>
                    Manage your job postings and find the perfect candidates
                <?php endif; ?>
            </p>
        </div>
    </div>
</section>

<main class="py-5">
    <div class="container">
        
        <?php if ($isLoggedIn): ?>
            <!-- Logged In: Show Options -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <a href="post-job-omr.php" class="text-decoration-none">
                        <div class="card-modern p-5 text-center option-card h-100">
                            <div class="option-icon text-success">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <h3 class="h4 mb-3">Post a New Job</h3>
                            <p class="text-muted mb-0">Create a new job listing and reach qualified candidates in <?php echo htmlspecialchars(defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'OMR'); ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="my-posted-jobs-omr.php" class="text-decoration-none">
                        <div class="card-modern p-5 text-center option-card h-100">
                            <div class="option-icon text-primary">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <h3 class="h4 mb-3">My Posted Jobs</h3>
                            <p class="text-muted mb-0">View your posted jobs and manage your listings</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="employer-dashboard-omr.php" class="text-decoration-none">
                        <div class="card-modern p-5 text-center option-card h-100">
                            <div class="option-icon text-info">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="h4 mb-3">View Applications</h3>
                            <p class="text-muted mb-0">Manage all job applications with advanced filtering and bulk actions</p>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <?php
            require_once __DIR__ . '/../core/omr-connect.php';
            global $conn;
            $employerId = (int)($_SESSION['employer_id'] ?? 0);
            $statsQuery = $conn->query("SELECT 
                COUNT(*) as total_jobs,
                SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved_jobs,
                SUM(applications_count) as total_applications,
                SUM(views) as total_views
                FROM job_postings WHERE employer_id = {$employerId}");
            $stats = $statsQuery ? $statsQuery->fetch_assoc() : null;
            ?>
            
            <?php if ($stats && $stats['total_jobs'] > 0): ?>
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="card-modern p-4 text-center">
                        <div class="h2 mb-1 text-primary"><?php echo $stats['total_jobs']; ?></div>
                        <small class="text-muted">Total Jobs</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card-modern p-4 text-center">
                        <div class="h2 mb-1 text-success"><?php echo $stats['approved_jobs']; ?></div>
                        <small class="text-muted">Active Jobs</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card-modern p-4 text-center">
                        <div class="h2 mb-1 text-info"><?php echo $stats['total_applications'] ?? 0; ?></div>
                        <small class="text-muted">Applications</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card-modern p-4 text-center">
                        <div class="h2 mb-1 text-warning"><?php echo $stats['total_views'] ?? 0; ?></div>
                        <small class="text-muted">Total Views</small>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
        <?php else: ?>
            <!-- Not Logged In: Show Login/Register Options -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card-modern p-5 text-center mb-4">
                        <div class="mb-4">
                            <i class="fas fa-user-tie fa-4x text-primary"></i>
                        </div>
                        <h2 class="h3 mb-3">Join as an Employer</h2>
                        <p class="text-muted mb-4">Post job openings and connect with talented professionals in the OMR area</p>
                        
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="employer-login-omr.php?redirect=employer-landing-omr.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </a>
                            <a href="employer-register-omr.php" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </a>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card-modern p-4 h-100">
                                <h4 class="h5 mb-3"><i class="fas fa-check-circle text-success me-2"></i>Post Jobs Free</h4>
                                <p class="text-muted mb-0">List unlimited job openings at no cost</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-modern p-4 h-100">
                                <h4 class="h5 mb-3"><i class="fas fa-users text-primary me-2"></i>Reach Candidates</h4>
                                <p class="text-muted mb-0">Connect with qualified professionals in OMR</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
    </div>
</main>

<?php require_once __DIR__ . '/../components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

