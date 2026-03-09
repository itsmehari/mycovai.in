-- MyCovai: Consolidated Coimbatore seed data (single file)
-- Target DB: metap8ok_mycovai
-- Run after main structure import (metap8ok_mycovai-main.sql).
-- Each section TRUNCATEs then INSERTs so this script is safe to re-run (replaces seed data).
-- Foreign key checks are disabled during run so TRUNCATE works on tables referenced by FKs.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- =============================================================================
-- 1. List of Areas (Coimbatore localities)
-- =============================================================================
CREATE TABLE IF NOT EXISTS `List of Areas` (
  `Sl No` int(10) NOT NULL AUTO_INCREMENT,
  `Areas` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Sl No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

TRUNCATE TABLE `List of Areas`;
INSERT INTO `List of Areas` (`Sl No`, `Areas`) VALUES
(1, 'RS Puram'),
(2, 'Gandhipuram'),
(3, 'Peelamedu'),
(4, 'Ukkadam'),
(5, 'Saibaba Koil'),
(6, 'Townhall'),
(7, 'Rathinapuri'),
(8, 'Tatabad'),
(9, 'Ramnagar'),
(10, 'Singanallur'),
(11, 'Saravanampatti'),
(12, 'Kalapatti'),
(13, 'Podanur'),
(14, 'Sivananda Colony'),
(15, 'Race Course'),
(16, 'Gopalapuram'),
(17, 'Sidhapudur'),
(18, 'Kottaimedu'),
(19, 'Selvapuram'),
(20, 'Avarampalayam'),
(21, 'Sukrawarpettai'),
(22, 'Ramanathapuram'),
(23, 'Vadavalli'),
(24, 'Thudiyalur'),
(25, 'Kuniyamuthur');

-- =============================================================================
-- 2. Event categories & Job categories
-- =============================================================================
-- (No TRUNCATE: event_listings has FK to event_categories. Use ON DUPLICATE KEY UPDATE instead.)
INSERT INTO `event_categories` (`id`, `name`, `slug`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 'Community', 'community', 1, 1, NOW(), NULL),
(2, 'Education & Workshops', 'education-workshops', 1, 2, NOW(), NULL),
(3, 'Sports & Fitness', 'sports-fitness', 1, 3, NOW(), NULL),
(4, 'Arts & Culture', 'arts-culture', 1, 4, NOW(), NULL),
(5, 'Business & Networking', 'business-networking', 1, 5, NOW(), NULL)
ON DUPLICATE KEY UPDATE
  `name` = VALUES(`name`),
  `slug` = VALUES(`slug`),
  `is_active` = VALUES(`is_active`),
  `display_order` = VALUES(`display_order`),
  `updated_at` = NOW();

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
(10, 'Other', 'other', 'General and miscellaneous positions', 1, NOW())
ON DUPLICATE KEY UPDATE
  `name` = VALUES(`name`),
  `slug` = VALUES(`slug`),
  `description` = VALUES(`description`),
  `is_active` = VALUES(`is_active`);

-- =============================================================================
-- 3. Articles (Coimbatore local news)
-- =============================================================================
TRUNCATE TABLE `articles`;
INSERT INTO `articles` (`title`, `slug`, `summary`, `content`, `published_date`, `author`, `category`, `tags`, `image_path`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(
  'Multi-level car parking facility to come up on KG Theatre Road, Coimbatore',
  'multi-level-car-parking-kg-theatre-road-coimbatore',
  'Coimbatore Corporation is building a multi-level car parking facility at KG Theatre Road junction at Rs 9.5 crore to ease traffic congestion on Race Course Road and Government Arts College Road.',
  '<p>Coimbatore City Municipal Corporation (CCMC) has proposed a multi-level car parking facility at the KG Theatre Road junction. The project, estimated at Rs 9.5 crore, aims to address traffic congestion on Race Course Road and Government Arts College Road. Initial debris removal and encroachment clearance work began in late February 2025.</p><p>The facility will provide much-needed parking space for visitors and shoppers in the busy commercial area, reducing on-road parking and improving traffic flow.</p>',
  '2025-02-26 10:00:00',
  'MyCovai Editorial Team',
  'Infrastructure',
  'Coimbatore, KG Theatre Road, car parking, CCMC, Race Course, traffic',
  NULL,
  1,
  'published',
  NOW(),
  NOW()
),
(
  'Ukkadam bus terminus plan tweaked for Metro Rail in Coimbatore',
  'ukkadam-bus-terminus-metro-rail-coimbatore',
  'CCMC has submitted a revised DPR for twin bus terminals at Ukkadam (Rs 21 crore), aligned with the upcoming Metro Rail project. Ukkadam will be a hub for all four metro corridors.',
  '<p>The Coimbatore Corporation has submitted a revised detailed project report (DPR) to the Directorate of Municipal Administration for twin bus terminals at Ukkadam, estimated at Rs 21 crore. The plan was modified to accommodate the upcoming Metro Rail project, which will make Ukkadam a major hub for all four metro corridors.</p><p>In addition, the 50-year-old Gandhipuram bus stand is set to be demolished and replaced with a new facility at an estimated cost of Rs 30 crore.</p>',
  '2025-02-18 10:00:00',
  'MyCovai Editorial Team',
  'Infrastructure',
  'Coimbatore, Ukkadam, bus terminus, Metro Rail, Gandhipuram, CCMC',
  NULL,
  1,
  'published',
  NOW(),
  NOW()
),
(
  'Noyyal river front development: Coimbatore gets Rs 202.5 crore from Tamil Nadu government',
  'noyyal-river-front-development-coimbatore-202-crore',
  'The Coimbatore corporation has received Rs 202.5 crore from the Tamil Nadu government for the Noyyal river front development project, boosting green and recreational space along the river.',
  '<p>The Tamil Nadu government has allocated Rs 202.5 crore to the Coimbatore Corporation for the Noyyal river front development project. The initiative aims to restore and develop the river front, creating green spaces and recreational facilities for residents.</p><p>The project is part of broader efforts to improve urban ecology and quality of life in Coimbatore.</p>',
  '2025-02-20 10:00:00',
  'MyCovai Editorial Team',
  'Development',
  'Coimbatore, Noyyal, river front, development, Tamil Nadu government',
  NULL,
  0,
  'published',
  NOW(),
  NOW()
),
(
  'RS Puram new flower market begins operations; Corporation hikes rent by 25%',
  'rs-puram-flower-market-operations-rent-hike-coimbatore',
  'The new RS Puram flower market (Panneer Slevan market) began full operations with 122 platform shops and 28 permanent shops. Coimbatore Corporation has increased rental rates by 25%.',
  '<p>The new R.S. Puram flower market (Panneer Slevan market) has begun full operations following renovation. The facility features 122 platform shops and 28 permanent shops. The Coimbatore Corporation has increased rental rates by 25%, with vendors reporting improved facilities despite the rent hike.</p><p>The old market on Rangai Gounder Street has been closed, and the new market is now the primary flower market for the RS Puram area.</p>',
  '2025-02-15 10:00:00',
  'MyCovai Editorial Team',
  'Local News',
  'Coimbatore, RS Puram, flower market, Panneer Slevan, Corporation',
  NULL,
  0,
  'published',
  NOW(),
  NOW()
),
(
  'E-permits for quarries to be expanded to all taluks in Coimbatore district',
  'e-permits-quarries-coimbatore-district-taluks',
  'The e-permit system for stone quarry operations is being expanded to all taluks in Coimbatore district to streamline mining and prevent overloading. It was first implemented in Pollachi and Kinathukkadavu.',
  '<p>The e-permit system for stone quarry operations in Coimbatore district is being expanded to all taluks. The system was first implemented in Pollachi and Kinathukkadavu taluks in February 2025, with plans to extend it to the remaining taluks. The move aims to streamline mining operations and prevent overloading, ensuring better regulation and environmental compliance.</p>',
  '2025-02-16 10:00:00',
  'MyCovai Editorial Team',
  'Local News',
  'Coimbatore, quarries, e-permits, Pollachi, Kinathukkadavu, mining',
  NULL,
  0,
  'published',
  NOW(),
  NOW()
),
(
  'Gandhipuram bus stand to be rebuilt at Rs 30 crore',
  'gandhipuram-bus-stand-rebuild-coimbatore-30-crore',
  'The 50-year-old Gandhipuram bus stand will be demolished and a new bus stand constructed at an estimated cost of Rs 30 crore, as part of Coimbatore''s transport hub upgrades.',
  '<p>Coimbatore Corporation has planned the demolition of the 50-year-old Gandhipuram bus stand and the construction of a new facility at an estimated cost of Rs 30 crore. The project is part of broader upgrades to the city''s transport infrastructure, including the Ukkadam terminus and Metro Rail integration.</p><p>Gandhipuram is one of the busiest commercial and transport nodes in Coimbatore.</p>',
  '2025-02-18 14:00:00',
  'MyCovai Editorial Team',
  'Infrastructure',
  'Coimbatore, Gandhipuram, bus stand, CCMC, transport',
  NULL,
  0,
  'published',
  NOW(),
  NOW()
),
(
  'Tamil Nadu MoUs target Rs 35,000 crore investment and 76,795 new jobs',
  'tamil-nadu-mous-investment-jobs-coimbatore',
  'Tamil Nadu signed 59 MoUs targeting Rs 35,000 crore investment and 76,795 new jobs. Coimbatore and other districts are set to benefit from the industrial and employment push.',
  '<p>Tamil Nadu has signed 59 memoranda of understanding (MoUs) targeting Rs 35,000 crore in investment and 76,795 new jobs across the state. Coimbatore, as a major industrial and textile hub, is among the districts set to benefit from the new projects and employment opportunities.</p><p>The state government has been actively promoting investment in manufacturing, IT, and renewable energy.</p>',
  '2025-02-22 10:00:00',
  'MyCovai Editorial Team',
  'Business',
  'Coimbatore, Tamil Nadu, MoU, investment, jobs, industry',
  NULL,
  1,
  'published',
  NOW(),
  NOW()
),
(
  'Residents call for better maintenance of Smart City info boards in RS Puram',
  'smart-city-info-boards-rs-puram-coimbatore-maintenance',
  'Residents have raised concerns over poor maintenance of Smart City information boards along D.B. Road in RS Puram. Of around 70 boards, barely 10 are fully functional.',
  '<p>Residents in R.S. Puram have called for better maintenance of the information boards installed along D.B. Road under the Smart Cities Mission. Of approximately 70 boards featuring local leaders and activists, barely 10 are fully functional, with many showing damaged or non-working digital displays. Each board cost around Rs 12,500 to develop. The feedback has been shared with the Coimbatore Corporation for corrective action.</p>',
  '2025-02-10 10:00:00',
  'MyCovai Editorial Team',
  'Local News',
  'Coimbatore, RS Puram, Smart City, D.B. Road, info boards',
  NULL,
  0,
  'published',
  NOW(),
  NOW()
);

-- =============================================================================
-- 4. Banks (omrbankslist)
-- =============================================================================
TRUNCATE TABLE `omrbankslist`;
INSERT INTO `omrbankslist` (`slno`, `bankname`, `address`, `locality`, `contact`, `landmark`, `website`, `slug`, `verified`) VALUES
(1, 'State Bank of India', 'DB Road, RS Puram', 'RS Puram', '0422 254 5678', 'Near DB Road Junction', 'https://www.onlinesbi.sbi', 'sbi-rs-puram', 1),
(2, 'HDFC Bank', 'Cross Cut Road, Gandhipuram', 'Gandhipuram', '0422 221 2345', 'Opposite Gandhipuram Bus Stand', 'https://www.hdfcbank.com', 'hdfc-gandhipuram', 1),
(3, 'ICICI Bank', 'Avinashi Road, Peelamedu', 'Peelamedu', '0422 257 8901', 'Near Peelamedu Junction', 'https://www.icicibank.com', 'icici-peelamedu', 1),
(4, 'Canara Bank', 'Town Hall, Coimbatore', 'Townhall', '0422 239 4567', 'Near Town Hall', 'https://canarabank.com', 'canara-townhall', 1),
(5, 'Indian Overseas Bank', '100 Feet Road, Saibaba Koil', 'Saibaba Koil', '0422 231 6789', 'Near Saibaba Temple', 'https://www.iob.in', 'iob-saibaba-koil', 1),
(6, 'Kotak Mahindra Bank', 'Lakshmi Mills, Coimbatore', 'Coimbatore', '0422 249 0123', 'Lakshmi Mills Junction', 'https://www.kotak.com', 'kotak-lakshmi-mills', 1),
(7, 'Axis Bank', 'Rathinapuri Main Road', 'Rathinapuri', '0422 234 5678', 'Rathinapuri Junction', 'https://www.axisbank.com', 'axis-rathinapuri', 1),
(8, 'Karur Vysya Bank', 'Tatabad, Coimbatore', 'Tatabad', '0422 245 9012', 'Tatabad Main Road', 'https://www.kvb.co.in', 'kvb-tatabad', 1);

-- =============================================================================
-- 5. Hospitals (omrhospitalslist)
-- =============================================================================
TRUNCATE TABLE `omrhospitalslist`;
INSERT INTO `omrhospitalslist` (`slno`, `hospitalname`, `address`, `locality`, `contact`, `landmark`, `website`, `type`, `slug`, `verified`) VALUES
(1, 'KG Hospital', '5/63, College Road', 'RS Puram', '0422 221 2121', 'Near Coimbatore Medical College', 'https://kghospital.com', 'Multi-speciality', 'kg-hospital', 1),
(2, 'Kovai Medical Center and Hospital', 'Avinashi Road, Peelamedu', 'Peelamedu', '0422 262 7788', 'KMCH Campus', 'https://www.kmchhospital.com', 'Multi-speciality', 'kmch-peelamedu', 1),
(3, 'PSG Hospitals', 'Avinashi Road, Peelamedu', 'Peelamedu', '0422 257 0170', 'PSG College of Technology Campus', 'https://www.psghospitals.com', 'Multi-speciality', 'psg-hospitals', 1),
(4, 'G Kuppuswamy Naidu Memorial Hospital', 'P B No 632, Nava India Road', 'Coimbatore', '0422 221 3500', 'Near Ukkadam', 'https://gknhospital.org', 'Multi-speciality', 'gkn-hospital', 1),
(5, 'Sri Ramakrishna Hospital', '395, Sarojini Naidu Road', 'Sidhapudur', '0422 450 0000', 'Near RS Puram', 'https://www.sriramakrishnahospital.org', 'Multi-speciality', 'sri-ramakrishna-hospital', 1),
(6, 'Aravind Eye Hospital', 'Avinashi Road, Coimbatore', 'Coimbatore', '0422 261 7000', 'Near Peelamedu', 'https://www.aravind.org', 'Eye Care', 'aravind-eye-covai', 1);

-- =============================================================================
-- 6. Parks (omrparkslist)
-- =============================================================================
TRUNCATE TABLE `omrparkslist`;
INSERT INTO `omrparkslist` (`slno`, `parkname`, `location`, `locality`, `area`, `features`, `timings`, `slug`, `verified`) VALUES
(1, 'VOC Park', 'VOC Park Road, Gandhipuram', 'Gandhipuram', 'Gandhipuram', 'Walking track, children play area, greenery', '5:00 AM - 9:00 PM', 'voc-park', 1),
(2, 'Race Course', 'Race Course Road', 'Race Course', 'Race Course', 'Walking track, jogging, equestrian', '5:00 AM - 8:00 PM', 'race-course-covai', 1),
(3, 'Periyakulam Lake Park', 'Periyakulam, Ukkadam', 'Ukkadam', 'Ukkadam', 'Lake view, walking, boating', '6:00 AM - 7:00 PM', 'periyakulam-park', 1),
(4, 'Brookefields Mall Park', 'Brookefields Mall, RS Puram', 'RS Puram', 'RS Puram', 'Open space, events', '10:00 AM - 10:00 PM', 'brookefields-park', 1),
(5, 'Singanallur Lake Park', 'Singanallur Lake Road', 'Singanallur', 'Singanallur', 'Lake, bird watching, walking', '6:00 AM - 6:00 PM', 'singanallur-lake-park', 1);

-- =============================================================================
-- 7. Government offices (omr_gov_offices)
-- =============================================================================
TRUNCATE TABLE `omr_gov_offices`;
INSERT INTO `omr_gov_offices` (`slno`, `office_name`, `address`, `locality`, `contact`, `landmark`, `slug`, `verified`) VALUES
(1, 'RTO Office Coimbatore Central', 'State Highway 79, Gandhipuram', 'Gandhipuram', '0422 230 2345', 'Near Gandhipuram Bus Stand', 'rto-coimbatore-central', 1),
(2, 'Coimbatore City Municipal Corporation', 'Town Hall, Coimbatore', 'Townhall', '0422 239 0261', 'Town Hall Building', 'coimbatore-corporation', 1),
(3, 'Coimbatore District Collector Office', 'Collectorate Campus, Coimbatore', 'Coimbatore', '0422 230 5200', 'Near RS Puram', 'district-collector-covai', 1),
(4, 'Coimbatore City Police Commissionerate', 'RS Puram, Coimbatore', 'RS Puram', '0422 230 0100', 'Commissionerate Building', 'police-commissionerate-covai', 1),
(5, 'Passport Seva Kendra Coimbatore', 'Avinashi Road, Peelamedu', 'Peelamedu', '0422 257 1234', 'Near Peelamedu Junction', 'passport-covai', 1),
(6, 'ESI Dispensary Coimbatore', 'Gandhipuram', 'Gandhipuram', '0422 221 3456', 'ESI Hospital Road', 'esi-dispensary-covai', 1);

-- =============================================================================
-- 8. Restaurants (omr_restaurants) — geolocation: POINT(longitude latitude)
-- =============================================================================
TRUNCATE TABLE `omr_restaurants`;
INSERT INTO `omr_restaurants` (`id`, `name`, `address`, `locality`, `cuisine`, `cost_for_two`, `rating`, `availability`, `accessibility`, `reviews`, `imagelocation`, `geolocation`, `slug`, `verified`) VALUES
(1, 'Anandhas', '1081, Avinashi Road, Peelamedu', 'Peelamedu', 'South Indian, North Indian', 400, 4.2, 'Lunch, Dinner', 'Parking, AC', 'Popular for meals and biryani.', '', ST_GeomFromText('POINT(76.9570 11.0310)'), 'anandhas-peelamedu', 1),
(2, 'Sree Annapoorna', 'Opposite Gandhipuram Bus Stand', 'Gandhipuram', 'South Indian', 150, 4.0, 'Breakfast, Lunch', 'Central location', 'Famous for ghee roast and coffee.', '', ST_GeomFromText('POINT(76.9520 11.0180)'), 'sree-annapoorna-gandhipuram', 1),
(3, 'Shree Krishna Sweets', 'RS Puram, DB Road', 'RS Puram', 'South Indian, Sweets', 300, 4.3, 'All day', 'Parking, AC', 'Sweets and meals.', '', ST_GeomFromText('POINT(76.9480 11.0120)'), 'shree-krishna-sweets-rs-puram', 1),
(4, 'Barbeque Nation', 'Brookefields Mall, RS Puram', 'RS Puram', 'North Indian, BBQ', 1200, 4.1, 'Lunch, Dinner', 'Mall parking, AC', 'Buffet and grill.', '', ST_GeomFromText('POINT(76.9500 11.0140)'), 'barbeque-nation-brookefields', 1),
(5, 'Hotel Dhaba', 'Avinashi Road, Coimbatore', 'Peelamedu', 'North Indian, Punjabi', 500, 4.0, 'Lunch, Dinner', 'Parking', 'North Indian and tandoor.', '', ST_GeomFromText('POINT(76.9580 11.0280)'), 'hotel-dhaba-avinashi', 1);

-- =============================================================================
-- 9. Schools (omr_schools)
-- =============================================================================
TRUNCATE TABLE `omr_schools`;
INSERT INTO `omr_schools` (`school_id`, `school_name`, `address`, `city`, `pincode`, `curriculum`, `fees_annual`, `contact_number`, `email`, `website`, `established_year`, `grades_offered`, `student_teacher_ratio`, `total_students`, `rating`, `infrastructure`, `extracurricular`, `transport_available`, `boarding_available`, `principal_name`, `affiliation_number`, `medium_of_instruction`, `admission_process`, `last_updated`, `google_maps_link`) VALUES
(1, 'PSG Sarvajana Higher Secondary School', 'Avinashi Road, Peelamedu', 'Coimbatore', '641004', 'State Board', 25000.00, '0422 257 2345', 'school@psg.in', 'https://www.psgps.org', 1926, '1-12', '25:1', 3500, 4.5, 'Labs, library, sports', 'Sports, arts, NCC', 1, 0, NULL, NULL, 'Tamil, English', 'Merit and application', NOW(), NULL),
(2, 'Sri Krishna International School', 'Kovaipudur, Coimbatore', 'Coimbatore', '641042', 'CBSE', 85000.00, '0422 262 5678', 'info@skis.in', 'https://www.srikrishnaschool.org', 1995, 'LKG-12', '20:1', 2800, 4.4, 'Smart classes, labs', 'Sports, robotics, music', 1, 0, NULL, NULL, 'English', 'Entrance and application', NOW(), NULL),
(3, 'Bharatiya Vidya Bhavan', 'Race Course Road', 'Coimbatore', '641018', 'CBSE', 70000.00, '0422 221 3456', 'bvb@bhavans.net', 'https://www.bhavanscovai.org', 1982, 'LKG-12', '22:1', 2200, 4.3, 'Library, labs, auditorium', 'Sports, cultural', 1, 0, NULL, NULL, 'English', 'Application and interaction', NOW(), NULL),
(4, 'SBOA School and Junior College', 'Avinashi Road, Civil Aerodrome Post', 'Coimbatore', '641014', 'State Board, CBSE', 45000.00, '0422 257 8901', 'sboa@sboadschool.com', 'https://www.sboadschool.com', 1975, 'LKG-12', '24:1', 3000, 4.2, 'Labs, playground', 'Sports, clubs', 1, 0, NULL, NULL, 'English, Tamil', 'Merit', NOW(), NULL),
(5, 'St. Francis Anglo-Indian Higher Secondary School', 'Hopes College Road, Coimbatore', 'Coimbatore', '641018', 'State Board', 35000.00, '0422 221 2345', 'stfrancis@sfais.in', NULL, 1885, '1-12', '26:1', 2500, 4.3, 'Heritage campus, labs', 'Sports, music', 1, 0, NULL, NULL, 'English', 'Application', NOW(), NULL);

-- =============================================================================
-- 10. IT parks (omr_it_parks)
-- =============================================================================
TRUNCATE TABLE `omr_it_parks`;
INSERT INTO `omr_it_parks` (`id`, `name`, `locality`, `address`, `phone`, `website`, `inauguration_year`, `owner`, `built_up_area`, `total_area`, `image`, `lat`, `lng`, `verified`, `amenity_sez`, `amenity_parking`, `amenity_cafeteria`, `amenity_shuttle`) VALUES
(1, 'Tidel Park Coimbatore', 'Saravanampatti', 'Tidel Park Road, Saravanampatti', '0422 710 0000', 'https://www.tidelpark.co.in', '2010', 'TIDCO', '5 lakh sq ft', '25 acres', NULL, 11.0690, 76.9980, 1, 1, 1, 1, 1),
(2, 'ELCOT IT Park Coimbatore', 'Vedapatti', 'ELCOT IT Park, Vedapatti', '0422 231 5678', 'https://elcot.in', '2008', 'ELCOT', '3 lakh sq ft', '15 acres', NULL, 11.0520, 76.9650, 1, 1, 1, 1, 0),
(3, 'Kovai Industrial Park', 'Saravanampatti', 'Kovai Industrial Park, Saravanampatti', NULL, NULL, '2012', 'Private', '2 lakh sq ft', '10 acres', NULL, 11.0720, 77.0050, 1, 0, 1, 1, 0),
(4, 'Coimbatore Tech Park', 'Kalapatti', 'Kalapatti Road, Coimbatore', NULL, NULL, '2015', 'Private', '1.5 lakh sq ft', '8 acres', NULL, 11.0880, 77.0180, 1, 0, 1, 1, 0);

SET FOREIGN_KEY_CHECKS = 1;
-- End of seed-covai-all.sql
