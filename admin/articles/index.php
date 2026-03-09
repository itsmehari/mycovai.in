<?php
require_once __DIR__ . '/../_bootstrap.php';
requireAdmin();

require_once __DIR__ . '/../../core/omr-connect.php';

$DOC_ROOT = dirname(__DIR__, 2);

$title = 'News Articles';
$breadcrumbs = ['Articles' => null];

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if ($id > 0) {
        $stmt = $conn->prepare('SELECT image_path FROM articles WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res ? $res->fetch_assoc() : null;
        $stmt->close();

        $del = $conn->prepare('DELETE FROM articles WHERE id = ?');
        $del->bind_param('i', $id);
        if ($del->execute()) {
            if ($row && !empty($row['image_path'])) {
                $path = $row['image_path'];
                if (strpos($path, 'http://') !== 0 && strpos($path, 'https://') !== 0) {
                    $file = $DOC_ROOT . (strpos($path, '/') === 0 ? '' : '/') . $path;
                    if (file_exists($file) && is_file($file)) {
                        @unlink($file);
                    }
                }
            }
            $_SESSION['flash_success'] = 'Article deleted.';
        } else {
            $_SESSION['flash_error'] = 'Error deleting article.';
        }
        $del->close();
        header('Location: /admin/articles/index.php');
        exit;
    }
}

$result = $conn->query("SELECT id, title, slug, status, published_date, author, category, created_at FROM articles ORDER BY created_at DESC");

include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>News Articles</h2>
        <a href="/admin/articles/add.php" class="btn btn-success"><i class="fas fa-plus"></i> Add Article</a>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo (int)$row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><code><?php echo htmlspecialchars($row['slug']); ?></code></td>
                    <td><span class="badge <?php echo $row['status'] === 'published' ? 'bg-success' : 'bg-secondary'; ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
                    <td><?php echo $row['published_date'] ? date('M d, Y', strtotime($row['published_date'])) : '-'; ?></td>
                    <td><?php echo htmlspecialchars($row['category'] ?? '-'); ?></td>
                    <td>
                        <a href="/local-news/<?php echo htmlspecialchars($row['slug']); ?>" class="btn btn-sm btn-outline-primary" target="_blank" title="View">View</a>
                        <a href="/admin/articles/edit.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="/admin/articles/index.php?delete=<?php echo (int)$row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this article?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p class="text-muted">No articles yet. <a href="/admin/articles/add.php">Add your first article</a>.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
