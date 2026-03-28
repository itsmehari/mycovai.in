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
<!DOCTYPE html>
<html lang="en">
  <head>
<?php $breadcrumbs = [
  ['https://mycovai.in/','Home'],
  ['https://mycovai.in/directory/best-schools.php','Best Schools']
]; ?>
<?php include '../components/meta.php'; ?>
<?php include '../components/analytics.php'; ?>
<?php include '../components/head-resources.php'; ?>
<title>Best Schools in Coimbatore | MyCovai</title>
<meta name="description" content="Discover the best schools along Coimbatore. Find top-rated institutions, addresses, contact details, and more for your child's education.">
<link rel="canonical" href="https://mycovai.in/directory/best-schools.php" />
<meta property="og:title" content="Best Schools in Coimbatore | MyCovai" />
<meta property="og:description" content="Discover the best schools along Coimbatore. Find top-rated institutions, addresses, contact details, and more for your child's education." />
<meta property="og:url" content="https://mycovai.in/directory/best-schools.php" />
<meta property="og:type" content="article" />
<meta property="og:image" content="https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="Best Schools in Coimbatore | MyCovai" />
<meta name="twitter:description" content="Discover the best schools along Coimbatore. Find top-rated institutions, addresses, contact details, and more for your child's education." />
<meta name="twitter:image" content="https://mycovai.in<?php echo defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg'; ?>" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<style>
.hover-me:hover
{
background-color:#0583D2;
cursor: pointer;
opacity: 0.5;

}
</style>
</head>
<body>
<?php include '../components/main-nav.php'; ?>
<div class ="container">
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

<?php include $_SERVER['DOCUMENT_ROOT'].'/components/directory-nav.php'; ?>

<div class="container">
  <h1 style="text-align:center; color:#0583D2;">Best Schools in Coimbatore – Directory</h1>
  
  <!-- Introductory Content Start -->
  <div class="row">
    <div class="col-12">
      <p class="mt-4" style="text-align:justify;">
        Coimbatore (Covai) is often referred to as the educational hub of Tamil Nadu, with significant growth over the past decade and a vibrant mix of technological advancement and residential serenity. This has led to numerous esteemed educational institutions catering to the diverse needs of the community.
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

<?php

if ($result->num_rows > 0) {
  echo "";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<div class='row'><div class='col-sm-1 hover-me' style='background-color:#b8e3ff;  border-top: 2px solid white;border-bottom: 2px solid white;'><br>";
    echo $row["slno"];
    echo "<br></div>";
    echo "<div class='col-sm-7 hover-me' style='font-weight: bold;background-color:#0583D2;color:#fff;  border-top: 2px solid white;border-bottom: 2px solid white;'><br>";
    echo $row["schoolname"];
    echo "<br>";
    echo "<span style='color:#cccccc;font-weight: normal;'>";
    echo $row["address"];
    echo "<br></span>";
    echo "<br></div>";
    echo "<div class='col-sm-4 hover-me' style='background-color:#386FA4;color:#fff;  border-top: 2px solid white;border-bottom: 2px solid white;'><br>";
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

    
    
    
 
</div>
    <!--footer section begins -->
    <?php include '../components/footer.php'; ?>
    <!--footer section ends -->
    
    <!-- UN SDG Floating Badges -->
    <?php include '../components/sdg-badge.php'; ?>
</body>
</html>