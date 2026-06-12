<?php
/**
 * Publish Tamil Nadu cabinet portfolios article for Coimbatore / Covai (16 May 2026).
 * Inserts or updates English + Tamil (-tamil) pair.
 *
 * Run (local):  php dev-tools/sql/run-tamil-nadu-cabinet-portfolios-coimbatore-covai-article-16-may-2026.php
 * Run (live):   DB_HOST=mycovai.in php dev-tools/sql/run-tamil-nadu-cabinet-portfolios-coimbatore-covai-article-16-may-2026.php
 */
$root = dirname(__DIR__, 2);
require_once $root . '/core/omr-connect.php';
require_once __DIR__ . '/cabinet-article-covai-body.php';
require_once __DIR__ . '/cabinet-article-covai-body-tamil.php';

$electionsBase = '/coimbatore-elections-2026';
$published_date = '2026-05-16 09:00:00';
$author = 'MyCovai Editorial Team';
$category = 'Local News';
$image_path = 'https://images.news9live.com/wp-content/uploads/2025/06/Tamil-Nadu-govt.jpg';
$is_featured = 1;
$status = 'published';

$articles = [
    [
        'slug'    => 'tamil-nadu-cabinet-portfolios-announced-coimbatore-covai-impact',
        'title'   => 'Tamil Nadu Cabinet Portfolios Announced: What It Means for Coimbatore and Covai Residents',
        'summary' => 'Tamil Nadu CM C. Joseph Vijay has allocated ministerial portfolios. What Municipal Administration, PWD, Industries, Health and Finance mean for Coimbatore, Covai, Peelamedu and the district.',
        'tags'    => 'Tamil Nadu Cabinet, Coimbatore, Covai, C. Joseph Vijay, MLA, Municipal Administration, Avinashi Road, Industries, CMCH, Lok Bhavan',
        'content' => covai_cabinet_article_html($electionsBase),
    ],
    [
        'slug'    => 'tamil-nadu-cabinet-portfolios-announced-coimbatore-covai-impact-tamil',
        'title'   => 'தமிழ்நாடு அமைச்சரவை பொறுப்புகள்: கோயம்புத்தூர் & கோவை வாசிகளுக்கு என்ன அர்த்தம்?',
        'summary' => 'முதலமைச்சர் C. Joseph Vijay அமைச்சரவை பொறுப்புகள் ஒதுக்கீடு. நகராட்சி நிர்வாகம், பொதுப்பணி, தொழில், சுகாதாரம், நிதி &mdash; கோவை, பீலாமேடு, சிங்காநல்லூர் பகுதிகளுக்கு என்ன பொருள்?',
        'tags'    => 'தமிழ்நாடு அமைச்சரவை, கோயம்புத்தூர், கோவை, C. Joseph Vijay, எம்எல்ஏ, நகராட்சி, அவினாசி சாலை, தொழில், CMCH, லோக் பவன',
        'content' => covai_cabinet_article_html_tamil($electionsBase),
    ],
];

/**
 * @param array{slug:string,title:string,summary:string,tags:string,content:string} $article
 */
function covai_cabinet_upsert_article(mysqli $conn, array $article, string $published_date, string $author, string $category, ?string $image_path, int $is_featured, string $status): void
{
    $check = $conn->prepare('SELECT id FROM articles WHERE slug = ? LIMIT 1');
    $check->bind_param('s', $article['slug']);
    $check->execute();
    $existing = $check->get_result()->fetch_assoc();
    $check->close();

    if ($existing) {
        $stmt = $conn->prepare(
            'UPDATE articles SET title = ?, summary = ?, content = ?, published_date = ?, author = ?, category = ?, tags = ?, image_path = ?, is_featured = ?, status = ?, updated_at = NOW() WHERE slug = ?'
        );
        $stmt->bind_param(
            'ssssssssiss',
            $article['title'],
            $article['summary'],
            $article['content'],
            $published_date,
            $author,
            $category,
            $article['tags'],
            $image_path,
            $is_featured,
            $status,
            $article['slug']
        );
        if ($stmt->execute()) {
            echo "Updated article id {$existing['id']}: {$article['slug']}\n";
        } else {
            fwrite(STDERR, 'Update failed for ' . $article['slug'] . ': ' . $stmt->error . "\n");
            exit(1);
        }
        $stmt->close();
        return;
    }

    $stmt = $conn->prepare(
        'INSERT INTO articles (title, slug, summary, content, published_date, author, category, tags, image_path, is_featured, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())'
    );
    $stmt->bind_param(
        'sssssssssis',
        $article['title'],
        $article['slug'],
        $article['summary'],
        $article['content'],
        $published_date,
        $author,
        $category,
        $article['tags'],
        $image_path,
        $is_featured,
        $status
    );
    if ($stmt->execute()) {
        echo "Inserted article id {$conn->insert_id}: {$article['slug']}\n";
    } else {
        fwrite(STDERR, 'Insert failed for ' . $article['slug'] . ': ' . $stmt->error . "\n");
        exit(1);
    }
    $stmt->close();
}

foreach ($articles as $article) {
    covai_cabinet_upsert_article($conn, $article, $published_date, $author, $category, $image_path, $is_featured, $status);
    echo "Canonical: https://mycovai.in/local-news/{$article['slug']}\n";
}

$conn->close();
echo "Done.\n";
