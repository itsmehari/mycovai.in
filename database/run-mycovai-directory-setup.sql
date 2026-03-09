-- =============================================================================
-- MyCovai Directory: Complete Setup (Drop OMR → Create Covai → Seed)
-- Run this ONE file in phpMyAdmin against metap8ok_mycovai
-- =============================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------------------------------
-- STEP 1: Drop OMR directory tables
-- -----------------------------------------------------------------------------
DROP TABLE IF EXISTS `omr_it_companies_featured`;
DROP TABLE IF EXISTS `omr_it_parks_featured`;
DROP TABLE IF EXISTS `omr_it_company_submissions`;
DROP TABLE IF EXISTS `omr_it_parks`;
DROP TABLE IF EXISTS `omr_it_companies`;
DROP TABLE IF EXISTS `omr_restaurants`;
DROP TABLE IF EXISTS `omr_industries`;
DROP TABLE IF EXISTS `omr_gov_offices`;
DROP TABLE IF EXISTS `omr_atms`;
DROP TABLE IF EXISTS `omrparkslist`;
DROP TABLE IF EXISTS `omr_schools`;
DROP TABLE IF EXISTS `omrschoolslist`;
DROP TABLE IF EXISTS `omrhospitalslist`;
DROP TABLE IF EXISTS `omrbankslist`;
DROP TABLE IF EXISTS `omrgovernmentofficeslist`;
DROP TABLE IF EXISTS `omrindustrieslist`;
DROP TABLE IF EXISTS `omratmslist`;

SET FOREIGN_KEY_CHECKS = 1;

-- -----------------------------------------------------------------------------
-- STEP 2: Create covai_* tables
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `covai_schools` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `schoolname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `locality` varchar(100) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `about` text DEFAULT NULL,
  `services` text DEFAULT NULL,
  `careers_url` varchar(500) DEFAULT NULL,
  `slug` varchar(260) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slno`),
  KEY `idx_schoolname` (`schoolname`),
  KEY `idx_locality` (`locality`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `covai_banks` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `bankname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `slug` varchar(260) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slno`),
  KEY `idx_bankname` (`bankname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `covai_hospitals` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `hospitalname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `locality` varchar(100) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `about` text DEFAULT NULL,
  `services` text DEFAULT NULL,
  `careers_url` varchar(500) DEFAULT NULL,
  `slug` varchar(260) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slno`),
  KEY `idx_hospitalname` (`hospitalname`),
  KEY `idx_locality` (`locality`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `covai_restaurants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `locality` varchar(100) NOT NULL,
  `cuisine` varchar(255) NOT NULL,
  `cost_for_two` int(11) NOT NULL DEFAULT 0,
  `rating` decimal(3,1) NOT NULL DEFAULT 0.0,
  `availability` varchar(255) DEFAULT NULL,
  `reviews` text DEFAULT NULL,
  `imagelocation` varchar(500) DEFAULT NULL,
  `geolocation` point DEFAULT NULL,
  `slug` varchar(260) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`),
  KEY `idx_locality` (`locality`),
  KEY `idx_cuisine` (`cuisine`),
  KEY `idx_rating` (`rating`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `covai_atms` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `bankname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `slug` varchar(260) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slno`),
  KEY `idx_bankname` (`bankname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `covai_parks` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `parkname` varchar(255) NOT NULL,
  `location` varchar(500) NOT NULL,
  `area` varchar(100) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `timings` varchar(100) DEFAULT NULL,
  `slug` varchar(260) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slno`),
  KEY `idx_parkname` (`parkname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `covai_industries` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `industry_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `industry_type` varchar(255) DEFAULT NULL,
  `locality` varchar(100) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `about` text DEFAULT NULL,
  `services` text DEFAULT NULL,
  `careers_url` varchar(500) DEFAULT NULL,
  `slug` varchar(260) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slno`),
  KEY `idx_industry_name` (`industry_name`),
  KEY `idx_locality` (`locality`),
  KEY `idx_industry_type` (`industry_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `covai_it_companies` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `industry_type` varchar(255) DEFAULT NULL,
  `locality` varchar(100) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `about` text DEFAULT NULL,
  `services` text DEFAULT NULL,
  `careers_url` varchar(500) DEFAULT NULL,
  `slug` varchar(260) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slno`),
  KEY `idx_company_name` (`company_name`),
  KEY `idx_locality` (`locality`),
  KEY `idx_industry_type` (`industry_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `covai_gov_offices` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `office_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `slug` varchar(260) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slno`),
  KEY `idx_office_name` (`office_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `covai_it_parks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `locality` varchar(100) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `inauguration_year` varchar(10) DEFAULT NULL,
  `owner` varchar(160) DEFAULT NULL,
  `built_up_area` varchar(80) DEFAULT NULL,
  `total_area` varchar(80) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `amenity_sez` tinyint(1) NOT NULL DEFAULT 0,
  `amenity_parking` tinyint(1) NOT NULL DEFAULT 0,
  `amenity_cafeteria` tinyint(1) NOT NULL DEFAULT 0,
  `amenity_shuttle` tinyint(1) NOT NULL DEFAULT 0,
  `lat` decimal(10,7) DEFAULT NULL,
  `lng` decimal(10,7) DEFAULT NULL,
  `companies` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`),
  KEY `idx_locality` (`locality`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `covai_it_companies_featured` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_slno` int(11) NOT NULL,
  `rank_position` int(11) NOT NULL DEFAULT 1,
  `blurb` varchar(400) DEFAULT NULL,
  `cta_text` varchar(80) DEFAULT NULL,
  `cta_url` varchar(255) DEFAULT NULL,
  `start_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `end_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_company_slno` (`company_slno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `covai_it_parks_featured` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `park_id` int(11) NOT NULL,
  `rank_position` int(11) NOT NULL DEFAULT 1,
  `blurb` varchar(400) DEFAULT NULL,
  `cta_text` varchar(80) DEFAULT NULL,
  `cta_url` varchar(255) DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_park_id` (`park_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------------------------------
-- STEP 3: Seed Coimbatore directory data
-- -----------------------------------------------------------------------------
INSERT INTO `covai_schools` (`schoolname`, `address`, `contact`, `landmark`, `locality`, `verified`, `about`, `services`, `careers_url`) VALUES
('PSG Sarvajana Higher Secondary School', 'Avinashi Road, Peelamedu, Coimbatore 641004', '0422 257 2345', 'Near PSG Tech', 'Peelamedu', 1, 'Est. 1926. State Board. Labs, library, sports.', 'Classes 1-12', NULL),
('Sri Krishna International School', 'Kovaipudur, Coimbatore 641042', '0422 262 5678', 'Kovaipudur Main Road', 'Kovaipudur', 1, 'CBSE school. Smart classes, labs.', 'LKG-12', NULL),
('Bharatiya Vidya Bhavan', 'Race Course Road, Coimbatore 641018', '0422 221 3456', 'Near Race Course', 'Race Course', 1, 'CBSE. Library, labs, auditorium.', 'LKG-12', NULL),
('SBOA School and Junior College', 'Avinashi Road, Civil Aerodrome Post, Coimbatore 641014', '0422 257 8901', 'Near Airport', 'Peelamedu', 1, 'State Board, CBSE. Labs, playground.', 'LKG-12', NULL),
('St. Francis Anglo-Indian Higher Secondary School', 'Hopes College Road, Coimbatore 641018', '0422 221 2345', 'Near Hope College', 'Race Course', 1, 'Est. 1885. Heritage campus.', '1-12', NULL),
('Chinmaya International Residential School', 'Coimbatore Road, Siruvani', '0422 264 7222', 'Siruvani Road', 'Coimbatore', 1, 'CBSE. Residential school.', '6-12', NULL),
('The Shishya School', 'Hopes College Road, Coimbatore 641018', '0422 221 1000', 'Near Hope College', 'Race Course', 1, 'IB curriculum.', 'PreK-12', NULL),
('Suguna PIP School', 'Kumaraguru College Road, Coimbatore', '0422 266 5432', 'Near Kumaraguru', 'Saravanampatti', 1, 'CBSE. Integrated program.', '1-12', NULL),
('Senthil Public School', 'Ramanathapuram, Coimbatore 641045', '0422 266 1234', 'Ramanathapuram', 'Ramanathapuram', 1, 'CBSE.', 'LKG-12', NULL),
('MVM Matriculation Higher Secondary School', 'Tatabad, Coimbatore 641012', '0422 245 6789', 'Tatabad Main Road', 'Tatabad', 1, 'Matriculation board.', '1-12', NULL);

INSERT INTO `covai_banks` (`bankname`, `address`, `contact`, `landmark`, `website`) VALUES
('State Bank of India', 'DB Road, RS Puram, Coimbatore 641002', '0422 254 5678', 'Near DB Road Junction', 'https://www.onlinesbi.sbi'),
('HDFC Bank', 'Cross Cut Road, Gandhipuram, Coimbatore 641012', '0422 221 2345', 'Opposite Gandhipuram Bus Stand', 'https://www.hdfcbank.com'),
('ICICI Bank', 'Avinashi Road, Peelamedu, Coimbatore 641004', '0422 257 8901', 'Near Peelamedu Junction', 'https://www.icicibank.com'),
('Canara Bank', 'Town Hall, Coimbatore 641001', '0422 239 4567', 'Near Town Hall', 'https://canarabank.com'),
('Indian Overseas Bank', '100 Feet Road, Saibaba Koil, Coimbatore 641011', '0422 231 6789', 'Near Saibaba Temple', 'https://www.iob.in'),
('Kotak Mahindra Bank', 'Lakshmi Mills, Coimbatore 641045', '0422 249 0123', 'Lakshmi Mills Junction', 'https://www.kotak.com'),
('Axis Bank', 'Rathinapuri Main Road, Coimbatore 641027', '0422 234 5678', 'Rathinapuri Junction', 'https://www.axisbank.com'),
('Karur Vysya Bank', 'Tatabad, Coimbatore 641012', '0422 245 9012', 'Tatabad Main Road', 'https://www.kvb.co.in'),
('Indian Bank', 'Gandhipuram, Coimbatore 641012', '0422 230 1234', 'Opposite Bus Stand', 'https://www.indianbank.in'),
('Union Bank of India', 'RS Puram, Coimbatore 641002', '0422 255 6789', 'Near DB Road', 'https://www.unionbankofindia.co.in');

INSERT INTO `covai_hospitals` (`hospitalname`, `address`, `contact`, `landmark`, `locality`, `verified`, `about`, `services`, `careers_url`) VALUES
('KG Hospital', '5/63, College Road, Coimbatore 641018', '0422 221 2121', 'Near Coimbatore Medical College', 'RS Puram', 1, 'Multi-speciality hospital.', 'Emergency, ICU, diagnostics', NULL),
('Kovai Medical Center and Hospital', 'Avinashi Road, Peelamedu, Coimbatore 641014', '0422 262 7788', 'KMCH Campus', 'Peelamedu', 1, 'Multi-speciality. NABH accredited.', 'Cardiology, neurology, ortho', NULL),
('PSG Hospitals', 'Avinashi Road, Peelamedu, Coimbatore 641004', '0422 257 0170', 'PSG College Campus', 'Peelamedu', 1, 'Teaching hospital. Multi-speciality.', 'Emergency, surgery, labs', NULL),
('G Kuppuswamy Naidu Memorial Hospital', 'Nava India Road, Coimbatore 641018', '0422 221 3500', 'Near Ukkadam', 'Ukkadam', 1, 'GKNM Hospital. Multi-speciality.', 'Cancer care, cardiology', NULL),
('Sri Ramakrishna Hospital', '395, Sarojini Naidu Road, Sidhapudur, Coimbatore 641044', '0422 450 0000', 'Near RS Puram', 'Sidhapudur', 1, 'SRH. Multi-speciality.', 'Emergency, ICU, labs', NULL),
('Aravind Eye Hospital', 'Avinashi Road, Coimbatore 641014', '0422 261 7000', 'Near Peelamedu', 'Peelamedu', 1, 'Eye care specialty.', 'Cataract, LASIK, retina', NULL);

INSERT INTO `covai_restaurants` (`name`, `address`, `locality`, `cuisine`, `cost_for_two`, `rating`, `availability`, `reviews`, `imagelocation`) VALUES
('Anandhas', '1081, Avinashi Road, Peelamedu, Coimbatore 641004', 'Peelamedu', 'South Indian, North Indian', 400, 4.2, 'Lunch, Dinner', 'Popular for meals and biryani.', ''),
('Sree Annapoorna', 'Opposite Gandhipuram Bus Stand, Coimbatore 641012', 'Gandhipuram', 'South Indian', 150, 4.0, 'Breakfast, Lunch', 'Famous for ghee roast and coffee.', ''),
('Shree Krishna Sweets', 'DB Road, RS Puram, Coimbatore 641002', 'RS Puram', 'South Indian, Sweets', 300, 4.3, 'All day', 'Sweets and meals.', ''),
('Barbeque Nation', 'Brookefields Mall, RS Puram, Coimbatore 641002', 'RS Puram', 'North Indian, BBQ', 1200, 4.1, 'Lunch, Dinner', 'Buffet and grill.', ''),
('Hotel Dhaba', 'Avinashi Road, Peelamedu, Coimbatore 641004', 'Peelamedu', 'North Indian, Punjabi', 500, 4.0, 'Lunch, Dinner', 'North Indian and tandoor.', ''),
('Annapoorna Gowrishankar', 'Gandhipuram, Coimbatore 641012', 'Gandhipuram', 'South Indian', 200, 4.2, 'Breakfast, Lunch, Dinner', 'Traditional meals.', ''),
('Thalappakatti', 'RS Puram, Coimbatore 641002', 'RS Puram', 'South Indian, Biryani', 500, 4.2, 'Lunch, Dinner', 'Famous biryani.', ''),
('Saravana Bhavan', 'Gandhipuram, Coimbatore 641012', 'Gandhipuram', 'South Indian', 250, 4.0, 'All day', 'Chain. South Indian.', '');

INSERT INTO `covai_atms` (`bankname`, `address`, `contact`, `landmark`) VALUES
('State Bank of India', 'DB Road, RS Puram, Coimbatore 641002', NULL, 'Near DB Road Junction'),
('HDFC Bank', 'Gandhipuram Bus Stand, Coimbatore 641012', NULL, 'Opposite Bus Stand'),
('ICICI Bank', 'Avinashi Road, Peelamedu, Coimbatore 641004', NULL, 'Peelamedu Junction'),
('Axis Bank', 'RS Puram, Coimbatore 641002', NULL, 'DB Road'),
('SBI', 'Town Hall, Coimbatore 641001', NULL, 'Town Hall'),
('HDFC Bank', 'Brookefields Mall, RS Puram, Coimbatore 641002', NULL, 'Mall Entrance'),
('Canara Bank', 'Saibaba Koil, Coimbatore 641011', NULL, '100 Feet Road'),
('Kotak Mahindra', 'Rathinapuri, Coimbatore 641027', NULL, 'Rathinapuri Main Road'),
('Indian Bank', 'Tatabad, Coimbatore 641012', NULL, 'Tatabad Junction'),
('SBI', 'Singanallur, Coimbatore 641005', NULL, 'Singanallur Main Road');

INSERT INTO `covai_parks` (`parkname`, `location`, `area`, `features`, `timings`) VALUES
('VOC Park', 'VOC Park Road, Gandhipuram, Coimbatore', 'Gandhipuram', 'Walking track, children play area, greenery', '5:00 AM - 9:00 PM'),
('Race Course', 'Race Course Road, Coimbatore 641018', 'Race Course', 'Walking track, jogging, equestrian', '5:00 AM - 8:00 PM'),
('Periyakulam Lake Park', 'Periyakulam, Ukkadam, Coimbatore', 'Ukkadam', 'Lake view, walking, boating', '6:00 AM - 7:00 PM'),
('Singanallur Lake Park', 'Singanallur Lake Road, Coimbatore 641005', 'Singanallur', 'Lake, bird watching, walking', '6:00 AM - 6:00 PM'),
('Mahatma Gandhi Park', 'Gandhipuram, Coimbatore 641012', 'Gandhipuram', 'Walking, greenery', '5:00 AM - 8:00 PM');

INSERT INTO `covai_industries` (`industry_name`, `address`, `contact`, `industry_type`, `locality`, `verified`, `about`, `services`) VALUES
('Lakshmi Machine Works', 'Coimbatore 641020', '0422 238 7000', 'Textile machinery', 'Coimbatore', 1, 'LMW. Textile machinery manufacturer.', 'Weaving, spinning machinery'),
('ELGI Equipments', 'Trichy Road, Coimbatore 641018', '0422 262 1321', 'Air compressors', 'Coimbatore', 1, 'Air compressor manufacturer.', 'Industrial compressors'),
('Pricol Ltd', 'Hope College, Coimbatore 641018', '0422 661 6000', 'Auto components', 'Race Course', 1, 'Automotive instruments.', 'Dashboard, sensors'),
('Sundaram Clayton', 'Pappanaickenpalayam, Coimbatore', '0422 661 7000', 'Auto components', 'Coimbatore', 1, 'Brake components.', 'Disc brakes, drums'),
('Lakshmi Mills', 'Avinashi Road, Coimbatore 641045', '0422 249 0123', 'Textiles', 'Coimbatore', 1, 'Textile conglomerate.', 'Yarn, fabric');

INSERT INTO `covai_it_companies` (`company_name`, `address`, `contact`, `industry_type`, `locality`, `verified`, `about`, `services`) VALUES
('Cognizant', 'Tidel Park, Saravanampatti, Coimbatore 641035', '0422 710 0000', 'IT Services', 'Saravanampatti', 1, 'Global IT services.', 'Software development, BPO'),
('HCL Technologies', 'Saravanampatti, Coimbatore 641035', NULL, 'IT Services', 'Saravanampatti', 1, 'IT services and consulting.', 'Development, support'),
('L&T Infotech', 'Peelamedu IT Corridor, Coimbatore 641004', NULL, 'IT Services', 'Peelamedu', 1, 'LTI. Digital solutions.', 'Consulting, development'),
('Sutherland', 'Saravanampatti, Coimbatore 641035', NULL, 'BPO', 'Saravanampatti', 1, 'Customer experience.', 'BPO, customer support'),
('KGISL', 'KG Campus, Saravanampatti, Coimbatore 641035', '0422 661 9000', 'IT, Education', 'Saravanampatti', 1, 'IT and education group.', 'Software, training'),
('Kovai.co', 'RS Puram, Coimbatore 641002', NULL, 'SaaS', 'RS Puram', 1, 'SaaS products.', 'Document 360, BizTalk'),
('Zoho Corporation', 'Saravanampatti, Coimbatore', NULL, 'SaaS', 'Saravanampatti', 1, 'Zoho offices in Coimbatore.', 'CRM, productivity');

INSERT INTO `covai_gov_offices` (`office_name`, `address`, `contact`, `landmark`) VALUES
('RTO Office Coimbatore Central', 'State Highway 79, Gandhipuram, Coimbatore 641012', '0422 230 2345', 'Near Gandhipuram Bus Stand'),
('Coimbatore City Municipal Corporation', 'Town Hall, Coimbatore 641001', '0422 239 0261', 'Town Hall Building'),
('Coimbatore District Collector Office', 'Collectorate Campus, Coimbatore 641018', '0422 230 5200', 'Near RS Puram'),
('Coimbatore City Police Commissionerate', 'RS Puram, Coimbatore 641002', '0422 230 0100', 'Commissionerate Building'),
('Passport Seva Kendra Coimbatore', 'Avinashi Road, Peelamedu, Coimbatore 641004', '0422 257 1234', 'Near Peelamedu Junction'),
('ESI Dispensary Coimbatore', 'Gandhipuram, Coimbatore 641012', '0422 221 3456', 'ESI Hospital Road');

INSERT INTO `covai_it_parks` (`name`, `locality`, `address`, `phone`, `website`, `inauguration_year`, `owner`, `built_up_area`, `total_area`, `amenity_sez`, `amenity_parking`, `amenity_cafeteria`, `amenity_shuttle`, `lat`, `lng`, `companies`) VALUES
('Tidel Park Coimbatore', 'Saravanampatti', 'Tidel Park Road, Saravanampatti, Coimbatore 641035', '0422 710 0000', 'https://www.tidelpark.co.in', '2010', 'TIDCO', '5 lakh sq ft', '25 acres', 1, 1, 1, 1, 11.0690, 76.9980, 'Cognizant, HCL, Sutherland'),
('ELCOT IT Park Coimbatore', 'Vedapatti', 'ELCOT IT Park, Vedapatti, Coimbatore', '0422 231 5678', 'https://elcot.in', '2008', 'ELCOT', '3 lakh sq ft', '15 acres', 1, 1, 1, 0, 11.0520, 76.9650, 'IT companies'),
('KG Tech Park', 'Saravanampatti', 'KG Campus, Saravanampatti, Coimbatore 641035', '0422 661 9000', 'https://www.kgisl.com', '2012', 'KGISL', '2 lakh sq ft', '10 acres', 0, 1, 1, 0, 11.0680, 76.9950, 'KGISL, startups');
