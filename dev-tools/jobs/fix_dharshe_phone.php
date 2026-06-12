<?php
if (php_sapi_name() !== 'cli') {
    die("CLI only.\n");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$conn->set_charset('utf8mb4');

$phone = '7708424611';
$stmt = $conn->prepare("UPDATE employers SET phone = ?, updated_at = NOW() WHERE company_name = 'Dharshe Designers Boutique'");
$stmt->bind_param('s', $phone);
$stmt->execute();
echo "Updated phone for employer. Rows: " . $stmt->affected_rows . PHP_EOL;
