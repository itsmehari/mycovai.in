<?php
require_once __DIR__ . '/../includes/error-reporting.php';
require_once __DIR__ . '/../../core/omr-connect.php';
require_once __DIR__ . '/../includes/event-functions-covai.php';
require_once __DIR__ . '/../../core/admin-auth.php';
requireAdmin();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['admin_csrf'])) {
    $_SESSION['admin_csrf'] = bin2hex(random_bytes(16));
}

$blockedDupId = isset($_GET['blocked_dup']) ? (int)$_GET['blocked_dup'] : 0;
$blockedDupList = ($blockedDupId > 0) ? getDuplicateListingsForSubmission($blockedDupId) : [];

$pending = [];
try {
    global $conn;
    if ($conn && !$conn->connect_error) {
        $sql = "SELECT id, title, organizer_name, organizer_email, start_datetime, location, status, created_at FROM event_submissions WHERE status IN ('submitted','draft') ORDER BY created_at DESC LIMIT 100";
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            $pending[] = $row;
        }
    }
} catch (Throwable $e) {
    error_log('Events Admin: failed to load submissions: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Events – Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container py-4">
  <h1 class="h3 mb-4">Manage Events – Submissions</h1>

  <?php if (!empty($_GET['approved'])): ?>
    <div class="alert alert-success">Submission approved and published.</div>
  <?php endif; ?>
  <?php if (!empty($_GET['rejected'])): ?>
    <div class="alert alert-info">Submission rejected.</div>
  <?php endif; ?>

  <?php if ($blockedDupId > 0 && !empty($blockedDupList)): ?>
    <div class="alert alert-warning">
      <strong>Possible duplicate listings</strong> — similar time and venue already live. Review below, then approve only if this is intentional.
      <table class="table table-sm mt-2 mb-0 bg-white">
        <thead><tr><th>ID</th><th>Title</th><th>Start</th><th>Location</th></tr></thead>
        <tbody>
          <?php foreach ($blockedDupList as $d): ?>
            <tr>
              <td><?php echo (int)$d['id']; ?></td>
              <td><a href="<?php echo htmlspecialchars(eventsPublicEventUrl($d['slug'])); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($d['title']); ?></a></td>
              <td><?php echo htmlspecialchars($d['start_datetime']); ?></td>
              <td><?php echo htmlspecialchars($d['location']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <form method="post" action="process-approve-event.php" class="mt-3 d-inline">
        <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['admin_csrf']); ?>">
        <input type="hidden" name="id" value="<?php echo (int)$blockedDupId; ?>">
        <input type="hidden" name="duplicate_ack" value="1">
        <button class="btn btn-success" type="submit">Approve anyway (duplicate acknowledged)</button>
      </form>
      <a class="btn btn-outline-secondary ms-2" href="manage-events-covai.php">Cancel</a>
    </div>
  <?php elseif ($blockedDupId > 0 && empty($blockedDupList)): ?>
    <div class="alert alert-secondary">No duplicate warning data for this ID (it may have been resolved). <a href="manage-events-covai.php">Back</a></div>
  <?php endif; ?>

  <div class="card shadow-sm">
    <div class="card-body table-responsive">
      <table class="table table-striped align-middle mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Organizer</th>
            <th>Start</th>
            <th>Location</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($pending)): ?>
            <tr><td colspan="7" class="text-center text-muted">No pending submissions</td></tr>
          <?php else: foreach ($pending as $p): ?>
            <?php
              $dupCount = count(getDuplicateListingsForSubmission((int)$p['id']));
            ?>
            <tr>
              <td><?php echo (int)$p['id']; ?></td>
              <td>
                <?php echo htmlspecialchars($p['title']); ?>
                <?php if ($dupCount > 0): ?>
                  <span class="badge bg-warning text-dark ms-1" title="Overlapping listing at same venue"><?php echo (int)$dupCount; ?> similar</span>
                <?php endif; ?>
              </td>
              <td><?php echo htmlspecialchars($p['organizer_name'] ?: $p['organizer_email'] ?: '—'); ?></td>
              <td><?php echo htmlspecialchars($p['start_datetime']); ?></td>
              <td><?php echo htmlspecialchars($p['location']); ?></td>
              <td><span class="badge bg-warning text-dark"><?php echo htmlspecialchars($p['status']); ?></span></td>
              <td>
                <div class="btn-group btn-group-sm">
                  <form method="post" action="process-approve-event.php" class="d-inline">
                    <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['admin_csrf']); ?>">
                    <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
                    <button class="btn btn-success" title="Approve" type="submit">Approve</button>
                  </form>
                  <form method="post" action="process-reject-event.php" class="d-inline ms-1">
                    <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['admin_csrf']); ?>">
                    <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
                    <button class="btn btn-danger" title="Reject" type="submit">Reject</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <p class="mt-3 small text-muted mb-0"><a href="index.php">Events admin home</a> · Organizer self-service: <code>/local-events/my-submitted-events.php</code> (token from confirmation email)</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
