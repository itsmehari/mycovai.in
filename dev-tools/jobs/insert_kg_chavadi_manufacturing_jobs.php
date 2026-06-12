<?php
/**
 * Insert or update KG Chavadi manufacturing facility job postings (4 listings).
 *
 * Usage:
 *   php dev-tools/jobs/insert_kg_chavadi_manufacturing_jobs.php
 */
if (php_sapi_name() !== 'cli') {
    die("This script must be run from the command line.\n");
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli('mycovai.in:3306', 'metap8ok_myomr_admin', 'myomr@123', 'metap8ok_mycovai');
$conn->set_charset('utf8mb4');

$employerData = [
    'company_name'   => 'Manufacturing Facility – KG Chavadi',
    'contact_person' => 'Sameer',
    'email'          => 'kgchavadi.manufacturing@mycovai.in',
    'phone'          => '9731133773',
    'address'        => 'KG Chavadi, Coimbatore',
    'website'        => '',
    'status'         => 'verified',
];

$sharedIntro = "Job opportunities at our Coimbatore facility, KG Chavadi.\n\nContact: Sameer | Phone: 97311-33773\n\nYour reference for the below position(s) would be highly appreciated.";

$jobs = [
    [
        'title'        => 'Machinist, Lathe Operator & Trainee',
        'category'     => 'engineering',
        'job_type'     => 'Full-time',
        'location'     => 'KG Chavadi, Coimbatore',
        'salary_range' => '₹15,000 – ₹30,000 per month (role dependent)',
        'description'  => $sharedIntro . "\n\nOpen positions:\n• Machinist – 1 No. | Salary: ₹25,000 – ₹30,000\n• Conventional Lathe Operator – 1 No. | Salary: ₹20,000 – ₹25,000\n• Trainee – 1 No. | Salary: ₹15,000 – ₹20,000\n\nQualification: ITI / Diploma (all positions).",
        'requirements' => implode("\n", [
            'ITI or Diploma qualification',
            'Good working knowledge of turning operations on a conventional lathe',
            'Experience handling jobs from small dia to large dia up to 1.5 m',
            'Drawing reading and understanding capability',
            'Hands-on experience on traditional milling machine is an added advantage',
        ]),
        'benefits'     => 'Apply by calling Sameer: 97311-33773',
    ],
    [
        'title'        => 'Welder',
        'category'     => 'construction',
        'job_type'     => 'Full-time',
        'location'     => 'KG Chavadi, Coimbatore',
        'salary_range' => '₹15,000 – ₹20,000 per month',
        'description'  => $sharedIntro . "\n\nOpen position:\n• Welder – 1 No. | Salary: ₹15,000 – ₹20,000\n\nQualification: ITI Welding.",
        'requirements' => implode("\n", [
            'ITI Welding qualification',
            'Good working knowledge in SMAW, GTAW (TIG), and GMAW (MIG)',
            'Welding capability in carbon steels, stainless steel, and alloy steels',
            'Welder qualification certificate is an added advantage',
        ]),
        'benefits'     => 'Apply by calling Sameer: 97311-33773',
    ],
    [
        'title'        => 'Fitter',
        'category'     => 'engineering',
        'job_type'     => 'Full-time',
        'location'     => 'KG Chavadi, Coimbatore',
        'salary_range' => '₹18,000 – ₹20,000 per month',
        'description'  => $sharedIntro . "\n\nOpen position:\n• Fitter – 1 No. | Salary: ₹18,000 – ₹20,000\n\nQualification: ITI.",
        'requirements' => implode("\n", [
            'ITI qualification',
            'Hands-on experience in SMAW, GTAW (TIG), and GMAW (MIG) welding techniques',
            'Drawing reading and understanding capability',
            'Capable of fabricating vessels, structures, piping, tanks, and similar products',
        ]),
        'benefits'     => 'Apply by calling Sameer: 97311-33773',
    ],
    [
        'title'        => 'Mechanical & Electrical Assembly Technicians',
        'category'     => 'engineering',
        'job_type'     => 'Full-time',
        'location'     => 'KG Chavadi, Coimbatore',
        'salary_range' => '₹18,000 – ₹25,000 per month (role dependent)',
        'description'  => $sharedIntro . "\n\nMechanical assembly:\n• Mechanical Assembly – 2 Nos. | Salary: ₹22,000 – ₹25,000\n• Trainee – 1 No. | Salary: ₹18,000 – ₹20,000\nQualification: ITI / Diploma\n\nElectrical:\n• Electrical Technician – 1 No. | Salary: ₹22,000 – ₹25,000\n• Trainee – 1 No. | Salary: ₹18,000 – ₹20,000\nQualification: ITI – Electrical",
        'requirements' => implode("\n", [
            'Mechanical: ITI/Diploma; experience in assembly of machinery, compressors, engines; read drawings; handle tools and equipment',
            'Electrical: ITI Electrical; electrical maintenance, wiring, control panel wiring; understand electrical drawings; electrical safety',
        ]),
        'benefits'     => 'Apply by calling Sameer: 97311-33773',
    ],
];

$status = 'approved';
$featured = 0;
$applicationDeadline = null;

$conn->begin_transaction();

try {
    $employerId = null;
    $findEmployer = $conn->prepare('SELECT id FROM employers WHERE email = ? LIMIT 1');
    $findEmployer->bind_param('s', $employerData['email']);
    $findEmployer->execute();
    $employerResult = $findEmployer->get_result();

    if ($row = $employerResult->fetch_assoc()) {
        $employerId = (int) $row['id'];
        $updateEmployer = $conn->prepare('
            UPDATE employers
            SET company_name = ?, contact_person = ?, phone = ?, address = ?, website = ?, status = ?, updated_at = NOW()
            WHERE id = ?
        ');
        $updateEmployer->bind_param(
            'ssssssi',
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
        $insertEmployer = $conn->prepare('
            INSERT INTO employers (company_name, contact_person, email, phone, address, website, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $insertEmployer->bind_param(
            'sssssss',
            $employerData['company_name'],
            $employerData['contact_person'],
            $employerData['email'],
            $employerData['phone'],
            $employerData['address'],
            $employerData['website'],
            $employerData['status']
        );
        $insertEmployer->execute();
        $employerId = (int) $insertEmployer->insert_id;
        $insertEmployer->close();
    }
    $findEmployer->close();

    if (!$employerId) {
        throw new RuntimeException('Unable to resolve employer ID.');
    }

    $findJob = $conn->prepare('SELECT id FROM job_postings WHERE title = ? AND location = ? ORDER BY id DESC LIMIT 1');
    $updateJob = $conn->prepare('
        UPDATE job_postings
        SET employer_id = ?, category = ?, job_type = ?, salary_range = ?, description = ?, requirements = ?, benefits = ?,
            application_deadline = ?, status = ?, featured = ?, updated_at = NOW()
        WHERE id = ?
    ');
    $insertJob = $conn->prepare('
        INSERT INTO job_postings
            (employer_id, title, category, job_type, location, salary_range, description, requirements, benefits, application_deadline, status, featured)
        VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ');

    foreach ($jobs as $jobData) {
        $findJob->bind_param('ss', $jobData['title'], $jobData['location']);
        $findJob->execute();
        $jobResult = $findJob->get_result();
        $row = $jobResult->fetch_assoc();
        $jobResult->free();

        if ($row) {
            $jobId = (int) $row['id'];
            $updateJob->execute([
                $employerId,
                $jobData['category'],
                $jobData['job_type'],
                $jobData['salary_range'],
                $jobData['description'],
                $jobData['requirements'],
                $jobData['benefits'],
                $applicationDeadline,
                $status,
                $featured,
                $jobId,
            ]);
            echo "Updated job ID {$jobId}: {$jobData['title']}" . PHP_EOL;
        } else {
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
                $applicationDeadline,
                $status,
                $featured,
            ]);
            $jobId = (int) $insertJob->insert_id;
            echo "Inserted job ID {$jobId}: {$jobData['title']}" . PHP_EOL;
        }
    }

    $findJob->close();
    $updateJob->close();
    $insertJob->close();

    $conn->commit();
    echo "Done. Employer ID: {$employerId}" . PHP_EOL;
} catch (Throwable $e) {
    $conn->rollback();
    fwrite(STDERR, 'Failed: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}

exit(0);
