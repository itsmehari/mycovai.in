<?php
/**
 * Homepage listing counts for MyCovai directory categories.
 * Returns count per category; uses 0 if table doesn't exist or query fails.
 * Requires $conn (mysqli) to be available.
 */
if (!isset($conn) || !($conn instanceof mysqli)) {
    return [];
}

// MyCovai uses covai_* tables
$tables = [
    'schools'           => function_exists('covai_table') ? covai_table('schools') : 'omrschoolslist',
    'best-schools'      => function_exists('covai_table') ? covai_table('schools') : 'omrschoolslist',
    'it-companies'      => function_exists('covai_table') ? covai_table('it-companies') : 'omr_it_companies',
    'industries'        => function_exists('covai_table') ? covai_table('industries') : 'omr_industries',
    'restaurants'       => function_exists('covai_table') ? covai_table('restaurants') : 'omr_restaurants',
    'government-offices'=> function_exists('covai_table') ? covai_table('government-offices') : 'omr_gov_offices',
    'atms'              => function_exists('covai_table') ? covai_table('atms') : 'omr_atms',
    'parks'             => function_exists('covai_table') ? covai_table('parks') : 'omrparkslist',
    'banks'             => function_exists('covai_table') ? covai_table('banks') : 'omrbankslist',
    'hospitals'         => function_exists('covai_table') ? covai_table('hospitals') : 'omrhospitalslist',
    'hostels-pgs'       => 'hostels_pgs',
    'coworking-spaces'  => 'coworking_spaces',
];

$counts = [];
$seen_tables = [];

foreach ($tables as $key => $table) {
    if (isset($seen_tables[$table])) {
        $counts[$key] = $seen_tables[$table];
        continue;
    }
    $n = 0;
    try {
        $r = @$conn->query("SELECT COUNT(*) AS c FROM `" . $conn->real_escape_string($table) . "`");
        if ($r && $row = $r->fetch_assoc()) {
            $n = (int) $row['c'];
        }
    } catch (Exception $e) {
        // leave 0
    }
    $counts[$key] = $n;
    $seen_tables[$table] = $n;
}

return $counts;
