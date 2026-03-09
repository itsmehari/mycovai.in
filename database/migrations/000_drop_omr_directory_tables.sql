-- =============================================================================
-- MyCovai Cleanup: Drop OMR directory tables (replaced by covai_*)
-- Run this BEFORE 001_create_covai_directory_tables.sql if omr tables exist
-- Database: metap8ok_mycovai
-- =============================================================================

SET FOREIGN_KEY_CHECKS = 0;

-- Featured/supporting tables first (reference main tables)
DROP TABLE IF EXISTS `omr_it_companies_featured`;
DROP TABLE IF EXISTS `omr_it_parks_featured`;
DROP TABLE IF EXISTS `omr_it_company_submissions`;

-- Main directory tables
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

-- Legacy naming (if exists)
DROP TABLE IF EXISTS `omrgovernmentofficeslist`;
DROP TABLE IF EXISTS `omrindustrieslist`;
DROP TABLE IF EXISTS `omratmslist`;

SET FOREIGN_KEY_CHECKS = 1;
