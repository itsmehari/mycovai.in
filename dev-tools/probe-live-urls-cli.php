<?php
declare(strict_types=1);
$urls = [
    'https://mycovai.in/sitemap.xml',
    'https://mycovai.in/pages-sitemap.xml',
    'https://mycovai.in/directory/sitemap.xml',
    'https://mycovai.in/jobs/sitemap.xml',
    'https://mycovai.in/local-news/sitemap.xml',
    'https://mycovai.in/local-events/sitemap.xml',
    'https://mycovai.in/hostels-pgs/sitemap.xml',
    'https://mycovai.in/pentahive/sitemap.xml',
    'https://mycovai.in/',
];
foreach ($urls as $url) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 25,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_USERAGENT => 'MyCovai-Probe/1.0',
    ]);
    $body = (string) curl_exec($ch);
    $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $urlCount = substr_count($body, '<url>');
    $smapCount = substr_count($body, '<sitemap>');
    echo "=== $url ($code) urls=$urlCount smaps=$smapCount ===\n";
    echo substr($body, 0, 1200), "\n\n";
}
