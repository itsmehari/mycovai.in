<?php
/**
 * Elections 2026 – environment diagnostic.
 * Uses the same ROOT_PATH logic as includes/bootstrap.php so you can see why pages might not load.
 *
 * SECURITY: Delete or restrict access (e.g. .htaccess deny) after fixing the site.
 */
$bootstrap_dir = __DIR__ . '/includes';
$ROOT_PATH = dirname($bootstrap_dir, 2);

$core_omr = $ROOT_PATH . '/core/omr-connect.php';
$core_config = $ROOT_PATH . '/core/mycovai-config.php';
$core_url_helpers = $ROOT_PATH . '/core/url-helpers.php';
$components_meta = $ROOT_PATH . '/components/meta.php';

$omr_exists = file_exists($core_omr);
$config_exists = file_exists($core_config);
$url_helpers_exists = file_exists($core_url_helpers);
$meta_exists = file_exists($components_meta);

$db_ok = false;
$db_error = null;
if ($omr_exists && $config_exists) {
    try {
        require_once $core_omr;
        if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
            $db_ok = true;
        } else {
            $db_error = isset($conn) && $conn->connect_error ? $conn->connect_error : 'No $conn or connection failed';
        }
    } catch (Throwable $e) {
        $db_error = $e->getMessage();
    }
}

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elections 2026 – Environment Check</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 640px; margin: 2rem auto; padding: 0 1rem; }
        h1 { font-size: 1.25rem; }
        table { border-collapse: collapse; width: 100%; }
        th, td { text-align: left; padding: 0.5rem; border-bottom: 1px solid #eee; }
        .ok { color: #0a0; }
        .fail { color: #c00; }
        .warn { background: #fffbe6; padding: 1rem; margin: 1rem 0; border-radius: 4px; }
        code { background: #f5f5f5; padding: 0.2em 0.4em; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>Elections 2026 – Environment Check</h1>
    <p>ROOT_PATH (parent of <code>coimbatore-elections-2026/</code>) is set the same way as in <code>includes/bootstrap.php</code>.</p>

    <table>
        <tr>
            <th>Check</th>
            <th>Status</th>
        </tr>
        <tr>
            <td><code>ROOT_PATH</code></td>
            <td><code><?php echo htmlspecialchars($ROOT_PATH); ?></code></td>
        </tr>
        <tr>
            <td><code>core/omr-connect.php</code></td>
            <td class="<?php echo $omr_exists ? 'ok' : 'fail'; ?>"><?php echo $omr_exists ? 'Found' : 'Missing'; ?></td>
        </tr>
        <tr>
            <td><code>core/mycovai-config.php</code></td>
            <td class="<?php echo $config_exists ? 'ok' : 'fail'; ?>"><?php echo $config_exists ? 'Found' : 'Missing'; ?></td>
        </tr>
        <tr>
            <td><code>core/url-helpers.php</code></td>
            <td class="<?php echo $url_helpers_exists ? 'ok' : 'fail'; ?>"><?php echo $url_helpers_exists ? 'Found' : 'Missing'; ?></td>
        </tr>
        <tr>
            <td><code>components/meta.php</code></td>
            <td class="<?php echo $meta_exists ? 'ok' : 'fail'; ?>"><?php echo $meta_exists ? 'Found' : 'Missing'; ?></td>
        </tr>
        <tr>
            <td>Database connection</td>
            <td class="<?php echo $db_ok ? 'ok' : 'fail'; ?>">
                <?php
                if ($db_ok) {
                    echo 'OK';
                } elseif ($db_error !== null) {
                    echo 'Failed: ', htmlspecialchars($db_error);
                } else {
                    echo 'Skipped (core files missing)';
                }
                ?>
            </td>
        </tr>
    </table>

    <?php if (!$omr_exists || !$config_exists || !$meta_exists): ?>
    <div class="warn">
        <strong>Core files missing.</strong> Ensure the site is deployed so that the <strong>parent</strong> of
        <code>coimbatore-elections-2026/</code> contains <code>core/</code> and <code>components/</code>.
        Election pages will show a blank or error page until this layout is correct.
    </div>
    <?php endif; ?>

    <?php if ($omr_exists && $config_exists && !$db_ok && $db_error): ?>
    <div class="warn">
        <strong>Database connection failed.</strong> Check <code>core/omr-connect.php</code> (or env vars
        DB_HOST, DB_USER, DB_PASS, DB_NAME). The database must exist and credentials must match the server.
    </div>
    <?php endif; ?>

    <p><small>Remove or restrict <code>check-env.php</code> after fixing the site.</small></p>
</body>
</html>
