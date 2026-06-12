<?php
if (php_sapi_name() !== 'cli') {
    die("CLI only.\n");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$conn->set_charset('utf8mb4');

$title = 'Front Office Executive';
$stmt = $conn->prepare("
    SELECT jp.id, jp.title, jp.location, jp.salary_range, jp.status, e.company_name, e.email
    FROM job_postings jp
    INNER JOIN employers e ON e.id = jp.employer_id
    WHERE jp.title = ?
    ORDER BY jp.id DESC
    LIMIT 1
");
$stmt->bind_param('s', $title);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . PHP_EOL;
} else {
    echo "NOT_FOUND\n";
    exit(1);
}

exit(0);
