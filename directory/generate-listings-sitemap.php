<?php
require_once __DIR__ . '/../core/omr-connect.php';
header('Content-Type: application/xml; charset=utf-8');

$base_url = 'https://mycovai.in';

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
// Include IT parks data for detail URLs
@include_once __DIR__ . '/data/it-parks-data.php';


// Static listing roots (pretty URLs where available)
$static = [
  '/it-companies',
  '/hospitals',
  '/banks',
  '/schools',
  '/restaurants',
  '/it-parks',
  '/directory/parks.php',
  '/industries',
  '/parks',
  '/government-offices',
  '/atms',
];
foreach ($static as $u) {
  echo "\n  <url>\n";
  echo "    <loc>" . htmlspecialchars($base_url . $u, ENT_XML1) . "</loc>\n";
  echo "    <changefreq>weekly</changefreq>\n";
  echo "    <priority>0.6</priority>\n";
  echo "  </url>";
}

// IT company detail pages
$tItCo = covai_table('it-companies');
$itSql = "SELECT slno, company_name FROM `$tItCo` ORDER BY slno DESC";
if ($itRes = $conn->query($itSql)) {
  while ($it = $itRes->fetch_assoc()) {
    $name = $it['company_name'];
    $id = (int)$it['slno'];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    $slugBase = trim($slugBase, '-');
    $url = $base_url . '/it-companies/' . $slugBase . '-' . $id;
    echo "\n  <url>\n";
    echo "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.7</priority>\n";
    echo "  </url>";
  }
}

// Hospital detail pages
$tHosp = covai_table('hospitals');
$hSql = "SELECT slno, hospitalname FROM `$tHosp` ORDER BY slno DESC";
if ($hRes = $conn->query($hSql)) {
  while ($h = $hRes->fetch_assoc()) {
    $name = $h['hospitalname'];
    $id = (int)$h['slno'];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    $slugBase = trim($slugBase, '-');
    $url = $base_url . '/hospitals/' . $slugBase . '-' . $id;
    echo "\n  <url>\n";
    echo "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.7</priority>\n";
    echo "  </url>";
  }
}

// Bank detail pages
$tBank = covai_table('banks');
$bSql = "SELECT slno, bankname FROM `$tBank` ORDER BY slno DESC";
if ($bRes = $conn->query($bSql)) {
  while ($b = $bRes->fetch_assoc()) {
    $name = $b['bankname'];
    $id = (int)$b['slno'];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    $slugBase = trim($slugBase, '-');
    $url = $base_url . '/banks/' . $slugBase . '-' . $id;
    echo "\n  <url>\n";
    echo "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.7</priority>\n";
    echo "  </url>";
  }
}

// School detail pages
$tSchool = covai_table('schools');
$sSql = "SELECT slno, schoolname FROM `$tSchool` ORDER BY slno DESC";
if ($sRes = $conn->query($sSql)) {
  while ($s = $sRes->fetch_assoc()) {
    $name = $s['schoolname'];
    $id = (int)$s['slno'];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    $slugBase = trim($slugBase, '-');
    $url = $base_url . '/schools/' . $slugBase . '-' . $id;
    echo "\n  <url>\n";
    echo "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.7</priority>\n";
    echo "  </url>";
  }
}

// Restaurant detail pages
$tRest = covai_table('restaurants');
$rSql = "SELECT id, name FROM `$tRest` ORDER BY id DESC";
if ($rRes = $conn->query($rSql)) {
  while ($r = $rRes->fetch_assoc()) {
    $name = $r['name'];
    $id = (int)$r['id'];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    $slugBase = trim($slugBase, '-');
    $url = $base_url . '/restaurants/' . $slugBase . '-' . $id;
    echo "\n  <url>\n";
    echo "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.6</priority>\n";
    echo "  </url>";
  }
}

// Industry detail pages
$tInd = covai_table('industries');
$iSql = "SELECT slno, industry_name FROM `$tInd` ORDER BY slno DESC";
if ($iRes = $conn->query($iSql)) {
  while ($i = $iRes->fetch_assoc()) {
    $name = $i['industry_name'];
    $id = (int)$i['slno'];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    $slugBase = trim($slugBase, '-');
    $url = $base_url . '/industries/' . $slugBase . '-' . $id;
    echo "\n  <url>\n";
    echo "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.6</priority>\n";
    echo "  </url>";
  }
}

// Park detail pages
$tPark = covai_table('parks');
$pSql = "SELECT slno, parkname FROM `$tPark` ORDER BY slno DESC";
if ($pRes = $conn->query($pSql)) {
  while ($p = $pRes->fetch_assoc()) {
    $name = $p['parkname'];
    $id = (int)$p['slno'];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    $slugBase = trim($slugBase, '-');
    $url = $base_url . '/parks/' . $slugBase . '-' . $id;
    echo "\n  <url>\n";
    echo "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.5</priority>\n";
    echo "  </url>";
  }
}

// Government office detail pages
$tGov = covai_table('government-offices');
$gSql = "SELECT slno, office_name FROM `$tGov` ORDER BY slno DESC";
if ($gRes = $conn->query($gSql)) {
  while ($g = $gRes->fetch_assoc()) {
    $name = $g['office_name'];
    $id = (int)$g['slno'];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    $slugBase = trim($slugBase, '-');
    $url = $base_url . '/government-offices/' . $slugBase . '-' . $id;
    echo "\n  <url>\n";
    echo "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.6</priority>\n";
    echo "  </url>";
  }
}

// ATM detail pages
$tAtm = covai_table('atms');
$aSql = "SELECT slno, bankname FROM `$tAtm` ORDER BY slno DESC";
if ($aRes = $conn->query($aSql)) {
  while ($a = $aRes->fetch_assoc()) {
    $name = $a['bankname'];
    $id = (int)$a['slno'];
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    $slugBase = trim($slugBase, '-');
    $url = $base_url . '/atms/' . $slugBase . '-' . $id;
    echo "\n  <url>\n";
    echo "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.5</priority>\n";
    echo "  </url>";
  }
}

// IT Park detail pages (from static dataset)
if (isset($omr_it_parks_all) && is_array($omr_it_parks_all)) {
  foreach ($omr_it_parks_all as $p) {
    $name = (string)($p['name'] ?? '');
    $id = (int)($p['id'] ?? 0);
    if ($id <= 0 || $name === '') { continue; }
    $slugBase = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    $slugBase = trim($slugBase, '-');
    $url = $base_url . '/it-parks/' . $slugBase . '-' . $id;
    echo "\n  <url>\n";
    echo "    <loc>" . htmlspecialchars($url, ENT_XML1) . "</loc>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.6</priority>\n";
    echo "  </url>";
  }
}

echo "\n</urlset>\n";

?>


