<?php

/**

 * Homepage listing counts for MyCovai directory categories.

 * Returns count per category; uses 0 if table doesn't exist or query fails.

 * Requires $conn (mysqli) to be available.

 *

 * Results are cached in logs/cache/homepage-listing-counts.json (1 hour TTL).

 */

if (!isset($conn) || !($conn instanceof mysqli)) {

    return [];

}



$cacheDir = dirname(__DIR__) . '/logs/cache';

$cacheFile = $cacheDir . '/homepage-listing-counts.json';

$cacheTtl = 3600;



if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTtl) {

    $cached = json_decode((string) file_get_contents($cacheFile), true);

    if (is_array($cached)) {

        return $cached;

    }

}



// MyCovai uses covai_* tables

$tables = [

    'it-parks'          => function_exists('covai_table') ? covai_table('it-parks') : 'covai_it_parks',

    'schools'           => function_exists('covai_table') ? covai_table('schools') : 'covai_schools',

    'best-schools'      => function_exists('covai_table') ? covai_table('schools') : 'covai_schools',

    'it-companies'      => function_exists('covai_table') ? covai_table('it-companies') : 'covai_it_companies',

    'industries'        => function_exists('covai_table') ? covai_table('industries') : 'covai_industries',

    'restaurants'       => function_exists('covai_table') ? covai_table('restaurants') : 'covai_restaurants',

    'government-offices'=> function_exists('covai_table') ? covai_table('government-offices') : 'covai_gov_offices',

    'atms'              => function_exists('covai_table') ? covai_table('atms') : 'covai_atms',

    'parks'             => function_exists('covai_table') ? covai_table('parks') : 'covai_parks',

    'banks'             => function_exists('covai_table') ? covai_table('banks') : 'covai_banks',

    'hospitals'         => function_exists('covai_table') ? covai_table('hospitals') : 'covai_hospitals',

    'hostels-pgs'       => 'hostels_pgs',

    'coworking-spaces'  => 'coworking_spaces',

];



$count_queries = [

    'best-schools' => function (mysqli $conn, string $table) {

        $sql = "SELECT COUNT(*) AS c FROM `" . $conn->real_escape_string($table) . "` WHERE verified = 1";

        $r = @$conn->query($sql);

        if ($r && $row = $r->fetch_assoc()) {

            return (int) $row['c'];

        }

        return 0;

    },

];



$counts = [];

$seen_tables = [];



foreach ($tables as $key => $table) {

    if (isset($count_queries[$key])) {

        $counts[$key] = $count_queries[$key]($conn, $table);

        continue;

    }

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



if (!is_dir($cacheDir)) {

    @mkdir($cacheDir, 0755, true);

}

@file_put_contents($cacheFile, json_encode($counts, JSON_UNESCAPED_SLASHES));



return $counts;

