<?php
// Master admin auth for MyCovai

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/admin-config.php';

function isAdminLoggedIn(): bool {
    return !empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function admin_safe_redirect(?string $target, string $default = '/admin/index.php'): string {
    if ($target === null || $target === '') {
        return $default;
    }
    if (strpos($target, '//') !== false || strpos($target, ':') !== false) {
        return $default;
    }
    if ($target[0] !== '/') {
        return $default;
    }
    if (preg_match('/[\r\n]/', $target)) {
        return $default;
    }
    return $target;
}

function requireAdmin(): void {
    if (!isAdminLoggedIn()) {
        $redirect = urlencode($_SERVER['REQUEST_URI'] ?? '/');
        header('Location: /admin/login.php?redirect=' . $redirect);
        exit;
    }
}

function requireRole(array $allowedRoles): void {
    requireAdmin();
    $role = $_SESSION['admin_role'] ?? '';
    if (!in_array($role, $allowedRoles, true)) {
        http_response_code(403);
        echo 'Forbidden';
        exit;
    }
}

function attemptAdminLogin(string $username, string $password): bool {
    // Super admin
    if (hash_equals((string)MYCOVAI_ADMIN_USERNAME, (string)$username) && password_verify($password, (string)MYCOVAI_ADMIN_PASSWORD_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_login_time'] = time();
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_role'] = (string)MYCOVAI_ADMIN_DEFAULT_ROLE;
        return true;
    }
    // Editor events (optional)
    if (!empty(MYCOVAI_EDITOR_USERNAME) && hash_equals((string)MYCOVAI_EDITOR_USERNAME, (string)$username) && !empty(MYCOVAI_EDITOR_PASSWORD_HASH) && password_verify($password, (string)MYCOVAI_EDITOR_PASSWORD_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_login_time'] = time();
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_role'] = 'editor_events';
        return true;
    }
    return false;
}

function admin_current_role(): string
{
    return (string) ($_SESSION['admin_role'] ?? '');
}

/**
 * Whether the logged-in admin role may open a navigation module.
 * Modules without `roles` are super_admin only.
 */
function admin_can_access_module(array $module): bool
{
    $role = admin_current_role();
    if ($role === 'super_admin') {
        return true;
    }
    $allowed = $module['roles'] ?? null;
    if ($allowed === null) {
        return false;
    }
    return in_array($role, $allowed, true);
}

/**
 * Filter navigation sections/modules by current admin role.
 */
function admin_filter_navigation(array $sections): array
{
    $filtered = [];
    foreach ($sections as $section) {
        $modules = array_values(array_filter(
            $section['modules'] ?? [],
            'admin_can_access_module'
        ));
        if ($modules === []) {
            continue;
        }
        $section['modules'] = $modules;
        $filtered[] = $section;
    }
    return $filtered;
}

function adminLogout(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}


