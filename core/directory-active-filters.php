<?php
declare(strict_types=1);

/**
 * Active filter chips for directory listings (q + locality + optional extra GET params).
 *
 * @param array<string, string|int|float> $preserve_params Other query keys to keep when removing q/locality (e.g. cuisine, cost, rating).
 */
function covai_directory_active_filters_markup(
    string $base_path,
    string $filter_q,
    string $filter_locality,
    array $preserve_params = []
): string {
    $q = trim($filter_q);
    $loc = trim($filter_locality);
    if ($q === '' && $loc === '') {
        return '';
    }

    $merge = static function (array $base, array $add): array {
        foreach ($add as $k => $v) {
            if ($v === null || $v === '') {
                continue;
            }
            $base[$k] = $v;
        }
        return $base;
    };

    $build = static function (string $path, array $query): string {
        $query = array_filter($query, static fn ($v) => $v !== null && $v !== '');
        return $path . ($query === [] ? '' : '?' . http_build_query($query));
    };

    $base_only_preserve = [];
    foreach ($preserve_params as $k => $v) {
        if ($v === null || $v === '' || $v === 0 || $v === 0.0) {
            continue;
        }
        $base_only_preserve[$k] = $v;
    }

    $html = '<div class="covai-active-filters alert alert-light border-secondary mb-3 py-3 border" role="region" aria-label="Active search filters">';
    $html .= '<span class="small text-muted me-2 align-middle">Active filters:</span>';

    if ($q !== '') {
        $after = $merge($base_only_preserve, $loc !== '' ? ['locality' => $loc] : []);
        $href = $build($base_path, $after);
        $html .= '<span class="badge bg-dark rounded-pill px-3 py-2 me-2 mb-1">Keywords: <strong>' . htmlspecialchars($q, ENT_QUOTES, 'UTF-8') . '</strong> ';
        $html .= '<a class="text-white text-decoration-none ms-1" href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '" aria-label="Remove keyword filter">×</a></span>';
    }
    if ($loc !== '') {
        $after = $merge($base_only_preserve, $q !== '' ? ['q' => $q] : []);
        $href = $build($base_path, $after);
        $html .= '<span class="badge bg-secondary rounded-pill px-3 py-2 me-2 mb-1">Area: <strong>' . htmlspecialchars($loc, ENT_QUOTES, 'UTF-8') . '</strong> ';
        $html .= '<a class="text-white text-decoration-none ms-1" href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '" aria-label="Remove area filter">×</a></span>';
    }

    $html .= '<a href="' . htmlspecialchars($base_path, ENT_QUOTES, 'UTF-8') . '" class="btn btn-sm btn-outline-secondary ms-1 align-middle">Clear all</a>';
    $html .= '</div>';

    return $html;
}
