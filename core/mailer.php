<?php
require_once __DIR__ . '/app-secrets.php';

function myomrSendMail(string $to, string $subject, string $html, string $textAlt = ''): bool {
    $from = (string)(defined('MYCOVAI_MAIL_FROM') ? MYCOVAI_MAIL_FROM : MYOMR_MAIL_FROM);
    $fromName = (string)(defined('MYCOVAI_MAIL_FROM_NAME') ? MYCOVAI_MAIL_FROM_NAME : MYOMR_MAIL_FROM_NAME);
    $headers = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[] = 'From: ' . $fromName . ' <' . $from . '>';
    $headers[] = 'Reply-To: ' . $from;
    $headers[] = 'X-Mailer: PHP/' . phpversion();
    $ok = @mail($to, encodeHeader($subject), $html, implode("\r\n", $headers));
    if (!$ok) {
        @file_put_contents(__DIR__ . '/../weblog/email.log', date('c') . " FAIL to:$to subj:$subject\n", FILE_APPEND);
    }
    return $ok;
}

function encodeHeader(string $s): string {
    return '=?UTF-8?B?' . base64_encode($s) . '?=';
}


