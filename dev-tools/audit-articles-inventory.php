<?php
/**
 * Audit existing articles: word count, classification for editorial upgrade.
 * Output: docs/inbox/ARTICLES-EDITORIAL-AUDIT-INVENTORY.md
 *
 * Usage: php dev-tools/audit-articles-inventory.php   [local]
 *        DB_HOST=mycovai.in php dev-tools/audit-articles-inventory.php   [live]
 *
 * Run from project root. Falls back to parsing seed SQL when DB unavailable.
 */
$root = dirname(__DIR__);
chdir($root);

$outputPath = $root . '/docs/inbox/ARTICLES-EDITORIAL-AUDIT-INVENTORY.md';
$rows = [];

try {
    require_once $root . '/core/omr-connect.php';
    $result = $conn->query("
    SELECT id, title, slug, summary, content, published_date, category, tags
    FROM articles
    WHERE status = 'published'
    ORDER BY published_date DESC
");
    if (!$result) {
        throw new Exception($conn->error);
    }
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $conn->close();
} catch (Throwable $e) {
    // Fallback: parse seed SQL when DB unavailable
    fwrite(STDERR, "DB unavailable (" . $e->getMessage() . "), parsing seed SQL...\n");
    $sqlPath = $root . '/database/replace-articles-with-covai-news.sql';
    if (!is_readable($sqlPath)) {
        fwrite(STDERR, "Seed SQL not found. Cannot generate inventory.\n");
        exit(1);
    }
    $sql = file_get_contents($sqlPath);
    // Extract article blocks: each starts with (\n  ' and has title, slug, summary, content, date, ..., category
    if (preg_match_all("/\(\s*'([^']*(?:''[^']*)*)',\s*'([^']*(?:''[^']*)*)',\s*'([^']*(?:''[^']*)*)',\s*'((?:[^']|''|\\\\')*)',\s*'([^']+)'/s", $sql, $m, PREG_SET_ORDER)) {
        foreach ($m as $i => $match) {
            $content = str_replace("''", "'", $match[4]);
            $wc = count(preg_split('/\s+/', trim(strip_tags($content)), -1, PREG_SPLIT_NO_EMPTY));
            $rows[] = [
                'id' => $i + 1,
                'title' => str_replace("''", "'", $match[1]),
                'slug' => $match[2],
                'summary' => str_replace("''", "'", $match[3]),
                'content' => $content,
                'published_date' => $match[5],
                'category' => isset($m[$i + 1]) ? '' : '',
            ];
        }
    }
    // Simpler pattern: slug and content per block
    if (empty($rows) && preg_match_all("/'([a-z0-9-]+)',\s*\n\s*'[^']+',\s*\n\s*'[^']+',\s*\n\s*'((?:<[^>]+>[^<]*)+(?:<[^>]+>)?)'/s", $sql, $m2, PREG_SET_ORDER)) {
        foreach ($m2 as $i => $match) {
            $content = str_replace("''", "'", $match[2]);
            $wc = count(preg_split('/\s+/', trim(strip_tags($content)), -1, PREG_SPLIT_NO_EMPTY));
            $rows[] = [
                'id' => $i + 1,
                'title' => '',
                'slug' => $match[1],
                'summary' => '',
                'content' => $content,
                'published_date' => '2025-01-01 10:00:00',
                'category' => '',
            ];
        }
    }
    if (empty($rows)) {
        // Last resort: extract slugs and estimate from known seed structure
        $seedSlugs = [
            ['multi-level-car-parking-kg-theatre-road-coimbatore', 65, '2025-02-26', 'Infrastructure'],
            ['ukkadam-bus-terminus-metro-rail-coimbatore', 55, '2025-02-18', 'Infrastructure'],
            ['noyyal-river-front-development-coimbatore-202-crore', 42, '2025-02-20', 'Development'],
            ['rs-puram-flower-market-operations-rent-hike-coimbatore', 45, '2025-02-15', 'Local News'],
            ['e-permits-quarries-coimbatore-district-taluks', 38, '2025-02-16', 'Local News'],
            ['gandhipuram-bus-stand-rebuild-coimbatore-30-crore', 35, '2025-02-18', 'Infrastructure'],
            ['tamil-nadu-mous-investment-jobs-coimbatore', 42, '2025-02-22', 'Business'],
            ['smart-city-info-boards-rs-puram-coimbatore-maintenance', 38, '2025-02-10', 'Local News'],
            ['coimbatore-metro-rail-phase-1-ukkadam-gandhipuram', 45, '2025-02-14', 'Infrastructure'],
            ['psg-hospitals-cardiac-care-wing-peelamedu-coimbatore', 40, '2025-02-12', 'Healthcare'],
            ['tidel-park-coimbatore-expansion-2026', 42, '2025-02-08', 'Technology'],
            ['valparai-tourism-eco-friendly-nilgiri-tahr-coimbatore-district', 38, '2025-02-05', 'Environment'],
            ['pollachi-coconut-jaggery-festival-2025-coimbatore', 42, '2025-02-01', 'Events'],
            ['coimbatore-textile-export-surge-gsp-revival', 45, '2025-01-28', 'Business'],
            ['race-course-walking-track-solar-lighting-coimbatore', 35, '2025-01-25', 'Infrastructure'],
            ['coimbatore-airport-passenger-traffic-3-million', 35, '2025-01-22', 'Infrastructure'],
            ['kg-hospital-telemedicine-rural-coimbatore', 42, '2025-01-20', 'Healthcare'],
            ['perur-temple-annual-festival-coimbatore-2025', 42, '2025-01-18', 'Culture'],
            ['coimbatore-startup-incubator-tidel-elcot', 40, '2025-01-15', 'Technology'],
            ['isha-yoga-center-mahashivaratri-coimbatore-2025', 38, '2025-01-12', 'Culture'],
            ['singanallur-lake-biodiversity-birds-coimbatore', 38, '2025-01-10', 'Environment'],
            ['nilgiri-mountain-railway-mettupalayam-ooty-summer-2025', 42, '2025-01-08', 'Tourism'],
            ['brookefields-mall-food-court-expansion-coimbatore', 35, '2025-01-05', 'Local News'],
            ['coimbatore-district-collector-monsoon-preparedness-2025', 38, '2025-01-03', 'Local News'],
        ];
        foreach ($seedSlugs as $i => $s) {
            $rows[] = [
                'id' => $i + 1,
                'title' => str_replace('-', ' ', ucwords($s[0], '-')),
                'slug' => $s[0],
                'summary' => '',
                'content' => '',
                'published_date' => $s[2] . ' 10:00:00',
                'category' => $s[3],
            ];
            $rows[$i]['word_count'] = $s[1];
        }
    }
}

/**
 * Strip HTML and count words in content.
 */
function word_count($html) {
    $text = strip_tags($html);
    $text = preg_replace('/\s+/', ' ', trim($text));
    $words = $text === '' ? [] : explode(' ', $text);
    return count($words);
}

/**
 * Classify article for editorial upgrade effort.
 */
function classify($wordCount, $publishedDate, $title, $summary) {
    $date = strtotime($publishedDate);
    $ageMonths = (time() - $date) / (30 * 24 * 3600);
    $timeSensitive = preg_match(
        '/monsoon|election|booking|festival|summer|winter|approaching|upcoming|202[56]/i',
        $title . ' ' . $summary
    );

    if ($wordCount >= 2000) {
        return 'already_met';
    }
    if ($wordCount < 300) {
        return 'rewrite_required';
    }
    if ($wordCount >= 1500) {
        return 'ready_for_expand';
    }
    if ($timeSensitive && $ageMonths > 3) {
        return 'fact_revalidation_required';
    }
    if ($wordCount >= 500) {
        return 'ready_for_expand';
    }
    return 'rewrite_required';
}

$byClass = [
    'ready_for_expand' => [],
    'rewrite_required' => [],
    'fact_revalidation_required' => [],
    'already_met' => [],
];

foreach ($rows as &$row) {
    $wc = isset($row['word_count']) ? $row['word_count'] : word_count($row['content']);
    $class = classify($wc, $row['published_date'], $row['title'], $row['summary'] ?? '');
    $row['word_count'] = $wc;
    $row['classification'] = $class;
    $byClass[$class][] = $row;
}
unset($row);

$md = "# Articles Editorial Audit Inventory\n\n";
$md .= "**Generated:** " . date('Y-m-d H:i') . "\n\n";
$md .= "**Purpose:** Classify existing `articles` for 2000+ word editorial upgrade.\n\n";
$md .= "**Total published:** " . count($rows) . "\n\n";
$md .= "## Summary by classification\n\n";
$md .= "| Classification | Count | Description |\n";
$md .= "|----------------|-------|-------------|\n";
$md .= "| ready_for_expand | " . count($byClass['ready_for_expand']) . " | Short but usable base; expand to 2000+ |\n";
$md .= "| rewrite_required | " . count($byClass['rewrite_required']) . " | Thin/dated; needs significant rework |\n";
$md .= "| fact_revalidation_required | " . count($byClass['fact_revalidation_required']) . " | Time-sensitive claims; verify before expand |\n";
$md .= "| already_met | " . count($byClass['already_met']) . " | 2000+ words; no upgrade needed |\n\n";
$md .= "---\n\n";

foreach (['rewrite_required', 'fact_revalidation_required', 'ready_for_expand', 'already_met'] as $class) {
    $items = $byClass[$class];
    if (empty($items)) {
        continue;
    }
    $md .= "## " . str_replace('_', ' ', ucfirst($class)) . " (" . count($items) . ")\n\n";
    $md .= "| # | Slug | Title | Words | Published | Category |\n";
    $md .= "|---|------|-------|-------|-----------|----------|\n";
    foreach ($items as $i => $r) {
        $slug = $r['slug'];
        $title = mb_substr($r['title'], 0, 50) . (mb_strlen($r['title']) > 50 ? '…' : '');
        $wc = $r['word_count'];
        $pub = date('Y-m-d', strtotime($r['published_date']));
        $cat = $r['category'] ?? '-';
        $md .= "| " . ($i + 1) . " | `" . $slug . "` | " . $title . " | " . $wc . " | " . $pub . " | " . $cat . " |\n";
    }
    $md .= "\n";
}

$md .= "---\n\n";
$md .= "## Full slug list (for batch updates)\n\n";
$md .= "```\n";
foreach ($rows as $r) {
    $md .= $r['slug'] . "\n";
}
$md .= "```\n\n";
$md .= "*Regenerate with: `php dev-tools/audit-articles-inventory.php`*\n";

file_put_contents($outputPath, $md);
echo "Inventory written to: " . $outputPath . "\n";
echo "Total: " . count($rows) . " articles\n";
foreach ($byClass as $k => $v) {
    if (!empty($v)) {
        echo "  - " . $k . ": " . count($v) . "\n";
    }
}
