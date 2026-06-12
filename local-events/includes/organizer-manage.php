<?php
require_once __DIR__ . '/../../core/app-secrets.php';

function eventsGenerateManageToken(int $submissionId, string $organizerEmail): string {
    $msg = $submissionId . '|' . strtolower(trim($organizerEmail));
    $secret = defined('MYCOVAI_EVENTS_MANAGE_SECRET') ? (string) MYCOVAI_EVENTS_MANAGE_SECRET : '';
    return hash_hmac('sha256', $msg, $secret);
}

function eventsVerifyManageToken(int $submissionId, string $organizerEmail, string $token): bool {
    $expected = eventsGenerateManageToken($submissionId, $organizerEmail);
    return hash_equals($expected, (string)$token);
}


