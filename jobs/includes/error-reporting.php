<?php
/**
 * Job portal error reporting — defers to site-wide error-handler when available.
 */
require_once __DIR__ . '/../../core/env.php';

if (!defined('DEVELOPMENT_MODE')) {
    define('DEVELOPMENT_MODE', omr_is_development());
}

if (!defined('COVAI_JOB_ERROR_HANDLER_LOADED')) {
    define('COVAI_JOB_ERROR_HANDLER_LOADED', true);
    $handler = __DIR__ . '/../../core/error-handler.php';
    if (is_file($handler)) {
        require_once $handler;
    } elseif (DEVELOPMENT_MODE) {
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
    } else {
        ini_set('display_errors', '0');
        ini_set('display_startup_errors', '0');
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
        ini_set('log_errors', '1');
        ini_set('error_log', __DIR__ . '/../../weblog/job-portal-errors.log');
    }
}
