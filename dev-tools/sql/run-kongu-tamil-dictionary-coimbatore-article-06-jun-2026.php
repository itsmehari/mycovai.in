<?php
/**
 * Publish Kongu Tamil regional dictionary article (Coimbatore / Covai).
 * Inserts or updates English + Tamil (-tamil) pair.
 *
 * Run (local):  php dev-tools/sql/run-kongu-tamil-dictionary-coimbatore-article-06-jun-2026.php
 * Run (live):   DB_HOST=mycovai.in php dev-tools/sql/run-kongu-tamil-dictionary-coimbatore-article-06-jun-2026.php
 */
$root = dirname(__DIR__, 2);
require_once $root . '/core/omr-connect.php';
require_once __DIR__ . '/kongu-dictionary-article-covai-body.php';
require_once __DIR__ . '/kongu-dictionary-article-covai-body-tamil.php';

$published_date = '2026-06-06 10:00:00';
$author = 'MyCovai Editorial Team';
$category = 'Culture';
$image_path = null;
$is_featured = 1;
$status = 'published';

$articles = [
    [
        'slug'    => 'kongu-tamil-dictionary-coimbatore-free-download',
        'title'   => 'Kongu Tamil Dictionary: Free Download of Coimbatore Regional Words & Meanings',
        'summary' => 'MyCovai facilitates free access to a Kongu Tamil regional dictionary PDF — not as publisher, but in support of Tamil language, the Tamil community and local dialects. Rights remain with the author and publisher.',
        'tags'    => 'Kongu Tamil, Coimbatore, Covai, Kongu Nadu, regional dictionary, Tamil dialect, free download, Perumal Murugan, Kovai Tamil',
        'content' => kongu_dictionary_article_html(),
    ],
    [
        'slug'    => 'kongu-tamil-dictionary-coimbatore-free-download-tamil',
        'title'   => 'கொங்கு வட்டாரச் சொல்லகராதி: கோவை உள்ளூர் சொற்கள் &mdash; இலவச PDF பதிவிறக்கம்',
        'summary' => 'MyCovai கொங்கு வட்டார அகராதி PDF-க்கு வசதி செய்கிறது — வெளியீட்டாளர் அல்ல; தமிழ் மொழி, தமிழ் சமூகம், வட்டார மொழிகளுக்கு ஆதரவாக. உரிமை ஆசிரியர்/வெளியீட்டாளருக்கே.',
        'tags'    => 'கொங்கு தமிழ், கோயம்புத்தூர், கோவை, வட்டார அகராதி, தமிழ், இலவச பதிவிறக்கம், கொங்கு நாடு',
        'content' => kongu_dictionary_article_html_tamil(),
    ],
];

function kongu_dict_upsert_article(mysqli $conn, array $article, string $published_date, string $author, string $category, ?string $image_path, int $is_featured, string $status): void
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
    kongu_dict_upsert_article($conn, $article, $published_date, $author, $category, $image_path, $is_featured, $status);
    echo "Canonical: https://mycovai.in/local-news/{$article['slug']}\n";
}

$conn->close();
echo "Done.\n";
