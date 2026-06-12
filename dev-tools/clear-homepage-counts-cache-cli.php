<?php
/**
 * Clear homepage listing count cache (run after bulk directory imports).
 * Usage: php dev-tools/clear-homepage-counts-cache-cli.php
 */
declare(strict_types=1);

$cacheFile = dirname(__DIR__) . '/logs/cache/homepage-listing-counts.json';

if (is_file($cacheFile) && @unlink($cacheFile)) {
    echo "Cleared: $cacheFile\n";
    exit(0);
}

if (!is_file($cacheFile)) {
    echo "No cache file to clear.\n";
    exit(0);
}

echo "Failed to remove cache file.\n";
exit(1);
