<?php
/**
 * Renders one directory listing row (CSS grid). Expects HTML-escaped strings where noted.
 *
 * @param array $row {
 *   @var int         $rank          1-based position on current page
 *   @var int         $record_id     DB primary key (slno / id)
 *   @var string      $title         Escaped title text
 *   @var string      $title_href    Escaped URL (relative ok)
 *   @var string      $address       Escaped address (may be empty)
 *   @var string|null $contact       Escaped contact or null for N/A
 *   @var string|null $category      Escaped category / industry type (optional column)
 *   @var string      $badges_html   Raw HTML for badges (already safe)
 *   @var string|null $map_url       Escaped external maps URL or null
 *   @var string|null $enquire_href  Escaped enquire URL or null
 *   @var string      $anchor_id     Escaped id attribute for deep link (no #)
 *   @var string|null $analytics_company If set, adds js-map-click / js-enquire-click + data-company (escaped)
 * }
 */
if (!function_exists('directory_render_list_row')) {
    function directory_render_list_row(array $row): void {
        $rank = (int)($row['rank'] ?? 0);
        $recordId = (int)($row['record_id'] ?? 0);
        $title = $row['title'] ?? '';
        $titleHref = $row['title_href'] ?? '#';
        $address = $row['address'] ?? '';
        $contact = $row['contact'] ?? null;
        $category = $row['category'] ?? null;
        $badgesHtml = $row['badges_html'] ?? '';
        $mapUrl = $row['map_url'] ?? null;
        $enquireHref = $row['enquire_href'] ?? null;
        $anchorId = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)($row['anchor_id'] ?? ''));
        $analyticsCompany = isset($row['analytics_company']) ? (string)$row['analytics_company'] : null;

        $idAttr = $anchorId !== '' ? ' id="' . htmlspecialchars($anchorId, ENT_QUOTES, 'UTF-8') . '"' : '';

        echo '<article class="directory-row"' . $idAttr . ' role="listitem">';

        echo '<div class="directory-row__rank">';
        echo '<span class="directory-row__rank-label">#</span>';
        echo '<span class="directory-row__rank-num">' . $rank . '</span>';
        echo '<span class="directory-row__id">ID ' . $recordId . '</span>';
        echo '</div>';

        echo '<div class="directory-row__main">';
        echo '<h2 class="directory-row__title"><a href="' . $titleHref . '">' . $title . '</a></h2>';
        if ($badgesHtml !== '') {
            echo '<div class="directory-row__badges">' . $badgesHtml . '</div>';
        }
        if ($address !== '') {
            echo '<p class="directory-row__address">' . $address . '</p>';
        }
        if ($mapUrl || $enquireHref) {
            echo '<div class="directory-row__actions">';
            if ($mapUrl) {
                $mapClass = 'btn btn-sm btn-outline-secondary' . ($analyticsCompany !== null ? ' js-map-click' : '');
                $mapData = $analyticsCompany !== null ? ' data-company="' . htmlspecialchars($analyticsCompany, ENT_QUOTES, 'UTF-8') . '"' : '';
                echo '<a class="' . $mapClass . '" href="' . $mapUrl . '" target="_blank" rel="noopener"' . $mapData . '>View on map</a>';
            }
            if ($enquireHref) {
                $enqClass = 'btn btn-sm btn-warning' . ($analyticsCompany !== null ? ' js-enquire-click' : '');
                $enqData = $analyticsCompany !== null ? ' data-company="' . htmlspecialchars($analyticsCompany, ENT_QUOTES, 'UTF-8') . '"' : '';
                echo '<a class="' . $enqClass . '" href="' . $enquireHref . '"' . $enqData . '>Enquire</a>';
            }
            echo '</div>';
        }
        echo '</div>';

        echo '<div class="directory-row__contact">';
        if ($contact !== null && $contact !== '') {
            echo $contact;
        } else {
            echo '<span class="directory-row__contact-muted">N/A</span>';
        }
        echo '</div>';

        echo '<div class="directory-row__category">';
        if ($category !== null && $category !== '') {
            echo $category;
        } else {
            echo '<span class="directory-row__contact-muted">—</span>';
        }
        echo '</div>';

        echo '</article>';
    }
}
