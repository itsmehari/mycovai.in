<?php
/**
 * CLI: fetch live event listing + detail pages; check GA tag + Event JSON-LD.
 * Usage: php dev-tools/check-live-events-ga-jsonld.php [detailUrl] [listingUrl]
 */
if (PHP_SAPI !== 'cli') {
    exit('CLI only');
}

$detailUrl = $argv[1] ?? 'https://mycovai.in/local-events/event/vihansa-2026-sri-ramakrishna-institute-of-technology';
$listingUrl = $argv[2] ?? 'https://mycovai.in/local-events/';

function fetchUrl(string $url): ?string
{
    $ctx = stream_context_create([
        'http' => [
            'timeout' => 25,
            'header' => "User-Agent: MyCovai-events-qa/1.0\r\n",
            'follow_location' => 1,
        ],
        'ssl' => [
            'verify_peer' => true,
            'verify_peer_name' => true,
        ],
    ]);
    $html = @file_get_contents($url, false, $ctx);
    return $html === false ? null : $html;
}

/**
 * @param 'detail'|'listing' $kind
 */
function checkPage(string $label, string $url, string $kind): int
{
    echo "=== {$label} ===\n{$url}\n";
    $html = fetchUrl($url);
    if ($html === null) {
        echo "FAIL: could not fetch\n\n";
        return 1;
    }
    $fail = 0;
    if (preg_match('/googletagmanager\.com\/gtag|gtag\s*\(/', $html)) {
        echo "OK: GA / gtag present\n";
    } else {
        echo "FAIL: no gtag snippet detected\n";
        $fail++;
    }

    if ($kind === 'listing') {
        echo "(Listing page: Event JSON-LD not required)\n\n";
        return $fail > 0 ? 1 : 0;
    }

    if (!preg_match_all('#<script[^>]+type=["\']application/ld\+json["\'][^>]*>(.*?)</script>#is', $html, $m)) {
        echo "FAIL: no application/ld+json scripts\n\n";
        return 1;
    }
    $foundEvent = false;
    foreach ($m[1] as $raw) {
        $raw = trim($raw);
        $data = json_decode($raw, true);
        if (!is_array($data)) {
            continue;
        }
        $types = [];
        if (isset($data['@type'])) {
            $types[] = $data['@type'];
        }
        if (isset($data['@graph']) && is_array($data['@graph'])) {
            foreach ($data['@graph'] as $node) {
                if (isset($node['@type'])) {
                    $types[] = $node['@type'];
                }
            }
        }
        if (!in_array('Event', $types, true)) {
            continue;
        }
        $foundEvent = true;
        $need = ['name', 'startDate', 'location', 'url'];
        $missing = [];
        foreach ($need as $k) {
            if (empty($data[$k])) {
                $missing[] = $k;
            }
        }
        if ($missing === []) {
            echo "OK: Event JSON-LD has " . implode(', ', $need) . "\n";
        } else {
            echo "WARN: Event JSON-LD missing: " . implode(', ', $missing) . "\n";
            $fail++;
        }
        break;
    }
    if (!$foundEvent) {
        echo "FAIL: no @type Event in ld+json blocks\n";
        $fail++;
    }

    echo "\n";
    return $fail > 0 ? 1 : 0;
}

$code = 0;
$code |= checkPage('Event detail', $detailUrl, 'detail');
$code |= checkPage('Events listing', $listingUrl, 'listing');
exit($code);
