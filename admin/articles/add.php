<?php
require_once __DIR__ . '/../_bootstrap.php';
requireAdmin();

require_once __DIR__ . '/../../core/omr-connect.php';

$title = 'Add Article';
$breadcrumbs = ['Articles' => '/admin/articles/index.php', 'Add Article' => null];
$error = '';
$success = '';

// Upload folder for MyCovai (relative to doc root)
$UPLOAD_DIR = '/local-news/covai-news-images';
$UPLOAD_PATH = dirname(__DIR__, 2) . $UPLOAD_DIR;

// Path validation and create .htaccess if missing
if (!is_dir($UPLOAD_PATH)) {
    if (!@mkdir($UPLOAD_PATH, 0755, true)) {
        $error = 'Upload directory could not be created: ' . htmlspecialchars($UPLOAD_DIR);
    }
}
if (empty($error) && is_dir($UPLOAD_PATH)) {
    $htaccess = $UPLOAD_PATH . '/.htaccess';
    if (!file_exists($htaccess)) {
        $content = "# Block PHP execution in upload directory\n<FilesMatch \"\\.(php|phtml|php3|php4|php5)$\">\n    Require all denied\n</FilesMatch>\n";
        if (!@file_put_contents($htaccess, $content)) {
            $error = 'Could not create .htaccess in upload directory for security.';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($error)) {
    $title_val = trim($_POST['title'] ?? '');
    $slug_val = trim($_POST['slug'] ?? '');
    $summary_val = trim($_POST['summary'] ?? '');
    $content_val = trim($_POST['content'] ?? '');
    $date_val = !empty($_POST['published_date']) ? $_POST['published_date'] : null;
    $author_val = trim($_POST['author'] ?? 'MyCovai Editorial Team');
    $category_val = trim($_POST['category'] ?? 'Local News');
    $tags_val = trim($_POST['tags'] ?? '');
    $status_val = in_array($_POST['status'] ?? '', ['draft', 'published']) ? $_POST['status'] : 'draft';
    $is_featured = !empty($_POST['is_featured']) ? 1 : 0;

    if (empty($slug_val) && $title_val) {
        $slug_val = preg_replace('/[^a-z0-9]+/', '-', strtolower($title_val));
        $slug_val = trim($slug_val, '-');
    }

    $image_path_val = null;
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $allowed) && $_FILES['image']['size'] <= 5 * 1024 * 1024) {
            $filename = 'article-' . time() . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
            $dest = $UPLOAD_PATH . '/' . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                $image_path_val = $UPLOAD_DIR . '/' . $filename;
            }
        }
    } elseif (!empty($_POST['image_url'])) {
        $image_path_val = trim($_POST['image_url']);
    }

    if ($title_val && $slug_val && $summary_val) {
        $published = $date_val ? $date_val . ' 00:00:00' : date('Y-m-d H:i:s');
        $stmt = $conn->prepare('INSERT INTO articles (title, slug, summary, content, published_date, author, category, tags, image_path, is_featured, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssssssssis', $title_val, $slug_val, $summary_val, $content_val, $published, $author_val, $category_val, $tags_val, $image_path_val, $is_featured, $status_val);
        if ($stmt->execute()) {
            $_SESSION['flash_success'] = 'Article added successfully.';
            header('Location: /admin/articles/index.php');
            exit;
        } else {
            $error = 'Error adding article: ' . $conn->error;
        }
        $stmt->close();
    } else {
        $error = 'Title, slug, and summary are required.';
    }
}

include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <h2 class="mb-4">Add Article</h2>
    <?php if ($error): ?><div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="slug">Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?php echo htmlspecialchars($_POST['slug'] ?? ''); ?>" placeholder="auto-generated from title if empty">
                </div>
                <div class="mb-3">
                    <label for="summary">Summary <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary" rows="3" required><?php echo htmlspecialchars($_POST['summary'] ?? ''); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="10"><?php echo htmlspecialchars($_POST['content'] ?? ''); ?></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="published_date">Published Date</label>
                    <input type="date" class="form-control" id="published_date" name="published_date" value="<?php echo htmlspecialchars($_POST['published_date'] ?? date('Y-m-d')); ?>">
                </div>
                <div class="mb-3">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($_POST['author'] ?? 'MyCovai Editorial Team'); ?>">
                </div>
                <div class="mb-3">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($_POST['category'] ?? 'Local News'); ?>">
                </div>
                <div class="mb-3">
                    <label for="tags">Tags (comma separated)</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="<?php echo htmlspecialchars($_POST['tags'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="image">Image Upload</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="image_url">Or Image URL</label>
                    <input type="text" class="form-control" id="image_url" name="image_url" placeholder="/local-news/covai-news-images/...">
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" <?php echo !empty($_POST['is_featured']) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="draft" <?php echo ($_POST['status'] ?? '') === 'draft' ? 'selected' : ''; ?>>Draft</option>
                        <option value="published" <?php echo ($_POST['status'] ?? 'published') === 'published' ? 'selected' : ''; ?>>Published</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save Article</button>
        <a href="/admin/articles/index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
