-- MyCovai: Seed event_categories and job_categories (region-agnostic)
-- Target DB: metap8ok_mycovai
-- Run after main structure import. Same categories as MyOMR; reusable for Coimbatore.

-- ========== event_categories ==========
INSERT INTO `event_categories` (`id`, `name`, `slug`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 'Community', 'community', 1, 1, NOW(), NULL),
(2, 'Education & Workshops', 'education-workshops', 1, 2, NOW(), NULL),
(3, 'Sports & Fitness', 'sports-fitness', 1, 3, NOW(), NULL),
(4, 'Arts & Culture', 'arts-culture', 1, 4, NOW(), NULL),
(5, 'Business & Networking', 'business-networking', 1, 5, NOW(), NULL);

-- ========== job_categories ==========
INSERT INTO `job_categories` (`id`, `name`, `slug`, `description`, `is_active`, `created_at`) VALUES
(1, 'Information Technology', 'it', 'Software development, IT support, and technology roles', 1, NOW()),
(2, 'Teaching & Education', 'teaching-education', 'Teachers, tutors, and educational staff', 1, NOW()),
(3, 'Healthcare', 'healthcare', 'Medical, nursing, and healthcare professionals', 1, NOW()),
(4, 'Sales & Marketing', 'sales-marketing', 'Sales representatives and marketing professionals', 1, NOW()),
(5, 'Construction', 'construction', 'Construction, architecture, and engineering', 1, NOW()),
(6, 'Hospitality', 'hospitality', 'Restaurant, hotel, and service industry', 1, NOW()),
(7, 'Finance & Accounting', 'finance-accounting', 'Accountants, financial analysts, and bookkeepers', 1, NOW()),
(8, 'Engineering', 'engineering', 'Mechanical, civil, and other engineering roles', 1, NOW()),
(9, 'Customer Service', 'customer-service', 'Call center, support, and customer care', 1, NOW()),
(10, 'Other', 'other', 'General and miscellaneous positions', 1, NOW());
