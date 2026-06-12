<?php
if (php_sapi_name() !== 'cli') {
    die("CLI only.\n");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$conn->set_charset('utf8mb4');

$title = 'Kitchen Commi & Housekeeping Staff';
$location = 'Coimbatore';
$status = 'approved';

$stmt = $conn->prepare("UPDATE job_postings SET status = ?, updated_at = NOW() WHERE title = ? AND location = ?");
$stmt->bind_param('sss', $status, $title, $location);
$stmt->execute();

echo "Updated rows: " . $stmt->affected_rows . PHP_EOL;
exit(0);
