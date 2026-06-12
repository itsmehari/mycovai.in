<?php
/**
 * Insert or update Dharshe Designers Boutique tailor hiring post on live DB.
 *
 * Usage:
 *   php dev-tools/jobs/insert_dharshe_designers_tailor_job.php
 */
if (php_sapi_name() !== 'cli') {
    die("CLI only.\n");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$conn->set_charset('utf8mb4');

$employerData = [
    'company_name'   => 'Dharshe Designers Boutique',
    'contact_person' => 'Hiring Team',
    'email'          => 'dharshedesigners@mycovai.in',
    'phone'          => '7708424611',
    'address'        => '166 West Sambandham Road, R.S. Puram, Coimbatore',
    'website'        => '',
    'status'         => 'verified',
];

$jobData = [
    'title'        => 'Experienced Tailors – Urgent Hiring',
    'category'     => 'other',
    'job_type'     => 'Full-time / Part-time',
    'location'     => 'R.S. Puram, Coimbatore',
    'salary_range' => 'Good salary (competitive)',
    'description'  => implode("\n", [
        'Urgently hiring experienced tailors for Dharshe Designers Boutique, Coimbatore.',
        '',
        'Open positions: Experienced Tailors',
        '',
        'We welcome both full-time and part-time candidates. Immediate joining preferred.',
        '',
        'How to apply:',
        'Call or WhatsApp: 7708424611 / 9047059999',
        '',
        'Address: 166 West Sambandham Road, R.S. Puram, Coimbatore',
    ]),
    'requirements' => implode("\n", [
        'Minimum 5 years tailoring experience preferred',
        'Skilled in boutique / designer garment work',
        'Full-time or part-time candidates welcome',
    ]),
    'benefits'     => implode("\n", [
        'Good salary',
        'Weekly payment option available',
        'Sunday holiday',
        'Friendly work atmosphere',
    ]),
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
    echo "Success: Job {$action}. Job ID: {$jobId}. Employer ID: {$employerId}" . PHP_EOL;
} catch (Throwable $e) {
    $conn->rollback();
    fwrite(STDERR, "Failed: " . $e->getMessage() . PHP_EOL);
    exit(1);
}

exit(0);
