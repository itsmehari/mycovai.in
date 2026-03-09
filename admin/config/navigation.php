<?php
/**
 * Unified navigation registry for MyCovai admin.
 * Structure powers the sidebar, dashboard index, and future menu builders.
 */

return [
    [
        'key' => 'dashboard_content',
        'label' => 'Dashboard & Content',
        'icon' => 'fa-gauge-high',
        'modules' => [
            [
                'key' => 'module_picker',
                'name' => 'Module Picker',
                'description' => 'Jump to any admin module from one place.',
                'path' => '/admin/index.php',
                'icon' => 'fa-th-large',
                'tags' => ['dashboard', 'modules', 'picker'],
            ],
            [
                'key' => 'dashboard',
                'name' => 'Admin Overview',
                'description' => 'High-level analytics, pending approvals, and quick stats.',
                'path' => '/admin/dashboard.php',
                'icon' => 'fa-chart-pie',
                'tags' => ['dashboard', 'overview', 'analytics'],
            ],
            [
                'key' => 'articles',
                'name' => 'News Articles',
                'description' => 'Primary news system: homepage cards and /local-news/ detail pages.',
                'path' => '/admin/articles/index.php',
                'icon' => 'fa-newspaper',
                'tags' => ['news', 'articles', 'content'],
                'actions' => [
                    ['label' => 'Add Article', 'path' => '/admin/articles/add.php'],
                ],
            ],
            [
                'key' => 'news',
                'name' => 'News Bulletin',
                'description' => 'Legacy news_bulletin table, separate from Articles.',
                'path' => '/admin/news-list.php',
                'icon' => 'fa-list',
                'tags' => ['news', 'bulletin', 'legacy'],
                'actions' => [
                    ['label' => 'Add News', 'path' => '/admin/news-add.php'],
                    ['label' => 'Draft Queue', 'path' => '/admin/news-list.php#drafts'],
                ],
            ],
            [
                'key' => 'events',
                'name' => 'Events',
                'description' => 'Review submissions, publish events, and access analytics.',
                'path' => '/admin/events/events-list.php',
                'icon' => 'fa-calendar-days',
                'tags' => ['events', 'calendar'],
                'actions' => [
                    ['label' => 'Add Event', 'path' => '/admin/events/events-add.php'],
                    ['label' => 'Events Analytics', 'path' => '/admin/events-analytics.php'],
                ],
            ],
            [
                'key' => 'jobs',
                'name' => 'Jobs Portal',
                'description' => 'Manage job listings, approvals, and featured roles.',
                'path' => '/jobs/admin/index.php',
                'icon' => 'fa-briefcase',
                'tags' => ['jobs', 'careers', 'employment'],
            ],
            [
                'key' => 'hostels_pgs',
                'name' => 'Hostels & PGs',
                'description' => 'Oversee hostel, PG, and co-living listings.',
                'path' => '/hostels-pgs/admin/manage-properties.php',
                'icon' => 'fa-building-user',
                'tags' => ['hostel', 'pg', 'property'],
            ],
            [
                'key' => 'coworking',
                'name' => 'Coworking Spaces',
                'description' => 'Manage coworking space listings and owner verification.',
                'path' => '/coworking-spaces/admin/manage-spaces.php',
                'icon' => 'fa-people-group',
                'tags' => ['coworking', 'spaces', 'property'],
            ],
            [
                'key' => 'restaurants',
                'name' => 'Restaurants & Cafés',
                'description' => 'Curate restaurant listings, menus, and availability.',
                'path' => '/admin/restaurants-list.php',
                'icon' => 'fa-utensils',
                'tags' => ['restaurants', 'food', 'dining'],
                'actions' => [
                    ['label' => 'Add Restaurant', 'path' => '/admin/restaurants-add.php'],
                ],
            ],
        ],
    ],
    [
        'key' => 'directories',
        'label' => 'Local Directories',
        'icon' => 'fa-city',
        'modules' => [
            [
                'key' => 'banks',
                'name' => 'Banks Directory',
                'description' => 'Manage bank branches and ATM information.',
                'path' => '/admin/banks-list.php',
                'icon' => 'fa-landmark',
                'tags' => ['banks', 'finance', 'directories'],
                'actions' => [
                    ['label' => 'Manage Banks', 'path' => '/admin/manage-banks.php'],
                ],
            ],
            [
                'key' => 'schools',
                'name' => 'Schools & Colleges',
                'description' => 'Oversee educational listings, contact info, and facilities.',
                'path' => '/admin/schools-list.php',
                'icon' => 'fa-graduation-cap',
                'tags' => ['schools', 'education', 'directories'],
                'actions' => [
                    ['label' => 'Manage Schools', 'path' => '/admin/manage-schools.php'],
                ],
            ],
            [
                'key' => 'hospitals',
                'name' => 'Hospitals & Clinics',
                'description' => 'Maintain healthcare providers and emergency contacts.',
                'path' => '/admin/hospitals-list.php',
                'icon' => 'fa-house-medical',
                'tags' => ['hospitals', 'health', 'directories'],
                'actions' => [
                    ['label' => 'Manage Hospitals', 'path' => '/admin/manage-hospitals.php'],
                ],
            ],
            [
                'key' => 'parks',
                'name' => 'Parks & Recreation',
                'description' => 'Update parks, recreation spaces, and amenities.',
                'path' => '/admin/parks-list.php',
                'icon' => 'fa-tree',
                'tags' => ['parks', 'outdoor', 'directories'],
                'actions' => [
                    ['label' => 'Manage Parks', 'path' => '/admin/manage-parks.php'],
                ],
            ],
            [
                'key' => 'industries',
                'name' => 'Industrial Directory',
                'description' => 'Manage industrial hubs and company listings.',
                'path' => '/admin/industries-list.php',
                'icon' => 'fa-industry-windows',
                'tags' => ['industries', 'business', 'directories'],
                'actions' => [
                    ['label' => 'Manage Industries', 'path' => '/admin/manage-industries.php'],
                ],
            ],
            [
                'key' => 'government',
                'name' => 'Government Offices',
                'description' => 'Maintain municipal offices, contacts, and services.',
                'path' => '/admin/government-offices-list.php',
                'icon' => 'fa-landmark-flag',
                'tags' => ['government', 'civic', 'directories'],
            ],
            [
                'key' => 'atms',
                'name' => 'ATM Network',
                'description' => 'Track ATMs and banking touchpoints across OMR.',
                'path' => '/admin/atms-list.php',
                'icon' => 'fa-building-columns',
                'tags' => ['atm', 'finance', 'directories'],
                'actions' => [
                    ['label' => 'Manage ATMs', 'path' => '/admin/manage-atms.php'],
                ],
            ],
        ],
    ],
    [
        'key' => 'technology',
        'label' => 'Technology & IT',
        'icon' => 'fa-microchip',
        'modules' => [
            [
                'key' => 'it_submissions',
                'name' => 'IT Submissions',
                'description' => 'Review IT company submissions and inbound leads.',
                'path' => '/admin/it-submissions-list.php',
                'icon' => 'fa-clipboard-list',
                'tags' => ['it', 'submissions', 'technology'],
            ],
            [
                'key' => 'it_companies',
                'name' => 'IT Companies',
                'description' => 'Manage IT company profiles and categories.',
                'path' => '/admin/it-companies-list.php',
                'icon' => 'fa-building',
                'tags' => ['it', 'companies', 'technology'],
            ],
            [
                'key' => 'featured_it',
                'name' => 'Featured IT Listings',
                'description' => 'Highlight premium IT companies and sponsorships.',
                'path' => '/admin/featured-it-list.php',
                'icon' => 'fa-star',
                'tags' => ['featured', 'it', 'technology'],
            ],
            [
                'key' => 'it_parks',
                'name' => 'IT Parks Hub',
                'description' => 'Maintain IT park details, tenants, and facilities.',
                'path' => '/admin/it-parks/manage.php',
                'icon' => 'fa-network-wired',
                'tags' => ['it', 'parks', 'technology'],
                'actions' => [
                    ['label' => 'Featured IT Parks', 'path' => '/admin/it-parks/featured.php'],
                    ['label' => 'Import & Export', 'path' => '/admin/it-parks/import-export.php'],
                ],
            ],
        ],
    ],
    [
        'key' => 'operations',
        'label' => 'Operations & Utilities',
        'icon' => 'fa-screwdriver-wrench',
        'modules' => [
            [
                'key' => 'migrations',
                'name' => 'Migrations Runner',
                'description' => 'Execute database migrations and schema updates.',
                'path' => '/admin/migrations-runner.php',
                'icon' => 'fa-database',
                'tags' => ['operations', 'database', 'maintenance'],
            ],
            [
                'key' => 'change_password',
                'name' => 'Admin Security',
                'description' => 'Update account passwords and manage session security.',
                'path' => '/admin/change-password.php',
                'icon' => 'fa-user-shield',
                'tags' => ['security', 'account', 'operations'],
            ],
        ],
    ],
];


