<?php
/**
 * Insert or update Siragugal Masala lady staff hiring post on live DB.
 *
 * Usage:
 *   php dev-tools/jobs/insert_siragugalmasala_lady_staff_job.php
 */
if (php_sapi_name() !== 'cli') {
    die("CLI only.\n");
}

require_once __DIR__ . '/../../jobs/includes/job-functions-covai.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$conn->set_charset('utf8mb4');

$employerData = [
    'company_name'   => 'Siragugal Masala',
    'contact_person' => 'Hiring Team',
    'email'          => 'siragugalmasala.covai@mycovai.in',
    'phone'          => '9150034141',
    'address'        => 'Nanjundapuram, Coimbatore',
    'website'        => '',
    'status'         => 'verified',
];

$jobData = [
    'title'        => 'Lady Staff – Coimbatore Branch (Urgent)',
    'category'     => 'sales-marketing',
    'job_type'     => 'Full-time',
    'location'     => 'Nanjundapuram, Coimbatore',
    'salary_range' => 'Not Disclosed',
    'description'  => implode("\n", [
        'URGENT REQUIREMENT — Lady Staff for our Coimbatore branch at Nanjundapuram.',
        '',
        'Siragugal Masala is hiring female staff for the Nanjundapuram branch.',
        '',
        'How to apply:',
        'Call or WhatsApp: 9150034141',
        '',
        'Source: Facebook job post (Siragugal Masala hiring group).',
    ]),
    'requirements' => implode("\n", [
        'Female candidates only',
        'Willing to work at Nanjundapuram, Coimbatore branch',
        'Freshers can apply',
    ]),
    'benefits'     => 'Branch role with Siragugal Masala.',
    'application_deadline' => null,
    'status'       => 'approved',
    'featured'     => 0,
];

$conn->begin_transaction();

try {
    $employerId = null;
    $findEmployer = $conn->prepare("SELECT id FROM employers WHERE email = ? LIMIT 1");
    $findEmployer->bind_param("s", $employerData['email']);
    $findEmployer->execute();
    $employerResult = $findEmployer->get_result();

    if ($row = $employerResult->fetch_assoc()) {
        $employerId = (int) $row['id'];
        $updateEmployer = $conn->prepare("
            UPDATE employers
            SET company_name = ?, contact_person = ?, phone = ?, address = ?, website = ?, status = ?, updated_at = NOW()
            WHERE id = ?
        ");
        $updateEmployer->bind_param(
            "ssssssi",
            $employerData['company_name'],
            $employerData['contact_person'],
            $employerData['phone'],
            $employerData['address'],
            $employerData['website'],
            $employerData['status'],
            $employerId
        );
        $updateEmployer->execute();
        $updateEmployer->close();
    } else {
        $insertEmployer = $conn->prepare("
            INSERT INTO employers (company_name, contact_person, email, phone, address, website, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $insertEmployer->bind_param(
            "sssssss",
            $employerData['company_name'],
            $employerData['contact_person'],
            $employerData['email'],
            $employerData['phone'],
            $employerData['address'],
            $employerData['website'],
            $employerData['status']
        );
        $insertEmployer->execute();
        $employerId = $insertEmployer->insert_id;
        $insertEmployer->close();
    }
    $findEmployer->close();

    if (!$employerId) {
        throw new RuntimeException('Unable to resolve employer ID.');
    }

    $jobId = null;
    $action = 'inserted';
    $findJob = $conn->prepare("SELECT id FROM job_postings WHERE title = ? AND location = ? ORDER BY id DESC LIMIT 1");
    $findJob->bind_param("ss", $jobData['title'], $jobData['location']);
    $findJob->execute();
    $jobResult = $findJob->get_result();

    if ($row = $jobResult->fetch_assoc()) {
        $jobId = (int) $row['id'];
        $updateJob = $conn->prepare("
            UPDATE job_postings
            SET employer_id = ?, category = ?, job_type = ?, salary_range = ?, description = ?, requirements = ?, benefits = ?,
                application_deadline = ?, status = ?, featured = ?, updated_at = NOW()
            WHERE id = ?
        ");
        $updateJob->bind_param(
            "issssssssii",
            $employerId,
            $jobData['category'],
            $jobData['job_type'],
            $jobData['salary_range'],
            $jobData['description'],
            $jobData['requirements'],
            $jobData['benefits'],
            $jobData['application_deadline'],
            $jobData['status'],
            $jobData['featured'],
            $jobId
        );
        $updateJob->execute();
        $updateJob->close();
        $action = 'updated';
    } else {
        $insertJob = $conn->prepare("
            INSERT INTO job_postings
                (employer_id, title, category, job_type, location, salary_range, description, requirements, benefits, application_deadline, status, featured)
            VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $insertJob->bind_param(
            "issssssssssi",
            $employerId,
            $jobData['title'],
            $jobData['category'],
            $jobData['job_type'],
            $jobData['location'],
            $jobData['salary_range'],
            $jobData['description'],
            $jobData['requirements'],
            $jobData['benefits'],
            $jobData['application_deadline'],
            $jobData['status'],
            $jobData['featured']
        );
        $insertJob->execute();
        $jobId = $insertJob->insert_id;
        $insertJob->close();
    }
    $findJob->close();

    $conn->commit();
    $publicUrl = 'https://mycovai.in' . getJobDetailUrl($jobId, $jobData['title']);
    echo "Success: Job {$action}. Job ID: {$jobId}. Employer ID: {$employerId}" . PHP_EOL;
    echo "Public URL: {$publicUrl}" . PHP_EOL;
} catch (Throwable $e) {
    $conn->rollback();
    fwrite(STDERR, "Failed: " . $e->getMessage() . PHP_EOL);
    exit(1);
}

exit(0);
