<?php
// Unified Bootstrap Navbar for MyCovai
if (!function_exists('covai_logo_url')) {
    require_once __DIR__ . '/../core/mycovai-config.php';
}
$logo = covai_logo_url();
$site = covai_site_name();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded mb-3" style="font-family: 'Josefin Sans', Arial, sans-serif;">
  <a class="navbar-brand d-flex align-items-center" href="/">
    <img src="<?php echo htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($site); ?> Logo" width="40" height="40" class="d-inline-block align-top mr-2 rounded-circle border border-primary">
    <span class="font-weight-bold text-primary" style="font-size: 1.5rem;"><?php echo htmlspecialchars($site); ?></span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a class="nav-link" href="/index.php"><i class="fas fa-home mr-1"></i>Home</a></li>
      <li class="nav-item"><a class="nav-link" href="/directory/index.php"><i class="fas fa-map-marker-alt mr-1"></i>Explore Covai</a></li>
      <li class="nav-item"><a class="nav-link" href="/about.php"><i class="fas fa-info-circle mr-1"></i>About</a></li>
      <li class="nav-item"><a class="nav-link" href="/coimbatore-news.php"><i class="fas fa-newspaper mr-1"></i>Covai News</a></li>
      <li class="nav-item"><a class="nav-link" href="/jobs/"><i class="fas fa-briefcase mr-1"></i>Jobs</a></li>
      <li class="nav-item"><a class="nav-link" href="/local-events/"><i class="fas fa-calendar-alt mr-1"></i>Events</a></li>
      <li class="nav-item"><a class="nav-link" href="/directory/get-listed.php"><i class="fas fa-building mr-1"></i>List Your Business</a></li>
      <li class="nav-item"><a class="nav-link" href="/contact.php"><i class="fas fa-envelope mr-1"></i>Contact</a></li>
      <!-- Onboarding Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle font-weight-bold bg-primary text-white px-3 rounded" href="#" id="onboardingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 0.5rem;">
          <i class="fas fa-user-plus mr-1"></i>Onboarding
        </a>
        <div class="dropdown-menu shadow rounded" aria-labelledby="onboardingDropdown">
          <a class="dropdown-item" href="/info/onboarding/overview.php"><i class="fas fa-eye mr-1"></i>Overview</a>
          <a class="dropdown-item" href="/info/onboarding/getting-started.php"><i class="fas fa-rocket mr-1"></i>Getting Started</a>
          <a class="dropdown-item" href="/info/onboarding/features.php"><i class="fas fa-star mr-1"></i>Features</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
