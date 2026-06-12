<?php
require_once __DIR__ . '/_bootstrap.php';
requireAdmin();
requireRole(['super_admin']);
require_once __DIR__ . '/../core/omr-connect.php';
require_once __DIR__ . '/includes/list-pagination.php';

$per_page = 25;
$page = admin_list_page();
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$table = covai_table('hospitals');
$list_script = 'manage-hospitals.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash_error'] = 'Invalid CSRF token';
        header('Location: ' . $list_script . admin_list_query_string(['page' => $page, 'q' => $q]));
        exit;
    }
    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0) {
        $del = $conn->prepare('DELETE FROM `' . $table . '` WHERE slno = ?');
        $del->bind_param('i', $id);
        $del->execute();
        $del->close();
        $_SESSION['flash_success'] = 'Hospital deleted';
    }
    header('Location: ' . $list_script . admin_list_query_string(['page' => $page, 'q' => $q]));
    exit;
}

$where = '';
if ($q !== '') {
    $esc = '%' . $conn->real_escape_string($q) . '%';
    $where = " WHERE hospitalname LIKE '" . $esc . "' OR address LIKE '" . $esc . "'";
}
$count_result = $conn->query('SELECT COUNT(*) FROM `' . $table . '`' . $where);
$total_records = (int) ($count_result ? $count_result->fetch_row()[0] : 0);
$pagination = admin_list_meta($page, $per_page, $total_records);
$page = $pagination['page'];

$sql = 'SELECT slno, hospitalname, address, contact FROM `' . $table . '`' . $where;
$sql .= ' ORDER BY hospitalname ASC LIMIT ' . (int) $pagination['limit'] . ' OFFSET ' . (int) $pagination['offset'];
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Hospitals - Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body style="background:#f4f6f8;">
<div class="container-fluid">
  <div class="row">
    <?php include 'admin-sidebar.php'; ?>
    <main class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content" aria-label="Main content">
      <?php include 'admin-header.php'; ?>
      <?php include 'admin-breadcrumbs.php'; ?>
      <?php include 'admin-flash.php'; ?>
      <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
        <h2>Hospitals</h2>
        <form class="form-inline" method="get">
          <input type="text" name="q" class="form-control mr-2" placeholder="Search" value="<?php echo htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>">
          <button class="btn btn-primary">Search</button>
        </form>
      </div>
      <div class="table-responsive bg-white p-3">
        <table class="table table-bordered table-hover">
          <thead class="thead-dark"><tr><th>#</th><th>Name</th><th>Address</th><th>Contact</th><th>Actions</th></tr></thead>
          <tbody>
          <?php if ($res && $res->num_rows > 0): while ($row = $res->fetch_assoc()): ?>
            <tr>
              <td><?php echo (int) $row['slno']; ?></td>
              <td><?php echo htmlspecialchars($row['hospitalname']); ?></td>
              <td><?php echo htmlspecialchars($row['address']); ?></td>
              <td><?php echo htmlspecialchars($row['contact']); ?></td>
              <td>
                <form method="post" onsubmit="return confirm('Delete this hospital?');" class="d-inline">
                  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generate_csrf_token()); ?>">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?php echo (int) $row['slno']; ?>">
                  <button class="btn btn-sm btn-danger">Delete</button>
                </form>
              </td>
            </tr>
          <?php endwhile; else: ?>
            <tr><td colspan="5" class="text-center">No results</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
        <?php admin_render_pagination($list_script, $pagination, ['q' => $q]); ?>
      </div>
    </main>
  </div>
</div>
</body>
</html>
