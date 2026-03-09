-- MyCovai: Seed parks (omrparkslist) with Coimbatore parks
-- Target DB: metap8ok_mycovai
-- Run after main structure import.

INSERT INTO `omrparkslist` (`slno`, `parkname`, `location`, `locality`, `area`, `features`, `timings`, `slug`, `verified`) VALUES
(1, 'VOC Park', 'VOC Park Road, Gandhipuram', 'Gandhipuram', 'Gandhipuram', 'Walking track, children play area, greenery', '5:00 AM - 9:00 PM', 'voc-park', 1),
(2, 'Race Course', 'Race Course Road', 'Race Course', 'Race Course', 'Walking track, jogging, equestrian', '5:00 AM - 8:00 PM', 'race-course-covai', 1),
(3, 'Periyakulam Lake Park', 'Periyakulam, Ukkadam', 'Ukkadam', 'Ukkadam', 'Lake view, walking, boating', '6:00 AM - 7:00 PM', 'periyakulam-park', 1),
(4, 'Brookefields Mall Park', 'Brookefields Mall, RS Puram', 'RS Puram', 'RS Puram', 'Open space, events', '10:00 AM - 10:00 PM', 'brookefields-park', 1),
(5, 'Singanallur Lake Park', 'Singanallur Lake Road', 'Singanallur', 'Singanallur', 'Lake, bird watching, walking', '6:00 AM - 6:00 PM', 'singanallur-lake-park', 1);
