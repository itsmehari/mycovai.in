<?php
require_once __DIR__ . '/../_bootstrap.php';
requireAdmin();

require_once __DIR__ . '/../../core/omr-connect.php';

$UPLOAD_DIR = '/local-news/covai-news-images';
$UPLOAD_PATH = dirname(__DIR__, 2) . $UPLOAD_DIR;

$title = 'Edit Article';
$breadcrumbs = ['Articles' => '/admin/articles/index.php', 'Edit Article' => null];
$error = '';
$article = null;
$id = (int)($_GET['id'] ?? 0);

if (!$id) {
    header('Location: /admin/articles/index.php');
    exit;
}

$stmt = $conn->prepare('SELECT * FROM articles WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$article = $result->fetch_assoc();
$stmt->close();

if (!$article) {
    $_SESSION['flash_error'] = 'Article not found.';
    header('Location: /admin/articles/index.php');
    exit;
}

$title_val = $article['title'];
$slug_val = $article['slug'];
$summary_val = $article['summary'];
$content_val = $article['content'];
$published_date_val = $article['published_date'] ? date('Y-m-d', strtotime($article['published_date'])) : '';
$author_val = $article['author'] ?? 'MyCovai Editorial Team';
$category_val = $article['category'] ?? 'Local News';
$tags_val = $article['tags'] ?? '';
$image_path_val = $article['image_path'];
$is_featured_val = (int)($article['is_featured'] ?? 0);
$status_val = $article['status'] ?? 'draft';

require_once __DIR__ . '/../../core/article-i18n-helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title_val = trim($_POST['title'] ?? '');
    $slug_val = trim($_POST['slug'] ?? '');
    $summary_val = trim($_POST['summary'] ?? '');
    $content_val = trim($_POST['content'] ?? '');
    $author_val = trim($_POST['author'] ?? 'MyCovai Editorial Team');
    $category_val = trim($_POST['category'] ?? 'Local News');
    $tags_val = trim($_POST['tags'] ?? '');
    $is_featured_val = !empty($_POST['is_featured']) ? 1 : 0;
    $status_val = in_array($_POST['status'] ?? '', ['draft', 'published']) ? $_POST['status'] : 'draft';

    // Preserve published_date when empty (e.g. when only changing image)
    $post_date = trim($_POST['published_date'] ?? '');
    if ($post_date !== '') {
        $published_date_val = $post_date;
    }

    $new_image_path = $image_path_val;
    $remove_old_image = false;

    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $allowed) && $_FILES['image']['size'] <= 5 * 1024 * 1024) {
            $filename = 'article-' . time() . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
            $dest = $UPLOAD_PATH . '/' . $filename;
            if (is_dir($UPLOAD_PATH) && move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                $new_image_path = $UPLOAD_DIR . '/' . $filename;
                $remove_old_image = !empty($image_path_val);
            }
        }
    } elseif (!empty($_POST['image_url'])) {
        $new_image_path = trim($_POST['image_url']);
    }

    if ($title_val && $slug_val && $summary_val) {
        $published = $published_date_val ? $published_date_val . ' 00:00:00' : null;
        if ($published === null && $article['published_date']) {
            $published = $article['published_date'];
        }
        if ($published === null) {
            $published = date('Y-m-d H:i:s');
        }

        $stmt = $conn->prepare('UPDATE articles SET title=?, slug=?, summary=?, content=?, published_date=?, author=?, category=?, tags=?, image_path=?, is_featured=?, status=? WHERE id=?');
        $stmt->bind_param('sssssssssisi', $title_val, $slug_val, $summary_val, $content_val, $published, $author_val, $category_val, $tags_val, $new_image_path, $is_featured_val, $status_val, $id);

        if ($stmt->execute()) {
            $stmt->close();
            if ($remove_old_image && !empty($image_path_val)) {
                $old_path = $image_path_val;
                if (strpos($old_path, 'http://') !== 0 && strpos($old_path, 'https://') !== 0) {
                    $old_file = dirname(__DIR__, 2) . (strpos($old_path, '/') === 0 ? '' : '/') . $old_path;
                    if (file_exists($old_file) && is_file($old_file)) {
                        @unlink($old_file);
                    }
                }
            }
            $_SESSION['flash_success'] = 'Article updated successfully.';
            header('Location: /admin/articles/index.php');
            exit;
        } else {
            $error = 'Error updating article: ' . $conn->error;
        }
        $stmt->close();
    } else {
        $error = 'Title, slug, and summary are required.';
    }
}

$slug_for_pair = $_SERVER['REQUEST_METHOD'] === 'POST' ? trim($_POST['slug'] ?? '') : ($article['slug'] ?? '');
$edit_pair_slug = $slug_for_pair !== ''
    ? (covai_article_slug_is_tamil($slug_for_pair)
        ? covai_article_english_base_slug($slug_for_pair)
        : covai_article_tamil_counterpart_slug($slug_for_pair))
    : '';
$edit_pair_article = null;
if ($edit_pair_slug !== '') {
    $ps = $conn->prepare('SELECT id, title, status, slug FROM articles WHERE slug = ? LIMIT 1');
    if ($ps) {
        $ps->bind_param('s', $edit_pair_slug);
        $ps->execute();
        $edit_pair_article = $ps->get_result()->fetch_assoc();
        $ps->close();
    }
}

include __DIR__ . '/../layout/header.php';
?>

<div class="container-fluid">
    <h2 class="mb-4">Edit Article</h2>
    <?php if ($error): ?><div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required value="<?php echo htmlspecialchars($title_val); ?>">
                </div>
                <div class="mb-3">
                    <label for="slug">Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug" required value="<?php echo htmlspecialchars($slug_val); ?>">
                    <small class="form-text text-muted">Tamil pairing: English uses the base slug; Tamil uses <code>{base}-tamil</code>. Both must be <code>published</code> for the language banner on the article page.</small>
                </div>
                <div class="mb-3">
                    <label for="summary">Summary <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary" rows="3" required><?php echo htmlspecialchars($summary_val); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="10"><?php echo htmlspecialchars($content_val); ?></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <?php if ($edit_pair_slug !== ''): ?>
                <div class="alert <?php echo $edit_pair_article ? 'alert-success' : 'alert-warning'; ?> small mb-3" role="status">
                    <strong>Language pair</strong><br>
                    <?php if (covai_article_slug_is_tamil($slug_for_pair)): ?>
                        English counterpart: <code><?php echo htmlspecialchars($edit_pair_slug); ?></code>
                    <?php else: ?>
                        Tamil counterpart: <code><?php echo htmlspecialchars($edit_pair_slug); ?></code>
                    <?php endif; ?>
                    <?php if ($edit_pair_article): ?>
                        <br><a href="/admin/articles/edit.php?id=<?php echo (int)$edit_pair_article['id']; ?>">Edit paired article</a>
                        (<?php echo htmlspecialchars($edit_pair_article['status']); ?>)
                    <?php else: ?>
                        <br>No row yet with that slug — add a second article for the other language.
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="published_date">Published Date</label>
                    <input type="date" class="form-control" id="published_date" name="published_date" value="<?php echo htmlspecialchars($published_date_val); ?>">
                </div>
                <div class="mb-3">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($author_val); ?>">
                </div>
                <div class="mb-3">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($category_val); ?>">
                </div>
                <div class="mb-3">
                    <label for="tags">Tags (comma separated)</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="<?php echo htmlspecialchars($tags_val); ?>">
                </div>
                <?php if ($image_path_val): ?>
                <div class="mb-3">
                    <label>Current Image</label>
                    <div><img src="<?php echo htmlspecialchars(strpos($image_path_val, 'http') === 0 ? $image_path_val : 'https://mycovai.in' . (strpos($image_path_val, '/') === 0 ? '' : '/') . $image_path_val); ?>" alt="Current" style="max-width:200px;max-height:120px;object-fit:cover;"></div>
                </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="image">Upload New Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="image_url">Or Image URL</label>
                    <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo htmlspecialchars($image_path_val ?? ''); ?>" placeholder="/local-news/covai-news-images/...">
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" <?php echo $is_featured_val ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="draft" <?php echo $status_val === 'draft' ? 'selected' : ''; ?>>Draft</option>
                        <option value="published" <?php echo $status_val === 'published' ? 'selected' : ''; ?>>Published</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Update Article</button>
        <a href="/admin/articles/index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
