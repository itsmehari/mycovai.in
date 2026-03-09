<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: /admin/login.php');
    exit;
}
require_once __DIR__ . '/../core/omr-connect.php';

$title = 'Admin Dashboard';
$breadcrumbs = [];
$username = $_SESSION['admin_username'] ?? 'admin';

// Helper to safely run a query and return result or null (table may not exist)
function safeQuery($conn, $sql, $default = null) {
    try {
        $res = @$conn->query($sql);
        return $res ? $res : $default;
    } catch (Throwable $e) {
        return $default;
    }
}

// Helper to safely count a table (returns 0 if table missing)
function safeCount($conn, $table) {
    try {
        $res = @$conn->query("SELECT COUNT(*) FROM `{$table}`");
        return ($res && $row = $res->fetch_row()) ? (int)$row[0] : 0;
    } catch (Throwable $e) {
        return 0;
    }
}

// Stats queries with try-catch (default to 0 when table missing)
$news_bulletin_count = safeCount($conn, 'news_bulletin');
$articles_count = safeCount($conn, 'articles');
$events_count = safeCount($conn, 'events');
$restaurants_count = safeCount($conn, covai_table('restaurants'));

// Recent activity with correct columns
$recent_articles = safeQuery($conn, "SELECT id, title, published_date FROM articles ORDER BY published_date DESC LIMIT 3");
$recent_bulletin = safeQuery($conn, "SELECT id, title, `date` FROM news_bulletin ORDER BY `date` DESC LIMIT 3");
$recent_events = safeQuery($conn, "SELECT id, title, event_date FROM events ORDER BY event_date DESC LIMIT 3");
$recent_restaurants = safeQuery($conn, "SELECT id, name AS title, created_at FROM `" . covai_table('restaurants') . "` ORDER BY created_at DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MyCovai CMS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #f4f6f8; }
        .sidebar { min-height: 100vh; background: #14532d; color: #fff; }
        .sidebar a { color: #fff; display: block; padding: 1rem; border-bottom: 1px solid #1e6b3a; text-decoration: none; }
        .sidebar a.active, .sidebar a:hover { background: #22c55e; color: #14532d; font-weight: bold; }
        .dashboard-header { background: #fff; border-bottom: 1px solid #e0e0e0; padding: 1rem 2rem; }
        .dashboard-title { color: #14532d; font-family: 'Playfair Display', serif; }
        .main-content { padding: 2rem; }
        .stat-card { background: #fff; border: 1px solid #e0e0e0; border-radius: 5px; padding: 1rem; text-align: center; transition: transform 0.2s; }
        .stat-card:hover { transform: scale(1.05); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .stat-card i { font-size: 2rem; }
        .stat-card h5 { margin: 0.5rem 0; }
        .card { transition: transform 0.2s; }
        .card:hover { transform: scale(1.02); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .recent-item { padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0; }
        .recent-item:last-child { border-bottom: none; }
    </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <?php include 'admin-sidebar.php'; ?>
    <main class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content" aria-label="Main content">
      <?php include 'admin-header.php'; ?>
      <?php include 'admin-breadcrumbs.php'; ?>
      <?php include 'admin-flash.php'; ?>

      <div class="alert alert-success mt-3">
        Welcome, <?php echo htmlspecialchars($username); ?>! Manage your content below.
      </div>

      <!-- Summary Stats: Articles, Bulletin, Events, Restaurants -->
      <div class="row mb-4">
        <div class="col-md-3">
          <div class="stat-card shadow-sm">
            <i class="fas fa-newspaper text-primary"></i>
            <h5><?php echo $articles_count; ?></h5>
            <p>Articles</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-card shadow-sm">
            <i class="fas fa-list text-info"></i>
            <h5><?php echo $news_bulletin_count; ?></h5>
            <p>Bulletin</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-card shadow-sm">
            <i class="fas fa-calendar-alt text-success"></i>
            <h5><?php echo $events_count; ?></h5>
            <p>Events</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-card shadow-sm">
            <i class="fas fa-utensils text-warning"></i>
            <h5><?php echo $restaurants_count; ?></h5>
            <p>Restaurants</p>
          </div>
        </div>
      </div>

      <!-- Recent Activity -->
      <h3 class="mb-3">Recent Activity</h3>
      <div class="row mb-4">
        <div class="col-md-3">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Recent Articles</h5>
              <?php if ($recent_articles && $recent_articles->num_rows > 0): ?>
                <?php while ($row = $recent_articles->fetch_assoc()): ?>
                  <div class="recent-item">
                    <a href="/admin/articles/edit.php?id=<?php echo (int)$row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                    <small class="d-block text-muted"><?php echo $row['published_date'] ? date('M d, Y', strtotime($row['published_date'])) : '-'; ?></small>
                  </div>
                <?php endwhile; ?>
              <?php else: ?>
                <p class="text-muted mb-0">No recent items</p>
              <?php endif; ?>
              <a href="/admin/articles/index.php" class="btn btn-sm btn-outline-primary mt-2">Manage Articles</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Recent Bulletin</h5>
              <?php if ($recent_bulletin && $recent_bulletin->num_rows > 0): ?>
                <?php while ($row = $recent_bulletin->fetch_assoc()): ?>
                  <div class="recent-item">
                    <a href="/admin/news-edit.php?id=<?php echo (int)$row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                    <small class="d-block text-muted"><?php echo !empty($row['date']) ? date('M d, Y', strtotime($row['date'])) : '-'; ?></small>
                  </div>
                <?php endwhile; ?>
              <?php else: ?>
                <p class="text-muted mb-0">No recent items</p>
              <?php endif; ?>
              <a href="/admin/news-list.php" class="btn btn-sm btn-outline-secondary mt-2">Manage Bulletin</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Recent Events</h5>
              <?php if ($recent_events && $recent_events->num_rows > 0): ?>
                <?php while ($row = $recent_events->fetch_assoc()): ?>
                  <div class="recent-item">
                    <a href="/admin/events-edit.php?id=<?php echo (int)$row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                    <small class="d-block text-muted"><?php echo !empty($row['event_date']) ? date('M d, Y', strtotime($row['event_date'])) : '-'; ?></small>
                  </div>
                <?php endwhile; ?>
              <?php else: ?>
                <p class="text-muted mb-0">No recent items</p>
              <?php endif; ?>
              <a href="/admin/events-list.php" class="btn btn-sm btn-outline-success mt-2">Manage Events</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Recent Restaurants</h5>
              <?php if ($recent_restaurants && $recent_restaurants->num_rows > 0): ?>
                <?php while ($row = $recent_restaurants->fetch_assoc()): ?>
                  <div class="recent-item">
                    <a href="/admin/restaurants-edit.php?id=<?php echo (int)$row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
                    <small class="d-block text-muted"><?php echo !empty($row['created_at']) ? date('M d, Y', strtotime($row['created_at'])) : '-'; ?></small>
                  </div>
                <?php endwhile; ?>
              <?php else: ?>
                <p class="text-muted mb-0">No recent items</p>
              <?php endif; ?>
              <a href="/admin/restaurants-list.php" class="btn btn-sm btn-outline-warning mt-2">Manage Restaurants</a>
            </div>
          </div>
        </div>
      </div>

      <!-- News Management: Articles vs Bulletin -->
      <h3 class="mb-3">News Management</h3>
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="card border-primary shadow-sm">
            <div class="card-body text-center">
              <i class="fas fa-newspaper fa-2x mb-2 text-primary"></i>
              <h5 class="card-title">News Articles</h5>
              <p class="card-text">Primary system: homepage cards and /local-news/ detail pages.</p>
              <a href="/admin/articles/index.php" class="btn btn-primary btn-block">Manage Articles</a>
              <a href="/admin/articles/add.php" class="btn btn-outline-primary btn-sm mt-2">Add Article</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card border-secondary shadow-sm">
            <div class="card-body text-center">
              <i class="fas fa-list fa-2x mb-2 text-secondary"></i>
              <h5 class="card-title">News Bulletin</h5>
              <p class="card-text">Legacy news_bulletin table, separate from Articles.</p>
              <a href="/admin/news-list.php" class="btn btn-secondary btn-block">Manage Bulletin</a>
              <a href="/admin/news-add.php" class="btn btn-outline-secondary btn-sm mt-2">Add Bulletin Item</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Module Picker -->
      <div class="alert alert-info mt-4">
        <strong>Tip:</strong> Use the <a href="/admin/index.php">Module Picker</a> to jump to any admin area quickly.
      </div>
    </main>
  </div>
</div>
</body>
</html>
<?php if (isset($conn)) $conn->close(); ?>
