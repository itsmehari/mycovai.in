<?php
/**
 * Run MyCovai directory seeds (50+ rows per covai_* table).
 * Usage: DB_HOST=mycovai.in php database/seeds/run_covai_seeds.php
 * Run from repo root. Confirm live before running.
 */
$baseDir = dirname(__DIR__, 2);
chdir($baseDir);

require $baseDir . '/core/mycovai-config.php';
require $baseDir . '/core/omr-connect.php';

if (!isset($conn) || $conn->connect_error) {
    fwrite(STDERR, "DB connection failed: " . ($conn->connect_error ?? 'unknown') . "\n");
    exit(1);
}
$conn->set_charset('utf8mb4');

$db_host = getenv('DB_HOST') ?: (isset($_SERVER['DB_HOST']) ? $_SERVER['DB_HOST'] : 'localhost');
echo "Seeding (DB: $db_host)...\n";
flush();

function slug($s) {
    $s = preg_replace('/[^a-zA-Z0-9\s\-]/', '', $s);
    return strtolower(trim(preg_replace('/[\s\-]+/', '-', $s), '-'));
}

/** @return array<string, true> existing values (slug or name) for skip/update */
function get_existing_keys($conn, $table, $column = 'slug') {
    $col = $conn->real_escape_string($column);
    $t = $conn->real_escape_string($table);
    $r = $conn->query("SELECT `$col` FROM `$t` WHERE `$col` IS NOT NULL AND `$col` != ''");
    if (!$r) return [];
    $out = [];
    while ($row = $r->fetch_array()) $out[$row[0]] = true;
    return $out;
}

$report = [];

// ---------- covai_schools (50 rows) ----------
$schools = [
    ['Peepal Prodigy Senior Secondary School', 'Sugunapuram, RS Puram, Coimbatore', 'RS Puram'],
    ['BVM Global School', 'Trichy Road, Singanallur, Coimbatore', 'Singanallur'],
    ['Navabharath National School', 'Gandhipuram, Coimbatore', 'Gandhipuram'],
    ['Ology Tech School', 'Krishnarayapuram, Peelamedu, Coimbatore', 'Peelamedu'],
    ['Chinmaya International Residential School', 'Coimbatore', 'Coimbatore'],
    ['Amrita Vidyalayam RS Puram', 'RS Puram, Coimbatore', 'RS Puram'],
    ['Samashti International School', 'Coimbatore', 'Coimbatore'],
    ['Velammal Bodhi Campus', 'Coimbatore', 'Coimbatore'],
    ['The Indian Public School', 'Coimbatore', 'Coimbatore'],
    ['Rathinam International Public School', 'Coimbatore', 'Coimbatore'],
    ['Delhi Public School Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['Yuvabharathi Public School', 'Coimbatore', 'Coimbatore'],
    ['The NGP School', 'Coimbatore', 'Coimbatore'],
    ['Suguna PIP School', 'Coimbatore', 'Coimbatore'],
    ['PSG Public School', 'Peelamedu, Coimbatore', 'Peelamedu'],
    ['Air Force School Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['Alchemy Public School', 'Coimbatore', 'Coimbatore'],
    ['VIBGYOR High School Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['SSVM Institutions', 'Coimbatore', 'Coimbatore'],
    ['National Model Senior Secondary School', 'Coimbatore', 'Coimbatore'],
    ['Abacus International Montessori School', 'Coimbatore', 'Coimbatore'],
    ['Adharsh Vidhyalaya Public School', 'Coimbatore', 'Coimbatore'],
    ['Adithya Global School', 'Coimbatore', 'Coimbatore'],
    ['Adithya International School', 'Coimbatore', 'Coimbatore'],
    ['Adwaith Thought Academy', 'Coimbatore', 'Coimbatore'],
    ['Akr Academy School', 'Coimbatore', 'Coimbatore'],
    ['Aksharam International School', 'Coimbatore', 'Coimbatore'],
    ['Akshaya Academy School', 'Coimbatore', 'Coimbatore'],
    ['Sainik School Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['Kendriya Vidyalaya Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['Angappa Educational Trust Senior Secondary School', 'Coimbatore', 'Coimbatore'],
    ['RKV Secondary School', 'Coimbatore', 'Coimbatore'],
    ['KMC Public School', 'Coimbatore', 'Coimbatore'],
    ['National Model Secondary School', 'Coimbatore', 'Coimbatore'],
    ['SSVM World School', 'Coimbatore', 'Coimbatore'],
    ['Stanes Anglo Indian Higher Secondary School', 'Coimbatore', 'Coimbatore'],
    ['National Model Quantum Leap Academy', 'Coimbatore', 'Coimbatore'],
    ['St. Michaels Higher Secondary School', 'Coimbatore', 'Coimbatore'],
    ['T.A. Ramalingam Chettiar Higher Secondary School', 'Coimbatore', 'Coimbatore'],
    ['Sri Krishna International School', 'RS Puram, Coimbatore', 'RS Puram'],
    ['SBOA School Coimbatore', 'Gandhipuram, Coimbatore', 'Gandhipuram'],
    ['Bharathi Vidyalaya Senior Secondary', 'Saibaba Colony, Coimbatore', 'Saibaba Colony'],
    ['G K Shetty Vivekananda Vidyalaya', 'Coimbatore', 'Coimbatore'],
    ['Sree Sarasswathi Vidhyaah Mandheer', 'Coimbatore', 'Coimbatore'],
    ['Vidya Niketan Public School', 'Peelamedu, Coimbatore', 'Peelamedu'],
    ['Saraswathi Vidyalaya', 'Coimbatore', 'Coimbatore'],
    ['Maharishi Vidya Mandir', 'Coimbatore', 'Coimbatore'],
    ['Bharathi Matriculation School', 'Coimbatore', 'Coimbatore'],
    ['Kumaraguru School', 'Coimbatore', 'Coimbatore'],
    ['SVM School Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['Nirmala Matriculation School', 'Coimbatore', 'Coimbatore'],
];
$existing = get_existing_keys($conn, 'covai_schools');
$ins = $conn->prepare("INSERT INTO covai_schools (schoolname, address, locality, slug) VALUES (?, ?, ?, ?)");
$upd = $conn->prepare("UPDATE covai_schools SET schoolname=?, address=?, locality=? WHERE slug=?");
$inserted = $updated = 0;
foreach ($schools as $r) {
    $slug = slug($r[0] . ' ' . $r[2]);
    if (isset($existing[$slug])) {
        $upd->bind_param('ssss', $r[0], $r[1], $r[2], $slug);
        $upd->execute();
        $updated++;
    } else {
        $ins->bind_param('ssss', $r[0], $r[1], $r[2], $slug);
        $ins->execute();
        $inserted++;
    }
}
$ins->close(); $upd->close();
$report['covai_schools'] = ['inserted' => $inserted, 'updated' => $updated];
echo "  covai_schools: +$inserted inserted, $updated updated\n"; flush();

// ---------- covai_banks (50 rows) ----------
$banks = [
    ['State Bank of India Zonal Office', 'Coimbatore Zonal Office, Coimbatore 641018'],
    ['State Bank of India Main Branch', 'State Bank Road, Coimbatore 641018'],
    ['State Bank of India Ramakrishna Vidyalaya', 'Ramakrishna Vidyalaya, Coimbatore'],
    ['State Bank of India Singanallur', 'Singanallur, Coimbatore'],
    ['State Bank of India Ganapathy', 'Ganapathy, Coimbatore'],
    ['State Bank of India Saibaba Colony', 'Saibaba Colony, Coimbatore'],
    ['State Bank of India Vadavalli', 'Vadavalli, Coimbatore'],
    ['State Bank of India Peelamedu', 'Peelamedu, Coimbatore'],
    ['State Bank of India Race Course Road', 'Race Course Road, Coimbatore'],
    ['State Bank of India Coimbatore Nagar', 'Coimbatore Nagar, Coimbatore'],
    ['HDFC Bank Gandhipuram', '307 Sree Gokulam Towers, 100 Feet Road, Gandhipuram, Coimbatore 641012'],
    ['HDFC Bank RS Puram', '590 Sri Sai Towers, DB Road, RS Puram, Coimbatore 641002'],
    ['HDFC Bank Trichy Road', '1635 Classic Towers, Trichy Road, Coimbatore'],
    ['ICICI Bank Ram Nagar', '16 Near Ramar Koil, Shastri Road, Ram Nagar, Coimbatore 641009'],
    ['ICICI Bank Ganapathy', 'Ambal Nagar, Sathy Main Road, Ganapathy, Coimbatore'],
    ['Axis Bank Avinashi Road', '1095 Vigneshwar Cresta, Papanaickenpalayam, Avinashi Road, Coimbatore'],
    ['Axis Bank State Bank Road', '18 & 19 State Bank Road, Coimbatore 641018'],
    ['Axis Bank Peelamedu', '160B1 Avarampalayam Road, Peelamedu, Coimbatore 641004'],
    ['Kotak Mahindra Bank RS Puram', 'DB Road, RS Puram, Coimbatore'],
    ['Kotak Mahindra Bank Gandhipuram', 'Gandhipuram, Coimbatore'],
    ['Indian Bank Coimbatore Main', 'Oppanakara Street, Coimbatore'],
    ['Indian Overseas Bank RS Puram', 'RS Puram, Coimbatore'],
    ['Canara Bank Gandhipuram', 'Gandhipuram, Coimbatore'],
    ['Union Bank of India Coimbatore', 'Coimbatore'],
    ['Bank of Baroda Coimbatore', 'Coimbatore'],
    ['Punjab National Bank Coimbatore', 'Coimbatore'],
    ['Central Bank of India Coimbatore', 'Coimbatore'],
    ['Bank of India Coimbatore', 'Coimbatore'],
    ['Indian Bank Peelamedu', 'Peelamedu, Coimbatore'],
    ['Indian Bank Saibaba Colony', 'Saibaba Colony, Coimbatore'],
    ['Canara Bank RS Puram', 'RS Puram, Coimbatore'],
    ['Federal Bank Coimbatore', 'Coimbatore'],
    ['South Indian Bank Coimbatore', 'Coimbatore'],
    ['Karur Vysya Bank Coimbatore', 'Coimbatore'],
    ['Tamilnad Mercantile Bank Coimbatore', 'Coimbatore'],
    ['Lakshmi Vilas Bank Coimbatore', 'Coimbatore'],
    ['City Union Bank Coimbatore', 'Coimbatore'],
    ['IDFC First Bank Coimbatore', 'Coimbatore'],
    ['Yes Bank Coimbatore', 'Coimbatore'],
    ['Bandhan Bank Coimbatore', 'Coimbatore'],
    ['IDBI Bank Coimbatore', 'Coimbatore'],
    ['Bank of Maharashtra Coimbatore', 'Coimbatore'],
    ['UCO Bank Coimbatore', 'Coimbatore'],
    ['Bank of India RS Puram', 'RS Puram, Coimbatore'],
    ['PNB Gandhipuram', 'Gandhipuram, Coimbatore'],
    ['Canara Bank Peelamedu', 'Peelamedu, Coimbatore'],
    ['Union Bank RS Puram', 'RS Puram, Coimbatore'],
    ['Central Bank Peelamedu', 'Peelamedu, Coimbatore'],
    ['Baroda Gandhipuram', 'Gandhipuram, Coimbatore'],
    ['IOB Peelamedu', 'Peelamedu, Coimbatore'],
    ['Indian Bank Saravanampatti', 'Saravanampatti, Coimbatore'],
    ['SBI Ukkadam', 'Ukkadam, Coimbatore'],
    ['HDFC Bank Saravanampatti', 'Saravanampatti, Coimbatore'],
];
$existing = get_existing_keys($conn, 'covai_banks');
$ins = $conn->prepare("INSERT INTO covai_banks (bankname, address, slug) VALUES (?, ?, ?)");
$upd = $conn->prepare("UPDATE covai_banks SET bankname=?, address=? WHERE slug=?");
$inserted = $updated = 0;
foreach ($banks as $r) {
    $slug = slug($r[0]);
    if (isset($existing[$slug])) {
        $upd->bind_param('sss', $r[0], $r[1], $slug);
        $upd->execute();
        $updated++;
    } else {
        $ins->bind_param('sss', $r[0], $r[1], $slug);
        $ins->execute();
        $inserted++;
    }
}
$ins->close(); $upd->close();
$report['covai_banks'] = ['inserted' => $inserted, 'updated' => $updated];
echo "  covai_banks: +$inserted inserted, $updated updated\n"; flush();

// ---------- covai_atms (50 rows) ----------
$atms = [];
for ($i = 1; $i <= 50; $i++) {
    $banks_atm = ['State Bank of India', 'HDFC Bank', 'ICICI Bank', 'Axis Bank', 'Kotak Mahindra Bank'];
    $areas = ['State Bank Road', 'RS Puram', 'Gandhipuram', 'Peelamedu', 'Saibaba Colony', 'Singanallur', 'Race Course', 'Avinashi Road', 'Trichy Road', 'Saravanampatti'];
    $bank = $banks_atm[($i - 1) % count($banks_atm)];
    $area = $areas[($i - 1) % count($areas)];
    $atms[] = [$bank, "$area, Coimbatore 6410" . (2 + ($i % 17))];
}
$existing = get_existing_keys($conn, 'covai_atms');
$ins = $conn->prepare("INSERT INTO covai_atms (bankname, address, slug) VALUES (?, ?, ?)");
$upd = $conn->prepare("UPDATE covai_atms SET bankname=?, address=? WHERE slug=?");
$inserted = $updated = 0;
foreach ($atms as $r) {
    $slug = slug($r[0] . ' ' . $r[1]);
    if (isset($existing[$slug])) {
        $upd->bind_param('sss', $r[0], $r[1], $slug);
        $upd->execute();
        $updated++;
    } else {
        $ins->bind_param('sss', $r[0], $r[1], $slug);
        $ins->execute();
        $inserted++;
    }
}
$ins->close(); $upd->close();
$report['covai_atms'] = ['inserted' => $inserted, 'updated' => $updated];
echo "  covai_atms: +$inserted inserted, $updated updated\n"; flush();

// ---------- covai_hospitals (50 rows) ----------
$hospitals = [
    ['Vedanayagam Hospital', '52 East Bashyakaralu Road, RS Puram, Coimbatore', 'RS Puram'],
    ['Rao Hospital', '120 W Periasamy Rd, RS Puram, Coimbatore', 'RS Puram'],
    ['The Eye Foundation', 'DB Road, RS Puram, Coimbatore', 'RS Puram'],
    ['Vikram E.N.T Hospital', 'RS Puram, Coimbatore', 'RS Puram'],
    ['Balaji Neuro Psychiatric Centre', 'RS Puram, Coimbatore', 'RS Puram'],
    ['Arun Urology Hospital', 'RS Puram, Coimbatore', 'RS Puram'],
    ['Global Ortho Hospital', 'RS Puram, Coimbatore', 'RS Puram'],
    ['Rasi Hospital', '558 DB Road, Coimbatore', 'RS Puram'],
    ['Ponniah Hospital', '232 T.V. Samy Road, Coimbatore', 'RS Puram'],
    ['GP Hospital', 'Gandhipuram, Coimbatore', 'Gandhipuram'],
    ['Kongunad Hospital', '11th Street Tatabad, Gandhipuram, Coimbatore', 'Gandhipuram'],
    ['Ashwin Hospital', 'Sathy Main Road, Gandhipuram, Coimbatore', 'Gandhipuram'],
    ['CSR Hospital', '272 7th St Ext, Gandhipuram, Coimbatore', 'Gandhipuram'],
    ['PSG Hospitals', 'Peelamedu, Coimbatore', 'Peelamedu'],
    ['KG Hospital', 'Coimbatore', 'Coimbatore'],
    ['Ganga Hospital', 'Coimbatore', 'Coimbatore'],
    ['Kovai Medical Center', 'Coimbatore', 'Coimbatore'],
    ['Sri Ramakrishna Hospital', 'Coimbatore', 'Coimbatore'],
    ['Aravind Eye Hospital Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['Apollo Clinic RS Puram', 'RS Puram, Coimbatore', 'RS Puram'],
    ['Apollo Clinic Gandhipuram', 'Gandhipuram, Coimbatore', 'Gandhipuram'],
    ['Fortis Hospital Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['Billroth Hospital', 'Coimbatore', 'Coimbatore'],
    ['Lifeline Hospital', 'Coimbatore', 'Coimbatore'],
    ['Gem Hospital', 'Coimbatore', 'Coimbatore'],
    ['Sankara Eye Hospital', 'Coimbatore', 'Coimbatore'],
    ['Avinashi Road Hospital', 'Avinashi Road, Coimbatore', 'Avinashi Road'],
    ['Saibaba Colony Clinic', 'Saibaba Colony, Coimbatore', 'Saibaba Colony'],
    ['Peelamedu Medical Centre', 'Peelamedu, Coimbatore', 'Peelamedu'],
    ['Saravanampatti Hospital', 'Saravanampatti, Coimbatore', 'Saravanampatti'],
    ['Ukkadam Health Centre', 'Ukkadam, Coimbatore', 'Ukkadam'],
    ['Race Course Hospital', 'Race Course, Coimbatore', 'Race Course'],
    ['RS Puram Multispeciality', 'RS Puram, Coimbatore', 'RS Puram'],
    ['Gandhipuram Nursing Home', 'Gandhipuram, Coimbatore', 'Gandhipuram'],
    ['Coimbatore Heart Institute', 'Coimbatore', 'Coimbatore'],
    ['Ortho Care Hospital', 'Coimbatore', 'Coimbatore'],
    ['Dental Care RS Puram', 'RS Puram, Coimbatore', 'RS Puram'],
    ['Child Care Hospital', 'Coimbatore', 'Coimbatore'],
    ['City Hospital Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['Metro Hospital', 'Coimbatore', 'Coimbatore'],
    ['Prime Hospital', 'Coimbatore', 'Coimbatore'],
    ['Care Hospital Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['Unity Hospital', 'Coimbatore', 'Coimbatore'],
    ['Hope Hospital', 'Coimbatore', 'Coimbatore'],
    ['Trust Hospital', 'Coimbatore', 'Coimbatore'],
    ['Medicare Hospital', 'Coimbatore', 'Coimbatore'],
    ['Life Care Hospital', 'Coimbatore', 'Coimbatore'],
    ['General Hospital Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['District Hospital Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['ESI Hospital Coimbatore', 'Coimbatore', 'Coimbatore'],
    ['Government Hospital Coimbatore', 'Coimbatore', 'Coimbatore'],
];
$existing = get_existing_keys($conn, 'covai_hospitals');
$ins = $conn->prepare("INSERT INTO covai_hospitals (hospitalname, address, locality, slug) VALUES (?, ?, ?, ?)");
$upd = $conn->prepare("UPDATE covai_hospitals SET hospitalname=?, address=?, locality=? WHERE slug=?");
$inserted = $updated = 0;
foreach ($hospitals as $r) {
    $slug = slug($r[0] . ' ' . $r[2]);
    if (isset($existing[$slug])) {
        $upd->bind_param('ssss', $r[0], $r[1], $r[2], $slug);
        $upd->execute();
        $updated++;
    } else {
        $ins->bind_param('ssss', $r[0], $r[1], $r[2], $slug);
        $ins->execute();
        $inserted++;
    }
}
$ins->close(); $upd->close();
$report['covai_hospitals'] = ['inserted' => $inserted, 'updated' => $updated];
echo "  covai_hospitals: +$inserted inserted, $updated updated\n"; flush();

// ---------- covai_gov_offices (50 rows) ----------
$gov = [
    ['District Collector Office', 'Collectorate Building, Coimbatore 641018', '0422-2301114'],
    ['Coimbatore City Municipal Corporation Commissioner', 'Coimbatore Corporation, Coimbatore', '0422-2302323'],
    ['Coimbatore Corporation North Zone', 'North Zone Office, Coimbatore', NULL],
    ['Coimbatore Corporation South Zone', 'South Zone Office, Coimbatore', NULL],
    ['Coimbatore Corporation East Zone', 'East Zone Office, Coimbatore', NULL],
    ['Coimbatore Corporation West Zone', 'West Zone Office, Coimbatore', NULL],
    ['Coimbatore Corporation Central Zone', 'Central Zone Office, Coimbatore', NULL],
    ['Municipality Mettupalayam', 'Mettupalayam, Coimbatore District', NULL],
    ['Municipality Pollachi', 'Pollachi, Coimbatore District', NULL],
    ['Municipality Valparai', 'Valparai, Coimbatore District', NULL],
    ['Municipality Gudalur', 'Gudalur, Coimbatore District', NULL],
    ['Municipality Karamadai', 'Karamadai, Coimbatore District', NULL],
    ['Municipality Karumathampatti', 'Karumathampatti, Coimbatore District', NULL],
    ['Municipality Madukkarai', 'Madukkarai, Coimbatore District', NULL],
    ['Taluk Office Coimbatore North', 'Coimbatore North Taluk', NULL],
    ['Taluk Office Coimbatore South', 'Coimbatore South Taluk', NULL],
    ['Taluk Office Sulur', 'Sulur, Coimbatore District', NULL],
    ['Taluk Office Mettupalayam', 'Mettupalayam Taluk', NULL],
    ['Taluk Office Pollachi', 'Pollachi Taluk', NULL],
    ['Taluk Office Valparai', 'Valparai Taluk', NULL],
    ['Revenue Divisional Office Coimbatore', 'Coimbatore', NULL],
    ['RTO Coimbatore Central', 'Coimbatore', NULL],
    ['RTO Coimbatore North', 'Coimbatore North', NULL],
    ['RTO Coimbatore South', 'Coimbatore South', NULL],
    ['Police Commissionerate Coimbatore', 'Coimbatore', NULL],
    ['District Court Coimbatore', 'Coimbatore', NULL],
    ['Labour Office Coimbatore', 'Coimbatore', NULL],
    ['Employment Office Coimbatore', 'Coimbatore', NULL],
    ['Commercial Tax Office Coimbatore', 'Coimbatore', NULL],
    ['Central Excise Coimbatore', 'Coimbatore', NULL],
    ['Passport Seva Kendra Coimbatore', 'Coimbatore', NULL],
    ['Post Office Head Coimbatore', 'Coimbatore GPO', NULL],
    ['BSNL Coimbatore', 'Coimbatore', NULL],
    ['TANGEDCO Coimbatore', 'Coimbatore', NULL],
    ['TWAD Board Coimbatore', 'Coimbatore', NULL],
    ['Fire Service Coimbatore', 'Coimbatore', NULL],
    ['Municipal Water Supply Coimbatore', 'Coimbatore', NULL],
    ['District Education Office', 'Coimbatore', NULL],
    ['District Health Office', 'Coimbatore', NULL],
    ['District Agriculture Office', 'Coimbatore', NULL],
    ['District Industries Centre', 'Coimbatore', NULL],
    ['Khadi Board Coimbatore', 'Coimbatore', NULL],
    ['Social Welfare Office Coimbatore', 'Coimbatore', NULL],
    ['Women Development Office', 'Coimbatore', NULL],
    ['Child Development Office', 'Coimbatore', NULL],
    ['Tamil Nadu Housing Board Coimbatore', 'Coimbatore', NULL],
    ['Slum Clearance Board Coimbatore', 'Coimbatore', NULL],
    ['Town Panchayat Sulur', 'Sulur, Coimbatore District', NULL],
    ['Town Panchayat Annur', 'Annur, Coimbatore District', NULL],
    ['Town Panchayat Kinathukadavu', 'Kinathukadavu, Coimbatore District', NULL],
    ['Town Panchayat Pollachi', 'Pollachi', NULL],
    ['Town Panchayat Mettupalayam', 'Mettupalayam', NULL],
];
$existing = get_existing_keys($conn, 'covai_gov_offices');
$ins = $conn->prepare("INSERT INTO covai_gov_offices (office_name, address, contact, slug) VALUES (?, ?, ?, ?)");
$upd = $conn->prepare("UPDATE covai_gov_offices SET office_name=?, address=?, contact=? WHERE slug=?");
$inserted = $updated = 0;
foreach ($gov as $r) {
    $slug = slug($r[0]);
    $contact = $r[2] ?? '';
    if (isset($existing[$slug])) {
        $upd->bind_param('ssss', $r[0], $r[1], $contact, $slug);
        $upd->execute();
        $updated++;
    } else {
        $ins->bind_param('ssss', $r[0], $r[1], $contact, $slug);
        $ins->execute();
        $inserted++;
    }
}
$ins->close(); $upd->close();
$report['covai_gov_offices'] = ['inserted' => $inserted, 'updated' => $updated];
echo "  covai_gov_offices: +$inserted inserted, $updated updated\n"; flush();

// ---------- covai_restaurants (50 rows) ----------
$restaurants = [
    ['Bulls & Bears Bistro', 'RS Puram, Coimbatore', 'RS Puram', 'Continental, Italian', 1000, 4.8],
    ['The French Door Cafe', 'RS Puram, Coimbatore', 'RS Puram', 'Continental, North Indian', 1500, 4.4],
    ['Sherlocks Lounge & Kitchen', 'RS Puram, Coimbatore', 'RS Puram', 'Chinese, Continental', 2400, 4.6],
    ['Britain To Bombay 1800', 'RS Puram, Coimbatore', 'RS Puram', 'Multicuisine, Cafe', 1700, 4.0],
    ['Thats Y Food', 'RS Puram, Coimbatore', 'RS Puram', 'Multicuisine', 800, 4.3],
    ['Tapriwala The Contemporary Cafe', 'RS Puram, Coimbatore', 'RS Puram', 'Street Food', 700, 5.0],
    ['La Cafe Riders Cult', 'RS Puram, Coimbatore', 'RS Puram', 'Cafe', 700, 5.0],
    ['Cahyo Garden Cafe', 'RS Puram, Coimbatore', 'RS Puram', 'Italian', 800, 4.0],
    ['The Bermuda Cocktail Commune', 'RS Puram, Coimbatore', 'RS Puram', 'Indian', 1200, 4.0],
    ['Sharief Bhai Biryani', 'RS Puram, Coimbatore', 'RS Puram', 'Hyderabadi', 600, 4.3],
    ['Chitram Cafe & Craft Chocolates', 'Gandhipuram, Coimbatore', 'Gandhipuram', 'Desserts, Italian', 500, 4.8],
    ['Salem RR Biryani', 'Gandhipuram, Coimbatore', 'Gandhipuram', 'South Indian', 1000, 3.9],
    ['Fruit Cane', 'Gandhipuram, Coimbatore', 'Gandhipuram', 'Beverages', 400, 3.9],
    ['Glacier Park', 'Gandhipuram, Coimbatore', 'Gandhipuram', 'Beverages', 300, 4.1],
    ['Biryani In Bucket', 'Gandhipuram, Coimbatore', 'Gandhipuram', 'South Indian, Biryani', 400, 4.7],
    ['Idly Virundhu', 'Gandhipuram, Coimbatore', 'Gandhipuram', 'South Indian', 200, 4.2],
    ['Lallkudi Sea Food Restaurant', 'Gandhipuram, Coimbatore', 'Gandhipuram', 'Seafood', 800, 3.6],
];
for ($i = 18; $i <= 50; $i++) {
    $loc = ['RS Puram', 'Gandhipuram', 'Peelamedu', 'Saibaba Colony', 'Race Course'][$i % 5];
    $restaurants[] = ['Restaurant Coimbatore ' . $i, $loc . ', Coimbatore', $loc, 'South Indian, North Indian', 500 + ($i * 20), 4.0 + ($i % 10) / 10];
}
$existing = get_existing_keys($conn, 'covai_restaurants');
$ins = $conn->prepare("INSERT INTO covai_restaurants (name, address, locality, cuisine, cost_for_two, rating, slug) VALUES (?, ?, ?, ?, ?, ?, ?)");
$upd = $conn->prepare("UPDATE covai_restaurants SET name=?, address=?, locality=?, cuisine=?, cost_for_two=?, rating=? WHERE slug=?");
$inserted = $updated = 0;
foreach ($restaurants as $r) {
    $slug = slug($r[0] . ' ' . $r[2]);
    if (isset($existing[$slug])) {
        $upd->bind_param('ssssids', $r[0], $r[1], $r[2], $r[3], $r[4], $r[5], $slug);
        $upd->execute();
        $updated++;
    } else {
        $ins->bind_param('ssssids', $r[0], $r[1], $r[2], $r[3], $r[4], $r[5], $slug);
        $ins->execute();
        $inserted++;
    }
}
$ins->close(); $upd->close();
$report['covai_restaurants'] = ['inserted' => $inserted, 'updated' => $updated];
echo "  covai_restaurants: +$inserted inserted, $updated updated\n"; flush();

// ---------- covai_it_companies (50 rows) ----------
$it = [
    ['Tata Consultancy Services', 'TIDEL Park, Peelamedu, Coimbatore', 'Peelamedu', 'IT Services'],
    ['HCL Technologies', 'TIDEL Park, Peelamedu, Coimbatore', 'Peelamedu', 'IT Services'],
    ['Wipro Limited', 'TIDEL Park, Peelamedu, Coimbatore', 'Peelamedu', 'IT Services'],
    ['Robert Bosch', 'TIDEL Park, Peelamedu, Coimbatore', 'Peelamedu', 'IT Services'],
    ['Payoda Technologies', 'TIDEL Park, Peelamedu, Coimbatore', 'Peelamedu', 'Software'],
    ['Visionet Systems', 'TIDEL Park, Peelamedu, Coimbatore', 'Peelamedu', 'IT'],
    ['Cognizant Technology Solutions', 'KCT Tech Park, Saravanampatti, Coimbatore', 'Saravanampatti', 'IT Services'],
    ['ThoughtWorks', 'KCT Tech Park, Saravanampatti, Coimbatore', 'Saravanampatti', 'Software'],
    ['Ford Business Services', 'KCT Tech Park, Saravanampatti, Coimbatore', 'Saravanampatti', 'IT'],
    ['State Street HCL Services', 'KCT Tech Park, Saravanampatti, Coimbatore', 'Saravanampatti', 'IT'],
    ['Amazon', 'India Land Tech Park, Saravanampatti, Coimbatore', 'Saravanampatti', 'IT'],
    ['Bosch India', 'India Land Tech Park, Saravanampatti, Coimbatore', 'Saravanampatti', 'IT'],
    ['RedHat', 'India Land Tech Park, Saravanampatti, Coimbatore', 'Saravanampatti', 'Software'],
    ['Infovision', 'India Land Tech Park, Saravanampatti, Coimbatore', 'Saravanampatti', 'IT'],
    ['Bank of America', 'India Land Tech Park, Saravanampatti, Coimbatore', 'Saravanampatti', 'IT'],
    ['Sparkout Tech Solutions', 'Hanudev IT Park, Udayampalayam, Coimbatore', 'Udayampalayam', 'Software'],
    ['QBrainX Inc', 'Hanudev IT Park, Udayampalayam, Coimbatore', 'Udayampalayam', 'Software'],
];
for ($i = 17; $i <= 50; $i++) {
    $loc = ['Peelamedu', 'Saravanampatti', 'Udayampalayam', 'RS Puram', 'Gandhipuram'][$i % 5];
    $it[] = ['IT Company Coimbatore ' . $i, $loc . ', Coimbatore', $loc, 'Software, IT Services'];
}
$existing = get_existing_keys($conn, 'covai_it_companies');
$ins = $conn->prepare("INSERT INTO covai_it_companies (company_name, address, locality, industry_type, slug) VALUES (?, ?, ?, ?, ?)");
$upd = $conn->prepare("UPDATE covai_it_companies SET company_name=?, address=?, locality=?, industry_type=? WHERE slug=?");
$inserted = $updated = 0;
foreach ($it as $r) {
    $slug = slug($r[0] . ' ' . $r[2]);
    if (isset($existing[$slug])) {
        $upd->bind_param('sssss', $r[0], $r[1], $r[2], $r[3], $slug);
        $upd->execute();
        $updated++;
    } else {
        $ins->bind_param('sssss', $r[0], $r[1], $r[2], $r[3], $slug);
        $ins->execute();
        $inserted++;
    }
}
$ins->close(); $upd->close();
$report['covai_it_companies'] = ['inserted' => $inserted, 'updated' => $updated];
echo "  covai_it_companies: +$inserted inserted, $updated updated\n"; flush();

// ---------- covai_industries (50 rows) ----------
$industries = [
    ['Lakshmi Machine Works Limited', 'Coimbatore', 'Textile Machinery', 'Coimbatore'],
    ['Lakshmi Mills', 'Coimbatore', 'Cotton Yarn, Fabric', 'Coimbatore'],
    ['Sree Padma Baalaji Industries', 'Coimbatore', 'Textile Machinery Spares', 'Coimbatore'],
    ['Arunaa Textiles', 'Coimbatore', 'Fabric', 'Coimbatore'],
];
for ($i = 5; $i <= 50; $i++) {
    $types = ['Textile', 'Pump Manufacturing', 'Motor Manufacturing', 'Engineering', 'Foundry', 'Automotive Components', 'Garment Export', 'Precision Engineering'];
    $industries[] = ['Industry Coimbatore ' . $i, 'Coimbatore District', $types[$i % count($types)], 'Coimbatore'];
}
$existing = get_existing_keys($conn, 'covai_industries');
$ins = $conn->prepare("INSERT INTO covai_industries (industry_name, address, industry_type, locality, slug) VALUES (?, ?, ?, ?, ?)");
$upd = $conn->prepare("UPDATE covai_industries SET industry_name=?, address=?, industry_type=?, locality=? WHERE slug=?");
$inserted = $updated = 0;
foreach ($industries as $r) {
    $slug = slug($r[0] . ' ' . $r[3]);
    if (isset($existing[$slug])) {
        $upd->bind_param('sssss', $r[0], $r[1], $r[2], $r[3], $slug);
        $upd->execute();
        $updated++;
    } else {
        $ins->bind_param('sssss', $r[0], $r[1], $r[2], $r[3], $slug);
        $ins->execute();
        $inserted++;
    }
}
$ins->close(); $upd->close();
$report['covai_industries'] = ['inserted' => $inserted, 'updated' => $updated];
echo "  covai_industries: +$inserted inserted, $updated updated\n"; flush();

// ---------- covai_parks (50 rows) ----------
$parks = [
    ['VOC Park and Zoo', 'Coimbatore', '4.5 acres', 'Zoo, play area, toy train', '4 PM-7:30 PM weekdays'],
    ['Gandhi Park', 'Main Road, RS Puram, Coimbatore', 'RS Puram', 'Recreational', '6 AM-8 PM'],
    ['Memorial Garden', 'Saibaba Colony, Coimbatore', 'Saibaba Colony', 'Garden', '5 AM-7 PM'],
    ['Childrens Park', 'Saibaba Colony, Coimbatore', 'Saibaba Colony', 'Play area', '5 AM-7 PM'],
    ['Bharathi Park', 'Saibaba Colony, Coimbatore', 'Saibaba Colony', 'Garden', '5 AM-7 PM'],
];
for ($i = 6; $i <= 50; $i++) {
    $loc = ['RS Puram', 'Gandhipuram', 'Peelamedu', 'Saibaba Colony', 'Race Course', 'Saravanampatti', 'Ukkadam', 'Singanallur'][$i % 8];
    $parks[] = ['Park Coimbatore ' . $i, $loc . ', Coimbatore', $loc, 'Recreational, Green space', '6 AM-8 PM'];
}
$existing = get_existing_keys($conn, 'covai_parks');
$ins = $conn->prepare("INSERT INTO covai_parks (parkname, location, area, features, timings, slug) VALUES (?, ?, ?, ?, ?, ?)");
$upd = $conn->prepare("UPDATE covai_parks SET parkname=?, location=?, area=?, features=?, timings=? WHERE slug=?");
$inserted = $updated = 0;
foreach ($parks as $r) {
    $slug = slug($r[0] . ' ' . $r[1]);
    if (isset($existing[$slug])) {
        $upd->bind_param('ssssss', $r[0], $r[1], $r[2], $r[3], $r[4], $slug);
        $upd->execute();
        $updated++;
    } else {
        $ins->bind_param('ssssss', $r[0], $r[1], $r[2], $r[3], $r[4], $slug);
        $ins->execute();
        $inserted++;
    }
}
$ins->close(); $upd->close();
$report['covai_parks'] = ['inserted' => $inserted, 'updated' => $updated];
echo "  covai_parks: +$inserted inserted, $updated updated\n"; flush();

// ---------- covai_it_parks (50 rows) ----------
$itparks = [
    ['TIDEL Park Coimbatore', 'Peelamedu', '2010', '17 lakh sq.ft'],
    ['KCT Tech Park', 'Saravanampatti', '2008', '4.18 acres'],
    ['India Land Tech Park', 'Saravanampatti', '2007', '12 acres'],
    ['Hanudev IT Park', 'Udayampalayam', '2018', '8-story'],
];
for ($i = 5; $i <= 50; $i++) {
    $loc = ['Peelamedu', 'Saravanampatti', 'Udayampalayam', 'Gandhipuram', 'RS Puram', 'Coimbatore'][$i % 6];
    $itparks[] = ['IT Park Coimbatore ' . $i, $loc, (string)(2005 + ($i % 15)), 'Commercial'];
}
// covai_it_parks has no slug column; use name as key
$existing = get_existing_keys($conn, 'covai_it_parks', 'name');
$ins = $conn->prepare("INSERT INTO covai_it_parks (name, locality, inauguration_year, location, address) VALUES (?, ?, ?, ?, ?)");
$upd = $conn->prepare("UPDATE covai_it_parks SET locality=?, inauguration_year=?, location=?, address=? WHERE name=?");
$inserted = $updated = 0;
foreach ($itparks as $r) {
    $addr = $r[1] . ', Coimbatore';
    if (isset($existing[$r[0]])) {
        $upd->bind_param('sssss', $r[1], $r[2], $addr, $addr, $r[0]);
        $upd->execute();
        $updated++;
    } else {
        $ins->bind_param('sssss', $r[0], $r[1], $r[2], $addr, $addr);
        $ins->execute();
        $inserted++;
    }
}
$ins->close(); $upd->close();
$report['covai_it_parks'] = ['inserted' => $inserted, 'updated' => $updated];
echo "  covai_it_parks: +$inserted inserted, $updated updated\n"; flush();

// ---------- Report ----------
echo "Seeds completed.\n";
foreach ($report as $table => $count) {
    if (is_array($count)) {
        echo "  $table: +" . $count['inserted'] . " inserted, " . $count['updated'] . " updated\n";
    } else {
        echo "  $table: +$count rows\n";
    }
}
$conn->close();
exit(0);
