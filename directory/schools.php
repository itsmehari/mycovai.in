<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $browser = get_browser(null, true); // Disabled for stability

require '../core/omr-connect.php';

//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

$t = covai_table('schools');
$sql = "SELECT slno, schoolname, address, contact, landmark FROM `$t`";
$result = $conn->query($sql);
?>
<?php include __DIR__ . '/../weblog/log.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $breadcrumbs = [
  ['https://mycovai.in/','Home'],
  ['https://mycovai.in/directory/schools.php','Schools']
]; ?>
<?php include '../components/meta.php'; ?>
<?php include '../components/analytics.php'; ?>
<?php include '../components/head-resources.php'; ?>
<link rel="stylesheet" href="/assets/css/homepage-directone.css">
<title>Schools in Coimbatore | MyCovai</title>
<meta name="description" content="Find schools in Coimbatore (Covai). Get school names, addresses, contacts, and landmarks for your child's education.">
<link rel="canonical" href="https://mycovai.in/directory/schools.php" />
<meta property="og:title" content="Schools in Coimbatore | MyCovai" />
<meta property="og:description" content="Find schools in Coimbatore (Covai). Get school names, addresses, contacts, and landmarks for your child's education." />
<meta property="og:url" content="https://mycovai.in/directory/schools.php" />
<meta property="og:type" content="article" />
<meta property="og:image" content="https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="Schools in Coimbatore | MyCovai" />
<meta name="twitter:description" content="Find schools in Coimbatore (Covai). Get school names, addresses, contacts, and landmarks for your child's education." />
<meta name="twitter:image" content="https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>" />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Explore a detailed list of schools located along Coimbatore (Coimbatore. Find addresses, contact details, and more to choose the best educational institution for your needs.">
<meta name="keywords" content="Coimbatore, Covai, MyCovai, schools, RS Puram, Gandhipuram, Peelamedu, Saibaba Colony, Saravanampatti, Tamil Nadu">
<meta name="author" content="Krishnan">

<meta name="robots" content="index, follow">
<meta property="og:site_name" content="MyCovai – Coimbatore Directory" />
<meta property="og:locale" content="en_US" />
<meta property="og:locale:alternate" content="ta_IN" />
<link rel="stylesheet" href="/directory/footer.css">
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

<script src="modal.js"></script>
<link rel="stylesheet" href="modal.css">
<link rel="stylesheet" href="subscribe.css">

</head>
<body>
    <!--<button onclick="showModal()">Open Modal</button>-->
    
    <!-- Modal Section -->
<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Unlock Exclusive Access to MyCovai</h2>
        <ul>
            <li>✔ Get the latest Coimbatore news & updates</li>
            <li>✔ Find local job listings easily</li>
            <li>✔ Discover events & activities near you</li>
            <li>✔ Browse business directories & real estate listings</li>
            <li>✔ Boost your brand with targeted advertising</li>
            <li>✔ Connect with the Coimbatore community in one platform</li>
        </ul>
        <button onclick="window.location.href='tel:+919884785845'">Call Us for Discussion</button>
    </div>
</div>
<!-- Modal Section Ends -->


<?php include $_SERVER['DOCUMENT_ROOT'].'/components/skip-link.php'; ?>
<a href="https://wa.me/919445088028" class="float" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa fa-whatsapp my-float"></i></a>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v14.0" nonce="brAi0ji4"></script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/components/directory-header.php'; ?>

<!-- Banner ad: listing-top -->
<div class="container maxw-1280 py-3">
    <?php covai_ad_slot('listing-top', '336x280'); ?>
</div>

<div class="container maxw-1280" id="main-content" role="main">
  <h1 style="text-align:center; color:#0583D2;">Schools in Coimbatore</h1>
  
  <!-- Introductory Content Start -->
  <div class="row">
    <div class="col-12">
      <p class="mt-4" style="text-align:justify;">
        Coimbatore has experienced significant growth as a major educational hub, with numerous schools catering to the diverse needs of the community across RS Puram, Gandhipuram, Peelamedu, Saibaba Colony and beyond.
      </p>
      <p style="text-align:justify;">
        The schools in Coimbatore are renowned for their commitment to academic excellence, holistic development, and state-of-the-art facilities. They offer a variety of curricula, including CBSE, ICSE, and international programs, ensuring that parents have a wide array of choices to best suit their children's educational requirements.
      </p>
      <p style="text-align:justify;">
        Whether you're seeking institutions with a strong emphasis on traditional values or those that incorporate innovative teaching methodologies, the schools in Coimbatore provide an ideal environment for nurturing young minds.
      </p>
    </div>
  </div>
  <!-- Introductory Content End -->
  
  <!-- SDG Education Initiative Callout -->
  <div class="row mt-4 mb-4">
    <div class="col-12">
      <div class="alert alert-success" style="background: linear-gradient(135deg, #1e3a1e 0%, #3d7a3d 50%, #4CAF50 100%); border: none; border-radius: 15px; padding: 30px;">
        <div class="row align-items-center">
          <div class="col-md-2 text-center mb-3 mb-md-0">
            <i class="fas fa-seedling fa-4x text-white"></i>
          </div>
          <div class="col-md-8">
            <h4 class="text-white mb-2"><i class="fas fa-star"></i> Join MyCovai's SDG Education Initiative</h4>
            <p class="text-white mb-0" style="font-size: 1.1rem;">
              <strong>Making Coimbatore an SDG-Aware Community!</strong> Help spread UN Sustainable Development Goals awareness in schools. 
              Teachers, parents, and students—everyone has a role to play.
            </p>
          </div>
          <div class="col-md-2 text-center mt-3 mt-md-0">
            <a href="/discover/sdg-education-schools.php" class="btn btn-light btn-lg" style="background: white; color: #2e7d32; font-weight: 600; border-radius: 25px;">
              Learn More <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- SDG Education Initiative Callout End -->

  <!-- Banner ad: listing-mid -->
  <div class="row justify-content-center mb-4">
    <div class="col-auto">
      <?php covai_ad_slot('listing-mid', '336x280'); ?>
    </div>
  </div>
  

<?php

if ($result->num_rows > 0) {
  echo "";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<div class='row row-item'><div class='col-sm-1 col-serial'><br>";
    echo $row["slno"];
    echo "<br></div>";
    echo "<div class='col-sm-7 bg-primary-omr' style='font-weight:bold; padding:10px;'><br>";
    $nm = $row["schoolname"];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/','-',$nm));
    $slugBase = trim($slugBase, '-');
    $detail = '/schools/' . $slugBase . '-' . (int)$row['slno'];
    echo '<a style="color:#fff; text-decoration:underline;" href="' . htmlspecialchars($detail, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($nm, ENT_QUOTES, 'UTF-8') . '</a>';
    echo "<br>";
    echo "<span class='muted-note'>";
    echo $row["address"];
    echo "<br></span>";
    echo "<br></div>";
    echo "<div class='col-sm-4 bg-secondary-omr' style='padding:10px;'><br>";
    echo $row["contact"];
    echo "<br></div>";
    echo "</div>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();
?>

    
    
 <!-- Subscribe Section -->
<section class="subscribe-section">
    <h2>Subscribe</h2>
    <form action="subscribe.php" method="POST" class="subscribe-container">
        <input type="email" name="email" placeholder="you@email.com" class="subscribe-input" required>
        <button type="submit" class="subscribe-button">Submit</button>
    </form>
    <p class="subscribe-text">
        By clicking "Subscribe" you agree to MyCovai Privacy Policy and consent to MyCovai using your contact data for newsletter purposes.
    </p>
</section>   
 
</div>

    <!--footer section begins -->
    <?php include '../components/footer.php'; ?>
    <!--footer section ends -->
    
    <!-- UN SDG Floating Badges -->
    <?php include '../components/sdg-badge.php'; ?>
</body>
</html>