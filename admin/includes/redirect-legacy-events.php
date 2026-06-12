<?php
/**
 * Retired legacy events admin (events table). Use local-events module instead.
 */
require_once dirname(__DIR__) . '/_bootstrap.php';
requireAdmin();
$_SESSION['flash_success'] = 'Events are now managed in Local Events admin.';
header('Location: /local-events/admin/manage-events-covai.php');
exit;
