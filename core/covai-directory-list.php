<?php
require 'omr-connect.php';
require_once __DIR__ . '/mycovai-config.php';

//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

$browser = get_browser(null, true);
//print_r($browser);

$t = covai_table('schools');
$sql = "SELECT slno, schoolname, address, contact, landmark FROM `$t`";
$result = $conn->query($sql);
?>
<?php include __DIR__ . '/../weblog/log.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include __DIR__ . '/../components/analytics.php'; ?>

<title>Search for Local Businesses, Shops, Offices, Schools, ATMs in Coimbatore | MyCovai Directory</title>
<link rel="canonical" href="https://mycovai.in/covai-directory-list.php" />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Find schools, hospitals, banks, restaurants, IT companies and more in Coimbatore. Your local directory for Covai — news, events, and business listings.">
<meta name="keywords" content="Coimbatore, Covai, MyCovai, directory, schools, banks, hospitals, RS Puram, Gandhipuram, Peelamedu, Saravanampatti, Tamil Nadu">
<meta name="author" content="Krishnan">

<meta property="og:type" content="article" />
<meta name="robots" content="index, follow">
<meta property="og:title" content="Coimbatore Directory — Schools, Businesses, News, Events | MyCovai" />
<meta property="og:description" content="Your local directory for Coimbatore. Find schools, hospitals, banks, restaurants, IT companies and more. News, events, and community updates." />
<meta property="og:image" content="https://mycovai.in/My-OMR-Logo.jpg" />
<meta property="og:url" content="https://mycovai.in/covai-directory-list.php" />
<meta property="og:site_name" content="MyCovai - Coimbatore Directory" />
<meta property="og:locale" content="en_US" />
<meta property="og:locale:alternate" content="ta_IN" />

<meta name="twitter:title" content="Coimbatore Directory — Schools, Businesses, News | MyCovai">
<meta name="twitter:description" content="Find schools, hospitals, banks, restaurants and more in Coimbatore. Your local directory for Covai.">
<meta name="twitter:image" content="https://mycovai.in/My-OMR-Logo.jpg">
<meta name="twitter:site" content="@MyomrNews">
<meta name="twitter:creator" content="@MyomrNews">
<link rel="stylesheet" href="/assets/css/footer.css">
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
<style>
.fakeimg { height: 200px; background: #aaa; }
.jumbotron { background-color:#CCFF33; font-family: 'Libre Baskerville', serif; }
.button { background-color: #D62828; border: none; color: #EAE287; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; }
.button1 { background-color: #F77F00; color: #EAE287; }
.button1 a { color: #EAE287; }
.button2 { background-color: #008CBA; }
.button3 { background-color: #f44336; }
.button4 { background-color: #e7e7e7; color: black; }
.button5 { background-color: #555555; }
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&display=swap" rel="stylesheet">
<style>
h2{ font-family: 'Playfair Display', serif; color: #4c516D; }
</style>

<style>
.float{ position:fixed; width:60px; height:60px; bottom:40px; right:40px; background-color:#25d366; color:#FFF; border-radius:50px; text-align:center; font-size:30px; box-shadow: 2px 2px 3px #999; z-index:100; }
.my-float{ margin-top:16px; }
</style>
</head>
<body>
    <?php include __DIR__ . '/../components/main-nav.php'; ?>
    <a href="https://wa.me/919445088028" class="float" target="_blank" rel="noopener"><i class="fa fa-whatsapp my-float"></i></a>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v14.0" nonce="brAi0ji4"></script>

    <a href="/admin/commonlogin.php">Login to your Admin panel</a>

<div class="container">
<div class="row">
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/markets/" rel="noopener" target="_blank"><span class="blue-text">Markets</span></a> by TradingView</div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
  {"symbols":[{"proName":"FOREXCOM:SPXUSD","title":"S&P 500"},{"proName":"FOREXCOM:NSXUSD","title":"US 100"},{"proName":"FX_IDC:EURUSD","title":"EUR/USD"},{"proName":"BITSTAMP:BTCUSD","title":"Bitcoin"},{"proName":"BITSTAMP:ETHUSD","title":"Ethereum"}],"showSymbolLogo":true,"colorTheme":"light","isTransparent":false,"displayMode":"adaptive","locale":"in"}
  </script>
</div>
<!-- TradingView Widget END -->
</div>
</div>

<div class="container">
    <div class="row">
<ul>
  <li><a class="active" href="/">Home</a></li>
  <li><a href="/directory/schools.php">Schools</a></li>
  <li><a href="/directory/hospitals.php">Hospitals</a></li>
  <li><a href="/directory/banks.php">Banks</a></li>
  <li><a href="/directory/parks.php">Parks</a></li>
  <li><a href="/directory/atms.php">ATMs</a></li>
  <li><a href="/directory/government-offices.php">Government Offices</a></li>
  <li><a href="/directory/restaurants.php">Restaurants</a></li>
  <li><a href="/directory/industries.php">Industries</a></li>
  <li><a href="/directory/it-companies.php">IT Companies</a></li>
  <li><a href="/directory/best-schools.php">Best Schools</a></li>
</ul>

</div></div>
<div class="container">
  <h1 style="text-align:center; color:#0583D2;">Schools in Coimbatore</h1>

<?php

if ($result->num_rows > 0) {
  echo "";
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
} else {
  echo "0 results";
}
$conn->close();
?>

</div>

<?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
