<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $browser = get_browser(null, true); // Disabled for stability

require '../core/omr-connect.php';
require_once __DIR__ . '/components/generic-list-renderer.php';
require_once __DIR__ . '/directory-config.php';
require_once __DIR__ . '/components/directory-list-row.php';

$cfg = get_directory_config('industries');
$searchQueryRaw = isset($_GET['q']) ? trim((string)$_GET['q']) : '';
$localityRaw = isset($_GET['locality']) ? trim((string)$_GET['locality']) : '';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$perPage = 20;
$allowedLocalities = defined('COIMBATORE_LOCALITIES') ? COIMBATORE_LOCALITIES : [];
$locality = in_array($localityRaw, $allowedLocalities, true) ? $localityRaw : '';

$res = render_directory_list($cfg, ['q' => $searchQueryRaw, 'locality' => $locality, 'sort' => 'az'], $page, $perPage);
$totalResults = $res['total'];
$totalPages = $res['pages'];
$offset = ($page - 1) * $perPage;

?>
<?php include __DIR__ . '/../weblog/log.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $breadcrumbs = [
  ['https://mycovai.in/','Home'],
  ['https://mycovai.in/directory/industries.php','Industries']
]; ?>
<?php include '../components/meta.php'; ?>
<?php include '../components/analytics.php'; ?>
<?php include '../components/head-resources.php'; ?>
<link rel="stylesheet" href="/assets/css/homepage-directone.css">
<link rel="stylesheet" href="/directory/directory-listing.css">

<title>Industries in Coimbatore | MyCovai</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Explore major industries along Coimbatore. Find industry names, addresses, types, and contact details for business and networking.">
<meta name="keywords" content="Coimbatore, Covai, MyCovai, industries, RS Puram, Gandhipuram, Saravanampatti, Peelamedu, Tamil Nadu">
<meta name="author" content="Krishnan">

<meta property="og:type" content="article" />
<meta name=”robots” content=”index, follow”>
<meta property="og:title" content="Industries in Coimbatore | MyCovai" />
<meta property="og:description" content="Explore major industries in Coimbatore (Covai). Find industry names, addresses, types, and contact details for business and networking." />
<meta property="og:image" content="https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>" />
<meta property="og:url" content="https://mycovai.in/directory/industries.php" />
<meta property="og:site_name" content="MyCovai – Coimbatore Directory" />
<meta property="og:locale" content="en_US" />
<meta property="og:locale:alternate" content="ta_IN" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="Industries in Coimbatore | MyCovai" />
<meta name="twitter:description" content="Explore major industries in Coimbatore (Covai). Find industry names, addresses, types, and contact details for business and networking." />
<meta name="twitter:image" content="https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>" />
<meta name="twitter:site" content="@MyCovai">
<meta name="twitter:creator" content="@MyCovai">
<link rel="stylesheet" href="footer.css">
<style>
.hover-me:hover
{
background-color:#0583D2;
cursor: pointer;
opacity: 0.5;

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
  <!-- Font, Bootstrap, MDB, FA v6 already included by components/head-resources.php -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<style>
h2{
font-family: 'Playfair Display', serif;
color: #4c516D;
}
</style>
<!-- Duplicate Font Awesome (v4) removed; FA v6 loaded via head-resources -->

<link rel="canonical" href="https://mycovai.in/directory/industries.php" />

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
<?php include $_SERVER['DOCUMENT_ROOT'].'/components/directory-header.php'; ?>
    <a href="https://chat.whatsapp.com/Eixz1mmURuFLvnNZzCfGDi" class="float" target="_blank">
 <i class="fa fa-whatsapp my-float"></i>
</a>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v14.0" nonce="brAi0ji4"></script>

    <div class ="container maxw-1280" id="main-content" role="main">
<div class ="row">
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/markets/" rel="noopener" target="_blank"><span class="blue-text">Markets</span></a> by TradingView</div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
  {
  "symbols": [
    {
      "proName": "FOREXCOM:SPXUSD",
      "title": "S&P 500"
    },
    {
      "proName": "FOREXCOM:NSXUSD",
      "title": "US 100"
    },
    {
      "proName": "FX_IDC:EURUSD",
      "title": "EUR/USD"
    },
    {
      "proName": "BITSTAMP:BTCUSD",
      "title": "Bitcoin"
    },
    {
      "proName": "BITSTAMP:ETHUSD",
      "title": "Ethereum"
    }
  ],
  "showSymbolLogo": true,
  "colorTheme": "light",
  "isTransparent": false,
  "displayMode": "adaptive",
  "locale": "in"
}
  </script>
</div>
<!-- TradingView Widget END -->
</div>
</div>


<div class="container maxw-1280">
  <h1 class="text-center text-primary-omr">Industries in Coimbatore – Directory</h1>
  <p class="text-center text-muted mb-3">Search and browse industrial listings in Coimbatore.</p>

  <form class="mb-3" method="get" action="">
    <div class="form-row">
      <div class="col-12 col-md-5 mb-2">
        <input type="text" name="q" class="form-control" placeholder="Search by name, address or industry type" value="<?php echo htmlspecialchars($searchQueryRaw, ENT_QUOTES, 'UTF-8'); ?>">
      </div>
      <div class="col-12 col-md-4 mb-2">
        <select name="locality" class="form-control">
          <option value="">All areas</option>
          <?php foreach ($allowedLocalities as $loc): ?>
            <option value="<?php echo htmlspecialchars($loc, ENT_QUOTES, 'UTF-8'); ?>" <?php echo $locality === $loc ? 'selected' : ''; ?>><?php echo htmlspecialchars($loc, ENT_QUOTES, 'UTF-8'); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-12 col-md-3 mb-2">
        <button type="submit" class="btn btn-primary btn-block">Search</button>
      </div>
    </div>
  </form>

  <?php
  $from = ($totalResults === 0) ? 0 : ($offset + 1);
  $to = min($offset + $perPage, $totalResults);
  echo '<p class="text-muted small mb-2">Showing ' . (int)$from . '–' . (int)$to . ' of ' . (int)$totalResults . ' results</p>';
  ?>

  <?php
  if (!empty($res['items'])) {
      echo '<div class="directory-list" role="list">';
      $rank = $offset;
      $itemList = [];
      $idCol = $cfg['fields']['id'];
      $nameCol = $cfg['fields']['name'];
      $addrCol = $cfg['fields']['address'];
      $contactCol = $cfg['fields']['contact'];
      $typeCol = $cfg['fields']['industry_type'] ?? null;
      foreach ($res['items'] as $row) {
          $rank++;
          $sl = (int)$row[$idCol];
          $nm = (string)$row[$nameCol];
          $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nm));
          $slugBase = trim($slugBase, '-');
          $detail = '/industries/' . $slugBase . '-' . $sl;
          $addr = isset($row[$addrCol]) ? (string)$row[$addrCol] : '';
          $contact = isset($row[$contactCol]) ? trim((string)$row[$contactCol]) : '';
          $itype = ($typeCol && isset($row[$typeCol])) ? trim((string)$row[$typeCol]) : '';
          $mapsQuery = urlencode($nm . ' ' . $addr);
          $mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . $mapsQuery;
          $enquireSubject = urlencode('Listing Enquiry: ' . $nm . ' (Coimbatore Industries)');
          $enquireHref = '/contact.php?subject=' . $enquireSubject;
          $itemList[] = [
              '@type' => 'ListItem',
              'position' => $rank,
              'url' => 'https://mycovai.in' . $detail,
              'name' => $nm,
          ];
          directory_render_list_row([
              'rank' => $rank,
              'record_id' => $sl,
              'title' => htmlspecialchars($nm, ENT_QUOTES, 'UTF-8'),
              'title_href' => htmlspecialchars($detail, ENT_QUOTES, 'UTF-8'),
              'address' => htmlspecialchars($addr, ENT_QUOTES, 'UTF-8'),
              'contact' => $contact !== '' ? htmlspecialchars($contact, ENT_QUOTES, 'UTF-8') : null,
              'category' => $itype !== '' ? htmlspecialchars($itype, ENT_QUOTES, 'UTF-8') : null,
              'badges_html' => '',
              'map_url' => htmlspecialchars($mapsUrl, ENT_QUOTES, 'UTF-8'),
              'enquire_href' => htmlspecialchars($enquireHref, ENT_QUOTES, 'UTF-8'),
              'anchor_id' => 'industry-' . $sl,
          ]);
      }
      echo '</div>';

      if ($totalPages > 1) {
          $queryParams = [];
          if ($searchQueryRaw !== '') {
              $queryParams['q'] = $searchQueryRaw;
          }
          if ($locality !== '') {
              $queryParams['locality'] = $locality;
          }
          $built = http_build_query($queryParams);
          $queryPrefix = ($built !== '' ? ('?' . htmlspecialchars($built, ENT_QUOTES, 'UTF-8') . '&') : '?');
          echo '<nav aria-label="Pagination" class="mt-3"><ul class="pagination justify-content-center">';
          $prev = max(1, $page - 1);
          $next = min($totalPages, $page + 1);
          echo '<li class="page-item' . ($page <= 1 ? ' disabled' : '') . '"><a class="page-link" href="' . $queryPrefix . 'page=' . $prev . '">Previous</a></li>';
          echo '<li class="page-item active"><span class="page-link">' . (int)$page . ' / ' . (int)$totalPages . '</span></li>';
          echo '<li class="page-item' . ($page >= $totalPages ? ' disabled' : '') . '"><a class="page-link" href="' . $queryPrefix . 'page=' . $next . '">Next</a></li>';
          echo '</ul></nav>';
      }

      echo '<script type="application/ld+json">';
      echo json_encode([
          '@context' => 'https://schema.org',
          '@type' => 'ItemList',
          'name' => 'Industries in Coimbatore',
          'itemListElement' => $itemList,
      ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      echo '</script>';
  } else {
      echo '<p class="text-center">No industries found.</p>';
  }

  $conn->close();
  ?>
    
    
    
 
</div>


<!--footer section begins -->
<?php include '../components/footer.php'; ?>
<!--footer section ends -->
</body>
</html>