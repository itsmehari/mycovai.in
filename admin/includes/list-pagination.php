<?php
/**
 * Shared pagination helpers for admin directory manage-* lists.
 */

function admin_list_page(): int
{
    return max(1, (int) ($_GET['page'] ?? 1));
}

/**
 * @return array{page:int,per_page:int,total:int,total_pages:int,offset:int,limit:int}
 */
function admin_list_meta(int $page, int $perPage, int $totalRecords): array
{
    $perPage = max(1, min(100, $perPage));
    $totalPages = max(1, (int) ceil($totalRecords / $perPage));
    $page = min(max(1, $page), $totalPages);
    $offset = ($page - 1) * $perPage;

    return [
        'page' => $page,
        'per_page' => $perPage,
        'total' => $totalRecords,
        'total_pages' => $totalPages,
        'offset' => $offset,
        'limit' => $perPage,
    ];
}

function admin_list_query_string(array $params = []): string
{
    $parts = [];
    if (!empty($params['page']) && (int) $params['page'] > 1) {
        $parts[] = 'page=' . (int) $params['page'];
    }
    if (isset($params['q']) && $params['q'] !== '') {
        $parts[] = 'q=' . rawurlencode((string) $params['q']);
    }
    return $parts ? ('?' . implode('&', $parts)) : '';
}

function admin_render_pagination(string $script, array $meta, array $params = []): void
{
    if (($meta['total_pages'] ?? 1) <= 1) {
        return;
    }

    $page = (int) ($meta['page'] ?? 1);
    $totalPages = (int) ($meta['total_pages'] ?? 1);
    $q = $params['q'] ?? '';

    echo '<nav class="mt-3" aria-label="Page navigation"><ul class="pagination">';
    $prev = max(1, $page - 1);
    $next = min($totalPages, $page + 1);
    $disabledPrev = $page <= 1 ? ' disabled' : '';
    $disabledNext = $page >= $totalPages ? ' disabled' : '';

    echo '<li class="page-item' . $disabledPrev . '"><a class="page-link" href="'
        . htmlspecialchars($script . admin_list_query_string(['page' => $prev, 'q' => $q]), ENT_QUOTES, 'UTF-8')
        . '">Previous</a></li>';

    $windowStart = max(1, $page - 2);
    $windowEnd = min($totalPages, $page + 2);
    for ($i = $windowStart; $i <= $windowEnd; $i++) {
        $active = $i === $page ? ' active' : '';
        echo '<li class="page-item' . $active . '"><a class="page-link" href="'
            . htmlspecialchars($script . admin_list_query_string(['page' => $i, 'q' => $q]), ENT_QUOTES, 'UTF-8')
            . '">' . $i . '</a></li>';
    }

    echo '<li class="page-item' . $disabledNext . '"><a class="page-link" href="'
        . htmlspecialchars($script . admin_list_query_string(['page' => $next, 'q' => $q]), ENT_QUOTES, 'UTF-8')
        . '">Next</a></li>';
    echo '</ul><p class="text-muted small">Showing page ' . $page . ' of ' . $totalPages
        . ' (' . (int) ($meta['total'] ?? 0) . ' records)</p></nav>';
}
