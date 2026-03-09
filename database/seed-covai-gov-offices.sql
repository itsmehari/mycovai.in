-- MyCovai: Seed government offices (omr_gov_offices) for Coimbatore
-- Target DB: metap8ok_mycovai
-- Run after main structure import.

INSERT INTO `omr_gov_offices` (`slno`, `office_name`, `address`, `locality`, `contact`, `landmark`, `slug`, `verified`) VALUES
(1, 'RTO Office Coimbatore Central', 'State Highway 79, Gandhipuram', 'Gandhipuram', '0422 230 2345', 'Near Gandhipuram Bus Stand', 'rto-coimbatore-central', 1),
(2, 'Coimbatore City Municipal Corporation', 'Town Hall, Coimbatore', 'Townhall', '0422 239 0261', 'Town Hall Building', 'coimbatore-corporation', 1),
(3, 'Coimbatore District Collector Office', 'Collectorate Campus, Coimbatore', 'Coimbatore', '0422 230 5200', 'Near RS Puram', 'district-collector-covai', 1),
(4, 'Coimbatore City Police Commissionerate', 'RS Puram, Coimbatore', 'RS Puram', '0422 230 0100', 'Commissionerate Building', 'police-commissionerate-covai', 1),
(5, 'Passport Seva Kendra Coimbatore', 'Avinashi Road, Peelamedu', 'Peelamedu', '0422 257 1234', 'Near Peelamedu Junction', 'passport-covai', 1),
(6, 'ESI Dispensary Coimbatore', 'Gandhipuram', 'Gandhipuram', '0422 221 3456', 'ESI Hospital Road', 'esi-dispensary-covai', 1);
