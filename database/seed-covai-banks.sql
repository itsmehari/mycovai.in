-- MyCovai: Seed banks (omrbankslist) with Coimbatore branches
-- Target DB: metap8ok_mycovai
-- Run after main structure import.

INSERT INTO `omrbankslist` (`slno`, `bankname`, `address`, `locality`, `contact`, `landmark`, `website`, `slug`, `verified`) VALUES
(1, 'State Bank of India', 'DB Road, RS Puram', 'RS Puram', '0422 254 5678', 'Near DB Road Junction', 'https://www.onlinesbi.sbi', 'sbi-rs-puram', 1),
(2, 'HDFC Bank', 'Cross Cut Road, Gandhipuram', 'Gandhipuram', '0422 221 2345', 'Opposite Gandhipuram Bus Stand', 'https://www.hdfcbank.com', 'hdfc-gandhipuram', 1),
(3, 'ICICI Bank', 'Avinashi Road, Peelamedu', 'Peelamedu', '0422 257 8901', 'Near Peelamedu Junction', 'https://www.icicibank.com', 'icici-peelamedu', 1),
(4, 'Canara Bank', 'Town Hall, Coimbatore', 'Townhall', '0422 239 4567', 'Near Town Hall', 'https://canarabank.com', 'canara-townhall', 1),
(5, 'Indian Overseas Bank', '100 Feet Road, Saibaba Koil', 'Saibaba Koil', '0422 231 6789', 'Near Saibaba Temple', 'https://www.iob.in', 'iob-saibaba-koil', 1),
(6, 'Kotak Mahindra Bank', 'Lakshmi Mills, Coimbatore', 'Coimbatore', '0422 249 0123', 'Lakshmi Mills Junction', 'https://www.kotak.com', 'kotak-lakshmi-mills', 1),
(7, 'Axis Bank', 'Rathinapuri Main Road', 'Rathinapuri', '0422 234 5678', 'Rathinapuri Junction', 'https://www.axisbank.com', 'axis-rathinapuri', 1),
(8, 'Karur Vysya Bank', 'Tatabad, Coimbatore', 'Tatabad', '0422 245 9012', 'Tatabad Main Road', 'https://www.kvb.co.in', 'kvb-tatabad', 1);
