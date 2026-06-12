<?php
/**
 * Employer authentication — magic-link email verification.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($conn) || !$conn) {
    require_once __DIR__ . '/../../core/omr-connect.php';
}

require_once __DIR__ . '/../../core/magic-link-auth.php';

/**
 * Establish employer session after verified email (internal).
 */
function employerEstablishSession(string $email): bool {
    global $conn;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    $stmt = $conn->prepare('SELECT id, email, company_name, status FROM employers WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $employer = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$employer) {
        return false;
    }

    $_SESSION['employer_id'] = (int) $employer['id'];
    $_SESSION['employer_email'] = $employer['email'];
    $_SESSION['employer_company'] = $employer['company_name'] ?? 'Employer';
    $_SESSION['employer_status'] = $employer['status'] ?? 'pending';

    return true;
}

/**
 * Request a magic-link sign-in email.
 */
function employerRequestMagicLink(string $email, string $redirectPath = 'my-posted-jobs-covai.php'): bool {
    global $conn;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    $check = $conn->prepare('SELECT id FROM employers WHERE email = ? LIMIT 1');
    $check->bind_param('s', $email);
    $check->execute();
    $exists = $check->get_result()->fetch_assoc();
    $check->close();
    if (!$exists) {
        // Same success UX as sent link — avoids email enumeration.
        return true;
    }

    $redirectPath = magic_link_safe_redirect($redirectPath, '/jobs/my-posted-jobs-covai.php');
    $created = magic_link_create($conn, $email, 'employer', $redirectPath, 30);
    if (!$created['ok'] || empty($created['token'])) {
        return false;
    }

    $base = defined('SITE_CANONICAL_BASE') ? rtrim(SITE_CANONICAL_BASE, '/') : 'https://mycovai.in';
    $verifyUrl = $base . '/jobs/employer-verify-login-covai.php?token=' . urlencode($created['token']);

    return magic_link_send_email($email, $verifyUrl, 'MyCovai Employer Portal');
}

/**
 * Complete login from magic-link token.
 *
 * @return array{ok:bool,redirect?:string,message?:string}
 */
function employerCompleteMagicLinkLogin(string $token): array {
    global $conn;

    $verified = magic_link_verify($conn, $token, 'employer');
    if (!$verified['ok'] || empty($verified['email'])) {
        return ['ok' => false, 'message' => $verified['message'] ?? 'Invalid link'];
    }

    if (!employerEstablishSession($verified['email'])) {
        return ['ok' => false, 'message' => 'Could not sign you in'];
    }

    $redirect = magic_link_safe_redirect($verified['redirect'] ?? '', '/jobs/my-posted-jobs-covai.php');
    return ['ok' => true, 'redirect' => $redirect];
}

/** @deprecated Instant login removed — use magic link */
function employerLogin(string $email): bool {
    return false;
}

function isEmployerLoggedIn(): bool {
    return !empty($_SESSION['employer_id']);
}

function requireEmployerAuth(): void {
    if (!isEmployerLoggedIn()) {
        header('Location: employer-login-covai.php?redirect=' . urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
}

function employerLogout(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}
