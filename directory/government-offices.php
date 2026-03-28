<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $browser = get_browser(null, true); // Disabled for stability

require '../core/omr-connect.php';

//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

$locality = isset($_GET['locality']) ? trim($_GET['locality']) : '';
$t = covai_table('government-offices');
$sql = "SELECT slno, office_name, address, contact, landmark FROM `$t`";
if ($locality !== '') {
  $safe = '%' . $conn->real_escape_string($locality) . '%';
  $sql .= " WHERE address LIKE '" . $safe . "'";
}
$result = $conn->query($sql);


?>
<?php include __DIR__ . '/../weblog/log.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $breadcrumbs = [
  ['https://mycovai.in/','Home'],
  ['https://mycovai.in/directory/government-offices.php','Government Offices']
]; ?>
<?php include '../components/meta.php'; ?>
<?php include '../components/analytics.php'; ?>
<?php include '../components/head-resources.php'; ?>
<link rel="stylesheet" href="/assets/css/homepage-directone.css">
<link rel="stylesheet" href="/directory/directory-listing.css">

<title>Government Offices in Coimbatore | MyCovai</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Find government offices along Coimbatore. Get office names, addresses, contacts, and landmarks for public services.">
<meta name="keywords" content="Coimbatore, Covai, MyCovai, government offices, RS Puram, Gandhipuram, Peelamedu, Tamil Nadu">
<meta name="author" content="Krishnan">

<meta property="og:type" content="article" />
<meta name="robots" content="index, follow">
<meta property="og:title" content="Government Offices in Coimbatore | MyCovai" />
<meta property="og:description" content="Find government offices in Coimbatore (Covai). Get office names, addresses, contacts, and landmarks for public services." />
<meta property="og:image" content="https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>" />
<meta property="og:url" content="https://mycovai.in/directory/government-offices.php" />
<meta property="og:site_name" content="MyCovai – Coimbatore Directory" />
<meta property="og:locale" content="en_US" />
<meta property="og:locale:alternate" content="ta_IN" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="Government Offices in Coimbatore | MyCovai" />
<meta name="twitter:description" content="Find government offices in Coimbatore (Covai). Get office names, addresses, contacts, and landmarks for public services." />
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

<link rel="canonical" href="https://mycovai.in/directory/government-offices.php" />

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

<div class="container maxw-1280" id="main-content" role="main">
  <h1 class="text-center text-primary-omr">Government Offices in Coimbatore</h1>
  <p class="text-center text-muted mb-0" style="max-width: 36rem; margin-left: auto; margin-right: auto;">Public offices, civic services, and administrative locations across Covai.</p>
  <?php
if ($result->num_rows > 0) {
    echo '<div class="gov-offices-flex-grid" role="list">';
    $rank = 0;
    while ($row = $result->fetch_assoc()) {
        $rank++;
        $nm = (string)$row['office_name'];
        $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nm));
        $slugBase = trim($slugBase, '-');
        $sl = (int)$row['slno'];
        $detail = '/government-offices/' . $slugBase . '-' . $sl;
        $addr = isset($row['address']) ? trim((string)$row['address']) : '';
        $contact = isset($row['contact']) ? trim((string)$row['contact']) : '';
        $landmark = isset($row['landmark']) ? trim((string)$row['landmark']) : '';
        $mapsQuery = urlencode($nm . ' ' . $addr);
        $mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . $mapsQuery;

        echo '<article class="gov-flex-card" role="listitem">';
        echo '<header class="gov-flex-card__header">';
        echo '<h2 class="h6 mb-0"><a href="' . htmlspecialchars($detail, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($nm, ENT_QUOTES, 'UTF-8') . '</a></h2>';
        echo '</header>';
        echo '<div class="gov-flex-card__media" aria-hidden="true"><i class="fa-solid fa-building-columns"></i></div>';
        echo '<div class="gov-flex-card__body">';
        echo '<p class="gov-flex-card__rank">Office #' . $rank . '</p>';
        if ($addr !== '') {
            echo '<p class="gov-flex-card__address">' . htmlspecialchars($addr, ENT_QUOTES, 'UTF-8') . '</p>';
        } else {
            echo '<p class="gov-flex-card__address gov-flex-card__meta-muted">Address not listed</p>';
        }
        echo '<div class="gov-flex-card__meta">';
        echo '<div class="gov-flex-card__meta-row">';
        echo '<i class="fa-solid fa-phone" aria-hidden="true"></i>';
        echo '<span>';
        if ($contact !== '') {
            $telHref = preg_replace('/[^0-9+]/', '', $contact);
            echo '<a href="tel:' . htmlspecialchars($telHref, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($contact, ENT_QUOTES, 'UTF-8') . '</a>';
        } else {
            echo '<span class="gov-flex-card__meta-muted">No phone listed</span>';
        }
        echo '</span></div>';
        echo '<div class="gov-flex-card__meta-row">';
        echo '<i class="fa-solid fa-location-dot" aria-hidden="true"></i>';
        echo '<span>';
        if ($landmark !== '') {
            echo htmlspecialchars($landmark, ENT_QUOTES, 'UTF-8');
        } else {
            echo '<span class="gov-flex-card__meta-muted">—</span>';
        }
        echo '</span></div>';
        echo '</div>';
        echo '<div class="gov-flex-card__footer">';
        echo '<span class="gov-flex-card__id">ID ' . $sl . '</span>';
        echo '<a class="gov-flex-card__link-map" href="' . htmlspecialchars($mapsUrl, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noopener">Map</a>';
        echo '</div>';
        echo '</div></article>';
    }
    echo '</div>';
} else {
    echo '<p class="text-center mt-4">No government offices found in Coimbatore.</p>';
}

$conn->close();
?>
    
    
    
 
</div>


<!--footer section begins -->
<?php include '../components/footer.php'; ?>
<!--footer section ends -->

<!-- UN SDG Floating Badges -->
<?php include '../components/sdg-badge.php'; ?>
</body>
</html>