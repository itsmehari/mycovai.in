<?php
/**
 * Centralized configuration for directory pages.
 * MyCovai uses covai_* tables; table names resolved via covai_table() when available.
 */

// Directory page configurations (table names use covai_table() when available)
$directory_configs = [
    'schools' => [
        'title' => 'Schools in Coimbatore',
        'description' => 'Find schools in Coimbatore (Covai). Get school names, addresses, contacts, and landmarks for your child\'s education.',
        'table' => (function_exists('covai_table') ? covai_table('schools') : 'omrschoolslist'),
        'fields' => [
            'id' => 'slno',
            'name' => 'schoolname',
            'address' => 'address',
            'contact' => 'contact',
            'landmark' => 'landmark'
        ],
        'icon' => 'fas fa-graduation-cap',
        'color' => '#0583D2',
        'intro_text' => [
            'Coimbatore has experienced significant growth as a major educational hub, with numerous schools catering to the diverse needs of the community across RS Puram, Gandhipuram, Peelamedu, Saibaba Colony and beyond.',
            'The schools in Coimbatore are renowned for their commitment to academic excellence, holistic development, and state-of-the-art facilities. They offer a variety of curricula, including CBSE, ICSE, and international programs, ensuring that parents have a wide array of choices to best suit their children\'s educational requirements.',
            'Whether you\'re seeking institutions with a strong emphasis on traditional values or those that incorporate innovative teaching methodologies, the schools in Coimbatore provide an ideal environment for nurturing young minds.'
        ]
    ],
    'hospitals' => [
        'title' => 'Hospitals in Coimbatore',
        'description' => 'Find hospitals in Coimbatore (Covai). Get hospital names, addresses, contacts, and landmarks for healthcare services.',
        'table' => (function_exists('covai_table') ? covai_table('hospitals') : 'omrhospitalslist'),
        'fields' => [
            'id' => 'slno',
            'name' => 'hospitalname',
            'address' => 'address',
            'contact' => 'contact',
            'landmark' => 'landmark'
        ],
        'icon' => 'fas fa-hospital',
        'color' => '#0583D2',
        'intro_text' => [
            'Healthcare accessibility is crucial for any thriving community, and Coimbatore has developed into a well-equipped medical hub serving the growing population.',
            'The hospitals and medical facilities in Coimbatore offer comprehensive healthcare services, from emergency care to specialized treatments, ensuring residents have access to quality medical care close to home.',
            'These healthcare institutions are equipped with modern facilities and staffed by experienced medical professionals, providing peace of mind to the Coimbatore community.'
        ]
    ],
    'restaurants' => [
        'title' => 'Restaurants in Coimbatore',
        'description' => 'Explore restaurants in Coimbatore (Covai). Find restaurant names, addresses, cuisines, ratings, and more.',
        'table' => (function_exists('covai_table') ? covai_table('restaurants') : 'omr_restaurants'),
        'fields' => [
            'id' => 'id',
            'name' => 'name',
            'address' => 'address',
            'contact' => 'contact',
            'landmark' => 'locality',
            'cuisine' => 'cuisine',
            'rating' => 'rating',
            'cost_for_two' => 'cost_for_two'
        ],
        'icon' => 'fas fa-utensils',
        'color' => '#0583D2',
        'intro_text' => [
            'Coimbatore\'s dining scene has flourished, offering a diverse range of vegetarian restaurants that cater to every palate and budget.',
            'From traditional South Indian cuisine to North Indian delicacies, the restaurants in Coimbatore provide authentic flavors and modern dining experiences.',
            'Whether you\'re looking for a quick lunch, family dinner, or special occasion dining, Coimbatore\'s restaurant scene has something to satisfy every craving.'
        ],
        'has_filters' => true,
        'filters' => [
            'locality' => 'Locality',
            'cuisine' => 'Cuisine',
            'cost' => 'Max Cost for Two (₹)',
            'rating' => 'Minimum Rating'
        ]
    ],
    'banks' => [
        'title' => 'Banks in Coimbatore',
        'description' => 'Find banks and financial institutions in Coimbatore (Covai). Get bank names, addresses, contacts, and services.',
        'table' => (function_exists('covai_table') ? covai_table('banks') : 'omrbankslist'),
        'fields' => [
            'id' => 'slno',
            'name' => 'bankname',
            'address' => 'address',
            'contact' => 'contact',
            'landmark' => 'landmark'
        ],
        'icon' => 'fas fa-university',
        'color' => '#0583D2',
        'intro_text' => [
            'Financial services are essential for any growing community, and Coimbatore hosts a comprehensive network of banks and financial institutions.',
            'From nationalized banks to private sector banks, Coimbatore offers convenient access to all major banking services across RS Puram, Gandhipuram, Peelamedu and beyond.',
            'These institutions provide a full range of services including savings accounts, loans, investment options, and digital banking solutions.'
        ]
    ],
    'atms' => [
        'title' => 'ATMs in Coimbatore',
        'description' => 'Find ATM locations in Coimbatore (Covai). Get ATM locations, addresses, and bank information.',
        'table' => (function_exists('covai_table') ? covai_table('atms') : 'omr_atms'),
        'fields' => [
            'id' => 'slno',
            'name' => 'atmname',
            'address' => 'address',
            'contact' => 'contact',
            'landmark' => 'landmark'
        ],
        'icon' => 'fas fa-credit-card',
        'color' => '#0583D2',
        'intro_text' => [
            'Convenient access to cash is essential for daily transactions, and Coimbatore provides numerous ATM locations throughout the city.',
            'These ATMs are strategically placed near residential areas, commercial zones, and IT parks for easy access.',
            'Most ATMs offer 24/7 service and support multiple banking networks for maximum convenience.'
        ]
    ],
    'it-companies' => [
        'title' => 'IT Companies in Coimbatore',
        'description' => 'Explore IT companies and technology firms in Coimbatore (Covai). Find company names, addresses, and contact information.',
        'table' => (function_exists('covai_table') ? covai_table('it-companies') : 'omr_it_companies'),
        'fields' => [
            'id' => 'slno',
            'name' => 'company_name',
            'address' => 'address',
            'contact' => 'contact',
            'locality' => 'locality',
            'industry_type' => 'industry_type',
            'slug' => 'slug',
            'verified' => 'verified'
        ],
        'icon' => 'fas fa-laptop-code',
        'color' => '#0583D2',
        'intro_text' => [
            'Coimbatore is a thriving tech hub, hosting numerous technology companies, startups, and multinational corporations.',
            'From established IT giants to innovative startups, the Coimbatore ecosystem provides opportunities for career growth and technological advancement.',
            'These companies offer diverse roles in software development, data analytics, artificial intelligence, and other cutting-edge technologies.'
        ]
    ],
    'industries' => [
        'title' => 'Industries in Coimbatore',
        'description' => 'Find industrial units and manufacturing facilities in Coimbatore (Covai).',
        'table' => (function_exists('covai_table') ? covai_table('industries') : 'omr_industries'),
        'fields' => [
            'id' => 'slno',
            'name' => 'industryname',
            'address' => 'address',
            'contact' => 'contact',
            'landmark' => 'landmark'
        ],
        'icon' => 'fas fa-industry',
        'color' => '#0583D2',
        'intro_text' => [
            'Coimbatore hosts a diverse range of industrial units and manufacturing facilities.',
            'These industries contribute significantly to the local economy and provide employment opportunities.',
            'From small-scale manufacturing to large industrial units, Coimbatore offers a balanced mix of technology and traditional industries.'
        ]
    ],
    'parks' => [
        'title' => 'Parks in Coimbatore',
        'description' => 'Discover parks and recreational spaces in Coimbatore (Covai). Find park locations, facilities, and amenities.',
        'table' => (function_exists('covai_table') ? covai_table('parks') : 'omrparkslist'),
        'fields' => [
            'id' => 'slno',
            'name' => 'parkname',
            'address' => 'address',
            'contact' => 'contact',
            'landmark' => 'landmark'
        ],
        'icon' => 'fas fa-tree',
        'color' => '#0583D2',
        'intro_text' => [
            'Green spaces are essential for community well-being, and Coimbatore offers several parks and recreational areas for residents.',
            'These parks provide spaces for exercise, relaxation, and community gatherings.',
            'From small neighborhood parks to larger recreational facilities, Coimbatore\'s green spaces enhance the quality of life for residents.'
        ]
    ],
    'government-offices' => [
        'title' => 'Government Offices in Coimbatore',
        'description' => 'Find government offices and administrative centers in Coimbatore (Covai).',
        'table' => (function_exists('covai_table') ? covai_table('government-offices') : 'omr_gov_offices'),
        'fields' => [
            'id' => 'slno',
            'name' => 'officename',
            'address' => 'address',
            'contact' => 'contact',
            'landmark' => 'landmark'
        ],
        'icon' => 'fas fa-building',
        'color' => '#0583D2',
        'intro_text' => [
            'Government services are easily accessible through various administrative offices located across Coimbatore.',
            'These offices provide essential services including civic administration, public utilities, and citizen services.',
            'Residents can access government services without traveling far from their homes or workplaces.'
        ]
    ]
];

/**
 * Get configuration for a specific directory type
 */
function get_directory_config($type) {
    global $directory_configs;
    return isset($directory_configs[$type]) ? $directory_configs[$type] : null;
}

/**
 * Get all available directory types
 */
function get_directory_types() {
    global $directory_configs;
    return array_keys($directory_configs);
}

/**
 * Generate SQL query for directory data
 */
function get_directory_sql($config, $filters = []) {
    $fields = implode(', ', array_values($config['fields']));
    $table = $config['table'];
    
    $sql = "SELECT $fields FROM $table WHERE 1=1";
    
    // Add filters if any
    foreach ($filters as $field => $value) {
        if (!empty($value)) {
            $sql .= " AND $field LIKE '%$value%'";
        }
    }
    
    return $sql;
}

/**
 * Generate structured data for SEO
 */
function generate_structured_data($config, $data) {
    $structured_data = [
        "@context" => "https://schema.org",
        "@type" => "LocalBusiness",
        "name" => $data['name'],
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => $data['address'],
            "addressLocality" => "Coimbatore",
            "addressRegion" => "Tamil Nadu",
            "postalCode" => "600097",
            "addressCountry" => "IN"
        ]
    ];
    
    if (isset($data['contact'])) {
        $structured_data["telephone"] = $data['contact'];
    }
    
    return json_encode($structured_data, JSON_UNESCAPED_SLASHES);
}
?>
