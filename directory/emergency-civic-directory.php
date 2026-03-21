<?php
/**
 * Emergency & Civic Directory — Coimbatore
 * Police stations, fire & rescue, civic offices, emergency helplines.
 */
require_once __DIR__ . '/../core/omr-connect.php';
require_once __DIR__ . '/../core/url-helpers.php';

$base = get_canonical_base();
$canonical_url = $base . '/directory/emergency-civic-directory.php';
$page_title = 'Emergency & Civic Directory — Coimbatore | ' . (defined('SITE_NAME') ? SITE_NAME : 'MyCovai');
$page_description = 'Official police stations across all four city zones, fire & rescue stations, civic offices, and emergency helplines for Coimbatore (CCMC limits and district).';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($page_title); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>" />
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>" />
  <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>" />
  <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>" />
  <meta property="og:site_name" content="<?php echo defined('SITE_OG_SITE_NAME') ? htmlspecialchars(SITE_OG_SITE_NAME) : 'MyCovai'; ?>" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>" />
  <meta name="twitter:description" content="<?php echo htmlspecialchars($page_description); ?>" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="/assets/css/homepage-directone.css" />
  <link rel="stylesheet" href="/assets/css/emergency-civic-directory.css" />
  <?php include __DIR__ . '/../components/analytics.php'; ?>
</head>
<body>

<?php include __DIR__ . '/../components/skip-link.php'; ?>
<?php include __DIR__ . '/../components/directory-header.php'; ?>

<div class="emergency-directory-wrap">

<!-- ── HERO ─────────────────────────────────────────────── -->
<header class="ec-hero">
  <div class="ec-hero-inner">
    <p class="ec-hero-eyebrow">Coimbatore — Tamil Nadu</p>
    <h1>Emergency &amp; Civic<br /><em>Government Directory</em></h1>
    <p class="ec-hero-desc">
      Official police stations across all four city zones, fire &amp; rescue
      stations, civic offices, and emergency helplines — covering the entire
      Coimbatore City Municipal Corporation (CCMC) limits and beyond.
    </p>
    <div class="ec-hero-scope">
      <span class="ec-scope-tag">RS Puram</span>
      <span class="ec-scope-tag">Gandhipuram</span>
      <span class="ec-scope-tag">Ukkadam</span>
      <span class="ec-scope-tag">Saibaba Colony</span>
      <span class="ec-scope-tag">Rathinapuri</span>
      <span class="ec-scope-tag">Ramanathapuram</span>
      <span class="ec-scope-tag">Peelamedu</span>
      <span class="ec-scope-tag">Singanallur</span>
      <span class="ec-scope-tag">Saravanampatti</span>
      <span class="ec-scope-tag">Podanur</span>
      <span class="ec-scope-tag">Kuniyamuthur</span>
      <span class="ec-scope-tag">+ District areas</span>
    </div>
    <div class="ec-hero-stats">
      <div class="ec-hero-stat">
        <div class="ec-hero-stat-num">15+</div>
        <div class="ec-hero-stat-label">City Police Stations</div>
      </div>
      <div class="ec-hero-stat">
        <div class="ec-hero-stat-num">4</div>
        <div class="ec-hero-stat-label">Police Zones</div>
      </div>
      <div class="ec-hero-stat">
        <div class="ec-hero-stat-num">5</div>
        <div class="ec-hero-stat-label">Fire Stations</div>
      </div>
      <div class="ec-hero-stat">
        <div class="ec-hero-stat-num">2</div>
        <div class="ec-hero-stat-label">Police Authorities</div>
      </div>
    </div>
  </div>
</header>

<!-- ── EMERGENCY BANNER ──────────────────────────────────── -->
<div class="ec-em-banner">
  <span class="ec-em-banner-label">Quick Dial</span>
  <div class="ec-em-pills">
    <span class="ec-em-pill"><span class="ec-em-pill-num">112</span> Unified Emergency</span>
    <span class="ec-em-pill"><span class="ec-em-pill-num">100</span> Police</span>
    <span class="ec-em-pill"><span class="ec-em-pill-num">101</span> Fire</span>
    <span class="ec-em-pill"><span class="ec-em-pill-num">108</span> Ambulance</span>
    <span class="ec-em-pill"><span class="ec-em-pill-num">1091</span> Women's Helpline</span>
    <span class="ec-em-pill"><span class="ec-em-pill-num">1930</span> Cyber Crime</span>
  </div>
</div>

<!-- ── JUMP LINKS ────────────────────────────────────────── -->
<nav class="ec-jump-links" aria-label="Jump to section">
  <a href="#police">Police</a>
  <a href="#district">District</a>
  <a href="#fire">Fire</a>
  <a href="#civic">Civic</a>
  <a href="#emergency">Emergency</a>
  <a href="#sources">Sources</a>
</nav>

<!-- ── MAIN ──────────────────────────────────────────────── -->
<main id="main-content" class="ec-main">

  <!-- CITY POLICE — ZONED -->
  <div id="police" class="ec-sec-head">
    <h2>City Police Stations — CCMC Limits</h2>
    <span class="ec-sbadge ec-sb-green">Coimbatore City Police Commissionerate</span>
  </div>

  <div class="ec-notice">
    <strong>Two separate police authorities serve Coimbatore.</strong>
    The <strong>City Police Commissionerate</strong> covers areas within CCMC limits — 15 stations across 4 zones (West / Central / South / East). Areas outside CCMC — including Periyanaickenpalayam, Thudiyalur, Sulur, Pollachi and other peri-urban areas — fall under the <strong>Coimbatore District Police (SP office)</strong>. Use the tabs below to browse by zone.
  </div>

  <!-- Zone filter -->
  <div class="ec-zone-filter-wrap">
    <div class="ec-zone-filter-label">Filter by Zone</div>
    <div class="ec-zone-tabs">
      <button class="ec-zone-tab active" data-zone="all">All zones</button>
      <button class="ec-zone-tab" data-zone="west">West Zone</button>
      <button class="ec-zone-tab" data-zone="central">Central Zone</button>
      <button class="ec-zone-tab" data-zone="south">South Zone</button>
      <button class="ec-zone-tab" data-zone="east">East Zone</button>
    </div>
  </div>

  <!-- ALL zones visible by default; JS hides/shows per zone -->
  <div class="ec-ps-grid" id="ec-ps-grid">

    <!-- ── WEST ZONE ─── -->
    <div class="ec-ps-card" data-zone="west">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">B1</span>
        <span class="ec-ps-zone-label">West Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Town Hall (Big Bazaar Street) Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Big Bazaar Street, Town Hall, Coimbatore – 641001</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222391000">0422-2391000</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Town Hall</span><span class="ec-tag">Big Bazaar</span><span class="ec-tag">Market area</span></div>
    </div>

    <div class="ec-ps-card" data-zone="west">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">B2</span>
        <span class="ec-ps-zone-label">West Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">R.S. Puram Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">194, Subramaniam Road, R.S. Puram, Coimbatore – 641002</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222350549">0422-2350549</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">RS Puram</span><span class="ec-tag">Race Course Road area</span></div>
    </div>

    <div class="ec-ps-card" data-zone="west">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">B3</span>
        <span class="ec-ps-zone-label">West Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Variety Hall Road Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">64, Variety Hall Road, Town Hall, Coimbatore – 641001</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222397121">0422-2397121</a> · <a href="tel:04222307821">2307821</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Variety Hall</span><span class="ec-tag">West Coimbatore</span></div>
    </div>

    <div class="ec-ps-card" data-zone="west">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">B4</span>
        <span class="ec-ps-zone-label">West Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Ukkadam Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Palakkad–Coimbatore Road, Fort, Town Hall, Coimbatore – 641001</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222392838">0422-2392838</a> · <a href="tel:04222307838">2307838</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Ukkadam</span><span class="ec-tag">Vellalore (part)</span><span class="ec-tag">Fort area</span></div>
    </div>

    <!-- ── CENTRAL ZONE ─── -->
    <div class="ec-ps-card" data-zone="central">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">C1</span>
        <span class="ec-ps-zone-label">Central Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Katoor Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Sathy Road, ATT Colony, Gopalapuram, Gandhipuram, Coimbatore – 641044</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222302005">0422-2302005</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Gandhipuram</span><span class="ec-tag">Kattoor</span><span class="ec-tag">Sathy Road area</span></div>
    </div>

    <div class="ec-ps-card" data-zone="central">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">C2</span>
        <span class="ec-ps-zone-label">Central Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Race Course Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Government Arts College Road, Gopalapuram, Coimbatore – 641018</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222309600">0422-2309600</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Race Course</span><span class="ec-tag">Gopalapuram</span><span class="ec-tag">Collector Office area</span></div>
    </div>

    <div class="ec-ps-card" data-zone="central">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">C3</span>
        <span class="ec-ps-zone-label">Central Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Saibaba Colony Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Mettupalayam Road, Saibaba Koil, Coimbatore – 641043</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222437100">0422-2437100</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Saibaba Colony</span><span class="ec-tag">Mettupalayam Road</span></div>
    </div>

    <div class="ec-ps-card" data-zone="central">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">C4</span>
        <span class="ec-ps-zone-label">Central Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Rathinapuri Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Rathinapuri, Coimbatore – 641027</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222300600">0422-2300600</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Rathinapuri</span><span class="ec-tag">Tatabad area</span></div>
    </div>

    <!-- ── SOUTH ZONE ─── -->
    <div class="ec-ps-card" data-zone="south">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">D1</span>
        <span class="ec-ps-zone-label">South Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Ramanathapuram Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">245, Puliakulam Road, Ramasamy Nagar, Puliakulam, Coimbatore – 641045</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222318195">0422-2318195</a> · <a href="tel:04222300600">2300600</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Ramanathapuram</span><span class="ec-tag">Puliakulam</span></div>
    </div>

    <div class="ec-ps-card" data-zone="south">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">D2</span>
        <span class="ec-ps-zone-label">South Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Selvapuram Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Selvapuram, Coimbatore – 641026</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222342477">0422-2342477</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Selvapuram</span><span class="ec-tag">South Coimbatore</span></div>
    </div>

    <div class="ec-ps-card" data-zone="south">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">D3</span>
        <span class="ec-ps-zone-label">South Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Podanur Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Podanur, Coimbatore – 641023</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222410550">0422-2410550</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Podanur</span><span class="ec-tag">Chettipalayam Road</span></div>
    </div>

    <div class="ec-ps-card" data-zone="south">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">D4</span>
        <span class="ec-ps-zone-label">South Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Kuniyamuthur Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Kuniyamuthur, Coimbatore – 641008</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v">0422-2300600 (verify)</span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Kuniyamuthur</span><span class="ec-tag">South-west fringe</span></div>
    </div>

    <!-- ── EAST ZONE ─── -->
    <div class="ec-ps-card" data-zone="east">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">E1</span>
        <span class="ec-ps-zone-label">East Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Singanallur Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Agraharam, Singanallur, Coimbatore – 641005</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222573254">0422-2573254</a> · <a href="tel:04222580354">2580354</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Singanallur</span><span class="ec-tag">Avinashi Road (east)</span></div>
    </div>

    <div class="ec-ps-card" data-zone="east">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">E2</span>
        <span class="ec-ps-zone-label">East Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Peelamedu Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Peelamedu, Coimbatore – 641004</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222571804">0422-2571804</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Peelamedu</span><span class="ec-tag">Airport area</span><span class="ec-tag">KMCH belt</span></div>
    </div>

    <div class="ec-ps-card" data-zone="east">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code">E3</span>
        <span class="ec-ps-zone-label">East Zone<br/>City Police</span>
      </div>
      <div class="ec-ps-name">Saravanampatti Police Station</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">Saravanampatti–Kalapatti Road, Thiruvannamail Nagar, Saravanampatti, Coimbatore – 641035</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v"><a href="tel:04222666445">0422-2666445</a></span>
      </div>
      <div class="ec-ps-tags"><span class="ec-tag">Saravanampatti</span><span class="ec-tag">Kalapatti</span><span class="ec-tag">IT Corridor east</span></div>
    </div>

  </div><!-- /ec-ps-grid -->

  <!-- ALL-WOMEN POLICE STATIONS -->
  <div class="ec-sec-head" style="margin-top:2rem;">
    <h2>All-Women Police Stations</h2>
    <span class="ec-sbadge ec-sb-purple">City Police — 3 stations</span>
  </div>
  <div class="ec-ps-grid">
    <div class="ec-ps-card">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code" style="background:#5B3A8A;color:#fff;">AW-W</span>
        <span class="ec-ps-zone-label">West Zone</span>
      </div>
      <div class="ec-ps-name">All-Women PS — West (RS Puram)</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Address</span><span class="ec-ps-v">R.S. Puram, Coimbatore – 641002</span>
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v">0422-2300600 (verify at SP office)</span>
      </div>
    </div>
    <div class="ec-ps-card">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code" style="background:#5B3A8A;color:#fff;">AW-C</span>
        <span class="ec-ps-zone-label">Central Zone</span>
      </div>
      <div class="ec-ps-name">All-Women PS — Central</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v">1091 (Women's Helpline) · verify at commissionerate</span>
      </div>
    </div>
    <div class="ec-ps-card">
      <div class="ec-ps-card-top">
        <span class="ec-ps-code" style="background:#5B3A8A;color:#fff;">AW-E</span>
        <span class="ec-ps-zone-label">East Zone</span>
      </div>
      <div class="ec-ps-name">All-Women PS — East</div>
      <div class="ec-ps-info">
        <span class="ec-ps-k">Phone</span><span class="ec-ps-v">1091 (Women's Helpline) · verify at commissionerate</span>
      </div>
    </div>
  </div>

  <!-- DISTRICT POLICE -->
  <div id="district" class="ec-sec-head" style="margin-top:2rem;">
    <h2>District Police — Beyond CCMC Limits</h2>
    <span class="ec-sbadge ec-sb-gold">SP Coimbatore (Rural)</span>
  </div>

  <div class="ec-notice">
    <strong>Areas outside CCMC boundaries</strong> — including Periyanaickenpalayam, Thudiyalur, Sulur, Singanallur (rural fringe), Annur, Mettupalayam, Pollachi, Valparai, and Tiruppur — are policed by the <strong>Coimbatore District Police (Superintendent of Police)</strong> office. Dial 100 or check <a href="https://coimbatore.nic.in/public-utility-category/police-station/" target="_blank" rel="noopener">coimbatore.nic.in</a> for current direct station numbers.
  </div>

  <div class="ec-civic-grid">
    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-gold">🏛</div>
      <div class="ec-civic-name">SP Office — Coimbatore (Rural)</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Address</span><span class="ec-ci-v">State Bank Road, Gopalapuram, Coimbatore – 641018</span>
        <span class="ec-ci-k">Phone</span><span class="ec-ci-v"><a href="tel:04222300600">0422-2300600</a></span>
        <span class="ec-ci-k">Covers</span><span class="ec-ci-v">Periyanaickenpalayam, Thudiyalur, Sulur, Annur, Mettupalayam, Pollachi, Valparai and all areas outside CCMC</span>
      </div>
    </div>
    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-gold">🚔</div>
      <div class="ec-civic-name">Chettipalayam Police Station</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Address</span><span class="ec-ci-v">Podanur Main Road, opp. SBI, Chettipalayam – 641201</span>
        <span class="ec-ci-k">Phone</span><span class="ec-ci-v"><a href="tel:04222655228">0422-2655228</a></span>
        <span class="ec-ci-k">Covers</span><span class="ec-ci-v">Chettipalayam, parts of Podanur Rural</span>
      </div>
    </div>
    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-gold">🚔</div>
      <div class="ec-civic-name">Alandurai Police Station</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Phone</span><span class="ec-ci-v"><a href="tel:04222651231">0422-2651231</a></span>
        <span class="ec-ci-k">Covers</span><span class="ec-ci-v">Alandurai, Vellalore (rural), western fringe</span>
      </div>
    </div>
  </div>

  <!-- CITY POLICE HEADQUARTERS -->
  <div class="ec-sec-head" style="margin-top:2rem;">
    <h2>Police Headquarters &amp; Commissioner</h2>
    <span class="ec-sbadge ec-sb-navy">City Commissionerate</span>
  </div>
  <div class="ec-civic-grid">
    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-navy">🏛</div>
      <div class="ec-civic-name">Coimbatore City Police Commissioner's Office</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Address</span><span class="ec-ci-v">62, Old Post Office Road, Near Railway Station, opp. Collector Office, Gopalapuram, Coimbatore – 641018</span>
        <span class="ec-ci-k">Phone</span><span class="ec-ci-v"><a href="tel:04222300600">0422-2300600</a></span>
        <span class="ec-ci-k">Website</span><span class="ec-ci-v"><a href="https://eservices.tnpolice.gov.in" target="_blank" rel="noopener">eservices.tnpolice.gov.in</a></span>
        <span class="ec-ci-k">Jurisdiction</span><span class="ec-ci-v">All CCMC limits — 15 city police stations + 3 All-Women PS + traffic + crime branch</span>
      </div>
    </div>
    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-navy">🚦</div>
      <div class="ec-civic-name">Coimbatore City Traffic Police</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Control Room</span><span class="ec-ci-v"><a href="tel:04222505370">0422-2505370</a></span>
        <span class="ec-ci-k">Report</span><span class="ec-ci-v">Dial <a href="tel:103"><strong>103</strong></a> for traffic violations / accidents</span>
        <span class="ec-ci-k">Note</span><span class="ec-ci-v">GPRS-enabled enforcement; covers all major junctions in CCMC</span>
      </div>
    </div>
    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-purple">💻</div>
      <div class="ec-civic-name">Cyber Crime Cell — Coimbatore</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Phone</span><span class="ec-ci-v"><a href="tel:04222300970">0422-2300970</a></span>
        <span class="ec-ci-k">National</span><span class="ec-ci-v"><a href="tel:1930"><strong>1930</strong></a></span>
        <span class="ec-ci-k">Online</span><span class="ec-ci-v"><a href="https://cybercrime.gov.in" target="_blank" rel="noopener">cybercrime.gov.in</a></span>
        <span class="ec-ci-k">Note</span><span class="ec-ci-v">Functional since March 2010 under City Police</span>
      </div>
    </div>
  </div>

  <!-- FIRE STATIONS -->
  <div id="fire" class="ec-sec-head">
    <h2>Fire &amp; Rescue Stations</h2>
    <span class="ec-sbadge ec-sb-red">TN Fire &amp; Rescue Services — Western Region</span>
  </div>

  <div class="ec-fire-grid">
    <div class="ec-fire-card">
      <div class="ec-fire-name">Coimbatore Main (Central)</div>
      <div class="ec-fire-addr">Coimbatore Central, Coimbatore – 641018</div>
      <div class="ec-fire-phone"><a href="tel:04222300101">0422-2300101</a></div>
    </div>
    <div class="ec-fire-card">
      <div class="ec-fire-name">Ganapathy Fire Station</div>
      <div class="ec-fire-addr">Ganapathi, Coimbatore – 641006</div>
      <div class="ec-fire-phone"><a href="tel:04222511001">0422-2511001</a></div>
    </div>
    <div class="ec-fire-card">
      <div class="ec-fire-name">Kavundampalayam Fire Station</div>
      <div class="ec-fire-addr">Koundampalayam, Coimbatore – 641030</div>
      <div class="ec-fire-phone"><a href="tel:04222450101">0422-2450101</a></div>
    </div>
    <div class="ec-fire-card">
      <div class="ec-fire-name">Peelamedu Fire Station</div>
      <div class="ec-fire-addr">No. 2, Anna Nagar, Peelamedu, Coimbatore – 641004</div>
      <div class="ec-fire-phone"><a href="tel:04222595101">0422-2595101</a></div>
    </div>
    <div class="ec-fire-card">
      <div class="ec-fire-name">Mettupalayam Fire Station</div>
      <div class="ec-fire-addr">Mettupalayam, Coimbatore – 641301</div>
      <div class="ec-fire-phone"><a href="tel:0422222299">0422-222299</a></div>
    </div>
  </div>
  <p style="font-size:12px; color:#96948C; margin-top: 10px;">
    Fire Officer (District): 0422-2301218 &nbsp;·&nbsp; All fire emergencies: <strong>101</strong> or <strong>112</strong> &nbsp;·&nbsp; Western Region HQ: <a href="https://www.tnfrs.tn.gov.in" target="_blank" rel="noopener">tnfrs.tn.gov.in</a>
  </p>

  <!-- CIVIC OFFICES -->
  <div id="civic" class="ec-sec-head">
    <h2>Civic &amp; Government Offices</h2>
    <span class="ec-sbadge ec-sb-green">CCMC, Revenue &amp; State Govt</span>
  </div>

  <div class="ec-civic-grid">

    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-green">🏛</div>
      <div class="ec-civic-name">Coimbatore City Municipal Corporation (CCMC)</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Address</span><span class="ec-ci-v">Corporation of Coimbatore, Coimbatore – 641001</span>
        <span class="ec-ci-k">Phone</span><span class="ec-ci-v"><a href="tel:04222390261">0422-2390261</a> · Fax: 2390167</span>
        <span class="ec-ci-k">Helpline</span><span class="ec-ci-v"><a href="tel:1913">1913</a> (civic complaints)</span>
        <span class="ec-ci-k">Website</span><span class="ec-ci-v"><a href="https://ccmc.gov.in" target="_blank" rel="noopener">ccmc.gov.in</a></span>
        <span class="ec-ci-k">Zones</span><span class="ec-ci-v">North, South, East, West, Central — 100 wards</span>
      </div>
    </div>

    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-gold">📋</div>
      <div class="ec-civic-name">Coimbatore District Collector Office</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Address</span><span class="ec-ci-v">Collectorate, Race Course Road, Coimbatore – 641018</span>
        <span class="ec-ci-k">Phone</span><span class="ec-ci-v"><a href="tel:04222300205">0422-2300205</a></span>
        <span class="ec-ci-k">Website</span><span class="ec-ci-v"><a href="https://coimbatore.nic.in" target="_blank" rel="noopener">coimbatore.nic.in</a></span>
        <span class="ec-ci-k">Services</span><span class="ec-ci-v">Revenue, disaster mgmt, district administration</span>
      </div>
    </div>

    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-gold">📄</div>
      <div class="ec-civic-name">Coimbatore Taluk Office</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Address</span><span class="ec-ci-v">Collectorate Complex, Coimbatore – 641018</span>
        <span class="ec-ci-k">Hours</span><span class="ec-ci-v">Mon–Fri, 10 am – 5:45 pm</span>
        <span class="ec-ci-k">Services</span><span class="ec-ci-v">Caste / income / nativity certs, patta, encumbrance</span>
        <span class="ec-ci-k">Online</span><span class="ec-ci-v"><a href="https://tndistricts.tn.gov.in" target="_blank" rel="noopener">tndistricts.tn.gov.in</a></span>
      </div>
    </div>

    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-purple">🚌</div>
      <div class="ec-civic-name">TNSTC — Coimbatore Division</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Address</span><span class="ec-ci-v">Gandhipuram Central Bus Stand, Coimbatore – 641012</span>
        <span class="ec-ci-k">Phone</span><span class="ec-ci-v"><a href="tel:04222300021">0422-2300021</a></span>
        <span class="ec-ci-k">Note</span><span class="ec-ci-v">Gandhipuram & Ukkadam are the two main city bus terminals</span>
      </div>
    </div>

    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-navy">⚡</div>
      <div class="ec-civic-name">TANGEDCO — Coimbatore</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Helpline</span><span class="ec-ci-v"><a href="tel:1912">1912</a> (power failure / complaints)</span>
        <span class="ec-ci-k">Phone</span><span class="ec-ci-v"><a href="tel:04222222299">0422-2222299</a></span>
        <span class="ec-ci-k">Website</span><span class="ec-ci-v"><a href="https://www.tangedco.gov.in" target="_blank" rel="noopener">tangedco.gov.in</a></span>
      </div>
    </div>

    <div class="ec-civic-card">
      <div class="ec-civic-ico ec-ico-green">🏥</div>
      <div class="ec-civic-name">Coimbatore Medical College Hospital (CMCH)</div>
      <div class="ec-civic-info">
        <span class="ec-ci-k">Address</span><span class="ec-ci-v">Avinashi Road, Coimbatore – 641014</span>
        <span class="ec-ci-k">Phone</span><span class="ec-ci-v"><a href="tel:04222301393">0422-2301393</a></span>
        <span class="ec-ci-k">Type</span><span class="ec-ci-v">Govt. tertiary referral hospital — 24×7 casualty</span>
      </div>
    </div>

  </div>

  <!-- EMERGENCY NUMBERS -->
  <div id="emergency" class="ec-sec-head">
    <h2>Emergency &amp; Helpline Numbers</h2>
    <span class="ec-sbadge ec-sb-red">Tamil Nadu — All Districts</span>
  </div>

  <div class="ec-em-grid">
    <div class="ec-em-card">
      <div class="ec-em-num">100</div>
      <div><div class="ec-em-label">Police Emergency</div><div class="ec-em-note">All of Tamil Nadu</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">112</div>
      <div><div class="ec-em-label">Unified Emergency (ERSS)</div><div class="ec-em-note">Police · Fire · Ambulance</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">101</div>
      <div><div class="ec-em-label">Fire &amp; Rescue</div><div class="ec-em-note">TN Fire Services</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">108</div>
      <div><div class="ec-em-label">Ambulance (Free)</div><div class="ec-em-note">GVK EMRI — 24×7</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">1091</div>
      <div><div class="ec-em-label">Women's Helpline</div><div class="ec-em-note">Police — women in distress</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">1098</div>
      <div><div class="ec-em-label">Child Helpline</div><div class="ec-em-note">Childline India — 24×7</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">1930</div>
      <div><div class="ec-em-label">Cyber Crime</div><div class="ec-em-note">National helpline</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">103</div>
      <div><div class="ec-em-label">Traffic Control Room</div><div class="ec-em-note">Violations / accidents</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">1913</div>
      <div><div class="ec-em-label">CCMC Civic Complaint</div><div class="ec-em-note">Coimbatore Corporation</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">1912</div>
      <div><div class="ec-em-label">Electricity (TANGEDCO)</div><div class="ec-em-note">Power failure / faults</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">104</div>
      <div><div class="ec-em-label">Medical Helpline</div><div class="ec-em-note">TN Health Department</div></div>
    </div>
    <div class="ec-em-card">
      <div class="ec-em-num">1093</div>
      <div><div class="ec-em-label">Coastal Security</div><div class="ec-em-note">TN coastal helpline</div></div>
    </div>
  </div>

  <!-- SOURCES -->
  <div id="sources" class="ec-sec-head">
    <h2>Official Sources &amp; Verification</h2>
    <span class="ec-sbadge ec-sb-navy">Always cross-check</span>
  </div>

  <ul class="ec-sources">
    <li>Coimbatore City Police — <a href="https://eservices.tnpolice.gov.in" target="_blank" rel="noopener">eservices.tnpolice.gov.in</a> (TN Police citizen portal / CCTNS)</li>
    <li>Coimbatore District Administration — <a href="https://coimbatore.nic.in/public-utility-category/police-station/" target="_blank" rel="noopener">coimbatore.nic.in → Police Stations</a></li>
    <li>CCMC (Corporation) — <a href="https://ccmc.gov.in" target="_blank" rel="noopener">ccmc.gov.in</a></li>
    <li>TN Fire &amp; Rescue Services (Western Region) — <a href="https://www.tnfrs.tn.gov.in/about-us/station-list/western-region/" target="_blank" rel="noopener">tnfrs.tn.gov.in → Station List → Western Region</a></li>
    <li>Tamil Nadu Government contact directory — <a href="https://www.tn.gov.in" target="_blank" rel="noopener">tn.gov.in</a></li>
    <li>City Police Commissioner's Office — 62, Old Post Office Road, Gopalapuram, Coimbatore – 641018 · 0422-2300600</li>
    <li>SP Coimbatore (Rural / District) — State Bank Road, Gopalapuram, Coimbatore – 641018 · 0422-2300600</li>
    <li>MyCovai government offices listing — <a href="/directory/government-offices.php">Government Offices in Coimbatore</a></li>
  </ul>

</main>

</div><!-- /.emergency-directory-wrap -->

<?php include __DIR__ . '/../components/footer.php'; ?>

<!-- ── ZONE FILTER JS ────────────────────────────────────── -->
<script>
(function() {
  var tabs   = document.querySelectorAll('.ec-zone-tab');
  var cards  = document.querySelectorAll('#ec-ps-grid .ec-ps-card');

  tabs.forEach(function(btn) {
    btn.addEventListener('click', function() {
      var zone = btn.dataset.zone;

      tabs.forEach(function(t) { t.classList.remove('active'); });
      btn.classList.add('active');

      cards.forEach(function(card) {
        if (zone === 'all' || card.dataset.zone === zone) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
})();
</script>

</body>
</html>
