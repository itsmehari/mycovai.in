<?php
declare(strict_types=1);

/**
 * Maps directory hub / homepage search slugs to listing URLs and query parameter names.
 * Homepage uses: q, location, category (slug). Listing pages use q/search + locality.
 */
function directory_hub_listing_targets(): array
{
    return [
        /** Canonical listing; clean URL /it-parks may 301 via legacy handler */
        'it-parks'           => ['path' => '/directory/it-parks.php', 'text_q' => 'q', 'area' => 'locality'],
        'schools'            => ['path' => '/directory/schools.php', 'text_q' => 'q', 'area' => 'locality'],
        'best-schools'       => ['path' => '/directory/best-schools.php', 'text_q' => 'q', 'area' => 'locality'],
        'it-companies'       => ['path' => '/directory/it-companies.php', 'text_q' => 'q', 'area' => 'locality'],
        'industries'         => ['path' => '/directory/industries.php', 'text_q' => 'q', 'area' => 'locality'],
        'restaurants'        => ['path' => '/directory/restaurants.php', 'text_q' => 'q', 'area' => 'locality'],
        'government-offices' => ['path' => '/directory/government-offices.php', 'text_q' => 'q', 'area' => 'locality'],
        'atms'               => ['path' => '/directory/atms.php', 'text_q' => 'q', 'area' => 'locality'],
        'parks'              => ['path' => '/directory/parks.php', 'text_q' => 'q', 'area' => 'locality'],
        'banks'              => ['path' => '/directory/banks.php', 'text_q' => 'q', 'area' => 'locality'],
        'hospitals'          => ['path' => '/directory/hospitals.php', 'text_q' => 'q', 'area' => 'locality'],
        'hostels-pgs'        => ['path' => '/hostels-pgs/', 'text_q' => 'search', 'area' => 'locality'],
        'coworking-spaces'   => ['path' => '/coworking-spaces/', 'text_q' => 'search', 'area' => 'locality'],
    ];
}

function directory_hub_build_url(string $slug, string $q, string $location): ?string
{
    $targets = directory_hub_listing_targets();
    if (!isset($targets[$slug])) {
        return null;
    }
    $t = $targets[$slug];
    $params = [];
    if ($t['text_q'] !== null && $q !== '') {
        $params[$t['text_q']] = $q;
    }
    if ($t['area'] !== null && $location !== '') {
        $params[$t['area']] = $location;
    }
    $query = http_build_query($params);
    return $t['path'] . ($query !== '' ? '?' . $query : '');
}
