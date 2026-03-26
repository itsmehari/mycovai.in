<?php
/**
 * News article EN/TA pairing for MyCovai database-driven articles.
 *
 * Convention:
 * - English article: slug is the base (e.g. coimbatore-road-project-2026)
 * - Tamil translation: same slug + suffix "-tamil" (e.g. coimbatore-road-project-2026-tamil)
 *
 * Listings (home, Covai news, related) exclude slugs ending in "-tamil" so Tamil
 * appears only via the language banner on the English article (and vice versa).
 */
if (!function_exists('covai_article_slug_is_tamil')) {
    function covai_article_slug_is_tamil($slug) {
        return is_string($slug) && substr($slug, -6) === '-tamil';
    }

    function covai_article_english_base_slug($slug) {
        if (!is_string($slug) || $slug === '') {
            return '';
        }
        if (covai_article_slug_is_tamil($slug)) {
            return substr($slug, 0, -6);
        }
        return $slug;
    }

    function covai_article_tamil_counterpart_slug($slug) {
        if (!is_string($slug) || $slug === '') {
            return '';
        }
        if (covai_article_slug_is_tamil($slug)) {
            return $slug;
        }
        return $slug . '-tamil';
    }

    /**
     * Full canonical URLs for published EN/TA pair (for hreflang and language banner logic).
     *
     * @return array{en: ?string, ta: ?string}
     */
    function covai_article_resolve_hreflang_urls($conn, $slug) {
        $result = ['en' => null, 'ta' => null];
        if (!$conn instanceof mysqli || !is_string($slug) || $slug === '') {
            return $result;
        }
        $en_slug = covai_article_english_base_slug($slug);
        $ta_slug = covai_article_tamil_counterpart_slug($slug);
        if ($en_slug === '' || $ta_slug === '') {
            return $result;
        }
        $stmt = $conn->prepare("SELECT slug FROM articles WHERE status = 'published' AND slug IN (?, ?)");
        if (!$stmt) {
            return $result;
        }
        $stmt->bind_param('ss', $en_slug, $ta_slug);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $s = $row['slug'];
            if ($s === $en_slug) {
                $result['en'] = 'https://mycovai.in/local-news/' . rawurlencode($en_slug);
            }
            if ($s === $ta_slug) {
                $result['ta'] = 'https://mycovai.in/local-news/' . rawurlencode($ta_slug);
            }
        }
        $stmt->close();
        return $result;
    }
}
