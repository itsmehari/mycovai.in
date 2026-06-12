<?php
/**
 * Homepage + directory hub category grid (single source of truth).
 * Keys must stay in sync with directory_hub_listing_targets() in directory-hub-redirect.php.
 *
 * @return array<string, array{0: string, 1: string, 2: string, 3: bool}>
 */
return [
    'it-parks'           => ['IT Parks', '/directory/it-parks.php', 'fas fa-building', false],
    'schools'            => ['Schools', '/directory/schools.php', 'fas fa-school', false],
    'best-schools'       => ['Best Schools', '/directory/best-schools.php', 'fas fa-star', false],
    'it-companies'       => ['IT Companies', '/directory/it-companies.php', 'fas fa-laptop-code', true],
    'industries'         => ['Industries', '/directory/industries.php', 'fas fa-industry', false],
    'restaurants'        => ['Restaurants', '/directory/restaurants.php', 'fas fa-utensils', false],
    'government-offices' => ['Government Offices', '/directory/government-offices.php', 'fas fa-building', false],
    'atms'               => ['ATMs', '/directory/atms.php', 'fas fa-credit-card', false],
    'parks'              => ['Parks', '/directory/parks.php', 'fas fa-tree', false],
    'banks'              => ['Banks', '/directory/banks.php', 'fas fa-university', false],
    'hospitals'          => ['Hospitals', '/directory/hospitals.php', 'fas fa-hospital', false],
    'hostels-pgs'        => ['Hostels & PGs', '/hostels-pgs/', 'fas fa-bed', false],
    'coworking-spaces'   => ['Coworking Spaces', '/coworking-spaces/', 'fas fa-building', false],
];
