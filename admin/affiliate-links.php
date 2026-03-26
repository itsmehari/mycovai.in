<?php
require_once __DIR__ . '/_bootstrap.php';
requireAdmin();

require_once __DIR__ . '/../core/omr-connect.php';

$title = 'Affiliate Links';
$breadcrumbs = ['Affiliate Links' => null];

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    if ($id > 0) {
        $stmt = $conn->prepare('DELETE FROM covai_affiliate_links WHERE id = ?');
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $_SESSION['flash_success'] = 'Affiliate link deleted.';
        } else {
            $_SESSION['flash_error'] = 'Could not delete (table missing?). Run dev-tools/sql/CREATE-covai-affiliate-links.sql';
        }
        $stmt->close();
        header('Location: /admin/affiliate-links.php');
        exit;
    }
}

$result = $conn->query('SELECT id, monetization_type, advertiser, headline, slot_ids, weight, active, updated_at FROM covai_affiliate_links ORDER BY id DESC');
$table_error = ($result === false) ? $conn->error : '';

include __DIR__ . '/layout/header.php';
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Affiliate Links</h2>
        <a href="/admin/affiliate-links-edit.php" class="btn btn-success"><i class="fas fa-plus"></i> Add link</a>
    </div>

    <?php include __DIR__ . '/admin-flash.php'; ?>

    <?php if ($table_error !== ''): ?>
        <div class="alert alert-warning">
            Database table not found or query failed: <?php echo htmlspecialchars($table_error); ?>.
            Import <code>dev-tools/sql/CREATE-covai-affiliate-links.sql</code> then refresh.
        </div>
    <?php elseif ($result && $result->num_rows > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Advertiser</th>
                    <th>Headline</th>
                    <th>Slots</th>
                    <th>Weight</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo (int) $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['monetization_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['advertiser']); ?></td>
                    <td><?php echo htmlspecialchars($row['headline']); ?></td>
                    <td><small><?php echo htmlspecialchars($row['slot_ids']); ?></small></td>
                    <td><?php echo (int) $row['weight']; ?></td>
                    <td><?php echo !empty($row['active']) ? 'Yes' : 'No'; ?></td>
                    <td>
                        <a href="/admin/affiliate-links-edit.php?id=<?php echo (int) $row['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="/admin/affiliate-links.php?delete=<?php echo (int) $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this row?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p class="text-muted">No rows yet. <a href="/admin/affiliate-links-edit.php">Add a link</a> (requires DB table).</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
