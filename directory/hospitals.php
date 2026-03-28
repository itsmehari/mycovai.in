<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $browser = get_browser(null, true); // Disabled for stability

require '../core/omr-connect.php';

//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

$t = covai_table('hospitals');
$sql = "SELECT slno, hospitalname, address, contact, landmark FROM `$t`";
$result = $conn->query($sql);
?>
<?php include __DIR__ . '/../weblog/log.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $breadcrumbs = [
  ['https://mycovai.in/','Home'],
  ['https://mycovai.in/directory/hospitals.php','Hospitals']
]; ?>
<?php include '../components/meta.php'; ?>
<?php include '../components/analytics.php'; ?>
<?php include '../components/head-resources.php'; ?>
<link rel="stylesheet" href="/assets/css/homepage-directone.css">
<title>Hospitals in Coimbatore | MyCovai</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Find hospitals along Coimbatore. Get hospital names, addresses, contacts, and landmarks for healthcare services.">
<meta name="keywords" content="Coimbatore, Covai, MyCovai, hospitals, RS Puram, Gandhipuram, Peelamedu, Saibaba Colony, healthcare, Tamil Nadu">
<meta name="author" content="Krishnan">

<meta property="og:type" content="article" />
<meta name=”robots” content=”index, follow”>
<meta property="og:title" content="Hospitals in Coimbatore | MyCovai" />
<meta property="og:description" content="Find hospitals along Coimbatore. Get hospital names, addresses, contacts, and landmarks for healthcare services." />
<meta property="og:image" content="https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>" />
<meta property="og:url" content="https://mycovai.in/directory/hospitals.php" />
<meta property="og:site_name" content="MyCovai - Coimbatore Directory" />
<meta property="og:locale" content="en_US" />
<meta property="og:locale:alternate" content="ta_IN" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="Hospitals in Coimbatore | MyCovai" />
<meta name="twitter:description" content="Find hospitals along Coimbatore. Get hospital names, addresses, contacts, and landmarks for healthcare services." />
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
<style>
h2{
font-family: 'Playfair Display', serif;
color: #4c516D;
}
</style>
<!-- Duplicate Font Awesome (v4) removed; FA v6 loaded via head-resources -->

<link rel="canonical" href="https://mycovai.in/directory/hospitals.php" />

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
  <h1 class="text-center text-primary-omr">Hospitals in Coimbatore</h1>
  <?php

if ($result->num_rows > 0) {
  echo "";
  $itemList = [];
  // Output data of each row
  while ($row = $result->fetch_assoc()) {
    echo "<div class='row row-item'><div class='col-sm-1 col-serial'><br>";
    echo $row["slno"];  // Serial Number
    echo "<br></div>";

    echo "<div class='col-sm-7 bg-primary-omr' style='font-weight:bold; padding:10px;'><br>";
    $nm = $row["hospitalname"];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/','-',$nm));
    $slugBase = trim($slugBase, '-');
    $detail = '/hospitals/' . $slugBase . '-' . (int)$row['slno'];
    echo '<a style="color:#fff; text-decoration:underline;" href="' . htmlspecialchars($detail, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($nm, ENT_QUOTES, 'UTF-8') . '</a>';
    $itemList[] = [
      '@type' => 'ListItem',
      'position' => (int)$row['slno'],
      'url' => 'https://mycovai.in' . $detail,
      'name' => $nm
    ];
    echo "<br>";
    echo "<span class='muted-note'>";
    echo $row["address"];  // Hospital Address
    echo "<br></span>";
    echo "<br></div>";

    echo "<div class='col-sm-4 bg-secondary-omr' style='padding:10px;'><br>";
    echo $row["contact"];  // Hospital Contact Number
    echo "<br></div>";

    echo "</div>";
  }
  echo "<script type=\"application/ld+json\">";
  echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => 'Hospitals in Coimbatore',
    'itemListElement' => $itemList,
  ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  echo "</script>";
} else {
  echo "0 results";
}
$conn->close();
?>

    
    
    
 
</div>

    <!--footer section begins -->
    <?php include '../components/footer.php'; ?>
    <!--footer section ends -->
<?php include '../components/sidebar.php'; ?>
<?php include '../components/action-buttons.php'; ?>
<!-- Social Icons -->
<?php include '../components/social-icons.php'; ?>

<!-- UN SDG Floating Badges -->
<?php include '../components/sdg-badge.php'; ?>
</body>
</html>