<?php
/**
 * Compact list: upcoming events in the next 7 days (for coimbatore-news, etc.)
 */
require_once __DIR__ . '/../includes/error-reporting.php';
require_once __DIR__ . '/../../core/omr-connect.php';
require_once __DIR__ . '/../includes/event-functions-covai.php';

$items = [];
try {
    global $conn;
    if ($conn && !$conn->connect_error) {
        $sql = "SELECT title, slug, start_datetime, location, locality
                FROM event_listings
                WHERE status IN ('scheduled','ongoing')
                AND start_datetime >= NOW()
                AND start_datetime < DATE_ADD(NOW(), INTERVAL 8 DAY)
                ORDER BY start_datetime DESC
                LIMIT 8";
        $res = $conn->query($sql);
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $items[] = $row;
            }
        }
    }
} catch (Throwable $e) {
    error_log('events-this-week-strip: ' . $e->getMessage());
}

if (empty($items)) {
    return;
}

$base = function_exists('eventsCanonicalBaseUrl') ? eventsCanonicalBaseUrl() : 'https://mycovai.in';
?>
<div class="events-this-week-strip card border-0 shadow-sm mb-4">
  <div class="card-body">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
      <h3 class="h5 mb-0"><i class="fas fa-calendar-week text-success me-2"></i>This week in <?php echo htmlspecialchars(defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'Covai'); ?></h3>
      <a href="/local-events/?utm_source=news&utm_medium=internal&utm_campaign=events_this_week" class="btn btn-sm btn-outline-success">All events</a>
    </div>
    <ul class="list-group list-group-flush">
      <?php foreach ($items as $ev): ?>
        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-start gap-2 px-0 bg-transparent">
          <div>
            <a href="<?php echo htmlspecialchars($base . '/local-events/event/' . rawurlencode($ev['slug'])); ?>?utm_source=news&utm_medium=internal&utm_campaign=events_this_week" class="fw-semibold text-decoration-none text-dark">
              <?php echo htmlspecialchars($ev['title']); ?>
            </a>
            <div class="small text-muted">
              <?php echo htmlspecialchars(date('D, M j · g:i a', strtotime($ev['start_datetime']))); ?>
              <?php if (!empty($ev['location'])): ?>
                · <?php echo htmlspecialchars($ev['location']); ?>
              <?php endif; ?>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
