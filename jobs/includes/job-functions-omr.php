<?php
/**
 * Job Portal Helper Functions
 * Central functions for the MyOMR Job Portal
 * 
 * @package MyOMR Job Portal
 * @version 1.0.0
 */

/**
 * Get all job listings with filters
 * 
 * @param array $filters Array of filters (category, location, job_type, search)
 * @param int $limit Number of results per page
 * @param int $offset Offset for pagination
 * @return array Array of job postings
 */
function getJobListings($filters = [], $limit = 20, $offset = 0) {
    require_once __DIR__ . '/../../core/omr-connect.php';
    global $conn;

    if (!isset($conn) || !$conn instanceof mysqli) {
        error_log('getJobListings(): $conn is null or invalid');
        return [];
    }
    
    // Check connection is valid
    if ($conn->connect_error) {
        error_log('getJobListings(): Connection error: ' . $conn->connect_error);
        return [];
    }
    
    // Start with simplest possible query - direct query first to verify data exists
    $limitInt = (int)$limit;
    $offsetInt = (int)$offset;
    
    // First, try direct query to get basic jobs (most reliable)
    $directSql = "SELECT * FROM job_postings 
                  WHERE status = 'approved' 
                  ORDER BY featured DESC, created_at DESC 
                  LIMIT {$limitInt} OFFSET {$offsetInt}";
    
    error_log('getJobListings(): Trying direct query: ' . $directSql);
    $directResult = $conn->query($directSql);
    
    if ($directResult && $directResult->num_rows > 0) {
        $rows = $directResult->fetch_all(MYSQLI_ASSOC);
        error_log('getJobListings(): Direct query succeeded, returned ' . count($rows) . ' rows');
        
        // Now enrich with JOIN data if we got results
        if (!empty($rows)) {
            $jobIds = array_column($rows, 'id');
            
            // Only try enrichment if we have job IDs
            if (!empty($jobIds)) {
                $placeholders = implode(',', array_fill(0, count($jobIds), '?'));
                
                // Get employer and category data
                $enrichSql = "SELECT j.id, e.company_name, e.contact_person, e.email as employer_email, 
                                    e.phone as employer_phone, e.address as company_address, c.name as category_name
                             FROM job_postings j
                             LEFT JOIN employers e ON j.employer_id = e.id
                             LEFT JOIN job_categories c ON j.category = c.slug
                             WHERE j.id IN ({$placeholders})";
                
                $enrichStmt = $conn->prepare($enrichSql);
                if ($enrichStmt) {
                    $types = str_repeat('i', count($jobIds));
                    if ($enrichStmt->bind_param($types, ...$jobIds)) {
                        if ($enrichStmt->execute()) {
                            $enrichResult = $enrichStmt->get_result();
                            if ($enrichResult) {
                                $enrichData = [];
                                while ($row = $enrichResult->fetch_assoc()) {
                                    $enrichData[$row['id']] = $row;
                                }
                                
                                // Merge enrichment data
                                foreach ($rows as &$row) {
                                    if (isset($enrichData[$row['id']])) {
                                        $row['company_name'] = $enrichData[$row['id']]['company_name'] ?? null;
                                        $row['contact_person'] = $enrichData[$row['id']]['contact_person'] ?? null;
                                        $row['employer_email'] = $enrichData[$row['id']]['employer_email'] ?? null;
                                        $row['employer_phone'] = $enrichData[$row['id']]['employer_phone'] ?? null;
                                        $row['company_address'] = $enrichData[$row['id']]['company_address'] ?? null;
                                        $row['category_name'] = $enrichData[$row['id']]['category_name'] ?? null;
                                    }
                                }
                            } else {
                                error_log('getJobListings(): Enrichment get_result failed: ' . $enrichStmt->error);
                            }
                        } else {
                            error_log('getJobListings(): Enrichment execute failed: ' . $enrichStmt->error);
                        }
                    } else {
                        error_log('getJobListings(): Enrichment bind_param failed: ' . $enrichStmt->error);
                    }
                    $enrichStmt->close();
                } else {
                    error_log('getJobListings(): Enrichment prepare failed: ' . $conn->error);
                }
            }
        }
        
        // Apply filters if needed (check if any filter has a value)
        $hasFilters = !empty(array_filter($filters, function($v) { return $v !== '' && $v !== null; }));
        if ($hasFilters) {
            $filteredRows = [];
            foreach ($rows as $row) {
                $match = true;
                
                if (!empty($filters['category']) && $row['category'] !== $filters['category']) {
                    $match = false;
                }
                if (!empty($filters['location']) && stripos($row['location'], $filters['location']) === false) {
                    $match = false;
                }
                if (!empty($filters['job_type']) && $row['job_type'] !== $filters['job_type']) {
                    $match = false;
                }
                if (!empty($filters['search'])) {
                    $searchLower = strtolower($filters['search']);
                    $searchMatch = (
                        stripos($row['title'], $filters['search']) !== false ||
                        stripos($row['description'], $filters['search']) !== false ||
                        (!empty($row['company_name']) && stripos($row['company_name'], $filters['search']) !== false)
                    );
                    if (!$searchMatch) {
                        $match = false;
                    }
                }
                
                if ($match) {
                    $filteredRows[] = $row;
                }
            }
            $rows = $filteredRows;
        }
        
        return $rows;
    } else {
        // Direct query failed or returned 0 rows - debug
        error_log('getJobListings(): Direct query failed or returned 0 rows. Error: ' . ($conn->error ?? 'None'));
        
        // Check what statuses actually exist
        $statusCheck = $conn->query("SELECT status, COUNT(*) as count FROM job_postings GROUP BY status");
        if ($statusCheck) {
            while ($statusRow = $statusCheck->fetch_assoc()) {
                error_log('getJobListings(): Status "' . addslashes($statusRow['status']) . '" = ' . $statusRow['count'] . ' jobs');
            }
        }
        
        // Try with LOWER/TRIM as fallback
        $fallbackSql = "SELECT * FROM job_postings 
                        WHERE LOWER(TRIM(status)) = 'approved' 
                        ORDER BY featured DESC, created_at DESC 
                        LIMIT {$limitInt} OFFSET {$offsetInt}";
        $fallbackResult = $conn->query($fallbackSql);
        if ($fallbackResult && $fallbackResult->num_rows > 0) {
            error_log('getJobListings(): Fallback query with LOWER/TRIM returned ' . $fallbackResult->num_rows . ' rows');
            return $fallbackResult->fetch_all(MYSQLI_ASSOC);
        }
        
        return [];
    }
}

/**
 * Get single job by ID
 * 
 * @param int $job_id Job ID
 * @return array|null Job details or null
 */
function getJobById($job_id) {
    require_once __DIR__ . '/../../core/omr-connect.php';
    global $conn;
    if (!isset($conn) || !$conn instanceof mysqli) {
        error_log('getJobById(): $conn is null or invalid');
        return null;
    }
    
    $stmt = $conn->prepare("SELECT j.*, e.company_name, e.contact_person, e.email as employer_email, 
                                   e.phone as employer_phone, e.address as company_address,
                                   c.name as category_name
                            FROM job_postings j
                            LEFT JOIN employers e ON j.employer_id = e.id
                            LEFT JOIN job_categories c ON j.category = c.slug
                            WHERE j.id = ? AND j.status = 'approved'");
    if (!$stmt) { error_log('getJobById(): prepare() failed: ' . $conn->error); return null; }
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}

/**
 * Get total job count with filters
 * 
 * @param array $filters Array of filters
 * @return int Total count
 */
function getJobCount($filters = []) {
    require_once __DIR__ . '/../../core/omr-connect.php';
    global $conn;

    if (!isset($conn) || !$conn instanceof mysqli) {
        error_log('getJobCount(): $conn is null or invalid');
        return 0;
    }
    
    // Check connection is valid
    if ($conn->connect_error) {
        error_log('getJobCount(): Connection error: ' . $conn->connect_error);
        return 0;
    }
    
    // Simple direct query first - same approach as getJobListings
    $countSql = "SELECT COUNT(*) as total FROM job_postings WHERE status = 'approved'";
    error_log('getJobCount(): Executing query: ' . $countSql);
    $countResult = $conn->query($countSql);
    
    if ($countResult) {
        $row = $countResult->fetch_assoc();
        $total = (int)($row['total'] ?? 0);
        error_log('getJobCount(): Direct query returned: ' . $total);
        
        // Check if any filters have values (same logic as getJobListings)
        $hasFilters = !empty(array_filter($filters, function($v) { return $v !== '' && $v !== null; }));
        
        if ($hasFilters) {
            error_log('getJobCount(): Filters applied, getting filtered count');
            // Get all approved jobs and count filtered ones
            $allJobsSql = "SELECT * FROM job_postings WHERE status = 'approved'";
            $allJobsResult = $conn->query($allJobsSql);
            if ($allJobsResult) {
                $allJobs = $allJobsResult->fetch_all(MYSQLI_ASSOC);
                $filteredCount = 0;
                
                foreach ($allJobs as $job) {
                    $match = true;
                    
                    if (!empty($filters['category']) && $job['category'] !== $filters['category']) {
                        $match = false;
                    }
                    if (!empty($filters['location']) && stripos($job['location'] ?? '', $filters['location']) === false) {
                        $match = false;
                    }
                    if (!empty($filters['job_type']) && $job['job_type'] !== $filters['job_type']) {
                        $match = false;
                    }
                    if (!empty($filters['search'])) {
                        $searchMatch = (
                            stripos($job['title'] ?? '', $filters['search']) !== false ||
                            stripos($job['description'] ?? '', $filters['search']) !== false
                        );
                        if (!$searchMatch && !empty($job['employer_id'])) {
                            // Check company name if we have employer data
                            $employerSql = "SELECT company_name FROM employers WHERE id = " . (int)$job['employer_id'];
                            $empResult = $conn->query($employerSql);
                            if ($empResult && $empRow = $empResult->fetch_assoc()) {
                                if (stripos($empRow['company_name'] ?? '', $filters['search']) !== false) {
                                    $searchMatch = true;
                                }
                            }
                        }
                        if (!$searchMatch) {
                            $match = false;
                        }
                    }
                    
                    if ($match) {
                        $filteredCount++;
                    }
                }
                
                error_log('getJobCount(): Filtered count: ' . $filteredCount);
                return $filteredCount;
            } else {
                error_log('getJobCount(): Failed to get all jobs for filtering: ' . $conn->error);
                // Return total if filtering fails
                return $total;
            }
        }
        
        error_log('getJobCount(): No filters, returning total: ' . $total);
        return $total;
    } else {
        error_log('getJobCount(): Direct query failed: ' . $conn->error);
        // Try fallback with LOWER/TRIM
        $fallbackCount = $conn->query("SELECT COUNT(*) AS total FROM job_postings WHERE LOWER(TRIM(status)) = 'approved'");
        if ($fallbackCount) {
            $fbRow = $fallbackCount->fetch_assoc();
            $fallbackTotal = (int)($fbRow['total'] ?? 0);
            error_log('getJobCount(): Fallback query returned: ' . $fallbackTotal);
            return $fallbackTotal;
        }
        error_log('getJobCount(): Both queries failed, returning 0');
        return 0;
    }
}

/**
 * Get all job categories
 * 
 * @return array Array of categories
 */
function getJobCategories() {
    try {
        require_once __DIR__ . '/../../core/omr-connect.php';
        global $conn;
        
        if (!isset($conn) || !$conn) {
            error_log("Database connection not available in getJobCategories()");
            if (defined('DEVELOPMENT_MODE') && DEVELOPMENT_MODE) {
                error_log("getJobCategories() DEBUG: \$conn is not set or is null");
            }
            return [];
        }
        
        // Verify connection is valid
        if ($conn->connect_error) {
            error_log("Database connection error in getJobCategories(): " . $conn->connect_error);
            return [];
        }
        
        // Try querying with is_active = 1 first
        $sql = "SELECT * FROM job_categories WHERE is_active = 1 ORDER BY name";
        $result = $conn->query($sql);
        
        // Check if query failed or returned no rows
        if (!$result) {
            error_log("Error in getJobCategories() query: " . $conn->error);
            // Fallback: try without is_active filter
            $sql = "SELECT * FROM job_categories ORDER BY name";
            $result = $conn->query($sql);
            
            if (!$result) {
                error_log("Error in getJobCategories() fallback query: " . $conn->error);
                return [];
            }
        }
        
        // Check if we have results
        if ($result->num_rows === 0) {
            error_log("getJobCategories() found 0 categories with is_active=1, trying all categories");
            // Try without is_active filter (in case all are 0 or NULL)
            $sql = "SELECT * FROM job_categories ORDER BY name";
            $result = $conn->query($sql);
            
            if (!$result) {
                error_log("Error in getJobCategories() without filter: " . $conn->error);
                return [];
            }
            
            if ($result->num_rows === 0) {
                error_log("getJobCategories() found 0 categories total in database");
                return [];
            }
        }
        
        // Fetch results
        $categories = [];
        if (method_exists($result, 'fetch_all')) {
            $categories = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Fallback for older PHP versions
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        
        // Debug logging in development mode
        if (defined('DEVELOPMENT_MODE') && DEVELOPMENT_MODE) {
            error_log("getJobCategories() SUCCESS: Found " . count($categories) . " categories");
            if (count($categories) > 0) {
                error_log("getJobCategories() First category: " . print_r($categories[0], true));
            }
        }
        
        return $categories;
    } catch (Exception $e) {
        error_log("Exception in getJobCategories(): " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());
        return [];
    } catch (Error $e) {
        error_log("Fatal error in getJobCategories(): " . $e->getMessage());
        error_log("File: " . $e->getFile() . " Line: " . $e->getLine());
        return [];
    }
}

/**
 * Create SEO-friendly slug from text
 * 
 * @param string $text Text to slugify
 * @return string Slug
 */
function createSlug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}

/**
 * Sanitize input to prevent XSS
 * 
 * @param string $data Input data
 * @return string Sanitized data
 */
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email format
 * 
 * @param string $email Email address
 * @return bool True if valid
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number (Indian format)
 * 
 * @param string $phone Phone number
 * @return bool True if valid
 */
function validatePhone($phone) {
    // Indian phone: 10 digits, optionally starts with +
    return preg_match('/^(\+91)?[0-9]{10}$/', $phone);
}

/**
 * Format salary range for display
 * 
 * @param string $salary Salary range string
 * @return string Formatted salary
 */
function formatSalary($salary) {
    if (empty($salary) || $salary === 'Not Disclosed') {
        return 'Competitive';
    }
    return '₹' . $salary;
}

/**
 * Increment job view count
 * 
 * @param int $job_id Job ID
 */
function incrementJobViews($job_id) {
    require_once __DIR__ . '/../../core/omr-connect.php';
    global $conn;
    if (!isset($conn) || !$conn instanceof mysqli) { return; }
    
    $stmt = $conn->prepare("UPDATE job_postings SET views = views + 1 WHERE id = ?");
    if (!$stmt) { return; }
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
}

/**
 * Get related jobs (same category)
 * 
 * @param int $job_id Current job ID
 * @param string $category Job category
 * @param int $limit Number of related jobs
 * @return array Array of related jobs
 */
function getRelatedJobs($job_id, $category, $limit = 3) {
    require_once __DIR__ . '/../../core/omr-connect.php';
    global $conn;
    if (!isset($conn) || !$conn instanceof mysqli) { return []; }
    
    $stmt = $conn->prepare("SELECT j.*, e.company_name
                            FROM job_postings j
                            LEFT JOIN employers e ON j.employer_id = e.id
                            WHERE j.category = ? AND j.id != ? AND j.status = 'approved'
                            ORDER BY j.created_at DESC
                            LIMIT ?");
    if (!$stmt) { return []; }
    $stmt->bind_param("sii", $category, $job_id, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Check if user already applied for job
 * 
 * @param int $job_id Job ID
 * @param string $email Applicant email
 * @return bool True if already applied
 */
function hasUserApplied($job_id, $email) {
    require_once __DIR__ . '/../../core/omr-connect.php';
    global $conn;
    if (!isset($conn) || !$conn instanceof mysqli) { return false; }
    
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM job_applications WHERE job_id = ? AND applicant_email = ?");
    if (!$stmt) { return false; }
    $stmt->bind_param("is", $job_id, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    return $row['count'] > 0;
}

/**
 * Generate pagination HTML
 * 
 * @param int $current_page Current page number
 * @param int $total_pages Total number of pages
 * @param string $base_url Base URL for pagination
 * @return string HTML pagination
 */
function generatePagination($current_page, $total_pages, $base_url) {
    if ($total_pages <= 1) {
        return '';
    }

    $buildPageUrl = function (int $page) use ($base_url) {
        $trimmedBase = rtrim($base_url, "?&");
        if ($page <= 1) {
            return $trimmedBase;
        }

        $separator = (strpos($trimmedBase, '?') !== false) ? '&' : '?';

        return $trimmedBase . $separator . 'page=' . $page;
    };

    $html = '<nav aria-label="Job listings pagination"><ul class="pagination justify-content-center">';

    // Previous button
    if ($current_page > 1) {
        $previousUrl = htmlspecialchars($buildPageUrl($current_page - 1), ENT_QUOTES, 'UTF-8');
        $html .= '<li class="page-item"><a class="page-link" href="' . $previousUrl . '">Previous</a></li>';
    } else {
        $html .= '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
    }

    // Page numbers
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            $html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
        } else {
            $pageUrl = htmlspecialchars($buildPageUrl($i), ENT_QUOTES, 'UTF-8');
            $html .= '<li class="page-item"><a class="page-link" href="' . $pageUrl . '">' . $i . '</a></li>';
        }
    }

    // Next button
    if ($current_page < $total_pages) {
        $nextUrl = htmlspecialchars($buildPageUrl($current_page + 1), ENT_QUOTES, 'UTF-8');
        $html .= '<li class="page-item"><a class="page-link" href="' . $nextUrl . '">Next</a></li>';
    } else {
        $html .= '<li class="page-item disabled"><span class="page-link">Next</span></li>';
    }

    $html .= '</ul></nav>';

    return $html;
}

