<?php
/**
 * Shared magic-link token helpers for employer and owner logins.
 */

require_once __DIR__ . '/email.php';

function magic_link_ensure_table(mysqli $conn): bool {
    static $checked = false;
    if ($checked) {
        return true;
    }
    $sql = "CREATE TABLE IF NOT EXISTS auth_magic_tokens (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        email VARCHAR(255) NOT NULL,
        context VARCHAR(32) NOT NULL,
        token_hash CHAR(64) NOT NULL,
        redirect_path VARCHAR(500) DEFAULT NULL,
        expires_at DATETIME NOT NULL,
        used_at DATETIME DEFAULT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY idx_token_hash (token_hash),
        KEY idx_email_context (email, context),
        KEY idx_expires (expires_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $ok = (bool) $conn->query($sql);
    $checked = $ok;
    return $ok;
}

function magic_link_safe_redirect(?string $path, string $default): string {
    if ($path === null || $path === '') {
        return $default;
    }
    if (strpos($path, '//') !== false || strpos($path, ':') !== false) {
        return $default;
    }
    if ($path[0] !== '/') {
        return $default;
    }
    return $path;
}

/**
 * @return array{ok:bool,token?:string,message?:string}
 */
function magic_link_create(mysqli $conn, string $email, string $context, string $redirectPath = '', int $ttlMinutes = 30): array {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['ok' => false, 'message' => 'Invalid email'];
    }
    if (!magic_link_ensure_table($conn)) {
        return ['ok' => false, 'message' => 'Login service unavailable'];
    }

    $token = bin2hex(random_bytes(32));
    $hash = hash('sha256', $token);
    $expires = date('Y-m-d H:i:s', time() + ($ttlMinutes * 60));
    $redirectPath = magic_link_safe_redirect($redirectPath, '');

    $stmt = $conn->prepare(
        'INSERT INTO auth_magic_tokens (email, context, token_hash, redirect_path, expires_at) VALUES (?, ?, ?, ?, ?)'
    );
    if (!$stmt) {
        return ['ok' => false, 'message' => 'Login service unavailable'];
    }
    $stmt->bind_param('sssss', $email, $context, $hash, $redirectPath, $expires);
    $ok = $stmt->execute();
    $stmt->close();

    if (!$ok) {
        return ['ok' => false, 'message' => 'Could not create login link'];
    }

    return ['ok' => true, 'token' => $token];
}

/**
 * @return array{ok:bool,email?:string,redirect?:string,message?:string}
 */
function magic_link_verify(mysqli $conn, string $token, string $context): array {
    if ($token === '' || !ctype_xdigit($token) || strlen($token) !== 64) {
        return ['ok' => false, 'message' => 'Invalid or expired link'];
    }
    if (!magic_link_ensure_table($conn)) {
        return ['ok' => false, 'message' => 'Login service unavailable'];
    }

    $hash = hash('sha256', $token);
    $stmt = $conn->prepare(
        "SELECT id, email, redirect_path FROM auth_magic_tokens
         WHERE token_hash = ? AND context = ? AND used_at IS NULL AND expires_at > NOW()
         LIMIT 1"
    );
    if (!$stmt) {
        return ['ok' => false, 'message' => 'Login service unavailable'];
    }
    $stmt->bind_param('ss', $hash, $context);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$row) {
        return ['ok' => false, 'message' => 'Invalid or expired link'];
    }

    $mark = $conn->prepare('UPDATE auth_magic_tokens SET used_at = NOW() WHERE id = ?');
    if ($mark) {
        $id = (int) $row['id'];
        $mark->bind_param('i', $id);
        $mark->execute();
        $mark->close();
    }

    return [
        'ok' => true,
        'email' => (string) $row['email'],
        'redirect' => (string) ($row['redirect_path'] ?? ''),
    ];
}

function magic_link_send_email(string $email, string $verifyUrl, string $portalLabel): bool {
    $body = renderEmailTemplate(
        $portalLabel . ' sign-in link',
        '<p>Click the button below to sign in to <strong>' . htmlspecialchars($portalLabel) . '</strong>.</p>'
        . '<p style="margin:24px 0"><a href="' . htmlspecialchars($verifyUrl) . '" '
        . 'style="background:#0f5132;color:#fff;padding:12px 20px;border-radius:6px;text-decoration:none;display:inline-block">'
        . 'Sign in</a></p>'
        . '<p style="font-size:13px;color:#6b7280">This link expires in 30 minutes. If you did not request it, ignore this email.</p>'
        . '<p style="font-size:12px;word-break:break-all;color:#9ca3af">' . htmlspecialchars($verifyUrl) . '</p>'
    );
    return sendEmail($email, 'Your MyCovai sign-in link', $body);
}
