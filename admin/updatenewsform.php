<?php
/**
 * Deprecated — blocked for security. Use /admin/articles/ instead.
 */
http_response_code(403);
header('Content-Type: text/plain; charset=UTF-8');
echo 'This endpoint has been disabled. Use the admin articles module.';
