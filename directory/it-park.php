<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../core/omr-connect.php';
require_once __DIR__ . '/data/it-parks-data.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$id = 0;
if (preg_match('/-(\d+)$/', $slug, $m)) { $id = (int)$m[1]; }

// Try DB first
$park = null;
if ($id > 0) {
  $tItParks = covai_table('it-parks');
  $chk = $conn->query("SHOW TABLES LIKE '" . $conn->real_escape_string($tItParks) . "'");
  if ($chk && $chk->num_rows > 0) {
    $stmt = $conn->prepare("SELECT id, name, locality, address, phone, website, inauguration_year, owner, built_up_area, total_area, image, amenity_sez, amenity_parking, amenity_cafeteria, amenity_shuttle FROM `$tItParks` WHERE id=? LIMIT 1");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $park = $res ? $res->fetch_assoc() : null;
    $stmt->close();
  }
}
if (!$park) { $park = $id ? omr_it_parks_get_by_id($id) : null; }

if (!$park) {
  http_response_code(404);
}
?>
<?php include __DIR__ . '/../weblog/log.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include '../components/meta.php'; ?>
<?php include '../components/analytics.php'; ?>
<?php include '../components/head-resources.php'; ?>
<link rel="stylesheet" href="/assets/css/homepage-directone.css">
<?php $title = $park ? ($park['name'].' | IT Parks in Coimbatore') : 'IT Park not found | MyCovai'; ?>
<title><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
<link rel="canonical" href="https://mycovai.in/it-parks/<?php echo htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>" />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo htmlspecialchars($park['name'] ?? 'IT Park not found', ENT_QUOTES, 'UTF-8'); ?> — details, location, map, and key tenants in Coimbatore." />

<meta property="og:type" content="article" />
<meta name="robots" content="index, follow">
<meta property="og:title" content="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:description" content="Explore <?php echo htmlspecialchars($park['name'] ?? 'IT Park', ENT_QUOTES, 'UTF-8'); ?> in Coimbatore — location, map, contact, and tenants." />
<meta property="og:image" content="https://mycovai.in<?php $img = $park['image'] ?? (defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'); echo htmlspecialchars($img[0] === '/' ? $img : '/' . $img, ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:url" content="https://mycovai.in/it-parks/<?php echo htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>" />

<style>
body { font-family: 'Poppins', sans-serif; }
.maxw-1280 { max-width: 1280px; }
.section-title { color:#0583D2; }
.muted-note { color:#6c757d; }
</style>

<?php if ($park): ?>
<script type="application/ld+json">
<?php
echo json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'Place',
  'name' => $park['name'],
  'address' => [
    '@type' => 'PostalAddress',
    'streetAddress' => $park['address'] ?? '',
    'addressLocality' => ($park['locality'] ?? $park['location'] ?? 'Coimbatore'),
    'addressRegion' => 'TN',
    'addressCountry' => 'IN'
  ],
  'geo' => (!empty($park['lat']) && !empty($park['lng'])) ? [
    '@type' => 'GeoCoordinates',
    'latitude' => (float)$park['lat'],
    'longitude' => (float)$park['lng']
  ] : null,
  'url' => 'https://mycovai.in/it-parks/'.($slug),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
</script>
<?php endif; ?>

</head>
<body>
<?php include '../components/skip-link.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/components/directory-header.php'; ?>

<div class="container maxw-1280 py-3">
  <?php if (!$park): ?>
    <h1 class="section-title">IT Park not found</h1>
    <p><a href="/it-parks">Back to IT Parks</a></p>
  <?php else: ?>
    <h1 class="section-title"><?php echo htmlspecialchars($park['name'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <?php if (!empty($park['image'])): ?>
      <div class="mb-3">
        <img src="<?php echo htmlspecialchars($park['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($park['name'], ENT_QUOTES, 'UTF-8'); ?>" style="max-width:100%;height:auto;border-radius:6px;">
      </div>
    <?php endif; ?>
    <?php if (!empty($park['address'])): ?><p class="muted-note mb-2"><?php echo htmlspecialchars($park['address'], ENT_QUOTES, 'UTF-8'); ?></p><?php endif; ?>
    <?php if (!empty($park['amenity_sez']) || !empty($park['amenity_parking']) || !empty($park['amenity_cafeteria']) || !empty($park['amenity_shuttle'])): ?>
      <p>
        <?php if (!empty($park['amenity_sez'])): ?><span class="badge badge-info mr-1">SEZ</span><?php endif; ?>
        <?php if (!empty($park['amenity_parking'])): ?><span class="badge badge-info mr-1">Parking</span><?php endif; ?>
        <?php if (!empty($park['amenity_cafeteria'])): ?><span class="badge badge-info mr-1">Cafeteria</span><?php endif; ?>
        <?php if (!empty($park['amenity_shuttle'])): ?><span class="badge badge-info mr-1">Shuttle</span><?php endif; ?>
      </p>
    <?php endif; ?>
    <ul class="mb-3">
      <?php if (!empty($park['inauguration_year'])): ?><li><strong>Year:</strong> <?php echo htmlspecialchars($park['inauguration_year'], ENT_QUOTES, 'UTF-8'); ?></li><?php endif; ?>
      <?php if (!empty($park['owner'])): ?><li><strong>Owner:</strong> <?php echo htmlspecialchars($park['owner'], ENT_QUOTES, 'UTF-8'); ?></li><?php endif; ?>
      <?php if (!empty($park['built_up_area'])): ?><li><strong>Built-up:</strong> <?php echo htmlspecialchars($park['built_up_area'], ENT_QUOTES, 'UTF-8'); ?></li><?php endif; ?>
      <?php if (!empty($park['total_area'])): ?><li><strong>Total area:</strong> <?php echo htmlspecialchars($park['total_area'], ENT_QUOTES, 'UTF-8'); ?></li><?php endif; ?>
      <?php if (!empty($park['companies'])): ?><li><strong>Major companies:</strong> <?php echo htmlspecialchars($park['companies'], ENT_QUOTES, 'UTF-8'); ?></li><?php endif; ?>
      <?php if (!empty($park['phone'])): ?><li><strong>Phone:</strong> <?php echo htmlspecialchars($park['phone'], ENT_QUOTES, 'UTF-8'); ?></li><?php endif; ?>
      <?php if (!empty($park['website'])): ?><li><strong>Website:</strong> <a href="<?php echo htmlspecialchars($park['website'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">Visit</a></li><?php endif; ?>
    </ul>
    <?php $mapQuery = urlencode(($park['name'] ?? '').' '.($park['address'] ?? 'Coimbatore')); $mapUrl = 'https://www.google.com/maps/search/?api=1&query='.$mapQuery; ?>
    <p>
      <a class="btn btn-sm btn-primary js-map-click" href="<?php echo htmlspecialchars($mapUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">View on Map</a>
      <a class="btn btn-sm btn-success ml-2" href="/contact.php?subject=Sponsor%20IT%20Park%20Listing:%20<?php echo urlencode($park['name']); ?>">Get Listed / Sponsor</a>
    </p>
    <?php if (!empty($park['lat']) && !empty($park['lng'])): ?>
      <div class="mb-3">
        <iframe style="border:0;width:100%;height:320px" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=<?php echo rawurlencode($park['lat'] . ',' . $park['lng']); ?>&z=16&output=embed"></iframe>
      </div>
    <?php endif; ?>

    <?php $loc = $park['location'] ?? ''; if ($loc !== ''): ?>
      <div class="mb-3">
        <strong>Companies nearby:</strong>
        <a class="btn btn-sm btn-outline-primary ml-2" href="/directory/it-companies.php?locality=<?php echo urlencode($loc); ?>">View IT companies in <?php echo htmlspecialchars($loc, ENT_QUOTES, 'UTF-8'); ?></a>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php include '../components/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  function sendEvent(name, params) {
    try {
      if (typeof gtag === 'function') { gtag('event', name, params); }
      else if (window.dataLayer && Array.isArray(window.dataLayer)) { window.dataLayer.push(Object.assign({ event: name }, params)); }
    } catch (e) {}
  }
  document.querySelectorAll('.js-map-click').forEach(function(el) {
    el.addEventListener('click', function() {
      sendEvent('map_click', { category: 'detail_it_parks', label: '<?php echo htmlspecialchars($park['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>' });
    });
  });
});
</script>

</body>
</html>


