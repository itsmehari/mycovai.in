<?php
/**
 * Import directory CSV into hostels_pgs (live or local).
 *
 * Usage (project root):
 *   DB_HOST=mycovai.in php dev-tools/import-hostels-pgs-csv.php --file=dev-tools/data/hostels-pgs-directory-import.csv
 *   php dev-tools/import-hostels-pgs-csv.php --file=... --dry-run
 *
 * Supports:
 * - Legacy headers: external_id,name,address,website,latitude,longitude,rating_note,category,status_note,listing_url,phone,email,social_json
 * - Spreadsheet export (18 cols): ID,Name,Address,Featured in,Bing Maps,Latitude,Longitude,Rating,Rating Info,Category,Open Hour,Website,Phone,Emails,Social Med,Facebook,Instagram,Twitter
 *
 * Rows are inserted with status=pending and verification_status=pending (not on public index until approved).
 */
declare(strict_types=1);

$baseDir = dirname(__DIR__);
chdir($baseDir);

$dryRun = in_array('--dry-run', $argv, true);
$fileArg = null;
foreach ($argv as $arg) {
    if (str_starts_with($arg, '--file=')) {
        $fileArg = substr($arg, 7);
        break;
    }
}
if ($fileArg === null || $fileArg === '') {
    fwrite(STDERR, "Missing --file=path/to.csv\n");
    exit(1);
}
$csvPath = $baseDir . '/' . ltrim(str_replace('\\', '/', $fileArg), '/');
if (!is_readable($csvPath)) {
    fwrite(STDERR, "File not readable: {$csvPath}\n");
    exit(1);
}

require $baseDir . '/core/omr-connect.php';

const IMPORT_OWNER_EMAIL = 'directory-import@mycovai.in';

/** @return array<string,int> logical field => column index */
function buildLogicalColumnMap(array $headerCells): array
{
    $norm = [];
    foreach ($headerCells as $i => $h) {
        $k = strtolower(trim((string) $h));
        $k = preg_replace('/\s+/', ' ', $k) ?? $k;
        if ($k !== '') {
            $norm[$k] = (int) $i;
        }
    }

    $pick = static function (array $candidates) use ($norm): ?int {
        foreach ($candidates as $c) {
            $c = strtolower(trim($c));
            if (isset($norm[$c])) {
                return $norm[$c];
            }
        }
        return null;
    };

    $logical = [];
    $logical['external_id'] = $pick(['external_id', 'id', 'ypid']);
    $logical['name'] = $pick(['name', 'property_name', 'title']);
    $logical['address'] = $pick(['address']);
    $logical['website'] = $pick(['website', 'web']);
    $logical['latitude'] = $pick(['latitude', 'lat']);
    $logical['longitude'] = $pick(['longitude', 'lng', 'lon']);
    $logical['rating'] = $pick(['rating']);
    $logical['rating_info'] = $pick(['rating info', 'rating_info', 'rating note', 'rating_note']);
    $logical['category'] = $pick(['category', 'type']);
    $logical['open_hour'] = $pick(['open hour', 'open_hours', 'open hours', 'hours', 'status_note']);
    $logical['featured_in'] = $pick(['featured in', 'featured_in', 'featured image', 'featured_image', 'listing_url', 'listing url']);
    $logical['bing_maps'] = $pick(['bing maps url', 'bing maps', 'bing_maps', 'bing']);
    $logical['phone'] = $pick(['phone', 'contact', 'mobile']);
    $logical['email'] = $pick(['emails', 'email', 'e-mail']);
    $logical['social'] = $pick(['social medias', 'social med', 'social_med', 'social', 'social_json', 'social json']);
    $logical['facebook'] = $pick(['facebook']);
    $logical['instagram'] = $pick(['instagram']);
    $logical['twitter'] = $pick(['twitter']);

    return $logical;
}

function slugify(string $text): string
{
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text) ?? '';
    return trim($text, '-');
}

function ensureImportOwner(mysqli $conn): int
{
    $email = IMPORT_OWNER_EMAIL;
    $esc = $conn->real_escape_string($email);
    $r = $conn->query("SELECT id FROM property_owners WHERE email = '{$esc}' LIMIT 1");
    if ($r && $r->num_rows > 0) {
        return (int) $r->fetch_row()[0];
    }
    $hash = password_hash(bin2hex(random_bytes(16)), PASSWORD_DEFAULT);
    $fn = 'MyCovai Directory Import';
    $phone = '04220000000';
    $stmt = $conn->prepare('INSERT INTO property_owners (full_name, email, phone, password_hash, status) VALUES (?, ?, ?, ?, ?)');
    if (!$stmt) {
        throw new RuntimeException($conn->error);
    }
    $status = 'verified';
    $stmt->bind_param('sssss', $fn, $email, $phone, $hash, $status);
    if (!$stmt->execute()) {
        throw new RuntimeException($stmt->error);
    }
    $id = (int) $conn->insert_id;
    $stmt->close();
    return $id;
}

function mapPropertyType(string $category, string $name): string
{
    $n = strtolower($name);
    $c = strtolower(trim($category));
    // Prefer name over generic "Hotel" category (Maps often labels hostels as Hotel).
    if (str_contains($n, 'hostel')) {
        return 'Hostel';
    }
    if (preg_match('/\bzolo\b/', $n) || preg_match('/\bpgs?\b/i', $name) || str_contains($n, 'paying guest')) {
        return 'PG';
    }
    if (str_contains($n, 'oyo')) {
        return 'PG';
    }
    if (str_contains($c, 'hospital')) {
        return 'PG';
    }
    if (str_contains($n, 'school') && !str_contains($n, 'hostel')) {
        return 'PG';
    }
    if (str_contains($c, 'college') || str_contains($c, 'university') || str_contains($c, 'education')) {
        return 'Hostel';
    }
    if (str_contains($c, 'hotel')) {
        return 'PG';
    }
    if (str_contains($n, 'pg') || preg_match('/\bpg\b/i', $name)) {
        return 'PG';
    }
    return 'PG';
}

function mapGenderPreference(string $name): string
{
    $n = strtolower($name);
    if (str_contains($n, 'ladies') || str_contains($n, 'girls') || str_contains($n, 'women')) {
        return 'Girls Only';
    }
    if (str_contains($n, 'boys') || str_contains($n, "men's")) {
        return 'Boys Only';
    }
    return 'Co-living';
}

function normalizePhone(string $p): string
{
    $p = trim(preg_replace('/\s+/', ' ', $p) ?? '');
    if (strlen($p) > 20) {
        $p = substr($p, 0, 20);
    }
    return $p;
}

function normalizeEmail(string $e): ?string
{
    $e = trim($e);
    if ($e === '' || strpos($e, '@') === false) {
        return null;
    }
    return substr($e, 0, 255);
}

function sqlStr(mysqli $conn, ?string $v): string
{
    if ($v === null || $v === '') {
        return 'NULL';
    }
    return "'" . $conn->real_escape_string($v) . "'";
}

$ownerId = ensureImportOwner($conn);
echo "Import owner id: {$ownerId} (" . IMPORT_OWNER_EMAIL . ")\n";
if ($dryRun) {
    echo "DRY RUN — no inserts.\n";
}

$fh = fopen($csvPath, 'rb');
if (!$fh) {
    fwrite(STDERR, "Could not open CSV\n");
    exit(1);
}
$header = fgetcsv($fh);
if ($header === false) {
    fwrite(STDERR, "Empty CSV\n");
    exit(1);
}
if (isset($header[0])) {
    $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]) ?? $header[0];
}

$logical = buildLogicalColumnMap($header);
if ($logical['name'] === null || $logical['address'] === null) {
    fwrite(STDERR, "CSV must include Name and Address columns (see script header for supported names).\n");
    exit(1);
}

$inserted = 0;
$errors = 0;

$rowGetter = static function (array $row, ?int $idx): string {
    if ($idx === null || !isset($row[$idx])) {
        return '';
    }
    return trim((string) $row[$idx]);
};

while (($row = fgetcsv($fh)) !== false) {
    if (count($row) === 1 && trim((string) $row[0]) === '') {
        continue;
    }

    $externalId = $rowGetter($row, $logical['external_id']);
    $name = $rowGetter($row, $logical['name']);
    $address = $rowGetter($row, $logical['address']);
    if ($name === '' || $address === '') {
        continue;
    }

    $website = $rowGetter($row, $logical['website']);
    $latStr = $rowGetter($row, $logical['latitude']);
    $lngStr = $rowGetter($row, $logical['longitude']);
    $rating = $rowGetter($row, $logical['rating']);
    $ratingInfo = $rowGetter($row, $logical['rating_info']);
    $category = $rowGetter($row, $logical['category']);
    $openHour = $rowGetter($row, $logical['open_hour']);
    $featuredIn = $rowGetter($row, $logical['featured_in']);
    $bingMaps = $rowGetter($row, $logical['bing_maps']);
    $phone = normalizePhone($rowGetter($row, $logical['phone']));
    $email = normalizeEmail($rowGetter($row, $logical['email']));
    $social = $rowGetter($row, $logical['social']);
    $fb = $rowGetter($row, $logical['facebook']);
    $ig = $rowGetter($row, $logical['instagram']);
    $tw = $rowGetter($row, $logical['twitter']);

    $baseSlug = 'yp-' . slugify($externalId !== '' ? $externalId : $name . '-' . uniqid('', true));
    if (strlen($baseSlug) < 6) {
        $baseSlug = 'yp-' . slugify($name) . '-' . substr(sha1($name . $address), 0, 8);
    }

    $slug = $baseSlug;
    $suffix = 0;
    while (true) {
        $sEsc = $conn->real_escape_string($slug);
        $chk = $conn->query("SELECT id FROM hostels_pgs WHERE slug = '{$sEsc}' LIMIT 1");
        if ($chk && $chk->num_rows === 0) {
            break;
        }
        $suffix++;
        $slug = $baseSlug . '-' . $suffix;
    }

    $lat = $latStr !== '' && is_numeric($latStr) ? (float) $latStr : null;
    $lng = $lngStr !== '' && is_numeric($lngStr) ? (float) $lngStr : null;

    $propertyType = mapPropertyType($category, $name);
    $gender = mapGenderPreference($name);
    $locality = 'Coimbatore';

    // Public card text (facilities column must stay a JSON *array* of amenity strings for the UI).
    $brief = $propertyType . ' in ' . $locality;
    if ($category !== '') {
        $brief .= ' · ' . $category;
    }
    if ($rating !== '' || $ratingInfo !== '') {
        $brief .= ' · ' . trim($rating . ' ' . $ratingInfo);
    }
    if ($openHour !== '') {
        $brief .= ' · ' . $openHour;
    }
    $brief .= ' · Contact for rent and availability.';

    $fullParts = [];
    if ($externalId !== '') {
        $fullParts[] = 'External ID: ' . $externalId;
    }
    if ($featuredIn !== '') {
        $fullParts[] = 'Featured in: ' . $featuredIn;
    }
    if ($bingMaps !== '') {
        $fullParts[] = 'Bing Maps: ' . $bingMaps;
    }
    if ($website !== '') {
        $fullParts[] = 'Website: ' . $website;
    }
    if ($social !== '') {
        $fullParts[] = 'Social: ' . $social;
    }
    $extraSocial = array_filter([$fb ? 'Facebook: ' . $fb : '', $ig ? 'Instagram: ' . $ig : '', $tw ? 'Twitter: ' . $tw : '']);
    if ($extraSocial !== []) {
        $fullParts[] = implode("\n", $extraSocial);
    }
    $fullParts[] = 'Please verify phone, email, and address in admin before publishing.';
    $fullDescription = implode("\n\n", $fullParts);

    // Metadata lives in full_description only; facilities JSON must be [] or ["WiFi",...] for listing UI.
    $facilitiesJson = '[]';

    $latSql = $lat === null ? 'NULL' : (string) $lat;
    $lngSql = $lng === null ? 'NULL' : (string) $lng;

    if ($dryRun) {
        echo "[dry-run] {$name} | slug={$slug} | type={$propertyType}\n";
        $inserted++;
        continue;
    }

    $sql = sprintf(
        "INSERT INTO hostels_pgs (
            owner_id, property_name, slug, property_type, address, locality, landmark, pincode,
            latitude, longitude, nearby_metro, nearby_bus_stand,
            brief_overview, full_description, house_rules, total_beds, gender_preference,
            monthly_rent_single, monthly_rent_double, monthly_rent_triple, security_deposit,
            facilities, food_options, is_student_friendly,
            contact_person, contact_email, contact_phone, contact_whatsapp,
            featured_image, verification_status, featured, status,
            created_at, updated_at
        ) VALUES (
            %d, %s, %s, %s, %s, %s, NULL, NULL,
            %s, %s, NULL, NULL,
            %s, %s, NULL, NULL, %s,
            NULL, NULL, NULL, NULL,
            %s, NULL, 0,
            NULL, %s, %s, NULL,
            NULL, 'pending', 0, 'pending',
            NOW(), NOW()
        )",
        $ownerId,
        sqlStr($conn, $name),
        sqlStr($conn, $slug),
        sqlStr($conn, $propertyType),
        sqlStr($conn, $address),
        sqlStr($conn, $locality),
        $latSql,
        $lngSql,
        sqlStr($conn, $brief),
        sqlStr($conn, $fullDescription),
        sqlStr($conn, $gender),
        sqlStr($conn, $facilitiesJson),
        sqlStr($conn, $email),
        $phone === '' ? 'NULL' : sqlStr($conn, $phone)
    );

    if (!$conn->query($sql)) {
        fwrite(STDERR, "Insert failed ({$name}): " . $conn->error . "\n");
        $errors++;
        continue;
    }
    echo "Inserted: {$name} (id {$conn->insert_id})\n";
    $inserted++;
}

fclose($fh);
$conn->close();

echo "\nDone. Inserted: {$inserted}, errors: {$errors}\n";
exit($errors > 0 ? 1 : 0);
