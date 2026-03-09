-- MyCovai: Seed restaurants (omr_restaurants) with Coimbatore eateries
-- Target DB: metap8ok_mycovai
-- Run after main structure import.
-- geolocation: POINT(longitude latitude) for Coimbatore area.

INSERT INTO `omr_restaurants` (`id`, `name`, `address`, `locality`, `cuisine`, `cost_for_two`, `rating`, `availability`, `accessibility`, `reviews`, `imagelocation`, `geolocation`, `slug`, `verified`) VALUES
(1, 'Anandhas', '1081, Avinashi Road, Peelamedu', 'Peelamedu', 'South Indian, North Indian', 400, 4.2, 'Lunch, Dinner', 'Parking, AC', 'Popular for meals and biryani.', '', ST_GeomFromText('POINT(76.9570 11.0310)'), 'anandhas-peelamedu', 1),
(2, 'Sree Annapoorna', 'Opposite Gandhipuram Bus Stand', 'Gandhipuram', 'South Indian', 150, 4.0, 'Breakfast, Lunch', 'Central location', 'Famous for ghee roast and coffee.', '', ST_GeomFromText('POINT(76.9520 11.0180)'), 'sree-annapoorna-gandhipuram', 1),
(3, 'Shree Krishna Sweets', 'RS Puram, DB Road', 'RS Puram', 'South Indian, Sweets', 300, 4.3, 'All day', 'Parking, AC', 'Sweets and meals.', '', ST_GeomFromText('POINT(76.9480 11.0120)'), 'shree-krishna-sweets-rs-puram', 1),
(4, 'Barbeque Nation', 'Brookefields Mall, RS Puram', 'RS Puram', 'North Indian, BBQ', 1200, 4.1, 'Lunch, Dinner', 'Mall parking, AC', 'Buffet and grill.', '', ST_GeomFromText('POINT(76.9500 11.0140)'), 'barbeque-nation-brookefields', 1),
(5, 'Hotel Dhaba', 'Avinashi Road, Coimbatore', 'Peelamedu', 'North Indian, Punjabi', 500, 4.0, 'Lunch, Dinner', 'Parking', 'North Indian and tandoor.', '', ST_GeomFromText('POINT(76.9580 11.0280)'), 'hotel-dhaba-avinashi', 1);
