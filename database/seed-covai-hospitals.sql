-- MyCovai: Seed hospitals (omrhospitalslist) with Coimbatore hospitals
-- Target DB: metap8ok_mycovai
-- Run after main structure import.

INSERT INTO `omrhospitalslist` (`slno`, `hospitalname`, `address`, `locality`, `contact`, `landmark`, `website`, `type`, `slug`, `verified`) VALUES
(1, 'KG Hospital', '5/63, College Road', 'RS Puram', '0422 221 2121', 'Near Coimbatore Medical College', 'https://kghospital.com', 'Multi-speciality', 'kg-hospital', 1),
(2, 'Kovai Medical Center and Hospital', 'Avinashi Road, Peelamedu', 'Peelamedu', '0422 262 7788', 'KMCH Campus', 'https://www.kmchhospital.com', 'Multi-speciality', 'kmch-peelamedu', 1),
(3, 'PSG Hospitals', 'Avinashi Road, Peelamedu', 'Peelamedu', '0422 257 0170', 'PSG College of Technology Campus', 'https://www.psghospitals.com', 'Multi-speciality', 'psg-hospitals', 1),
(4, 'G Kuppuswamy Naidu Memorial Hospital', 'P B No 632, Nava India Road', 'Coimbatore', '0422 221 3500', 'Near Ukkadam', 'https://gknhospital.org', 'Multi-speciality', 'gkn-hospital', 1),
(5, 'Sri Ramakrishna Hospital', '395, Sarojini Naidu Road', 'Sidhapudur', '0422 450 0000', 'Near RS Puram', 'https://www.sriramakrishnahospital.org', 'Multi-speciality', 'sri-ramakrishna-hospital', 1),
(6, 'Aravind Eye Hospital', 'Avinashi Road, Coimbatore', 'Coimbatore', '0422 261 7000', 'Near Peelamedu', 'https://www.aravind.org', 'Eye Care', 'aravind-eye-covai', 1);
