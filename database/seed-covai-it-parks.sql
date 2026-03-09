-- MyCovai: Seed IT parks (omr_it_parks) for Coimbatore
-- Target DB: metap8ok_mycovai
-- Run after main structure import.

INSERT INTO `omr_it_parks` (`id`, `name`, `locality`, `address`, `phone`, `website`, `inauguration_year`, `owner`, `built_up_area`, `total_area`, `image`, `lat`, `lng`, `verified`, `amenity_sez`, `amenity_parking`, `amenity_cafeteria`, `amenity_shuttle`) VALUES
(1, 'Tidel Park Coimbatore', 'Saravanampatti', 'Tidel Park Road, Saravanampatti', '0422 710 0000', 'https://www.tidelpark.co.in', '2010', 'TIDCO', '5 lakh sq ft', '25 acres', NULL, 11.0690, 76.9980, 1, 1, 1, 1, 1),
(2, 'ELCOT IT Park Coimbatore', 'Vedapatti', 'ELCOT IT Park, Vedapatti', '0422 231 5678', 'https://elcot.in', '2008', 'ELCOT', '3 lakh sq ft', '15 acres', NULL, 11.0520, 76.9650, 1, 1, 1, 1, 0),
(3, 'Kovai Industrial Park', 'Saravanampatti', 'Kovai Industrial Park, Saravanampatti', NULL, NULL, '2012', 'Private', '2 lakh sq ft', '10 acres', NULL, 11.0720, 77.0050, 1, 0, 1, 1, 0),
(4, 'Coimbatore Tech Park', 'Kalapatti', 'Kalapatti Road, Coimbatore', NULL, NULL, '2015', 'Private', '1.5 lakh sq ft', '8 acres', NULL, 11.0880, 77.0180, 1, 0, 1, 1, 0);
