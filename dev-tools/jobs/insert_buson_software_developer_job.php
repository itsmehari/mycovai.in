<?php
/**
 * Insert or update Buson Digital Services software developer & customer support job on live DB.
 *
 * Usage:
 *   php dev-tools/jobs/insert_buson_software_developer_job.php
 */
if (php_sapi_name() !== 'cli') {
    die("This script must be run from the command line.\n");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$conn->set_charset('utf8mb4');

$employerData = [
    'company_name'   => 'Buson Digital Services India Pvt. Ltd.',
    'contact_person' => 'Hiring Team',
    'email'          => 'support@buson.in',
    'phone'          => '+91 76734 39937',
    'address'        => '206/3, 2nd Floor, Devarajan Center, Sathyamurthy Road, Ram Nagar, Coimbatore 641009',
    'website'        => 'https://www.buson.in',
    'status'         => 'verified',
];

$applyUrl = 'https://connectsblue.com/jobs/software-developer-and-customer-support-buson-digital-coimbatore';

$jobData = [
    'title'        => 'Software Developer & Customer Support',
    'category'     => 'it',
    'job_type'     => 'Full-time',
    'location'     => 'Coimbatore, Tamil Nadu',
    'salary_range' => 'Competitive (freshers & experienced)',
    'description'  => implode("\n", [
        'Buson Digital Services India Pvt. Ltd., a Coimbatore-based technology company specialising in ERP, CRM and business intelligence solutions, is hiring a Software Developer & Customer Support professional.',
        '',
        'Passionate about software development and customer support? Join Buson Digital and build innovative business solutions while working with real clients.',
        '',
        'Key responsibilities:',
        '• Develop and maintain software applications',
        '• Support clients with product implementation and issue resolution',
        '• Troubleshoot technical issues and provide timely solutions',
        '• Work with development and support teams',
        '• Ensure smooth customer onboarding and product usage',
        '',
        'How to apply:',
        'Apply online via ConnectsBlue: ' . $applyUrl,
        'You can also reach the team at support@buson.in or +91 76734 39937.',
    ]),
    'requirements' => implode("\n", [
        'Degree in Computer Science, IT or a related field',
        'Knowledge of .NET, React and web technologies',
        'Good communication and customer handling skills',
        'Problem-solving mindset',
        'Freshers and experienced candidates both welcome',
    ]),
    'benefits'     => implode("\n", [
        'Full-time role in Coimbatore',
        'Work on ERP, CRM and business software products',
        'Exposure to real client implementations and support',
        'Suitable for freshers and experienced professionals',
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
