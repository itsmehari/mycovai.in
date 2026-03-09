-- =============================================================================
-- MyCovai Option B: Truncate all tables, then seed Coimbatore "List of Areas"
-- Target DB: metap8ok_mycovai
-- Run this ONCE after you have done a FULL import of metap8ok_myomr.sql
-- =============================================================================

SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE `admin_audit_log`;
TRUNCATE TABLE `admin_users`;
TRUNCATE TABLE `articles`;
TRUNCATE TABLE `businesses`;
TRUNCATE TABLE `coworking_spaces`;
TRUNCATE TABLE `employers`;
TRUNCATE TABLE `events`;
TRUNCATE TABLE `event_attendees`;
TRUNCATE TABLE `event_categories`;
TRUNCATE TABLE `event_listings`;
TRUNCATE TABLE `event_submissions`;
TRUNCATE TABLE `gallery`;
TRUNCATE TABLE `hostels_pgs`;
TRUNCATE TABLE `job_applications`;
TRUNCATE TABLE `job_categories`;
TRUNCATE TABLE `job_postings`;
TRUNCATE TABLE `List of Areas`;
TRUNCATE TABLE `omrbankslist`;
TRUNCATE TABLE `omrelections_civic_issues`;
TRUNCATE TABLE `omrelections_constituencies`;
TRUNCATE TABLE `omrelections_election_results`;
TRUNCATE TABLE `omrelections_localities`;
TRUNCATE TABLE `omrelections_polling_stations`;
TRUNCATE TABLE `omrelections_representatives`;
TRUNCATE TABLE `omrelections_voter_services`;
TRUNCATE TABLE `omrhospitalslist`;
TRUNCATE TABLE `omrparkslist`;
TRUNCATE TABLE `omrschoolslist`;
TRUNCATE TABLE `omr_atms`;
TRUNCATE TABLE `omr_election_blo`;
TRUNCATE TABLE `omr_gov_offices`;
TRUNCATE TABLE `omr_industries`;
TRUNCATE TABLE `omr_it_companies`;
TRUNCATE TABLE `omr_it_companies_featured`;
TRUNCATE TABLE `omr_it_company_submissions`;
TRUNCATE TABLE `omr_it_parks`;
TRUNCATE TABLE `omr_it_parks_featured`;
TRUNCATE TABLE `omr_restaurants`;
TRUNCATE TABLE `omr_schools`;
TRUNCATE TABLE `organizers`;
TRUNCATE TABLE `property_inquiries`;
TRUNCATE TABLE `property_owners`;
TRUNCATE TABLE `property_photos`;
TRUNCATE TABLE `property_reviews`;
TRUNCATE TABLE `saved_properties`;
TRUNCATE TABLE `saved_spaces`;
TRUNCATE TABLE `schools`;
TRUNCATE TABLE `space_inquiries`;
TRUNCATE TABLE `space_owners`;
TRUNCATE TABLE `space_photos`;
TRUNCATE TABLE `space_reviews`;

SET FOREIGN_KEY_CHECKS = 1;

-- Widen "List of Areas".Areas so long names (e.g. Sivananda Colony) fit
ALTER TABLE `List of Areas` MODIFY `Areas` VARCHAR(50) DEFAULT NULL;

-- Seed Coimbatore localities into "List of Areas"
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
