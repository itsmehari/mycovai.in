<?php
// Application secrets/config for token generation (do not expose publicly)
// MyCovai branding – previously MYOMR_* (legacy)

if (!defined('MYCOVAI_EVENTS_MANAGE_SECRET')) {
    define('MYCOVAI_EVENTS_MANAGE_SECRET', 'change-this-strong-secret-please-rotate');
}
if (!defined('MYOMR_EVENTS_MANAGE_SECRET')) { define('MYOMR_EVENTS_MANAGE_SECRET', MYCOVAI_EVENTS_MANAGE_SECRET); }

if (!defined('MYCOVAI_MAIL_FROM')) {
    define('MYCOVAI_MAIL_FROM', 'no-reply@mycovai.in');
}
if (!defined('MYOMR_MAIL_FROM')) { define('MYOMR_MAIL_FROM', MYCOVAI_MAIL_FROM); }
if (!defined('MYCOVAI_MAIL_FROM_NAME')) {
    define('MYCOVAI_MAIL_FROM_NAME', 'MyCovai');
}
if (!defined('MYOMR_MAIL_FROM_NAME')) { define('MYOMR_MAIL_FROM_NAME', MYCOVAI_MAIL_FROM_NAME); }
if (!defined('MYCOVAI_ADMIN_ALERT_EMAIL')) {
    define('MYCOVAI_ADMIN_ALERT_EMAIL', 'mycovai@gmail.com');
}
if (!defined('MYOMR_ADMIN_ALERT_EMAIL')) { define('MYOMR_ADMIN_ALERT_EMAIL', MYCOVAI_ADMIN_ALERT_EMAIL); }


