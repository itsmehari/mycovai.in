<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $browser = get_browser(null, true); // Disabled for stability

require '../core/omr-connect.php';
require_once __DIR__ . '/components/generic-list-renderer.php';
require_once __DIR__ . '/directory-config.php';
require_once __DIR__ . '/components/directory-list-row.php';
require_once '../core/cache-helpers.php';
omr_output_cache_start(omr_cache_key_from_request('it_companies:'), 300);
$tItCo = covai_table('it-companies');
$tItCoFeat = covai_table('it_companies_feat');
// Create featured table if missing (for sponsored slots)
$conn->query("CREATE TABLE IF NOT EXISTS `$tItCoFeat` (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_slno INT NOT NULL,
  rank_position INT NOT NULL DEFAULT 1,
  blurb VARCHAR(400) DEFAULT NULL,
  cta_text VARCHAR(80) DEFAULT NULL,
  cta_url VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX(company_slno)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

// Search and pagination (9 per page), with prepared statements
$searchQueryRaw = isset($_GET['q']) ? trim($_GET['q']) : '';
$searchQuery = $searchQueryRaw;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$perPage = 9;
$offset = ($page - 1) * $perPage;

// Locality filter (derived from address) and sorting
$allowedLocalities = defined('COIMBATORE_LOCALITIES') ? COIMBATORE_LOCALITIES : ['RS Puram','Gandhipuram','Peelamedu','Race Course','Saravanampatti','Kovaipudur'];
$localityRaw = isset($_GET['locality']) ? trim($_GET['locality']) : '';
$locality = in_array($localityRaw, $allowedLocalities, true) ? $localityRaw : '';

$sortRaw = isset($_GET['sort']) ? trim($_GET['sort']) : 'az';
$allowedSorts = ['az','newest'];
$sort = in_array($sortRaw, $allowedSorts, true) ? $sortRaw : 'az';
$orderSql = ($sort === 'newest') ? ' ORDER BY slno DESC ' : ' ORDER BY company_name ASC ';

// Count total
$whereSql = '';
$params = [];
$types = '';
if ($searchQuery !== '') {
    $whereSql = " WHERE (company_name LIKE ? OR address LIKE ? OR industry_type LIKE ?) ";
    $like = "%{$searchQuery}%";
    $params = [$like, $like, $like];
    $types = 'sss';
}
if ($locality !== '') {
    $whereSql .= ($whereSql === '' ? ' WHERE ' : ' AND ') . " address LIKE ? ";
    $params[] = "%{$locality}%";
    $types .= 's';
}

$countSql = "SELECT COUNT(*) AS total FROM `$tItCo`" . $whereSql;
$countStmt = $conn->prepare($countSql);
if ($countStmt) {
    if ($types !== '') { $countStmt->bind_param($types, ...$params); }
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $totalRow = $countResult ? $countResult->fetch_assoc() : ['total' => 0];
    $totalResults = (int)$totalRow['total'];
    $countStmt->close();
} else {
    $totalResults = 0;
}

// Generic renderer result (authoritative for list + pagination)
$cfg = get_directory_config('it-companies');
$res = render_directory_list($cfg, ['q'=>$searchQueryRaw,'locality'=>$locality,'sort'=>$sort], $page, $perPage);
$totalResults = $res['total'];
$totalPages = $res['pages'];
$page = $res['page'];
$offset = ($page - 1) * $perPage;

// Fetch paginated results
$dataSql = "SELECT slno, company_name, address, contact, industry_type, verified 
            FROM `$tItCo`" . $whereSql . $orderSql . " LIMIT ? OFFSET ?";
$dataStmt = $conn->prepare($dataSql);
if ($dataStmt) {
    if ($types !== '') {
        // add limit and offset bindings
        $typesWithLimits = $types . 'ii';
        $paramsWithLimits = array_merge($params, [$perPage, $offset]);
        $dataStmt->bind_param($typesWithLimits, ...$paramsWithLimits);
    } else {
        $dataStmt->bind_param('ii', $perPage, $offset);
    }
    $dataStmt->execute();
    $result = $dataStmt->get_result();
} else {
    $result = false;
}

?>
<?php include __DIR__ . '/../weblog/log.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $breadcrumbs = [
  ['https://mycovai.in/','Home'],
  ['https://mycovai.in/directory/it-companies.php','IT Companies']
]; ?>
<?php include '../components/meta.php'; ?>
<?php include '../components/analytics.php'; ?>
<?php include '../components/head-resources.php'; ?>

<title>IT Companies in Coimbatore | MyCovai</title>
<link rel="canonical" href="https://mycovai.in/directory/it-companies.php" />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Find top IT companies along Coimbatore. Explore company names, addresses, industry types, and contact details for your business needs.">
<meta name="keywords" content="Coimbatore, Covai, MyCovai, IT companies, RS Puram, Gandhipuram, Saravanampatti, Peelamedu, Tidel Park, Tamil Nadu">
<meta name="author" content="Krishnan">

<meta property="og:type" content="article" />
<meta name="robots" content="index, follow">
<meta property="og:title" content="IT Companies in Coimbatore | MyCovai" />
<meta property="og:description" content="Find top IT companies along Coimbatore. Explore company names, addresses, industry types, and contact details for your business needs." />
<meta property="og:image" content="https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>" />
<meta property="og:url" content="https://mycovai.in/directory/it-companies.php" />
<meta property="og:site_name" content="MyCovai - Coimbatore Directory" />
<meta property="og:locale" content="en_US" />
<meta property="og:locale:alternate" content="ta_IN" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="IT Companies in Coimbatore | MyCovai" />
<meta name="twitter:description" content="Find top IT companies along Coimbatore. Explore company names, addresses, industry types, and contact details for your business needs." />
<meta name="twitter:image" content="https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>" />
<meta name="twitter:site" content="@MyCovai">
<meta name="twitter:creator" content="@MyCovai">
<link rel="stylesheet" href="/assets/css/homepage-directone.css">
<link rel="stylesheet" href="/directory/directory-listing.css">
<link rel="stylesheet" href="/directory/footer.css">
<style>
.hover-me:hover
{
background-color:#0583D2;
cursor: pointer;
opacity: 0.5;

}
</style>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #04AA6D;
}
</style>
<script async defer data-pin-hover="true" data-pin-tall="true" data-pin-round="true" src="//assets.pinterest.com/js/pinit.js"></script>

<link rel="stylesheet" href="social-style.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  .jumbotron
  {
    background-color:#CCFF33;
    font-family: 'Libre Baskerville', serif;
  }
  .button {
  background-color: #D62828; /* Reddish Shade */
  border: none;
  color: #EAE287;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.button1 {background-color: #F77F00;color: #EAE287;} /* Dark Yellowish Scheme */
.button1 a {color: #EAE287;} /* Dark Yellowish Scheme */
.button2 {background-color: #008CBA;} /* Blue */
.button3 {background-color: #f44336;} /* Red */
.button4 {background-color: #e7e7e7; color: black;} /* Gray */
.button5 {background-color: #555555;} /* Black */
  </style>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  
  <!-- Font Awesome -->
<!-- Font, Bootstrap, MDB, FA v6 already included by components/head-resources.php -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&display=swap" rel="stylesheet">
<style>
h2{
font-family: 'Playfair Display', serif;
color: #4c516D;
}
body { font-family: 'Poppins', sans-serif; }
</style>
<!-- Duplicate Font Awesome (v4) removed; FA v6 loaded via head-resources -->

</head>
<style>
    .float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
  animation: myAnim 2s ease 0s 1 normal forwards;
}

.my-float{
	margin-top:16px;
	
}

@keyframes myAnim {
	0% {
		animation-timing-function: ease-in;
		opacity: 1;
		transform: translateY(-45px);
	}

	24% {
		opacity: 1;
	}

	40% {
		animation-timing-function: ease-in;
		transform: translateY(-24px);
	}

	65% {
		animation-timing-function: ease-in;
		transform: translateY(-12px);
	}

	82% {
		animation-timing-function: ease-in;
		transform: translateY(-6px);
	}

	93% {
		animation-timing-function: ease-in;
		transform: translateY(-4px);
	}

	25%,
	55%,
	75%,
	87% {
		animation-timing-function: ease-out;
		transform: translateY(0px);
	}

	100% {
		animation-timing-function: ease-out;
		opacity: 1;
		transform: translateY(0px);
	}
}

</style>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'].'/components/skip-link.php'; ?>
<a href="https://wa.me/919445088028" class="float" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa fa-whatsapp my-float"></i></a>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v14.0" nonce="brAi0ji4"></script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/components/directory-header.php'; ?>

<div class="container maxw-1280" id="main-content" role="main">
  <h1 class="text-center text-primary-omr">IT Companies in Coimbatore</h1>
  <p style="text-align:center; margin-bottom:18px;">Discover IT firms in Coimbatore. Search, filter and connect.</p>
  <?php if (!empty($locality)): ?>
    <div class="text-center mb-2">
      <small>Nearby IT Parks: <a href="/directory/it-parks.php?locality=<?php echo urlencode($locality); ?>">Browse parks in <?php echo htmlspecialchars($locality, ENT_QUOTES, 'UTF-8'); ?></a> or <a href="/directory/it-parks.php">see all</a>.</small>
    </div>
  <?php endif; ?>

  <form id="search-form" method="get" action="" class="mb-3">
    <div class="form-row">
      <div class="col-12 col-sm-6 mb-2">
        <input type="text" name="q" value="<?php echo htmlspecialchars($searchQueryRaw, ENT_QUOTES, 'UTF-8'); ?>" class="form-control" placeholder="Search by company, address or industry type">
      </div>
      <div class="col-6 col-sm-3 mb-2">
        <select name="locality" class="form-control">
          <option value="">All localities</option>
          <?php foreach ($allowedLocalities as $loc): ?>
            <option value="<?php echo htmlspecialchars($loc, ENT_QUOTES, 'UTF-8'); ?>" <?php echo ($locality === $loc ? 'selected' : ''); ?>><?php echo htmlspecialchars($loc, ENT_QUOTES, 'UTF-8'); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-6 col-sm-2 mb-2">
        <select name="sort" class="form-control">
          <option value="az" <?php echo ($sort === 'az' ? 'selected' : ''); ?>>A–Z</option>
          <option value="newest" <?php echo ($sort === 'newest' ? 'selected' : ''); ?>>Newest</option>
        </select>
      </div>
      <div class="col-12 col-sm-1 mb-2">
        <button type="submit" class="btn btn-primary btn-block">Go</button>
      </div>
    </div>
  </form>

  <div class="d-flex justify-content-between align-items-center mb-2">
    <div>
      <?php
        $from = ($totalResults === 0) ? 0 : ($offset + 1);
        $to = min($offset + $perPage, $totalResults);
        echo "<small>Showing {$from}–{$to} of {$totalResults} results</small>";
      ?>
    </div>
    <div>
      <?php if (!empty($locality)) { $hub = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $locality)); echo '<a class="btn btn-sm btn-outline-primary mr-2" href="/directory/locality/' . htmlspecialchars($hub, ENT_QUOTES, 'UTF-8') . '.php">' . htmlspecialchars($locality, ENT_QUOTES, 'UTF-8') . ' hub</a>'; } ?>
      <a href="/directory/get-listed.php" class="btn btn-sm btn-success">Get your company listed</a>
      <a href="/directory/get-listed.php#pricing" class="btn btn-sm btn-outline-success ml-2">Get Verified</a>
    </div>
  </div>

  <?php
  // Featured slots (sponsored)
  $featuredSql = "SELECT f.id, f.rank_position, f.blurb, f.cta_text, f.cta_url, f.start_at, f.end_at, c.slno, c.company_name, c.address
                  FROM `$tItCoFeat` f
                  JOIN `$tItCo` c ON c.slno = f.company_slno
                  WHERE (f.start_at IS NULL OR f.start_at <= NOW())
                    AND (f.end_at IS NULL OR f.end_at >= NOW())
                  ORDER BY f.rank_position ASC, f.start_at DESC
                  LIMIT 6";
  $featuredRes = $conn->query($featuredSql);
  if ($featuredRes && $featuredRes->num_rows > 0) {
      echo "<div class='mb-3'><h3 style='color:#0583D2;'>Featured IT Companies</h3>";
      echo "<div class='row'>";
      while ($fr = $featuredRes->fetch_assoc()) {
          $fname = htmlspecialchars($fr['company_name'], ENT_QUOTES, 'UTF-8');
          $faddr = htmlspecialchars($fr['address'], ENT_QUOTES, 'UTF-8');
          $fblurb = htmlspecialchars($fr['blurb'] ?? '', ENT_QUOTES, 'UTF-8');
          $fctaText = htmlspecialchars($fr['cta_text'] ?? 'Learn more', ENT_QUOTES, 'UTF-8');
          $fslugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $fr['company_name']));
          $fslugBase = trim($fslugBase, '-');
          $fdetail = '/it-companies/' . $fslugBase . '-' . ((int)$fr['slno']);
          $fctaUrl = htmlspecialchars($fr['cta_url'] ?? $fdetail, ENT_QUOTES, 'UTF-8');
          echo "<div class='col-md-4 mb-3'>";
          echo "<div class='card h-100'>";
          echo "<div class='card-body'>";
          echo "<h5 class='card-title'>{$fname}</h5>";
          echo "<p class='card-text'><small class='text-muted'>{$faddr}</small></p>";
          if ($fblurb !== '') { echo "<p class='card-text'>{$fblurb}</p>"; }
          echo "<a class='btn btn-primary' href='{$fctaUrl}' target='_blank' rel='noopener'>{$fctaText}</a>";
          echo "</div></div></div>";
      }
      echo "</div></div>";
  }
  ?>

  <?php
if (!empty($res['items'])) {
    echo "<div class='directory-list' role='list'>";
    $itemList = [];
    $listIndex = 0;

    foreach ($res['items'] as $row) {
        $listIndex++;
        $listRank = $offset + $listIndex;
        $companyId = (int)$row['slno'];
        $companyName = $row['company_name'];
        $companyAddress = $row['address'] ?? '';
        $mapsQuery = urlencode($companyName . ' ' . $companyAddress);
        $mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . $mapsQuery;
        $itemUrl = 'https://mycovai.in/directory/it-companies.php#company-' . $companyId;
        $itemList[] = [
            '@type' => 'ListItem',
            'position' => $listRank,
            'url' => $itemUrl,
            'name' => $companyName,
        ];

        $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $companyName));
        $slugBase = trim($slugBase, '-');
        $detailUrl = '/it-companies/' . $slugBase . '-' . $companyId;

        $badgesHtml = '';
        if (!empty($row['verified'])) {
            $badgesHtml .= '<span class="badge badge-success">Verified</span> ';
        }
        $badgeLocality = '';
        foreach ((defined('COIMBATORE_LOCALITIES') ? COIMBATORE_LOCALITIES : ['RS Puram','Gandhipuram','Peelamedu']) as $locBadge) {
            if (stripos($companyAddress, $locBadge) !== false) {
                $badgeLocality = $locBadge;
                break;
            }
        }
        if ($badgeLocality !== '') {
            $badgesHtml .= '<span class="badge badge-info">' . htmlspecialchars($badgeLocality, ENT_QUOTES, 'UTF-8') . '</span>';
        }

        $contactVal = isset($row['contact']) ? trim((string)$row['contact']) : '';
        $industryVal = isset($row[$cfg['fields']['industry_type']]) ? trim((string)$row[$cfg['fields']['industry_type']]) : '';
        $enquireSubject = urlencode('Listing Enquiry: ' . $companyName . ' (Coimbatore IT Companies)');
        $enquireHref = '/contact.php?subject=' . $enquireSubject;

        directory_render_list_row([
            'rank' => $listRank,
            'record_id' => $companyId,
            'title' => htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8'),
            'title_href' => htmlspecialchars($detailUrl, ENT_QUOTES, 'UTF-8'),
            'address' => htmlspecialchars($companyAddress, ENT_QUOTES, 'UTF-8'),
            'contact' => $contactVal !== '' ? htmlspecialchars($contactVal, ENT_QUOTES, 'UTF-8') : null,
            'category' => $industryVal !== '' ? htmlspecialchars($industryVal, ENT_QUOTES, 'UTF-8') : null,
            'badges_html' => trim($badgesHtml),
            'map_url' => htmlspecialchars($mapsUrl, ENT_QUOTES, 'UTF-8'),
            'enquire_href' => htmlspecialchars($enquireHref, ENT_QUOTES, 'UTF-8'),
            'anchor_id' => 'company-' . $companyId,
            'analytics_company' => $companyName,
        ]);
    }
    
    // Pagination
    // Build pagination prefix preserving filters
    $queryParams = [];
    if ($searchQueryRaw !== '') { $queryParams['q'] = $searchQueryRaw; }
    if ($locality !== '') { $queryParams['locality'] = $locality; }
    if ($sort !== '') { $queryParams['sort'] = $sort; }
    $built = http_build_query($queryParams);
    $queryPrefix = ($built !== '' ? ('?' . htmlspecialchars($built, ENT_QUOTES, 'UTF-8') . '&') : '?');
    echo "<nav aria-label='Pagination'><ul class='pagination justify-content-center mt-3'>";
    $prevDisabled = ($page <= 1) ? ' disabled' : '';
    $nextDisabled = ($page >= $totalPages) ? ' disabled' : '';
    $prevPage = max(1, $page - 1);
    $nextPage = min($totalPages, $page + 1);
    echo "<li class='page-item{$prevDisabled}'><a class='page-link js-page-link' href='{$queryPrefix}page=1' aria-label='First'>&laquo;</a></li>";
    echo "<li class='page-item{$prevDisabled}'><a class='page-link js-page-link' href='{$queryPrefix}page={$prevPage}' aria-label='Previous'>&lsaquo;</a></li>";
    // Current page indicator
    echo "<li class='page-item active'><span class='page-link'>{$page} / {$totalPages}</span></li>";
    echo "<li class='page-item{$nextDisabled}'><a class='page-link js-page-link' href='{$queryPrefix}page={$nextPage}' aria-label='Next'>&rsaquo;</a></li>";
    echo "<li class='page-item{$nextDisabled}'><a class='page-link js-page-link' href='{$queryPrefix}page={$totalPages}' aria-label='Last'>&raquo;</a></li>";
    echo "</ul></nav>";

    // JSON-LD ItemList schema
    echo "<script type=\"application/ld+json\">";
    echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'IT Companies in Coimbatore',
        'itemListElement' => $itemList,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    echo "</script>";

    echo "</div>"; // directory-list
} else {
    echo "<p style='text-align:center;'>No IT companies found in Coimbatore.</p>";
}

// Close connection
$conn->close();
?>
    
    
 
</div>

<div class="container maxw-1280">
  <?php include '../components/subscribe.php'; ?>
  <hr>
  <div class="row">
    <div class="col-12">
      <h3 class="mt-2" style="color:#0583D2;">Explore more Coimbatore listings</h3>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="/directory/banks.php">Banks</a></li>
        <li class="list-inline-item"><a href="/directory/hospitals.php">Hospitals</a></li>
        <li class="list-inline-item"><a href="/directory/restaurants.php">Restaurants</a></li>
        <li class="list-inline-item"><a href="/directory/schools.php">Schools</a></li>
        <li class="list-inline-item"><a href="/directory/parks.php">Parks</a></li>
        <li class="list-inline-item"><a href="/directory/industries.php">Industries</a></li>
      </ul>
    </div>
  </div>
  <div class="mb-3"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  function sendEvent(name, params) {
    try {
      if (typeof gtag === 'function') {
        gtag('event', name, params);
      } else if (window.dataLayer && Array.isArray(window.dataLayer)) {
        window.dataLayer.push(Object.assign({ event: name }, params));
      }
    } catch (e) { /* no-op */ }
  }

  document.querySelectorAll('.js-map-click').forEach(function(el) {
    el.addEventListener('click', function() {
      sendEvent('map_click', {
        category: 'listings_it_companies',
        label: this.dataset.company || ''
      });
    });
  });

  document.querySelectorAll('.js-enquire-click').forEach(function(el) {
    el.addEventListener('click', function() {
      sendEvent('enquire_click', {
        category: 'listings_it_companies',
        label: this.dataset.company || ''
      });
    });
  });

  document.querySelectorAll('.js-page-link').forEach(function(el) {
    el.addEventListener('click', function() {
      sendEvent('pagination_click', {
        category: 'listings_it_companies',
        label: this.getAttribute('href') || ''
      });
    });
  });

  var form = document.getElementById('search-form');
  if (form) {
    form.addEventListener('submit', function() {
      var q = (form.querySelector('[name="q"]').value || '').trim();
      var locality = form.querySelector('[name="locality"]').value || '';
      var sort = form.querySelector('[name="sort"]').value || '';
      sendEvent('search_submit', {
        category: 'listings_it_companies',
        search_term: q,
        locality: locality,
        sort: sort
      });
    });
  }
});
</script>

<script type="application/ld+json">
<?php
// BreadcrumbList for IT Companies list
$breadcrumbs = [
  '@context' => 'https://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => [
    [
      '@type' => 'ListItem',
      'position' => 1,
      'item' => [ '@id' => 'https://mycovai.in/', 'name' => 'Home' ]
    ],
    [
      '@type' => 'ListItem',
      'position' => 2,
      'item' => [ '@id' => 'https://mycovai.in/it-companies', 'name' => 'IT Companies' ]
    ]
  ]
];
echo json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
</script>

<script type="application/ld+json">
<?php
$faq = [
  '@context' => 'https://schema.org',
  '@type' => 'FAQPage',
  'mainEntity' => [
    [
      '@type' => 'Question',
      'name' => 'Which IT companies are in Coimbatore?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Coimbatore hosts a wide range of IT companies from startups to MNCs across RS Puram, Gandhipuram, Saravanampatti, Peelamedu and beyond. Use the search and filters to find specific companies.'
      ]
    ],
    [
      '@type' => 'Question',
      'name' => 'How do I contact an IT company listed here?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Click “View on Map” for directions or “Enquire” to reach our team with your request. You can also use the contact details shown in each row when available.'
      ]
    ],
    [
      '@type' => 'Question',
      'name' => 'How can my company get listed or updated on this page?',
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => 'Click “Get your company listed” and share your details. Our team will verify and publish your listing. Featured placement is also available.'
      ]
    ]
  ]
];
echo json_encode($faq, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
</script>

<!--footer section begins -->
<?php include '../components/footer.php'; ?>
<!--footer section ends -->

<!-- UN SDG Floating Badges -->
<?php include '../components/sdg-badge.php'; ?>
</body>
</html>