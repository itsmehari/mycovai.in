<?php
/**
 * Event helper functions – MyCovai /local-events module
 */

// Ensure DB connection
require_once __DIR__ . '/../../core/omr-connect.php';

if (!function_exists('sanitizeInput')) {
    function sanitizeInput(string $value): string {
        // FILTER_SANITIZE_STRING is deprecated in PHP 8.1+. Use a custom sanitizer.
        $clean = trim($value);
        $clean = strip_tags($clean);
        // Remove control characters
        $clean = preg_replace('/[\x00-\x1F\x7F]/u', '', $clean);
        // Collapse excessive whitespace
        $clean = preg_replace('/\s{2,}/', ' ', $clean);
        return $clean;
    }
}

if (!function_exists('generateSlug')) {
    function generateSlug(string $title): string {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        return trim($slug, '-');
    }
}

function getEventCategories(): array {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) {
            error_log('Events: DB connection unavailable in getEventCategories');
            return [];
        }
        $sql = "SELECT id, name, slug FROM event_categories WHERE is_active = 1 ORDER BY display_order, name";
        $result = $conn->query($sql);
        if (!$result) {
            error_log('Events: categories query error: ' . $conn->error);
            return [];
        }
        $rows = [];
        while ($row = $result->fetch_assoc()) { $rows[] = $row; }
        return $rows;
    } catch (Throwable $e) {
        error_log('Events: getEventCategories exception: ' . $e->getMessage());
        return [];
    }
}

function getCategoryBySlug(string $slug): ?array {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) { return null; }
        $sql = "SELECT id, name, slug FROM event_categories WHERE slug = ? AND is_active = 1 LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc() ?: null;
    } catch (Throwable $e) {
        error_log('Events: getCategoryBySlug exception: ' . $e->getMessage());
        return null;
    }
}

function slugToLocality(string $slug): string {
    // Convert slug back to locality label (e.g., sholinganallur → Sholinganallur)
    $label = str_replace('-', ' ', trim($slug));
    $label = preg_replace('/\s+/', ' ', $label);
    return ucwords($label);
}

function getEvents(array $filters, int $limit, int $offset): array {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) { return []; }

        $where = ["status IN ('scheduled','ongoing')"]; // only active
        $params = [];
        $types = '';

        if (!empty($filters['search'])) {
            $where[] = "(title LIKE CONCAT('%', ?, '%') OR location LIKE CONCAT('%', ?, '%'))";
            $params[] = $filters['search'];
            $params[] = $filters['search'];
            $types .= 'ss';
        }
        if (!empty($filters['category'])) {
            $where[] = "category_id = ?";
            $params[] = (int)$filters['category'];
            $types .= 'i';
        }
        if (!empty($filters['locality'])) {
            $where[] = "locality LIKE CONCAT('%', ?, '%')";
            $params[] = $filters['locality'];
            $types .= 's';
        }
        if (!empty($filters['is_free'])) {
            $where[] = "is_free = ?";
            $params[] = (int)($filters['is_free'] === '1');
            $types .= 'i';
        }
        if (!empty($filters['date_from'])) {
            $where[] = "start_datetime >= ?";
            $params[] = $filters['date_from'] . (strlen($filters['date_from']) === 10 ? ' 00:00:00' : '');
            $types .= 's';
        }
        if (!empty($filters['date_to'])) {
            $where[] = "start_datetime <= ?";
            $params[] = $filters['date_to'] . (strlen($filters['date_to']) === 10 ? ' 23:59:59' : '');
            $types .= 's';
        }
        // Furthest start first (latest upcoming at top; nearest / past toward bottom)
        $order = "ORDER BY start_datetime DESC";
        $whereSql = 'WHERE ' . implode(' AND ', $where);

        $sql = "SELECT id, title, slug, category_id, location, locality, start_datetime, end_datetime, is_free, price, image_url, featured
                FROM event_listings $whereSql $order LIMIT ? OFFSET ?";

        $stmt = $conn->prepare($sql);
        if ($types) {
            $typesFull = $types . 'ii';
            $bindValues = $params;
            $bindValues[] = $limit;
            $bindValues[] = $offset;
            $stmt->bind_param($typesFull, ...$bindValues);
        } else {
            $stmt->bind_param('ii', $limit, $offset);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = [];
        while ($row = $res->fetch_assoc()) { $rows[] = $row; }
        return $rows;
    } catch (Throwable $e) {
        error_log('Events: getEvents exception: ' . $e->getMessage());
        return [];
    }
}

function getEventCount(array $filters): int {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) { return 0; }

        $where = ["status IN ('scheduled','ongoing')"]; // only active
        $params = [];
        $types = '';

        if (!empty($filters['search'])) {
            $where[] = "(title LIKE CONCAT('%', ?, '%') OR location LIKE CONCAT('%', ?, '%'))";
            $params[] = $filters['search'];
            $params[] = $filters['search'];
            $types .= 'ss';
        }
        if (!empty($filters['category'])) {
            $where[] = "category_id = ?";
            $params[] = (int)$filters['category'];
            $types .= 'i';
        }
        if (!empty($filters['locality'])) {
            $where[] = "locality LIKE CONCAT('%', ?, '%')";
            $params[] = $filters['locality'];
            $types .= 's';
        }
        if (!empty($filters['is_free'])) {
            $where[] = "is_free = ?";
            $params[] = (int)($filters['is_free'] === '1');
            $types .= 'i';
        }
        if (!empty($filters['date_from'])) {
            $where[] = "start_datetime >= ?";
            $params[] = $filters['date_from'] . (strlen($filters['date_from']) === 10 ? ' 00:00:00' : '');
            $types .= 's';
        }
        if (!empty($filters['date_to'])) {
            $where[] = "start_datetime <= ?";
            $params[] = $filters['date_to'] . (strlen($filters['date_to']) === 10 ? ' 23:59:59' : '');
            $types .= 's';
        }
        $whereSql = 'WHERE ' . implode(' AND ', $where);
        $sql = "SELECT COUNT(*) AS cnt FROM event_listings $whereSql";
        $stmt = $conn->prepare($sql);
        if ($types) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        return (int)($row['cnt'] ?? 0);
    } catch (Throwable $e) {
        error_log('Events: getEventCount exception: ' . $e->getMessage());
        return 0;
    }
}

function getEventBySlug(string $slug): ?array {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) { return null; }
        $sql = "SELECT * FROM event_listings WHERE slug = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc() ?: null;
    } catch (Throwable $e) {
        error_log('Events: getEventBySlug exception: ' . $e->getMessage());
        return null;
    }
}

function getCategoryById(int $id): ?array {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) { return null; }
        $sql = "SELECT id, name, slug FROM event_categories WHERE id = ? AND is_active = 1 LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc() ?: null;
    } catch (Throwable $e) {
        error_log('Events: getCategoryById exception: ' . $e->getMessage());
        return null;
    }
}

function localityToSlug(string $locality): string {
    $slug = strtolower(trim($locality));
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    return trim($slug, '-');
}

function locationToVenueSlug(string $location): string {
    return localityToSlug($location);
}

function slugToLabel(string $slug): string {
    $label = str_replace('-', ' ', trim($slug));
    $label = preg_replace('/\s+/', ' ', $label);
    return ucwords($label);
}

function getEventsByVenue(string $venueLabel, int $limit, int $offset): array {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) { return []; }
        $sql = "SELECT id, title, slug, category_id, location, locality, start_datetime, end_datetime, is_free, price, image_url, featured
                FROM event_listings WHERE status IN ('scheduled','ongoing') AND location = ?
                ORDER BY start_datetime DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii', $venueLabel, $limit, $offset);
        $stmt->execute();
        $res = $stmt->get_result();
        $rows = [];
        while ($row = $res->fetch_assoc()) { $rows[] = $row; }
        return $rows;
    } catch (Throwable $e) {
        error_log('Events: getEventsByVenue exception: ' . $e->getMessage());
        return [];
    }
}

function getEventCountByVenue(string $venueLabel): int {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) { return 0; }
        $sql = "SELECT COUNT(*) AS cnt FROM event_listings WHERE status IN ('scheduled','ongoing') AND location = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $venueLabel);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        return (int)($row['cnt'] ?? 0);
    } catch (Throwable $e) {
        error_log('Events: getEventCountByVenue exception: ' . $e->getMessage());
        return 0;
    }
}

function validateEventSubmission(array $data): array {
    $errors = [];
    if (empty($data['title']) || strlen(trim($data['title'])) < 5) {
        $errors['title'] = 'Please provide a valid event title (min 5 chars).';
    }
    if (empty($data['location'])) {
        $errors['location'] = 'Please provide an event location.';
    }
    if (empty($data['start_datetime'])) {
        $errors['start_datetime'] = 'Please select a start date/time.';
    }
    if (!empty($data['organizer_email']) && !filter_var($data['organizer_email'], FILTER_VALIDATE_EMAIL)) {
        $errors['organizer_email'] = 'Please provide a valid email.';
    }
    if (empty($data['description']) || strlen(strip_tags($data['description'])) < 30) {
        $errors['description'] = 'Please add a description (min 30 chars).';
    }
    return $errors;
}

function approveSubmissionToListing(int $submissionId): bool {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) { return false; }

        // Fetch submission
        $s = $conn->prepare("SELECT * FROM event_submissions WHERE id = ? LIMIT 1");
        $s->bind_param('i', $submissionId);
        $s->execute();
        $sub = $s->get_result()->fetch_assoc();
        if (!$sub) { return false; }

        // Ensure unique slug
        $base = generateSlug($sub['title']);
        $slug = $base;
        $i = 1;
        $check = $conn->prepare("SELECT id FROM event_listings WHERE slug = ? LIMIT 1");
        while (true) {
            $check->bind_param('s', $slug);
            $check->execute();
            if ($check->get_result()->num_rows === 0) { break; }
            $slug = $base . '-' . (++$i);
        }

        // Insert into listings
        $ins = $conn->prepare("INSERT INTO event_listings (title, slug, category_id, organizer_id, organizer_name, organizer_email, organizer_phone, location, locality, start_datetime, end_datetime, is_all_day, is_free, price, tickets_url, website_url, image_url, description, featured, status) VALUES (?, ?, NULLIF(?,0), NULLIF(?,0), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 'scheduled')");
        $is_all_day = 0;
        $cat = !empty($sub['category_id']) ? (int)$sub['category_id'] : 0;
        $orgId = 0; // not used yet
        $websiteUrl = '';
        $ins->bind_param(
            'ssiisssssssiisssss',
            $sub['title'],            // s
            $slug,                    // s
            $cat,                     // i (nullable via NULLIF)
            $orgId,                   // i (nullable via NULLIF)
            $sub['organizer_name'],   // s
            $sub['organizer_email'],  // s
            $sub['organizer_phone'],  // s
            $sub['location'],         // s
            $sub['locality'],         // s
            $sub['start_datetime'],   // s
            $sub['end_datetime'],     // s
            $is_all_day,              // i
            $sub['is_free'],          // i
            $sub['price'],            // s
            $sub['tickets_url'],      // s
            $websiteUrl,              // s (website_url)
            $sub['image_url'],        // s
            $sub['description']       // s
        );
        if (!$ins->execute()) {
            error_log('Events: approve insert failed: ' . $ins->error);
            return false;
        }

        // Mark submission approved
        $up = $conn->prepare("UPDATE event_submissions SET status = 'approved' WHERE id = ?");
        $up->bind_param('i', $submissionId);
        $up->execute();
        return true;
    } catch (Throwable $e) {
        error_log('Events: approveSubmissionToListing failed: ' . $e->getMessage());
        return false;
    }
}

function rejectSubmission(int $submissionId, string $reason = ''): bool {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) { return false; }
        $up = $conn->prepare("UPDATE event_submissions SET status = 'rejected', admin_notes = ? WHERE id = ?");
        $up->bind_param('si', $reason, $submissionId);
        return $up->execute();
    } catch (Throwable $e) {
        error_log('Events: rejectSubmission failed: ' . $e->getMessage());
        return false;
    }
}

function eventsCanonicalBaseUrl(): string {
    return rtrim(defined('SITE_CANONICAL_BASE') ? SITE_CANONICAL_BASE : 'https://mycovai.in', '/');
}

function eventsDefaultOgImageUrl(): string {
    $base = eventsCanonicalBaseUrl();
    $path = defined('SITE_LOGO_URL') ? SITE_LOGO_URL : '/My-OMR-Logo.jpg';
    if (preg_match('#^https?://#i', $path)) {
        return $path;
    }
    return $base . '/' . ltrim($path, '/');
}

function eventsListingImageAbsolute(?string $image_url): string {
    if (empty($image_url)) {
        return eventsDefaultOgImageUrl();
    }
    if (preg_match('#^https?://#i', $image_url)) {
        return $image_url;
    }
    return eventsCanonicalBaseUrl() . '/' . ltrim($image_url, '/');
}

function eventsPublicEventUrl(string $slug): string {
    return eventsCanonicalBaseUrl() . '/local-events/event/' . rawurlencode($slug);
}

/** @return string[] */
function getCoimbatoreLocalitySelectOptions(): array {
    if (defined('COIMBATORE_LOCALITIES') && is_array(COIMBATORE_LOCALITIES)) {
        return COIMBATORE_LOCALITIES;
    }
    return [];
}

function normalizeSubmittedLocality(string $raw): string {
    $raw = trim($raw);
    if ($raw === '') {
        return '';
    }
    foreach (getCoimbatoreLocalitySelectOptions() as $loc) {
        if (strcasecmp($loc, $raw) === 0) {
            return $loc;
        }
    }
    return $raw;
}

/**
 * Listings that may duplicate this submission (same venue + overlapping time window).
 * @return array<int, array<string,mixed>>
 */
function getDuplicateListingsForSubmission(int $submissionId): array {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) {
            return [];
        }
        $s = $conn->prepare('SELECT id, title, location, start_datetime, end_datetime FROM event_submissions WHERE id = ? LIMIT 1');
        $s->bind_param('i', $submissionId);
        $s->execute();
        $sub = $s->get_result()->fetch_assoc();
        if (!$sub) {
            return [];
        }
        $loc = trim((string)$sub['location']);
        if ($loc === '') {
            return [];
        }
        $subStart = $sub['start_datetime'];
        $subEnd = !empty($sub['end_datetime'])
            ? $sub['end_datetime']
            : date('Y-m-d H:i:s', strtotime($sub['start_datetime'] . ' +3 hours'));

        $sql = "SELECT id, title, slug, start_datetime, end_datetime, location
                FROM event_listings
                WHERE status IN ('scheduled','ongoing')
                AND LOWER(TRIM(location)) = LOWER(?)
                AND start_datetime < ?
                AND COALESCE(end_datetime, DATE_ADD(start_datetime, INTERVAL 3 HOUR)) > ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $loc, $subEnd, $subStart);
        $stmt->execute();
        $res = $stmt->get_result();
        $out = [];
        $subTitle = strtolower(preg_replace('/\s+/', ' ', trim((string)$sub['title'])));
        while ($row = $res->fetch_assoc()) {
            if (strlen($subTitle) < 4) {
                $out[] = $row;
                continue;
            }
            $lt = strtolower(preg_replace('/\s+/', ' ', trim((string)$row['title'])));
            similar_text($subTitle, $lt, $pct);
            $prefix = substr($subTitle, 0, min(12, strlen($subTitle)));
            if ($pct >= 35.0 || ($prefix !== '' && strpos($lt, $prefix) !== false)) {
                $out[] = $row;
            }
        }
        return $out;
    } catch (Throwable $e) {
        error_log('Events: getDuplicateListingsForSubmission: ' . $e->getMessage());
        return [];
    }
}

/** Mark past listings as archived. Returns rows affected. */
function archivePastEventListings(): int {
    try {
        global $conn;
        if (!isset($conn) || !$conn || $conn->connect_error) {
            return 0;
        }
        $sql = "UPDATE event_listings SET status = 'archived'
                WHERE status IN ('scheduled','ongoing')
                AND COALESCE(end_datetime, DATE_ADD(start_datetime, INTERVAL 2 HOUR)) < NOW()";
        if ($conn->query($sql)) {
            return (int)$conn->affected_rows;
        }
        return 0;
    } catch (Throwable $e) {
        error_log('Events: archivePastEventListings: ' . $e->getMessage());
        return 0;
    }
}

function formatEventDateRangeDisplay(string $start, ?string $end): string {
    $ts = strtotime($start);
    if (empty($end)) {
        return date('M j, Y g:i a', $ts);
    }
    $te = strtotime($end);
    if (date('Y-m-d', $ts) === date('Y-m-d', $te)) {
        return date('M j, Y', $ts) . ', ' . date('g:i a', $ts) . ' – ' . date('g:i a', $te);
    }
    return date('M j, Y g:i a', $ts) . ' – ' . date('M j, Y g:i a', $te);
}


