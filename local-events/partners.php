<?php
require_once __DIR__ . '/includes/error-reporting.php';
$page_title = 'Partners: promote events in Coimbatore – badges & embeds';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($page_title); ?></title>
  <meta name="description" content="For RWAs, colleges, NGOs and local partners: embed MyCovai events badges and link to list your events for free." />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="modern-page">
<?php include __DIR__ . '/../components/main-nav.php'; ?>

<section class="py-5">
  <div class="container">
    <h1 class="mb-3">Partners: Help Your Community Discover Events</h1>
    <p class="lead">RWAs, colleges, NGOs and local orgs can embed our badge and link to the Coimbatore events hub. Listing is free.</p>

    <h2 class="h5 mt-4">Badge Preview</h2>
    <img src="/assets/img/myomr-events-badge.svg" alt="MyCovai Events" width="180" height="44" class="mb-3" />

    <h2 class="h5">Embed Code</h2>
    <p class="small text-muted">Copy-paste into your site:</p>
<pre class="bg-light p-3"><code>&lt;a href="https://mycovai.in/local-events/?utm_source=partner&amp;utm_medium=badge&amp;utm_campaign=events_partners" target="_blank" rel="noopener"&gt;
  &lt;img src="https://mycovai.in/assets/img/myomr-events-badge.svg" alt="MyCovai Events" width="180" height="44" /&gt;
&lt;/a&gt;</code></pre>

    <div class="mt-4">
      <a class="btn btn-success" href="/local-events/post-event-covai.php">List an Event</a>
      <a class="btn btn-outline-secondary" href="/local-events/">Browse Events</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


