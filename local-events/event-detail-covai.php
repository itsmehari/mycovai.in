<?php
require_once __DIR__ . '/includes/error-reporting.php';
require_once __DIR__ . '/../core/omr-connect.php';
require_once __DIR__ . '/includes/event-functions-covai.php';
include __DIR__ . '/includes/dev-diagnostics.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$event = $slug ? getEventBySlug($slug) : null;
$region_full = defined('SITE_REGION') ? SITE_REGION : 'Coimbatore';
$site_name = defined('SITE_NAME') ? SITE_NAME : 'MyCovai';
$canonical_event = ($event && $slug && function_exists('eventsPublicEventUrl')) ? eventsPublicEventUrl($slug) : (($slug !== '') ? ('https://mycovai.in/local-events/event/' . rawurlencode($slug)) : '');
$og_img = $event
  ? (function_exists('eventsListingImageAbsolute') ? eventsListingImageAbsolute($event['image_url'] ?? null) : ($event['image_url'] ?: 'https://mycovai.in/My-OMR-Logo.jpg'))
  : '';
$map_suffix = $event ? trim(($event['locality'] ?? '') . ' ' . $region_full) : $region_full;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $event ? htmlspecialchars($event['title']) . ' – ' . htmlspecialchars($site_name) : 'Event – ' . htmlspecialchars($site_name); ?></title>
  <meta name="description" content="<?php echo $event ? htmlspecialchars(substr(strip_tags($event['description']),0,160)) : 'Event details'; ?>" />
  <?php if ($event): ?>
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical_event); ?>" />
  <!-- Open Graph / Twitter for Event -->
  <meta property="og:title" content="<?php echo htmlspecialchars($event['title'] . ' – ' . $site_name); ?>" />
  <meta property="og:description" content="<?php echo htmlspecialchars(substr(strip_tags($event['description']),0,160)); ?>" />
  <meta property="og:url" content="<?php echo htmlspecialchars($canonical_event); ?>" />
  <meta property="og:type" content="event" />
  <meta property="og:image" content="<?php echo htmlspecialchars($og_img); ?>" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?php echo htmlspecialchars($event['title'] . ' – ' . $site_name); ?>" />
  <meta name="twitter:description" content="<?php echo htmlspecialchars(substr(strip_tags($event['description']),0,160)); ?>" />
  <meta name="twitter:image" content="<?php echo htmlspecialchars($og_img); ?>" />
  <?php endif; ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/jobs/assets/omr-jobs-unified-design.css" />
  <link rel="stylesheet" href="/assets/css/events-covai.css" />
  <?php include __DIR__ . '/../components/analytics.php'; ?>
  <?php if ($event): 
    $detailLd = [
      '@context' => 'https://schema.org',
      '@type' => 'Event',
      'name' => $event['title'],
      'description' => strip_tags($event['description']),
      'startDate' => date('c', strtotime($event['start_datetime'])),
      'eventStatus' => 'https://schema.org/EventScheduled',
      'isAccessibleForFree' => (bool)$event['is_free'],
      'location' => [
        '@type' => 'Place',
        'name' => $event['location'],
        'address' => [
          '@type' => 'PostalAddress',
          'addressLocality' => $event['locality'] ?: $region_full,
          'addressRegion' => 'Tamil Nadu',
          'addressCountry' => 'IN'
        ]
      ],
    'url' => function_exists('eventsPublicEventUrl') ? eventsPublicEventUrl($slug) : ('https://mycovai.in/local-events/event/' . rawurlencode($slug))
    ];
    if (!empty($event['end_datetime'])) { $detailLd['endDate'] = date('c', strtotime($event['end_datetime'])); }
    if (!empty($event['image_url'])) { $detailLd['image'] = function_exists('eventsListingImageAbsolute') ? eventsListingImageAbsolute($event['image_url']) : $event['image_url']; }
    if (!$event['is_free'] && !empty($event['price'])) {
      $detailLd['offers'] = [
        '@type' => 'Offer',
        'price' => $event['price'],
        'priceCurrency' => 'INR',
        'url' => function_exists('eventsPublicEventUrl') ? eventsPublicEventUrl($slug) : ('https://mycovai.in/local-events/event/' . rawurlencode($slug))
      ];
    }
  ?>
  <script type="application/ld+json"><?php echo json_encode($detailLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
      {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://mycovai.in/"},
      {"@type": "ListItem", "position": 2, "name": "Events", "item": "https://mycovai.in/local-events/"},
      {"@type": "ListItem", "position": 3, "name": <?php echo json_encode($event['title']); ?>,
       "item": <?php echo json_encode('https://mycovai.in/local-events/event/' . $slug); ?> }
    ]
  }
  </script>
  <?php endif; ?>
  <?php include __DIR__ . '/../components/organization-schema.php'; ?>
</head>
<body class="modern-page">
<?php include __DIR__ . '/../components/main-nav.php'; ?>

<div class="hero-modern">
  <div class="container">
    <div class="text-center text-white">
      <h1 class="hero-modern-title"><?php echo $event ? htmlspecialchars($event['title']) : 'Event'; ?></h1>
      <p class="hero-modern-subtitle"><?php echo $event ? htmlspecialchars((function_exists('formatEventDateRangeDisplay') ? formatEventDateRangeDisplay($event['start_datetime'], $event['end_datetime'] ?? null) : '') . ' · ' . $event['location']) : ''; ?></p>
    </div>
  </div>
</div>

<main class="py-5">
  <div class="container">
    <?php if (!$event): ?>
      <div class="alert alert-warning">Event not found.</div>
    <?php else: ?>
      <div class="card-modern mb-4">
        <div class="p-4">
          <div class="row g-4">
            <div class="col-md-8">
              <h3>About this event</h3>
              <div><?php echo $event['description']; ?></div>
              <?php if (!empty($event['tickets_url'])): ?>
                <p class="small text-muted mt-3 mb-0">Details and timings may change — confirm with the organizer or official ticketing link before you go.</p>
              <?php endif; ?>
      <hr class="my-4" />
      <div class="d-flex flex-wrap gap-2">
        <?php if (!empty($event['locality'])): ?>
          <?php $locSlug = localityToSlug($event['locality']); ?>
          <a class="badge-modern badge-modern-secondary" href="/local-events/locality/<?php echo rawurlencode($locSlug); ?>">More in <?php echo htmlspecialchars($event['locality']); ?></a>
        <?php endif; ?>
        <?php if (!empty($event['category_id'])): ?>
          <?php $cat = getCategoryById((int)$event['category_id']); if ($cat): ?>
            <a class="badge-modern badge-modern-secondary" href="/local-events/category/<?php echo rawurlencode($cat['slug']); ?>">More <?php echo htmlspecialchars($cat['name']); ?> events</a>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (!empty($event['location'])): ?>
          <?php $venueSlug = locationToVenueSlug($event['location']); ?>
          <a class="badge-modern badge-modern-secondary" href="/local-events/venue/<?php echo rawurlencode($venueSlug); ?>">More at this venue</a>
        <?php endif; ?>
      </div>
              <hr class="my-4" />
              <h5>Share</h5>
              <?php
                $baseUrl = function_exists('eventsPublicEventUrl') ? eventsPublicEventUrl($slug) : ('https://mycovai.in/local-events/event/' . rawurlencode($slug));
                $eventUrlWhatsApp = $baseUrl . (strpos($baseUrl, '?') !== false ? '&' : '?') . 'utm_source=whatsapp&utm_medium=social&utm_campaign=events_share';
                $eventUrlTwitter = $baseUrl . (strpos($baseUrl, '?') !== false ? '&' : '?') . 'utm_source=twitter&utm_medium=social&utm_campaign=events_share';
                $eventUrlFacebook = $baseUrl . (strpos($baseUrl, '?') !== false ? '&' : '?') . 'utm_source=facebook&utm_medium=social&utm_campaign=events_share';
                $shareText = urlencode(($event['title'] ?? 'Event') . ' – via ' . $site_name);
              ?>
              <div class="d-flex gap-2 flex-wrap">
                <a class="btn btn-sm btn-outline-secondary" target="_blank" data-share="whatsapp" href="https://wa.me/?text=<?php echo $shareText . '%20' . urlencode($eventUrlWhatsApp); ?>"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                <a class="btn btn-sm btn-outline-secondary" target="_blank" data-share="twitter" href="https://twitter.com/intent/tweet?text=<?php echo $shareText; ?>&url=<?php echo urlencode($eventUrlTwitter); ?>"><i class="fab fa-x-twitter"></i> Tweet</a>
                <a class="btn btn-sm btn-outline-secondary" target="_blank" data-share="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($eventUrlFacebook); ?>"><i class="fab fa-facebook"></i> Facebook</a>
                <?php 
                  $gcParams = http_build_query([
                    'action' => 'TEMPLATE',
                    'text' => $event['title'] ?? 'Event',
                    'dates' => date('Ymd\THis\Z', strtotime($event['start_datetime'])) . '/' . ($event['end_datetime'] ? date('Ymd\THis\Z', strtotime($event['end_datetime'])) : date('Ymd\THis\Z', strtotime($event['start_datetime'] . ' +1 hour'))),
                    'details' => strip_tags($event['description'] ?? ''),
                    'location' => ($event['location'] ?? ''),
                  ]);
                ?>
                <a class="btn btn-sm btn-outline-primary" target="_blank" data-analytics="addToCalendar" data-analytics-label="<?php echo htmlspecialchars($slug); ?>" href="https://www.google.com/calendar/render?<?php echo $gcParams; ?>"><i class="far fa-calendar-plus"></i> Add to Google Calendar</a>
                <a class="btn btn-sm btn-outline-primary" data-analytics="icsDownloaded" data-analytics-label="<?php echo htmlspecialchars($slug); ?>" href="/local-events/event-ics.php?slug=<?php echo urlencode($slug); ?>"><i class="far fa-file"></i> Download ICS</a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card-modern">
                <div class="p-4">
                  <div class="mb-2 covai-events-date-range"><i class="far fa-calendar"></i> <?php echo htmlspecialchars(function_exists('formatEventDateRangeDisplay') ? formatEventDateRangeDisplay($event['start_datetime'], $event['end_datetime'] ?? null) : date('M d, Y g:i a', strtotime($event['start_datetime']))); ?></div>
                  <div class="mb-3"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></div>
                  <div class="d-grid gap-2">
                    <a class="btn-modern btn-modern-secondary" target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode(($event['location'] ?: '') . ' ' . $map_suffix); ?>"><i class="fas fa-map"></i><span>View on Map</span></a>
                    <a class="btn-modern btn-modern-secondary" href="/local-events/post/"><i class="fas fa-plus"></i><span>List your event</span></a>
                    <?php if (!empty($event['tickets_url'])): ?>
                      <a class="btn-modern btn-modern-primary" href="<?php echo htmlspecialchars($event['tickets_url']); ?>" target="_blank"><i class="fas fa-ticket"></i><span>Get Tickets</span></a>
                    <?php endif; ?>
                  </div>
                </div>
                <?php if (!empty($event['location'])): ?>
                  <div class="ratio ratio-4x3">
                    <iframe src="https://www.google.com/maps?q=<?php echo urlencode(($event['location'] ?: '') . ' ' . $map_suffix); ?>&output=embed" style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-4">
        <?php include __DIR__ . '/components/newsletter-signup.php'; ?>
      </div>
      <div class="text-center">
        <a href="/local-events/" class="btn-modern btn-modern-secondary"><i class="fas fa-arrow-left"></i><span>Back to Events</span></a>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php include __DIR__ . '/../components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/local-events/assets/events-analytics.js"></script>
<script>
  (function(){
    var ev = window.MyCovaiEventsAnalytics || window.MyOMREventsAnalytics;
    var slug = <?php echo json_encode($slug); ?>;
    document.querySelectorAll('a[data-share]').forEach(function(el){
      el.addEventListener('click', function(){
        var ch = el.getAttribute('data-share');
        if (ev) ev.shareClicked(ch, slug);
      });
    });
    var mapBtn = document.querySelector('[data-analytics="mapClicked"]');
    if (mapBtn && ev) { mapBtn.addEventListener('click', function(){ ev.mapClicked(slug); }); }
    var ticketBtn = document.querySelector('[data-analytics="ticketClicked"]');
    if (ticketBtn && ev) { ticketBtn.addEventListener('click', function(){ ev.ticketClicked(slug); }); }
  })();
</script>
</body>
</html>


