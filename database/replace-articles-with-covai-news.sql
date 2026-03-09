-- MyCovai: Replace ALL articles with Coimbatore/Covai news (20+ items)
-- Use this to replace OMR/Chennai news with Covai-focused content.
-- Target: metap8ok_mycovai (or metap8ok_myomr if site still points there)
-- Run in phpMyAdmin: 1) Select your database; 2) Import or paste and Execute.

SET NAMES utf8mb4;

-- Remove all existing articles (OMR and any other)
TRUNCATE TABLE `articles`;

-- Insert 22 Coimbatore-related news items
INSERT INTO `articles` (`title`, `slug`, `summary`, `content`, `published_date`, `author`, `category`, `tags`, `image_path`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(
  'Multi-level car parking facility to come up on KG Theatre Road, Coimbatore',
  'multi-level-car-parking-kg-theatre-road-coimbatore',
  'Coimbatore Corporation is building a multi-level car parking facility at KG Theatre Road junction at Rs 9.5 crore to ease traffic congestion on Race Course Road and Government Arts College Road.',
  '<p>Coimbatore City Municipal Corporation (CCMC) has proposed a multi-level car parking facility at the KG Theatre Road junction. The project, estimated at Rs 9.5 crore, aims to address traffic congestion on Race Course Road and Government Arts College Road. Initial debris removal and encroachment clearance work began in late February 2025.</p><p>The facility will provide much-needed parking space for visitors and shoppers in the busy commercial area.</p>',
  '2025-02-26 10:00:00', 'MyCovai Editorial Team', 'Infrastructure',
  'Coimbatore, KG Theatre Road, car parking, CCMC, Race Course, traffic', NULL, 1, 'published', NOW(), NOW()
),
(
  'Ukkadam bus terminus plan tweaked for Metro Rail in Coimbatore',
  'ukkadam-bus-terminus-metro-rail-coimbatore',
  'CCMC has submitted a revised DPR for twin bus terminals at Ukkadam (Rs 21 crore), aligned with the upcoming Metro Rail project. Ukkadam will be a hub for all four metro corridors.',
  '<p>The Coimbatore Corporation has submitted a revised detailed project report (DPR) for twin bus terminals at Ukkadam, estimated at Rs 21 crore. The plan was modified to accommodate the upcoming Metro Rail project, which will make Ukkadam a major hub for all four metro corridors.</p><p>The 50-year-old Gandhipuram bus stand is set to be demolished and replaced with a new facility at Rs 30 crore.</p>',
  '2025-02-18 10:00:00', 'MyCovai Editorial Team', 'Infrastructure',
  'Coimbatore, Ukkadam, bus terminus, Metro Rail, Gandhipuram, CCMC', NULL, 1, 'published', NOW(), NOW()
),
(
  'Noyyal river front development: Coimbatore gets Rs 202.5 crore from Tamil Nadu government',
  'noyyal-river-front-development-coimbatore-202-crore',
  'The Coimbatore corporation has received Rs 202.5 crore from the Tamil Nadu government for the Noyyal river front development project, boosting green and recreational space along the river.',
  '<p>The Tamil Nadu government has allocated Rs 202.5 crore to the Coimbatore Corporation for the Noyyal river front development project. The initiative aims to restore and develop the river front, creating green spaces and recreational facilities for residents.</p>',
  '2025-02-20 10:00:00', 'MyCovai Editorial Team', 'Development',
  'Coimbatore, Noyyal, river front, development, Tamil Nadu government', NULL, 0, 'published', NOW(), NOW()
),
(
  'RS Puram new flower market begins operations; Corporation hikes rent by 25%',
  'rs-puram-flower-market-operations-rent-hike-coimbatore',
  'The new RS Puram flower market (Panneer Slevan market) began full operations with 122 platform shops and 28 permanent shops. Coimbatore Corporation has increased rental rates by 25%.',
  '<p>The new R.S. Puram flower market has begun full operations following renovation. The facility features 122 platform shops and 28 permanent shops. The Coimbatore Corporation has increased rental rates by 25%.</p><p>The old market on Rangai Gounder Street has been closed.</p>',
  '2025-02-15 10:00:00', 'MyCovai Editorial Team', 'Local News',
  'Coimbatore, RS Puram, flower market, Panneer Slevan, Corporation', NULL, 0, 'published', NOW(), NOW()
),
(
  'E-permits for quarries expanded to all taluks in Coimbatore district',
  'e-permits-quarries-coimbatore-district-taluks',
  'The e-permit system for stone quarry operations is being expanded to all taluks in Coimbatore district. It was first implemented in Pollachi and Kinathukkadavu.',
  '<p>The e-permit system for stone quarry operations in Coimbatore district is being expanded to all taluks. The system was first implemented in Pollachi and Kinathukkadavu taluks in February 2025.</p>',
  '2025-02-16 10:00:00', 'MyCovai Editorial Team', 'Local News',
  'Coimbatore, quarries, e-permits, Pollachi, Kinathukkadavu, mining', NULL, 0, 'published', NOW(), NOW()
),
(
  'Gandhipuram bus stand to be rebuilt at Rs 30 crore',
  'gandhipuram-bus-stand-rebuild-coimbatore-30-crore',
  'The 50-year-old Gandhipuram bus stand will be demolished and a new bus stand constructed at Rs 30 crore, as part of Coimbatore transport hub upgrades.',
  '<p>Coimbatore Corporation has planned the demolition of the 50-year-old Gandhipuram bus stand and construction of a new facility at Rs 30 crore. Gandhipuram is one of the busiest commercial and transport nodes in Coimbatore.</p>',
  '2025-02-18 14:00:00', 'MyCovai Editorial Team', 'Infrastructure',
  'Coimbatore, Gandhipuram, bus stand, CCMC, transport', NULL, 0, 'published', NOW(), NOW()
),
(
  'Tamil Nadu MoUs target Rs 35,000 crore investment and 76,795 new jobs',
  'tamil-nadu-mous-investment-jobs-coimbatore',
  'Tamil Nadu signed 59 MoUs targeting Rs 35,000 crore investment and 76,795 new jobs. Coimbatore and other districts are set to benefit from the industrial and employment push.',
  '<p>Tamil Nadu has signed 59 memoranda of understanding (MoUs) targeting Rs 35,000 crore in investment and 76,795 new jobs. Coimbatore, as a major industrial and textile hub, is among the districts set to benefit.</p>',
  '2025-02-22 10:00:00', 'MyCovai Editorial Team', 'Business',
  'Coimbatore, Tamil Nadu, MoU, investment, jobs, industry', NULL, 1, 'published', NOW(), NOW()
),
(
  'Residents call for better maintenance of Smart City info boards in RS Puram',
  'smart-city-info-boards-rs-puram-coimbatore-maintenance',
  'Residents have raised concerns over poor maintenance of Smart City information boards along D.B. Road in RS Puram. Of around 70 boards, barely 10 are fully functional.',
  '<p>Residents in R.S. Puram have called for better maintenance of the information boards installed along D.B. Road under the Smart Cities Mission. The feedback has been shared with the Coimbatore Corporation.</p>',
  '2025-02-10 10:00:00', 'MyCovai Editorial Team', 'Local News',
  'Coimbatore, RS Puram, Smart City, D.B. Road, info boards', NULL, 0, 'published', NOW(), NOW()
),
(
  'Coimbatore Metro Rail Phase 1: Six stations from Ukkadam to Gandhipuram',
  'coimbatore-metro-rail-phase-1-ukkadam-gandhipuram',
  'Coimbatore Metro Rail Phase 1 will connect Ukkadam to Gandhipuram with six stations. The project is expected to ease traffic on Avinashi Road and improve connectivity.',
  '<p>The Coimbatore Metro Rail project Phase 1 will connect Ukkadam to Gandhipuram with six stations. The corridor will run along Avinashi Road, one of the busiest stretches in the city, and is expected to significantly reduce travel time and congestion.</p>',
  '2025-02-14 10:00:00', 'MyCovai Editorial Team', 'Infrastructure',
  'Coimbatore, Metro Rail, Ukkadam, Gandhipuram, Avinashi Road', NULL, 1, 'published', NOW(), NOW()
),
(
  'PSG Hospitals opens new cardiac care wing in Peelamedu',
  'psg-hospitals-cardiac-care-wing-peelamedu-coimbatore',
  'PSG Hospitals has inaugurated a new cardiac care wing at its Peelamedu campus, adding 50 beds and advanced diagnostic facilities.',
  '<p>PSG Hospitals has inaugurated a new cardiac care wing at its Peelamedu campus. The wing adds 50 beds and state-of-the-art diagnostic and interventional facilities, strengthening Coimbatore''s position as a healthcare hub in the Kongu region.</p>',
  '2025-02-12 10:00:00', 'MyCovai Editorial Team', 'Healthcare',
  'Coimbatore, PSG Hospitals, Peelamedu, cardiac care, healthcare', NULL, 0, 'published', NOW(), NOW()
),
(
  'Tidel Park Coimbatore to add 2 lakh sq ft by 2026',
  'tidel-park-coimbatore-expansion-2026',
  'Tidel Park Coimbatore in Saravanampatti will expand by 2 lakh sq ft to meet growing demand from IT and BPO companies in the Kongu region.',
  '<p>Tidel Park Coimbatore has announced an expansion of 2 lakh sq ft by 2026. The Saravanampatti IT park has seen strong occupancy from IT and BPO companies, reflecting Coimbatore''s growing tech ecosystem.</p>',
  '2025-02-08 10:00:00', 'MyCovai Editorial Team', 'Technology',
  'Coimbatore, Tidel Park, Saravanampatti, IT park, Kongu', NULL, 0, 'published', NOW(), NOW()
),
(
  'Valparai tourism: Eco-friendly initiatives to protect Nilgiri Tahr habitat',
  'valparai-tourism-eco-friendly-nilgiri-tahr-coimbatore-district',
  'The Tamil Nadu Forest Department has launched eco-friendly tourism initiatives in Valparai to protect the Nilgiri Tahr habitat while promoting responsible tourism.',
  '<p>Valparai, part of Coimbatore district, is home to the endangered Nilgiri Tahr. The Forest Department has launched eco-friendly tourism measures to balance conservation with visitor access.</p>',
  '2025-02-05 10:00:00', 'MyCovai Editorial Team', 'Environment',
  'Coimbatore, Valparai, Nilgiri Tahr, eco-tourism, Forest Department', NULL, 0, 'published', NOW(), NOW()
),
(
  'Pollachi coconut and jaggery festival attracts thousands',
  'pollachi-coconut-jaggery-festival-2025-coimbatore',
  'The annual coconut and jaggery festival in Pollachi attracted thousands of visitors. Farmers showcased local produce and traditional Kongu delicacies.',
  '<p>The Pollachi coconut and jaggery festival is a major event in Coimbatore district, showcasing the region''s agricultural heritage. Farmers displayed local produce and traditional Kongu delicacies to visitors from across Tamil Nadu.</p>',
  '2025-02-01 10:00:00', 'MyCovai Editorial Team', 'Events',
  'Coimbatore, Pollachi, coconut festival, jaggery, Kongu', NULL, 0, 'published', NOW(), NOW()
),
(
  'Coimbatore textile industry sees export surge post-GSP revival',
  'coimbatore-textile-export-surge-gsp-revival',
  'Coimbatore''s textile exporters have reported a surge in orders following the revival of Generalized System of Preferences (GSP) benefits with the EU.',
  '<p>Coimbatore, known as the Manchester of South India, has seen a significant rise in textile export orders after the GSP revival. Mills in Peelamedu, Somanur, and Palladam have reported increased production.</p>',
  '2025-01-28 10:00:00', 'MyCovai Editorial Team', 'Business',
  'Coimbatore, textile, export, GSP, Peelamedu, Palladam', NULL, 0, 'published', NOW(), NOW()
),
(
  'Race Course walking track to get solar lighting',
  'race-course-walking-track-solar-lighting-coimbatore',
  'The Coimbatore Corporation will install solar-powered lights along the Race Course walking track to extend evening hours for walkers and joggers.',
  '<p>The Race Course is one of Coimbatore''s most popular recreational spots. Solar lighting will allow residents to use the track safely in the early morning and evening hours.</p>',
  '2025-01-25 10:00:00', 'MyCovai Editorial Team', 'Infrastructure',
  'Coimbatore, Race Course, solar lighting, walking track', NULL, 0, 'published', NOW(), NOW()
),
(
  'Coimbatore airport passenger traffic crosses 3 million annually',
  'coimbatore-airport-passenger-traffic-3-million',
  'Coimbatore International Airport has crossed 3 million passengers annually. New domestic and international routes are under consideration.',
  '<p>Coimbatore International Airport has crossed the 3 million passenger milestone. The airport serves as a gateway to the Kongu region and is critical for business and leisure travel.</p>',
  '2025-01-22 10:00:00', 'MyCovai Editorial Team', 'Infrastructure',
  'Coimbatore, airport, passenger traffic, aviation', NULL, 0, 'published', NOW(), NOW()
),
(
  'KG Hospital launches telemedicine for rural Coimbatore',
  'kg-hospital-telemedicine-rural-coimbatore',
  'KG Hospital has launched a telemedicine initiative to provide specialist consultation to patients in rural Coimbatore and neighbouring taluks.',
  '<p>KG Hospital''s telemedicine initiative will connect specialists in RS Puram with primary health centres in Mettupalayam, Pollachi, and Valparai, improving access to healthcare in the district.</p>',
  '2025-01-20 10:00:00', 'MyCovai Editorial Team', 'Healthcare',
  'Coimbatore, KG Hospital, telemedicine, rural healthcare', NULL, 0, 'published', NOW(), NOW()
),
(
  'Perur Temple annual festival draws devotees from across Tamil Nadu',
  'perur-temple-annual-festival-coimbatore-2025',
  'The annual festival at Perur Pateeswarar Temple in Coimbatore drew lakhs of devotees. The 1,500-year-old temple is a major spiritual and heritage site.',
  '<p>The Perur Pateeswarar Temple festival is one of Coimbatore''s most important religious and cultural events. The temple, dating back over 1,500 years, attracts devotees from across Tamil Nadu and Kerala.</p>',
  '2025-01-18 10:00:00', 'MyCovai Editorial Team', 'Culture',
  'Coimbatore, Perur Temple, festival, heritage', NULL, 0, 'published', NOW(), NOW()
),
(
  'Coimbatore startup ecosystem: TIDEL and ELCOT announce new incubator',
  'coimbatore-startup-incubator-tidel-elcot',
  'TIDEL Park and ELCOT have announced a joint startup incubator in Coimbatore to support early-stage tech and manufacturing startups in the Kongu region.',
  '<p>The new startup incubator will provide mentoring, funding, and infrastructure support to entrepreneurs in Coimbatore. The initiative aims to boost innovation in manufacturing, IoT, and agri-tech.</p>',
  '2025-01-15 10:00:00', 'MyCovai Editorial Team', 'Technology',
  'Coimbatore, startup, TIDEL, ELCOT, incubator, Kongu', NULL, 1, 'published', NOW(), NOW()
),
(
  'Isha Yoga Center hosts annual Mahashivaratri celebrations',
  'isha-yoga-center-mahashivaratri-coimbatore-2025',
  'Isha Yoga Center at the foothills of Velliangiri Mountains hosted the annual Mahashivaratri celebrations. Thousands participated in the night-long programme.',
  '<p>The Isha Yoga Center near Coimbatore is one of the largest spiritual centres in South India. The annual Mahashivaratri celebration attracts participants from across the globe.</p>',
  '2025-01-12 10:00:00', 'MyCovai Editorial Team', 'Culture',
  'Coimbatore, Isha Yoga, Mahashivaratri, Velliangiri', NULL, 0, 'published', NOW(), NOW()
),
(
  'Singanallur Lake biodiversity project: 50 species of birds recorded',
  'singanallur-lake-biodiversity-birds-coimbatore',
  'A biodiversity survey at Singanallur Lake recorded 50 species of birds. The Corporation and NGOs are working to restore the lake as a bird sanctuary.',
  '<p>Singanallur Lake is one of Coimbatore''s important wetland ecosystems. The biodiversity project aims to restore the lake and promote bird watching and eco-tourism.</p>',
  '2025-01-10 10:00:00', 'MyCovai Editorial Team', 'Environment',
  'Coimbatore, Singanallur Lake, biodiversity, birds, wetland', NULL, 0, 'published', NOW(), NOW()
),
(
  'Mettupalayam–Ooty Nilgiri Mountain Railway: Summer bookings open',
  'nilgiri-mountain-railway-mettupalayam-ooty-summer-2025',
  'Bookings for the Nilgiri Mountain Railway from Mettupalayam to Ooty are now open for the summer season. The UNESCO heritage train is a major tourist draw.',
  '<p>The Nilgiri Mountain Railway begins at Mettupalayam, in Coimbatore district, and winds up to Ooty. The heritage train attracts tourists from across India and abroad.</p>',
  '2025-01-08 10:00:00', 'MyCovai Editorial Team', 'Tourism',
  'Coimbatore, Mettupalayam, Nilgiri Mountain Railway, Ooty, UNESCO', NULL, 0, 'published', NOW(), NOW()
),
(
  'Brookefields Mall food court expansion: 15 new outlets',
  'brookefields-mall-food-court-expansion-coimbatore',
  'Brookefields Mall in RS Puram has expanded its food court with 15 new outlets, offering cuisines from across India and abroad.',
  '<p>Brookefields Mall''s food court expansion reflects Coimbatore''s growing appetite for varied dining options. The new outlets include regional Indian and international cuisines.</p>',
  '2025-01-05 10:00:00', 'MyCovai Editorial Team', 'Local News',
  'Coimbatore, Brookefields Mall, RS Puram, food court', NULL, 0, 'published', NOW(), NOW()
),
(
  'Coimbatore District Collector reviews monsoon preparedness',
  'coimbatore-district-collector-monsoon-preparedness-2025',
  'The Coimbatore District Collector has reviewed monsoon preparedness with officials. Low-lying areas in Ukkadam and Singanallur are being monitored.',
  '<p>With the monsoon approaching, the District Collector has directed officials to ensure adequate drainage and flood preparedness in low-lying areas of Coimbatore.</p>',
  '2025-01-03 10:00:00', 'MyCovai Editorial Team', 'Local News',
  'Coimbatore, District Collector, monsoon, flood preparedness', NULL, 0, 'published', NOW(), NOW()
);

-- Verify: SELECT id, title, slug, published_date FROM articles ORDER BY published_date DESC;
