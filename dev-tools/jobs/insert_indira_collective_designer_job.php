<?php
/**
 * Insert or update The Indira Collective designer hiring post on live DB.
 *
 * Usage:
 *   php dev-tools/jobs/insert_indira_collective_designer_job.php
 */
if (php_sapi_name() !== 'cli') {
    die("CLI only.\n");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$conn->set_charset('utf8mb4');

$employerData = [
    'company_name'   => 'The Indira Collective',
    'contact_person' => 'Hiring Team',
    'email'          => 'theindiracollective@gmail.com',
    'phone'          => '9655652515',
    'address'        => 'Coimbatore',
    'website'        => '',
    'status'         => 'verified',
];

$jobData = [
    'title'        => 'Graphic Designer – Logo, Flyer, Social Media & Apparel',
    'category'     => 'sales-marketing',
    'job_type'     => 'Full-time',
    'location'     => 'Coimbatore',
    'salary_range' => 'From ₹12,000 per month',
    'description'  => implode("\n", [
        'Dear AC Family,',
        '',
        'We are looking for creative minds to join us on an exciting long-term journey.',
        '',
        'Immediate requirements:',
        '1. Logo, flyer and social media poster designers',
        '2. Apparel / T-shirt graphic designers',
        '',
        'If one person can handle multiple design categories, that would be a huge plus.',
        '',
        'Interns and freelancers are wholeheartedly welcome. Stipend is paid for interns.',
        '',
        'How to apply:',
        'Kindly WhatsApp or email your portfolio / previous work. We will get back to you. No calls, please.',
        'WhatsApp: 96556 52515',
        'Email: theindiracollective@gmail.com',
    ]),
    'requirements' => implode("\n", [
        'Unique and creative thinkers',
        'Friendly and easy-going personalities',
        'Freshers and experienced candidates both welcome',
        'People who can grow along with our team in the long run',
        'Passion for startup culture, creativity and adaptability',
        'Portfolio or samples of previous design work',
    ]),
    'benefits'     => implode("\n", [
        'Long-term growth opportunity with a creative team',
        'Open to interns and freelancers; stipend for interns',
        'Welcoming environment for enthusiastic youngsters and beginners',
        'Salary from ₹12,000 per month (may vary based on experience, creativity and skill set)',
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
        $updateEmployer->execute([
            $employerData['company_name'],
            $employerData['contact_person'],
            $employerData['phone'],
            $employerData['address'],
            $employerData['website'],
            $employerData['status'],
            $employerId,
        ]);
        $updateEmployer->close();
    } else {
        $insertEmployer = $conn->prepare("
            INSERT INTO employers (company_name, contact_person, email, phone, address, website, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $insertEmployer->execute([
            $employerData['company_name'],
            $employerData['contact_person'],
            $employerData['email'],
            $employerData['phone'],
            $employerData['address'],
            $employerData['website'],
            $employerData['status'],
        ]);
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
    $findJob->execute([$jobData['title'], $jobData['location']]);
    $jobResult = $findJob->get_result();

    if ($row = $jobResult->fetch_assoc()) {
        $jobId = (int) $row['id'];
        $updateJob = $conn->prepare("
            UPDATE job_postings
            SET employer_id = ?, category = ?, job_type = ?, salary_range = ?, description = ?, requirements = ?, benefits = ?,
                application_deadline = ?, status = ?, featured = ?, updated_at = NOW()
            WHERE id = ?
        ");
        $updateJob->execute([
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
            $jobId,
        ]);
        $updateJob->close();
        $action = 'updated';
    } else {
        $insertJob = $conn->prepare("
            INSERT INTO job_postings
                (employer_id, title, category, job_type, location, salary_range, description, requirements, benefits, application_deadline, status, featured)
            VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $insertJob->execute([
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
            $jobData['featured'],
        ]);
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
