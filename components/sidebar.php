<?php
if (!function_exists('covai_logo_url')) {
    require_once __DIR__ . '/../core/mycovai-config.php';
}
$logo = covai_logo_url();
$site = covai_site_name();
?>
<div class="col-sm-4">
  <h2><?php echo htmlspecialchars($site); ?></h2>
  <h5>Coimbatore community portal</h5>
  <div><img src="<?php echo htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($site); ?> logo" style="width:inherit; position:relative;max-width: 280px; padding-bottom:10px;"></div>
  <ul class="nav nav-pills flex-column">
    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="/about.php">About</a></li>
    <li class="nav-item"><a class="nav-link" href="/coimbatore-news.php">Covai News</a></li>
    <li class="nav-item"><a class="nav-link" href="/directory/index.php">Explore Covai</a></li>
    <li class="nav-item"><a class="nav-link" href="/contact.php">Contact</a></li>
  </ul>
  <?php include __DIR__ . '/internal-links-hubs.php'; ?>
  <hr class="d-sm-none">
</div>
