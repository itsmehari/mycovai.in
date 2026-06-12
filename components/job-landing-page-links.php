<?php
/**
 * Job Landing Page Quick Links Component
 *
 * Usage: <?php include 'components/job-landing-page-links.php'; ?>
 */

$link_type = $link_type ?? 'all';
$show_title = $show_title ?? true;
$columns = $columns ?? 3;
?>

<?php if ($show_title): ?>
<div class="row mb-4">
    <div class="col-12">
        <h3 class="h4 mb-3"><?php echo $section_title ?? 'Find Jobs by Category'; ?></h3>
    </div>
</div>
<?php endif; ?>

<?php if ($link_type === 'all' || $link_type === 'locations'): ?>
<div class="row g-3 mb-4">
    <div class="col-12">
        <h4 class="h6 text-muted mb-3">Jobs by Location</h4>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs-in-rs-puram.php" class="btn btn-outline-primary btn-sm w-100">
            <i class="fas fa-map-marker-alt me-1"></i> Jobs in RS Puram
        </a>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs-in-gandhipuram.php" class="btn btn-outline-primary btn-sm w-100">
            <i class="fas fa-map-marker-alt me-1"></i> Jobs in Gandhipuram
        </a>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs-in-peelamedu.php" class="btn btn-outline-primary btn-sm w-100">
            <i class="fas fa-map-marker-alt me-1"></i> Jobs in Peelamedu
        </a>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs-in-saravanampatti.php" class="btn btn-outline-primary btn-sm w-100">
            <i class="fas fa-map-marker-alt me-1"></i> Jobs in Saravanampatti
        </a>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs-in-saibaba-colony.php" class="btn btn-outline-primary btn-sm w-100">
            <i class="fas fa-map-marker-alt me-1"></i> Jobs in Saibaba Colony
        </a>
    </div>
</div>
<?php endif; ?>

<?php if ($link_type === 'all' || $link_type === 'industries'): ?>
<div class="row g-3 mb-4">
    <div class="col-12">
        <h4 class="h6 text-muted mb-3">Jobs by Industry</h4>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/it-jobs-coimbatore.php" class="btn btn-outline-success btn-sm w-100">
            <i class="fas fa-laptop-code me-1"></i> IT Jobs
        </a>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs/?category=teaching" class="btn btn-outline-success btn-sm w-100">
            <i class="fas fa-chalkboard-teacher me-1"></i> Teaching Jobs
        </a>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs/?category=healthcare" class="btn btn-outline-success btn-sm w-100">
            <i class="fas fa-user-md me-1"></i> Healthcare Jobs
        </a>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs/?category=retail" class="btn btn-outline-success btn-sm w-100">
            <i class="fas fa-shopping-bag me-1"></i> Retail Jobs
        </a>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs/?category=hospitality" class="btn btn-outline-success btn-sm w-100">
            <i class="fas fa-utensils me-1"></i> Hospitality Jobs
        </a>
    </div>
</div>
<?php endif; ?>

<?php if ($link_type === 'all' || $link_type === 'experience'): ?>
<div class="row g-3 mb-4">
    <div class="col-12">
        <h4 class="h6 text-muted mb-3">Jobs by Experience Level</h4>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs/?experience=fresher" class="btn btn-outline-info btn-sm w-100">
            <i class="fas fa-user-graduate me-1"></i> Fresher Jobs
        </a>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs/?experience=experienced" class="btn btn-outline-info btn-sm w-100">
            <i class="fas fa-user-tie me-1"></i> Experienced Jobs
        </a>
    </div>
</div>
<?php endif; ?>

<?php if ($link_type === 'all' || $link_type === 'types'): ?>
<div class="row g-3 mb-4">
    <div class="col-12">
        <h4 class="h6 text-muted mb-3">Jobs by Type</h4>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs/?job_type=part-time" class="btn btn-outline-warning btn-sm w-100">
            <i class="fas fa-clock me-1"></i> Part-Time Jobs
        </a>
    </div>
    <div class="col-md-<?php echo $columns === 2 ? '6' : ($columns === 3 ? '4' : ($columns === 4 ? '3' : '2')); ?> col-sm-6">
        <a href="/jobs/?job_type=remote" class="btn btn-outline-warning btn-sm w-100">
            <i class="fas fa-home me-1"></i> Work from Home
        </a>
    </div>
</div>
<?php endif; ?>
