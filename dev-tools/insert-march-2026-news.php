<?php
/**
 * Insert 10 March 2026 Coimbatore news articles into articles table.
 * Sources: The Hindu, Times of India, New Indian Express, ANI (validated via web search, dates up to 19-03-2026).
 * Run: php insert-march-2026-news.php   [local]
 *      DB_HOST=mycovai.in php insert-march-2026-news.php   [live]
 */
$root = dirname(__DIR__);
require_once $root . '/core/omr-connect.php';

$articles = [
    [
        'title'        => 'Cordon and search operations held in Coimbatore ahead of Assembly election',
        'slug'         => 'cordon-search-operations-coimbatore-assembly-election-march-2026',
        'summary'      => 'Police conducted cordon and search operations across Coimbatore on March 15, 2026 to maintain law and order and curb anti-social activities ahead of the Tamil Nadu Assembly election.',
        'content'      => '<p>In view of the 2026 Tamil Nadu Legislative Assembly election, Coimbatore police carried out cordon and search operations at multiple locations in the city on March 15, 2026. The exercise was aimed at maintaining law and order and suppressing anti-social activities before polling.</p><p>Similar exercises have been conducted in other districts as part of election preparedness under the Model Code of Conduct.</p>',
        'published_date' => '2026-03-15 10:00:00',
        'category'     => 'Local News',
        'tags'         => 'Coimbatore, Assembly election 2026, cordon and search, police, Model Code of Conduct',
    ],
    [
        'title'        => 'Stalin opens 11.8 km stretch of Western Ring Road in Coimbatore',
        'slug'         => 'stalin-opens-western-ring-road-coimbatore-march-2026',
        'summary'      => 'Chief Minister M K Stalin inaugurated Phase I of the Western Ring Road in Coimbatore via videoconference on March 14, 2026. The 11.8 km four-lane stretch from Mayilkal to Madampatti includes two flyovers and 13 minor bridges.',
        'content'      => '<p>Chief Minister M K Stalin inaugurated the first phase of the Western Ring Road in Coimbatore via videoconference on March 14, 2026. The newly opened 11.8 km four-lane stretch runs from Mayilkal near Madukkarai to Madampatti Junction and includes two flyovers, two vehicle underpasses and 13 minor bridges.</p><p>Developed at an estimated Rs 250 crore, this section is part of a proposed 32.43 km ring road and is expected to reduce travel time to Siruvani Road from over 45 minutes to about 15 minutes.</p>',
        'published_date' => '2026-03-14 10:00:00',
        'category'     => 'Infrastructure',
        'tags'         => 'Coimbatore, Western Ring Road, Stalin, Madukkarai, Madampatti',
    ],
    [
        'title'        => 'TNPCB urged not to approve waste-to-energy plant at Vellalore dump yard',
        'slug'         => 'tnpcb-urged-reject-waste-to-energy-vellalore-coimbatore-march-2026',
        'summary'      => 'The Kurichi-Vellalore Pollution Prevention Action Committee has urged the Tamil Nadu Pollution Control Board not to approve the Coimbatore corporation\'s waste-to-energy plant at Vellalore, citing environmental concerns.',
        'content'      => '<p>On March 19, 2026, the Kurichi-Vellalore Pollution Prevention Action Committee urged the Tamil Nadu Pollution Control Board (TNPCB) not to approve the Coimbatore City Municipal Corporation\'s proposal to set up a waste-to-energy plant at the Vellalore dump yard. The committee cited existing environmental degradation in the area, including air pollution, groundwater contamination and odour issues.</p>',
        'published_date' => '2026-03-19 10:00:00',
        'category'     => 'Environment',
        'tags'         => 'Coimbatore, Vellalore, waste-to-energy, TNPCB, pollution',
    ],
    [
        'title'        => 'Cash and valuables worth Rs 1.09 crore seized in Coimbatore since Model Code of Conduct',
        'slug'         => 'cash-valuables-seized-coimbatore-model-code-conduct-march-2026',
        'summary'      => 'Election surveillance teams in Coimbatore have seized cash and valuables worth Rs 1.09 crore since the Model Code of Conduct came into effect for the 2026 Assembly election, with cash alone accounting for Rs 51.85 lakh.',
        'content'      => '<p>As of March 18, 2026, cash and valuables worth Rs 1.09 crore had been seized in Coimbatore district since the Model Code of Conduct came into effect for the Tamil Nadu Legislative Assembly election. Cash seizures accounted for Rs 51.85 lakh of the total. Flying squads and static surveillance teams have been deployed across the district to check use of money and gifts to influence voters.</p>',
        'published_date' => '2026-03-18 10:00:00',
        'category'     => 'Local News',
        'tags'         => 'Coimbatore, election 2026, Model Code of Conduct, seizure, surveillance',
    ],
    [
        'title'        => 'Marriage hall owners in Coimbatore told not to allow cash distribution',
        'slug'         => 'marriage-hall-owners-coimbatore-cash-distribution-march-2026',
        'summary'      => 'District administration and police held a consultation with marriage hall owners in Coimbatore on March 17, 2026, directing them not to allow premises to be used for distribution of cash or gifts during the election period.',
        'content'      => '<p>At a consultation meeting on March 17, 2026, marriage hall owners in Coimbatore were directed by the district administration and police not to allow their premises to be used for distribution of cash or other inducements during the Assembly election period. The move is part of efforts to enforce the Model Code of Conduct and prevent electoral malpractices.</p>',
        'published_date' => '2026-03-17 14:00:00',
        'category'     => 'Local News',
        'tags'         => 'Coimbatore, election 2026, marriage halls, Model Code of Conduct',
    ],
    [
        'title'        => 'NDA holds protest in Coimbatore against DMK government',
        'slug'         => 'nda-protest-coimbatore-dmk-government-march-2026',
        'summary'      => 'NDA leaders including AIADMK and BJP staged a protest in Coimbatore on March 17, 2026, criticising the DMK government over unfulfilled promises, law and order and infrastructure.',
        'content'      => '<p>The NDA held a protest in Coimbatore on March 17, 2026, with AIADMK and BJP leaders slamming the DMK government. Former minister S P Velumani, former BJP state president K Annamalai and BJP Mahila Morcha national president Vanathi Srinivasan were among those who spoke, criticising the government for failing to deliver on promises such as three lakh government jobs, and raising concerns over law and order and women\'s safety.</p>',
        'published_date' => '2026-03-17 10:00:00',
        'category'     => 'Local News',
        'tags'         => 'Coimbatore, NDA, AIADMK, BJP, DMK, protest, election 2026',
    ],
    [
        'title'        => 'Nearly 17,000 officials appointed as polling personnel in Coimbatore district',
        'slug'         => 'polling-personnel-coimbatore-district-assembly-election-2026',
        'summary'      => 'Nearly 17,000 government officials have been appointed as polling personnel for the 2026 Assembly election in Coimbatore district, with an additional 3,000 support staff. The district has over 27 lakh registered voters.',
        'content'      => '<p>Nearly 17,000 officials have been appointed as polling personnel in Coimbatore district for the 2026 Tamil Nadu Legislative Assembly election, with around 3,000 support staff taking the total to over 20,000. As of March 15, the district had 27,14,676 registered voters. The district has 3,540 polling stations. Election security measures include 90 flying squad teams, 90 static surveillance teams and 10 video surveillance teams across the 10 Assembly constituencies.</p>',
        'published_date' => '2026-03-15 10:00:00',
        'category'     => 'Local News',
        'tags'         => 'Coimbatore, election 2026, polling personnel, voters',
    ],
    [
        'title'        => 'Police take out flag march in Coimbatore ahead of elections',
        'slug'         => 'police-flag-march-coimbatore-election-march-2026',
        'summary'      => 'Coimbatore police conducted a flag march on March 17, 2026 to reinforce confidence in law and order ahead of the Tamil Nadu Assembly election.',
        'content'      => '<p>Police in Coimbatore took out a flag march on March 17, 2026 as part of election preparedness. The march was aimed at reinforcing public confidence in law and order ahead of the Tamil Nadu Legislative Assembly election. Such exercises are routinely conducted in the run-up to polling to deter unlawful activities and assure citizens of a secure environment.</p>',
        'published_date' => '2026-03-17 09:00:00',
        'category'     => 'Local News',
        'tags'         => 'Coimbatore, police, flag march, election 2026',
    ],
    [
        'title'        => 'Coimbatore roads being upgraded with Rs 200 crore special fund',
        'slug'         => 'coimbatore-roads-rs-200-crore-upgrade-march-2026',
        'summary'      => 'Coimbatore Corporation is upgrading roads with a Rs 200 crore special fund from the Tamil Nadu government. Renovation of 3,456 roads covering 503.67 km has been completed; TURIP works on over 2,084 roads are in progress.',
        'content'      => '<p>The Coimbatore City Municipal Corporation is undertaking extensive road upgrades with a special Rs 200 crore fund allocated by the Tamil Nadu government. The corporation has completed renovation of 3,456 roads covering 503.67 km through tar relaying and strengthening. Under the Tamil Nadu Urban Road Improvement Programme (TURIP), over 2,084 roads spanning 287.99 km are in progress at an estimated cost of Rs 123 crore. Damaged concrete roads across all five zones are to be repaired at Rs 10.86 crore.</p>',
        'published_date' => '2026-03-05 10:00:00',
        'category'     => 'Infrastructure',
        'tags'         => 'Coimbatore, roads, CCMC, TURIP, infrastructure',
    ],
    [
        'title'        => '182 polling stations marked as vulnerable in Coimbatore district',
        'slug'         => '182-polling-stations-vulnerable-coimbatore-march-2026',
        'summary'      => 'Election authorities have marked 182 polling stations as vulnerable in Coimbatore district for the 2026 Assembly election — 78 under City Police limits and 104 under District Police limits.',
        'content'      => '<p>For the 2026 Tamil Nadu Assembly election, 182 polling stations have been identified as vulnerable in Coimbatore district. Of these, 78 fall under Coimbatore City Police limits and 104 under District Police limits. The district has a total of 3,540 polling stations including eight auxiliary stations, with 2,537 in urban areas and 1,026 in rural areas. Extra security and monitoring are typically deployed at vulnerable booths to ensure free and fair polling.</p>',
        'published_date' => '2026-03-16 10:00:00',
        'category'     => 'Local News',
        'tags'         => 'Coimbatore, election 2026, polling stations, vulnerable',
    ],
];

$author = 'MyCovai Editorial Team';
$image_path = null;
$is_featured = 0;
$status = 'published';

$stmt = $conn->prepare("INSERT INTO articles (title, slug, summary, content, published_date, author, category, tags, image_path, is_featured, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
if (!$stmt) {
    fwrite(STDERR, "Prepare failed: " . $conn->error . "\n");
    exit(1);
}

$inserted = 0;
foreach ($articles as $a) {
    $stmt->bind_param('sssssssssis',
        $a['title'],
        $a['slug'],
        $a['summary'],
        $a['content'],
        $a['published_date'],
        $author,
        $a['category'],
        $a['tags'],
        $image_path,
        $is_featured,
        $status
    );
    if ($stmt->execute()) {
        $inserted++;
        echo "Inserted: " . $a['slug'] . "\n";
    } else {
        if ($conn->errno === 1062) {
            echo "Skip (duplicate slug): " . $a['slug'] . "\n";
        } else {
            fwrite(STDERR, "Error for " . $a['slug'] . ": " . $stmt->error . "\n");
        }
    }
}
$stmt->close();
$conn->close();

echo "\nDone. Inserted: $inserted of " . count($articles) . ".\n";
