-- =============================================================================
-- MyCovai Directory Seed – Coimbatore data for covai_* tables
-- Run AFTER: 000_drop_omr_directory_tables.sql, 001_create_covai_directory_tables.sql
-- Target DB: metap8ok_mycovai
-- =============================================================================

SET NAMES utf8mb4;

-- -----------------------------------------------------------------------------
-- 1. covai_schools
-- -----------------------------------------------------------------------------
INSERT INTO `covai_schools` (`schoolname`, `address`, `contact`, `landmark`, `locality`, `verified`, `about`, `services`, `careers_url`) VALUES
('PSG Sarvajana Higher Secondary School', 'Avinashi Road, Peelamedu, Coimbatore 641004', '0422 257 2345', 'Near PSG Tech', 'Peelamedu', 1, 'Est. 1926. State Board. Labs, library, sports.', 'Classes 1-12', NULL),
('Sri Krishna International School', 'Kovaipudur, Coimbatore 641042', '0422 262 5678', 'Kovaipudur Main Road', 'Kovaipudur', 1, 'CBSE school. Smart classes, labs.', 'LKG-12', NULL),
('Bharatiya Vidya Bhavan', 'Race Course Road, Coimbatore 641018', '0422 221 3456', 'Near Race Course', 'Race Course', 1, 'CBSE. Library, labs, auditorium.', 'LKG-12', NULL),
('SBOA School and Junior College', 'Avinashi Road, Civil Aerodrome Post, Coimbatore 641014', '0422 257 8901', 'Near Airport', 'Peelamedu', 1, 'State Board, CBSE. Labs, playground.', 'LKG-12', NULL),
('St. Francis Anglo-Indian Higher Secondary School', 'Hopes College Road, Coimbatore 641018', '0422 221 2345', 'Near Hope College', 'Race Course', 1, 'Est. 1885. Heritage campus.', '1-12', NULL),
('Chinmaya International Residential School', 'Coimbatore Road, Siruvani', '0422 264 7222', 'Siruvani Road', 'Coimbatore', 1, 'CBSE. Residential school.', '6-12', NULL),
('The Shishya School', 'Hopes College Road, Coimbatore 641018', '0422 221 1000', 'Near Hope College', 'Race Course', 1, 'IB curriculum.', 'PreK-12', NULL),
('Suguna PIP School', 'Kumaraguru College Road, Coimbatore', '0422 266 5432', 'Near Kumaraguru', 'Saravanampatti', 1, 'CBSE. Integrated program.', '1-12', NULL),
('Senthil Public School', 'Ramanathapuram, Coimbatore 641045', '0422 266 1234', 'Ramanathapuram', 'Ramanathapuram', 1, 'CBSE.', 'LKG-12', NULL),
('MVM Matriculation Higher Secondary School', 'Tatabad, Coimbatore 641012', '0422 245 6789', 'Tatabad Main Road', 'Tatabad', 1, 'Matriculation board.', '1-12', NULL);

-- -----------------------------------------------------------------------------
-- 2. covai_banks
-- -----------------------------------------------------------------------------
INSERT INTO `covai_banks` (`bankname`, `address`, `contact`, `landmark`, `website`) VALUES
('State Bank of India', 'DB Road, RS Puram, Coimbatore 641002', '0422 254 5678', 'Near DB Road Junction', 'https://www.onlinesbi.sbi'),
('HDFC Bank', 'Cross Cut Road, Gandhipuram, Coimbatore 641012', '0422 221 2345', 'Opposite Gandhipuram Bus Stand', 'https://www.hdfcbank.com'),
('ICICI Bank', 'Avinashi Road, Peelamedu, Coimbatore 641004', '0422 257 8901', 'Near Peelamedu Junction', 'https://www.icicibank.com'),
('Canara Bank', 'Town Hall, Coimbatore 641001', '0422 239 4567', 'Near Town Hall', 'https://canarabank.com'),
('Indian Overseas Bank', '100 Feet Road, Saibaba Koil, Coimbatore 641011', '0422 231 6789', 'Near Saibaba Temple', 'https://www.iob.in'),
('Kotak Mahindra Bank', 'Lakshmi Mills, Coimbatore 641045', '0422 249 0123', 'Lakshmi Mills Junction', 'https://www.kotak.com'),
('Axis Bank', 'Rathinapuri Main Road, Coimbatore 641027', '0422 234 5678', 'Rathinapuri Junction', 'https://www.axisbank.com'),
('Karur Vysya Bank', 'Tatabad, Coimbatore 641012', '0422 245 9012', 'Tatabad Main Road', 'https://www.kvb.co.in'),
('Indian Bank', 'Gandhipuram, Coimbatore 641012', '0422 230 1234', 'Opposite Bus Stand', 'https://www.indianbank.in'),
('Union Bank of India', 'RS Puram, Coimbatore 641002', '0422 255 6789', 'Near DB Road', 'https://www.unionbankofindia.co.in'),
('Punjab National Bank', 'Avinashi Road, Peelamedu, Coimbatore 641004', '0422 257 2345', 'Peelamedu', 'https://www.pnbonline.in'),
('Bank of Baroda', 'Town Hall, Coimbatore 641001', '0422 239 5678', 'Town Hall', 'https://www.bankofbaroda.in'),
('Federal Bank', 'Gandhipuram, Coimbatore 641012', '0422 221 5678', 'Cross Cut Road', 'https://www.federalbank.co.in'),
('South Indian Bank', 'RS Puram, Coimbatore 641002', '0422 254 3456', 'DB Road', 'https://www.southindianbank.com'),
('City Union Bank', 'Peelamedu, Coimbatore 641004', '0422 257 1234', 'Avinashi Road', 'https://www.cityunionbank.com');

-- -----------------------------------------------------------------------------
-- 3. covai_hospitals
-- -----------------------------------------------------------------------------
INSERT INTO `covai_hospitals` (`hospitalname`, `address`, `contact`, `landmark`, `locality`, `verified`, `about`, `services`, `careers_url`) VALUES
('KG Hospital', '5/63, College Road, Coimbatore 641018', '0422 221 2121', 'Near Coimbatore Medical College', 'RS Puram', 1, 'Multi-speciality hospital.', 'Emergency, ICU, diagnostics', NULL),
('Kovai Medical Center and Hospital', 'Avinashi Road, Peelamedu, Coimbatore 641014', '0422 262 7788', 'KMCH Campus', 'Peelamedu', 1, 'Multi-speciality. NABH accredited.', 'Cardiology, neurology, ortho', NULL),
('PSG Hospitals', 'Avinashi Road, Peelamedu, Coimbatore 641004', '0422 257 0170', 'PSG College Campus', 'Peelamedu', 1, 'Teaching hospital. Multi-speciality.', 'Emergency, surgery, labs', NULL),
('G Kuppuswamy Naidu Memorial Hospital', 'Nava India Road, Coimbatore 641018', '0422 221 3500', 'Near Ukkadam', 'Ukkadam', 1, 'GKNM Hospital. Multi-speciality.', 'Cancer care, cardiology', NULL),
('Sri Ramakrishna Hospital', '395, Sarojini Naidu Road, Sidhapudur, Coimbatore 641044', '0422 450 0000', 'Near RS Puram', 'Sidhapudur', 1, 'SRH. Multi-speciality.', 'Emergency, ICU, labs', NULL),
('Aravind Eye Hospital', 'Avinashi Road, Coimbatore 641014', '0422 261 7000', 'Near Peelamedu', 'Peelamedu', 1, 'Eye care specialty.', 'Cataract, LASIK, retina', NULL),
('Kumar Hospital', 'RS Puram, Coimbatore 641002', '0422 255 5000', 'DB Road', 'RS Puram', 1, 'Multi-speciality.', 'Emergency, surgery', NULL),
('Ganga Hospital', 'RS Puram, Coimbatore 641002', '0422 248 5000', 'Near RS Puram', 'RS Puram', 1, 'Orthopaedic specialty.', 'Bone, joint, spine', NULL),
('Gem Hospital', 'Ponnaiyarajapuram, Coimbatore 641015', '0422 252 0500', 'Sivananda Colony', 'Sivanandapuram', 1, 'Gastroenterology, surgery.', 'GI, laparoscopic', NULL),
('Kovai Ortho and Trauma Centre', 'RS Puram, Coimbatore', '0422 257 0500', 'DB Road', 'RS Puram', 1, 'Ortho and trauma.', 'Fracture, joint replacement', NULL);

-- -----------------------------------------------------------------------------
-- 4. covai_restaurants
-- -----------------------------------------------------------------------------
INSERT INTO `covai_restaurants` (`name`, `address`, `locality`, `cuisine`, `cost_for_two`, `rating`, `availability`, `reviews`, `imagelocation`) VALUES
('Anandhas', '1081, Avinashi Road, Peelamedu, Coimbatore 641004', 'Peelamedu', 'South Indian, North Indian', 400, 4.2, 'Lunch, Dinner', 'Popular for meals and biryani.', ''),
('Sree Annapoorna', 'Opposite Gandhipuram Bus Stand, Coimbatore 641012', 'Gandhipuram', 'South Indian', 150, 4.0, 'Breakfast, Lunch', 'Famous for ghee roast and coffee.', ''),
('Shree Krishna Sweets', 'DB Road, RS Puram, Coimbatore 641002', 'RS Puram', 'South Indian, Sweets', 300, 4.3, 'All day', 'Sweets and meals.', ''),
('Barbeque Nation', 'Brookefields Mall, RS Puram, Coimbatore 641002', 'RS Puram', 'North Indian, BBQ', 1200, 4.1, 'Lunch, Dinner', 'Buffet and grill.', ''),
('Hotel Dhaba', 'Avinashi Road, Peelamedu, Coimbatore 641004', 'Peelamedu', 'North Indian, Punjabi', 500, 4.0, 'Lunch, Dinner', 'North Indian and tandoor.', ''),
('Annapoorna Gowrishankar', 'Gandhipuram, Coimbatore 641012', 'Gandhipuram', 'South Indian', 200, 4.2, 'Breakfast, Lunch, Dinner', 'Traditional meals.', ''),
('The French Loaf', 'RS Puram, Coimbatore 641002', 'RS Puram', 'Bakery, Continental', 400, 4.0, 'All day', 'Bakery and cafe.', ''),
('Shree Anandhaas', 'Saibaba Colony, Coimbatore', 'Saibaba Colony', 'South Indian, North Indian', 350, 4.1, 'Lunch, Dinner', 'Multi-cuisine.', ''),
('Thalappakatti', 'RS Puram, Coimbatore 641002', 'RS Puram', 'South Indian, Biryani', 500, 4.2, 'Lunch, Dinner', 'Famous biryani.', ''),
('Ming Garden', 'Gandhipuram, Coimbatore 641012', 'Gandhipuram', 'Chinese, Asian', 600, 4.0, 'Lunch, Dinner', 'Chinese cuisine.', ''),
('Copper Chimney', 'Brookefields, RS Puram', 'RS Puram', 'North Indian', 800, 4.3, 'Lunch, Dinner', 'North Indian fine dining.', ''),
('Kumarakom', 'RS Puram, Coimbatore 641002', 'RS Puram', 'Kerala, South Indian', 450, 4.1, 'Lunch, Dinner', 'Kerala cuisine.', ''),
('Saravana Bhavan', 'Gandhipuram, Coimbatore 641012', 'Gandhipuram', 'South Indian', 250, 4.0, 'All day', 'Chain. South Indian.', ''),
('Aasife Biryani', 'Peelamedu, Coimbatore 641004', 'Peelamedu', 'Biryani, North Indian', 400, 4.1, 'Lunch, Dinner', 'Biryani specialist.', ''),
('Junior Kuppanna', 'Race Course, Coimbatore 641018', 'Race Course', 'South Indian, Non-Veg', 500, 4.0, 'Lunch, Dinner', 'Chettinad cuisine.', '');

-- -----------------------------------------------------------------------------
-- 5. covai_atms
-- -----------------------------------------------------------------------------
INSERT INTO `covai_atms` (`bankname`, `address`, `contact`, `landmark`) VALUES
('State Bank of India', 'DB Road, RS Puram, Coimbatore 641002', NULL, 'Near DB Road Junction'),
('HDFC Bank', 'Gandhipuram Bus Stand, Coimbatore 641012', NULL, 'Opposite Bus Stand'),
('ICICI Bank', 'Avinashi Road, Peelamedu, Coimbatore 641004', NULL, 'Peelamedu Junction'),
('Axis Bank', 'RS Puram, Coimbatore 641002', NULL, 'DB Road'),
('SBI', 'Town Hall, Coimbatore 641001', NULL, 'Town Hall'),
('HDFC Bank', 'Brookefields Mall, RS Puram, Coimbatore 641002', NULL, 'Mall Entrance'),
('ICICI Bank', 'Gandhipuram, Coimbatore 641012', NULL, 'Cross Cut Road'),
('Canara Bank', 'Saibaba Koil, Coimbatore 641011', NULL, '100 Feet Road'),
('Kotak Mahindra', 'Rathinapuri, Coimbatore 641027', NULL, 'Rathinapuri Main Road'),
('Axis Bank', 'Peelamedu, Coimbatore 641004', NULL, 'Avinashi Road'),
('Indian Bank', 'Tatabad, Coimbatore 641012', NULL, 'Tatabad Junction'),
('SBI', 'Singanallur, Coimbatore 641005', NULL, 'Singanallur Main Road'),
('HDFC Bank', 'Saravanampatti, Coimbatore 641035', NULL, 'Saravanampatti Junction'),
('ICICI Bank', 'Kovaipudur, Coimbatore 641042', NULL, 'Kovaipudur'),
('SBI', 'Race Course, Coimbatore 641018', NULL, 'Race Course Road');

-- -----------------------------------------------------------------------------
-- 6. covai_parks
-- -----------------------------------------------------------------------------
INSERT INTO `covai_parks` (`parkname`, `location`, `area`, `features`, `timings`) VALUES
('VOC Park', 'VOC Park Road, Gandhipuram, Coimbatore', 'Gandhipuram', 'Walking track, children play area, greenery', '5:00 AM - 9:00 PM'),
('Race Course', 'Race Course Road, Coimbatore 641018', 'Race Course', 'Walking track, jogging, equestrian', '5:00 AM - 8:00 PM'),
('Periyakulam Lake Park', 'Periyakulam, Ukkadam, Coimbatore', 'Ukkadam', 'Lake view, walking, boating', '6:00 AM - 7:00 PM'),
('Brookefields Mall Park', 'Brookefields Mall, RS Puram, Coimbatore 641002', 'RS Puram', 'Open space, events', '10:00 AM - 10:00 PM'),
('Singanallur Lake Park', 'Singanallur Lake Road, Coimbatore 641005', 'Singanallur', 'Lake, bird watching, walking', '6:00 AM - 6:00 PM'),
('Mahatma Gandhi Park', 'Gandhipuram, Coimbatore 641012', 'Gandhipuram', 'Walking, greenery', '5:00 AM - 8:00 PM'),
('Kovai Kulangal Park', 'Saravanampatti, Coimbatore', 'Saravanampatti', 'Water body, walking', '6:00 AM - 6:00 PM'),
('Children Park RS Puram', 'RS Puram, Coimbatore 641002', 'RS Puram', 'Play area, swings', '8:00 AM - 7:00 PM'),
('Valankulam Lake Park', 'Valankulam, Coimbatore', 'Coimbatore', 'Lake, walking track', '6:00 AM - 6:00 PM'),
('Tamil Nadu Horticulture Garden', 'VOC Park Road, Gandhipuram', 'Gandhipuram', 'Gardens, plants, walking', '9:00 AM - 6:00 PM');

-- -----------------------------------------------------------------------------
-- 7. covai_industries
-- -----------------------------------------------------------------------------
INSERT INTO `covai_industries` (`industry_name`, `address`, `contact`, `industry_type`, `locality`, `verified`, `about`, `services`) VALUES
('Lakshmi Machine Works', 'Coimbatore 641020', '0422 238 7000', 'Textile machinery', 'Coimbatore', 1, 'LMW. Textile machinery manufacturer.', 'Weaving, spinning machinery'),
('ELGI Equipments', 'Trichy Road, Coimbatore 641018', '0422 262 1321', 'Air compressors', 'Coimbatore', 1, 'Air compressor manufacturer.', 'Industrial compressors'),
('Pricol Ltd', 'Hope College, Coimbatore 641018', '0422 661 6000', 'Auto components', 'Race Course', 1, 'Automotive instruments.', 'Dashboard, sensors'),
('Craftlogic Innovations', 'Peelamedu, Coimbatore 641004', '0422 257 1234', 'Manufacturing', 'Peelamedu', 1, 'Precision components.', 'CNC, fabrication'),
('Sundaram Clayton', 'Pappanaickenpalayam, Coimbatore', '0422 661 7000', 'Auto components', 'Coimbatore', 1, 'Brake components.', 'Disc brakes, drums'),
('K G Denim', 'Saravanampatti, Coimbatore 641035', '0422 266 5000', 'Textiles', 'Saravanampatti', 1, 'Denim manufacturer.', 'Denim fabric'),
('Shanthi Gears', 'Ganapathy, Coimbatore 641006', '0422 261 2300', 'Gears', 'Coimbatore', 1, 'Gear manufacturer.', 'Industrial gears'),
('Bharat Gears', 'Peelamedu, Coimbatore 641004', '0422 257 3456', 'Gears', 'Peelamedu', 1, 'Auto and industrial gears.', 'Gear manufacturing'),
('Premier Mills', 'Coimbatore 641014', '0422 261 6789', 'Textiles', 'Peelamedu', 1, 'Textile mill.', 'Yarn, fabric'),
('Precision Pumps', 'Kuniyamuthur, Coimbatore 641008', '0422 248 9012', 'Pumps', 'Kuniyamuthur', 1, 'Pump manufacturer.', 'Submersible, centrifugal'),
('Coimbatore Pioneer Mills', 'Ganapathy, Coimbatore', '0422 261 2345', 'Textiles', 'Coimbatore', 1, 'Textile mill.', 'Yarn manufacturing'),
('Lakshmi Mills', 'Avinashi Road, Coimbatore 641045', '0422 249 0123', 'Textiles', 'Coimbatore', 1, 'Textile conglomerate.', 'Yarn, fabric'),
('Rane Brake Lining', 'Metupalayam Road, Coimbatore', '0422 266 7890', 'Auto components', 'Saravanampatti', 1, 'Brake linings.', 'Friction materials'),
('Super Auto Forge', 'Peelamedu, Coimbatore 641004', '0422 257 5678', 'Forging', 'Peelamedu', 1, 'Automotive forgings.', 'Forged components'),
('Jayashree Textiles', 'Coimbatore 641014', '0422 261 3456', 'Textiles', 'Peelamedu', 1, 'Textile manufacturer.', 'Denim, fabric');

-- -----------------------------------------------------------------------------
-- 8. covai_it_companies
-- -----------------------------------------------------------------------------
INSERT INTO `covai_it_companies` (`company_name`, `address`, `contact`, `industry_type`, `locality`, `verified`, `about`, `services`) VALUES
('Cognizant', 'Tidel Park, Saravanampatti, Coimbatore 641035', '0422 710 0000', 'IT Services', 'Saravanampatti', 1, 'Global IT services.', 'Software development, BPO'),
('HCL Technologies', 'Saravanampatti, Coimbatore 641035', NULL, 'IT Services', 'Saravanampatti', 1, 'IT services and consulting.', 'Development, support'),
('L&T Infotech', 'Peelamedu IT Corridor, Coimbatore 641004', NULL, 'IT Services', 'Peelamedu', 1, 'LTI. Digital solutions.', 'Consulting, development'),
('UST Global', 'Saravanampatti, Coimbatore', NULL, 'IT Services', 'Saravanampatti', 1, 'Digital services.', 'Software, digital'),
('Sutherland', 'Saravanampatti, Coimbatore 641035', NULL, 'BPO', 'Saravanampatti', 1, 'Customer experience.', 'BPO, customer support'),
('KGISL', 'KG Campus, Saravanampatti, Coimbatore 641035', '0422 661 9000', 'IT, Education', 'Saravanampatti', 1, 'IT and education group.', 'Software, training'),
('Kovai.co', 'RS Puram, Coimbatore 641002', NULL, 'SaaS', 'RS Puram', 1, 'SaaS products.', 'Document 360, BizTalk'),
('Thoughtworks', 'Coimbatore', NULL, 'IT Consulting', 'Coimbatore', 1, 'Software consultancy.', 'Agile, digital'),
('Zoho Corporation', 'Saravanampatti, Coimbatore', NULL, 'SaaS', 'Saravanampatti', 1, 'Zoho offices in Coimbatore.', 'CRM, productivity'),
('Aspire Systems', 'Coimbatore', NULL, 'IT Services', 'Coimbatore', 1, 'Software services.', 'Development, testing'),
('Freshworks', 'Coimbatore', NULL, 'SaaS', 'Coimbatore', 1, 'Customer engagement.', 'CRM, support software'),
('Sirius Computer Solutions', 'Saravanampatti, Coimbatore', NULL, 'IT Services', 'Saravanampatti', 1, 'IBM partner.', 'Cloud, infrastructure'),
('Mphasis', 'Coimbatore', NULL, 'IT Services', 'Coimbatore', 1, 'IT services.', 'Applications, BPO'),
('Hexaware', 'Coimbatore', NULL, 'IT Services', 'Coimbatore', 1, 'IT and BPO.', 'Digital, cloud'),
('Capgemini', 'Saravanampatti, Coimbatore', NULL, 'IT Consulting', 'Saravanampatti', 1, 'Consulting and technology.', 'Digital transformation');

-- -----------------------------------------------------------------------------
-- 9. covai_gov_offices
-- -----------------------------------------------------------------------------
INSERT INTO `covai_gov_offices` (`office_name`, `address`, `contact`, `landmark`) VALUES
('RTO Office Coimbatore Central', 'State Highway 79, Gandhipuram, Coimbatore 641012', '0422 230 2345', 'Near Gandhipuram Bus Stand'),
('Coimbatore City Municipal Corporation', 'Town Hall, Coimbatore 641001', '0422 239 0261', 'Town Hall Building'),
('Coimbatore District Collector Office', 'Collectorate Campus, Coimbatore 641018', '0422 230 5200', 'Near RS Puram'),
('Coimbatore City Police Commissionerate', 'RS Puram, Coimbatore 641002', '0422 230 0100', 'Commissionerate Building'),
('Passport Seva Kendra Coimbatore', 'Avinashi Road, Peelamedu, Coimbatore 641004', '0422 257 1234', 'Near Peelamedu Junction'),
('ESI Dispensary Coimbatore', 'Gandhipuram, Coimbatore 641012', '0422 221 3456', 'ESI Hospital Road'),
('Coimbatore District Court', 'Court Complex, Coimbatore 641018', '0422 230 2100', 'Court Complex'),
('TNEB Coimbatore', 'Avinashi Road, Coimbatore 641018', '0422 221 4000', 'EB Office'),
('TWAD Board Coimbatore', 'Ramanathapuram, Coimbatore 641045', '0422 266 5000', 'Water Board'),
('Commercial Tax Office Coimbatore', 'Gandhipuram, Coimbatore 641012', '0422 230 3456', 'Near Bus Stand');

-- -----------------------------------------------------------------------------
-- 10. covai_it_parks
-- -----------------------------------------------------------------------------
INSERT INTO `covai_it_parks` (`name`, `locality`, `address`, `phone`, `website`, `inauguration_year`, `owner`, `built_up_area`, `total_area`, `amenity_sez`, `amenity_parking`, `amenity_cafeteria`, `amenity_shuttle`, `lat`, `lng`, `companies`) VALUES
('Tidel Park Coimbatore', 'Saravanampatti', 'Tidel Park Road, Saravanampatti, Coimbatore 641035', '0422 710 0000', 'https://www.tidelpark.co.in', '2010', 'TIDCO', '5 lakh sq ft', '25 acres', 1, 1, 1, 1, 11.0690, 76.9980, 'Cognizant, HCL, Sutherland'),
('ELCOT IT Park Coimbatore', 'Vedapatti', 'ELCOT IT Park, Vedapatti, Coimbatore', '0422 231 5678', 'https://elcot.in', '2008', 'ELCOT', '3 lakh sq ft', '15 acres', 1, 1, 1, 0, 11.0520, 76.9650, 'IT companies'),
('KG Tech Park', 'Saravanampatti', 'KG Campus, Saravanampatti, Coimbatore 641035', '0422 661 9000', 'https://www.kgisl.com', '2012', 'KGISL', '2 lakh sq ft', '10 acres', 0, 1, 1, 0, 11.0680, 76.9950, 'KGISL, startups'),
('Kovai Industrial Park', 'Saravanampatti', 'Kovai Industrial Park, Saravanampatti, Coimbatore', NULL, NULL, '2012', 'Private', '2 lakh sq ft', '10 acres', 0, 1, 1, 0, 11.0720, 77.0050, NULL),
('Coimbatore Tech Park', 'Kalapatti', 'Kalapatti Road, Coimbatore 641048', NULL, NULL, '2015', 'Private', '1.5 lakh sq ft', '8 acres', 0, 1, 1, 0, 11.0880, 77.0180, NULL);
