<?php
/**
 * Verify KG Chavadi manufacturing job postings on live DB.
 */
if (php_sapi_name() !== 'cli') {
    die("CLI only.\n");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$conn->set_charset('utf8mb4');

require_once __DIR__ . '/../../jobs/includes/job-functions-covai.php';

$email = 'kgchavadi.manufacturing@mycovai.in';
$stmt = $conn->prepare('
    SELECT j.id, j.title, j.status, j.location, j.created_at, j.updated_at
    FROM job_postings j
    INNER JOIN employers e ON j.employer_id = e.id
    WHERE e.email = ?
    ORDER BY j.id
');
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();
$base = 'https://mycovai.in';

echo "KG Chavadi manufacturing jobs:\n";
while ($row = $res->fetch_assoc()) {
    $url = $base . getJobDetailUrl((int) $row['id'], $row['title']);
    echo sprintf(
        "  [%s] #%d %s\n      %s\n      created: %s | updated: %s\n",
        $row['status'],
        $row['id'],
        $row['title'],
        $url,
        $row['created_at'],
        $row['updated_at']
    );
}
$stmt->close();
