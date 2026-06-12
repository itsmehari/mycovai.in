<?php
require_once __DIR__ . '/includes/error-reporting.php';
require_once __DIR__ . '/includes/employer-auth.php';

$token = trim((string) ($_GET['token'] ?? ''));
$result = employerCompleteMagicLinkLogin($token);

if ($result['ok']) {
    header('Location: ' . ($result['redirect'] ?? '/jobs/my-posted-jobs-covai.php'));
    exit;
}

$msg = urlencode($result['message'] ?? 'Invalid or expired sign-in link.');
header('Location: employer-login-covai.php?error=' . $msg);
exit;
