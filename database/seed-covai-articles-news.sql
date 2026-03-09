-- MyCovai: Seed articles table with Coimbatore/Covai local news
-- Target DB: metap8ok_mycovai
-- Run after tables are created. Sources: TOI Coimbatore, The Hindu Coimbatore, New Indian Express (Tamil Nadu).
-- Image paths: NULL (site uses default); add real paths later to /local-news/covai-news-images/

-- Optional: clear existing articles if re-seeding (uncomment to use)
-- DELETE FROM articles WHERE author = 'MyCovai Editorial Team' OR category LIKE '%Coimbatore%';

INSERT INTO `articles` (`title`, `slug`, `summary`, `content`, `published_date`, `author`, `category`, `tags`, `image_path`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(
  'Multi-level car parking facility to come up on KG Theatre Road, Coimbatore',
  'multi-level-car-parking-kg-theatre-road-coimbatore',
  'Coimbatore Corporation is building a multi-level car parking facility at KG Theatre Road junction at Rs 9.5 crore to ease traffic congestion on Race Course Road and Government Arts College Road.',
  '<p>Coimbatore City Municipal Corporation (CCMC) has proposed a multi-level car parking facility at the KG Theatre Road junction. The project, estimated at Rs 9.5 crore, aims to address traffic congestion on Race Course Road and Government Arts College Road. Initial debris removal and encroachment clearance work began in late February 2025.</p><p>The facility will provide much-needed parking space for visitors and shoppers in the busy commercial area, reducing on-road parking and improving traffic flow.</p>',
  '2025-02-26 10:00:00',
  'MyCovai Editorial Team',
  'Infrastructure',
  'Coimbatore, KG Theatre Road, car parking, CCMC, Race Course, traffic',
  NULL,
  1,
  'published',
  NOW(),
  NOW()
),
(
  'Ukkadam bus terminus plan tweaked for Metro Rail in Coimbatore',
  'ukkadam-bus-terminus-metro-rail-coimbatore',
  'CCMC has submitted a revised DPR for twin bus terminals at Ukkadam (Rs 21 crore), aligned with the upcoming Metro Rail project. Ukkadam will be a hub for all four metro corridors.',
  '<p>The Coimbatore Corporation has submitted a revised detailed project report (DPR) to the Directorate of Municipal Administration for twin bus terminals at Ukkadam, estimated at Rs 21 crore. The plan was modified to accommodate the upcoming Metro Rail project, which will make Ukkadam a major hub for all four metro corridors.</p><p>In addition, the 50-year-old Gandhipuram bus stand is set to be demolished and replaced with a new facility at an estimated cost of Rs 30 crore.</p>',
  '2025-02-18 10:00:00',
  'MyCovai Editorial Team',
  'Infrastructure',
  'Coimbatore, Ukkadam, bus terminus, Metro Rail, Gandhipuram, CCMC',
  NULL,
  1,
  'published',
  NOW(),
  NOW()
),
(
  'Noyyal river front development: Coimbatore gets Rs 202.5 crore from Tamil Nadu government',
  'noyyal-river-front-development-coimbatore-202-crore',
  'The Coimbatore corporation has received Rs 202.5 crore from the Tamil Nadu government for the Noyyal river front development project, boosting green and recreational space along the river.',
  '<p>The Tamil Nadu government has allocated Rs 202.5 crore to the Coimbatore Corporation for the Noyyal river front development project. The initiative aims to restore and develop the river front, creating green spaces and recreational facilities for residents.</p><p>The project is part of broader efforts to improve urban ecology and quality of life in Coimbatore.</p>',
  '2025-02-20 10:00:00',
  'MyCovai Editorial Team',
  'Development',
  'Coimbatore, Noyyal, river front, development, Tamil Nadu government',
  NULL,
  0,
  'published',
  NOW(),
  NOW()
),
(
  'RS Puram new flower market begins operations; Corporation hikes rent by 25%',
  'rs-puram-flower-market-operations-rent-hike-coimbatore',
  'The new RS Puram flower market (Panneer Slevan market) began full operations with 122 platform shops and 28 permanent shops. Coimbatore Corporation has increased rental rates by 25%.',
  '<p>The new R.S. Puram flower market (Panneer Slevan market) has begun full operations following renovation. The facility features 122 platform shops and 28 permanent shops. The Coimbatore Corporation has increased rental rates by 25%, with vendors reporting improved facilities despite the rent hike.</p><p>The old market on Rangai Gounder Street has been closed, and the new market is now the primary flower market for the RS Puram area.</p>',
  '2025-02-15 10:00:00',
  'MyCovai Editorial Team',
  'Local News',
  'Coimbatore, RS Puram, flower market, Panneer Slevan, Corporation',
  NULL,
  0,
  'published',
  NOW(),
  NOW()
),
(
  'E-permits for quarries to be expanded to all taluks in Coimbatore district',
  'e-permits-quarries-coimbatore-district-taluks',
  'The e-permit system for stone quarry operations is being expanded to all taluks in Coimbatore district to streamline mining and prevent overloading. It was first implemented in Pollachi and Kinathukkadavu.',
  '<p>The e-permit system for stone quarry operations in Coimbatore district is being expanded to all taluks. The system was first implemented in Pollachi and Kinathukkadavu taluks in February 2025, with plans to extend it to the remaining taluks. The move aims to streamline mining operations and prevent overloading, ensuring better regulation and environmental compliance.</p>',
  '2025-02-16 10:00:00',
  'MyCovai Editorial Team',
  'Local News',
  'Coimbatore, quarries, e-permits, Pollachi, Kinathukkadavu, mining',
  NULL,
  0,
  'published',
  NOW(),
  NOW()
),
(
  'Gandhipuram bus stand to be rebuilt at Rs 30 crore',
  'gandhipuram-bus-stand-rebuild-coimbatore-30-crore',
  'The 50-year-old Gandhipuram bus stand will be demolished and a new bus stand constructed at an estimated cost of Rs 30 crore, as part of Coimbatore’s transport hub upgrades.',
  '<p>Coimbatore Corporation has planned the demolition of the 50-year-old Gandhipuram bus stand and the construction of a new facility at an estimated cost of Rs 30 crore. The project is part of broader upgrades to the city’s transport infrastructure, including the Ukkadam terminus and Metro Rail integration.</p><p>Gandhipuram is one of the busiest commercial and transport nodes in Coimbatore.</p>',
  '2025-02-18 14:00:00',
  'MyCovai Editorial Team',
  'Infrastructure',
  'Coimbatore, Gandhipuram, bus stand, CCMC, transport',
  NULL,
  0,
  'published',
  NOW(),
  NOW()
),
(
  'Tamil Nadu MoUs target Rs 35,000 crore investment and 76,795 new jobs',
  'tamil-nadu-mous-investment-jobs-coimbatore',
  'Tamil Nadu signed 59 MoUs targeting Rs 35,000 crore investment and 76,795 new jobs. Coimbatore and other districts are set to benefit from the industrial and employment push.',
  '<p>Tamil Nadu has signed 59 memoranda of understanding (MoUs) targeting Rs 35,000 crore in investment and 76,795 new jobs across the state. Coimbatore, as a major industrial and textile hub, is among the districts set to benefit from the new projects and employment opportunities.</p><p>The state government has been actively promoting investment in manufacturing, IT, and renewable energy.</p>',
  '2025-02-22 10:00:00',
  'MyCovai Editorial Team',
  'Business',
  'Coimbatore, Tamil Nadu, MoU, investment, jobs, industry',
  NULL,
  1,
  'published',
  NOW(),
  NOW()
),
(
  'Residents call for better maintenance of Smart City info boards in RS Puram',
  'smart-city-info-boards-rs-puram-coimbatore-maintenance',
  'Residents have raised concerns over poor maintenance of Smart City information boards along D.B. Road in RS Puram. Of around 70 boards, barely 10 are fully functional.',
  '<p>Residents in R.S. Puram have called for better maintenance of the information boards installed along D.B. Road under the Smart Cities Mission. Of approximately 70 boards featuring local leaders and activists, barely 10 are fully functional, with many showing damaged or non-working digital displays. Each board cost around Rs 12,500 to develop. The feedback has been shared with the Coimbatore Corporation for corrective action.</p>',
  '2025-02-10 10:00:00',
  'MyCovai Editorial Team',
  'Local News',
  'Coimbatore, RS Puram, Smart City, D.B. Road, info boards',
  NULL,
  0,
  'published',
  NOW(),
  NOW()
);

-- Verify: SELECT id, title, slug, published_date, status FROM articles ORDER BY published_date DESC;
