-- MyCovai: Truncate all tables (empty the database, keep structure)
-- Target: metap8ok_mycovai
-- Use only after a FULL import of metap8ok_myomr.sql (Option B in README-MYCOVAI-UPLOAD.md)

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
