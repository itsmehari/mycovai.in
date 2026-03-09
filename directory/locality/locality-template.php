<?php
/**
 * Coimbatore locality hub template.
 * Include this with $locality and $locality_slug defined.
 * Usage: define vars, then require this file.
 */
if (!isset($locality) || !isset($locality_slug)) {
    header('Location: /directory/');
    exit;
}
$page_title = $locality . ' | Locality Hub | MyCovai';
$page_description = 'Explore ' . $locality . ' in Coimbatore: IT companies, banks, hospitals, restaurants, schools, parks and more.';
$og_title = $page_title;
$og_description = $page_description;
$og_url = 'https://mycovai.in/directory/locality/' . $locality_slug . '.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$canonical_url = $og_url;
$breadcrumbs = [
  ['https://mycovai.in/','Home'],
  ['https://mycovai.in/directory/','Directory'],
  [$og_url, $locality]
];
?>
<?php include __DIR__ . '/../../components/meta.php'; ?>
<?php include __DIR__ . '/../../components/analytics.php'; ?>
<?php include __DIR__ . '/../../components/head-directory-list.php'; ?>
</head>
<body style="background-color: #FAF8F5;">
<?php include __DIR__ . '/../../components/homepage-header.php'; ?>
<div id="main-content" class="container maxw-1280 directory-content">
  <nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="/directory/">Directory</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($locality); ?></li>
    </ol>
  </nav>

  <h1 class="directory-list-hero">Explore <?php echo htmlspecialchars($locality); ?> in Coimbatore</h1>
  <p>Discover IT companies, banks, hospitals, restaurants, schools and parks in and around <?php echo htmlspecialchars($locality); ?>.</p>

  <div class="row mb-3">
    <?php
      $cards = [
        ['IT Companies', '/directory/it-companies.php?locality=' . urlencode($locality)],
        ['Banks', '/directory/banks.php?locality=' . urlencode($locality)],
        ['Hospitals', '/directory/hospitals.php?locality=' . urlencode($locality)],
        ['Restaurants', '/directory/restaurants.php?locality=' . urlencode($locality)],
        ['Schools', '/directory/schools.php?locality=' . urlencode($locality)],
        ['Parks', '/directory/parks.php?locality=' . urlencode($locality)],
      ];
      foreach ($cards as $c) {
        echo '<div class="col-sm-6 col-md-4 mb-3">';
        echo '<a class="card h-100" href="' . htmlspecialchars($c[1], ENT_QUOTES, 'UTF-8') . '"><div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($c[0]) . '</h5>';
        echo '<p class="card-text">View ' . htmlspecialchars($locality) . ' listings</p>';
        echo '</div></a></div>';
      }
    ?>
  </div>

  <h3 class="mt-4">IT companies in <?php echo htmlspecialchars($locality); ?></h3>
  <?php
    $tItCo = covai_table('it-companies');
    $stmt = $conn->prepare("SELECT slno, company_name, address FROM `$tItCo` WHERE (locality = ? OR address LIKE ?) ORDER BY company_name ASC LIMIT 12");
    $like = '%' . $locality . '%';
    $stmt->bind_param('ss', $locality, $like);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows > 0) {
      echo '<ul class="list-unstyled">';
      while ($row = $res->fetch_assoc()) {
        $nm = $row['company_name'];
        $id = (int)$row['slno'];
        $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nm));
        $slugBase = trim($slugBase, '-');
        $url = '/it-companies/' . $slugBase . '-' . $id;
        echo '<li class="mb-1"><a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($nm, ENT_QUOTES, 'UTF-8') . '</a></li>';
      }
      echo '</ul>';
    } else {
      echo '<p>No companies found yet in ' . htmlspecialchars($locality, ENT_QUOTES, 'UTF-8') . '.</p>';
    }
    $stmt->close();
    $conn->close();
  ?>
</div>
<?php include __DIR__ . '/../../components/footer.php'; ?>
<?php include __DIR__ . '/../../components/whatsapp-float.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
