-- =============================================================================
-- MyCovai Directory Tables - Coimbatore Local Business Directory
-- Migration: Create covai_* tables (replaces omr_* for MyCovai.in)
-- Run against: metap8ok_mycovai
-- Reference: docs/CHATGPT-RESEARCH-PROMPT-MYCOVAI-DIRECTORY-DATA.md
-- =============================================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;

-- -----------------------------------------------------------------------------
-- 1. covai_schools
-- Columns: slno | schoolname | address | contact | landmark | locality | verified | about | services | careers_url
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

-- -----------------------------------------------------------------------------
-- 2. covai_banks
-- Columns: slno | bankname | address | contact | landmark | website
-- -----------------------------------------------------------------------------
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
  KEY `idx_bankname` (`bankname`),
  KEY `idx_locality` (`address`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 3. covai_hospitals
-- Columns: slno | hospitalname | address | contact | landmark | locality | verified | about | services | careers_url
-- -----------------------------------------------------------------------------
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

-- -----------------------------------------------------------------------------
-- 4. covai_restaurants
-- Columns: id | name | address | locality | cuisine | cost_for_two | rating | availability | reviews | imagelocation
-- -----------------------------------------------------------------------------
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

-- -----------------------------------------------------------------------------
-- 5. covai_atms
-- Columns: slno | bankname | address | contact | landmark
-- -----------------------------------------------------------------------------
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
  KEY `idx_bankname` (`bankname`),
  KEY `idx_address` (`address`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 6. covai_parks
-- Columns: slno | parkname | location | area | features | timings
-- -----------------------------------------------------------------------------
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
  KEY `idx_parkname` (`parkname`),
  KEY `idx_location` (`location`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 7. covai_industries
-- Columns: slno | industry_name | address | contact | industry_type | locality | verified | about | services | careers_url
-- -----------------------------------------------------------------------------
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

-- -----------------------------------------------------------------------------
-- 8. covai_it_companies
-- Columns: slno | company_name | address | contact | industry_type | verified | about | services | careers_url
-- -----------------------------------------------------------------------------
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

-- -----------------------------------------------------------------------------
-- 9. covai_gov_offices
-- Columns: slno | office_name | address | contact | landmark
-- -----------------------------------------------------------------------------
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
  KEY `idx_office_name` (`office_name`),
  KEY `idx_address` (`address`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 10. covai_it_parks
-- Columns: id | name | locality | address | phone | website | inauguration_year | owner | built_up_area | total_area | image | amenity_sez | amenity_parking | amenity_cafeteria | amenity_shuttle | lat | lng | companies | location | updated_at
-- -----------------------------------------------------------------------------
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

-- -----------------------------------------------------------------------------
-- Supporting tables for featured listings (optional)
-- -----------------------------------------------------------------------------
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

-- =============================================================================
-- Migration complete. Use ChatGPT Research prompt to seed data.
-- See: docs/CHATGPT-RESEARCH-PROMPT-MYCOVAI-DIRECTORY-DATA.md
-- =============================================================================
