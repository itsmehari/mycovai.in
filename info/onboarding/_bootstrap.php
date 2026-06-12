<?php
require_once __DIR__ . '/../../core/omr-connect.php';
$site_name = covai_site_name();
$site_domain = defined('SITE_DOMAIN') ? SITE_DOMAIN : 'https://mycovai.in';
$region = defined('SITE_REGION') ? SITE_REGION : 'Coimbatore';
$region_short = defined('SITE_REGION_SHORT') ? SITE_REGION_SHORT : 'Covai';
$contact_email = defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'mycovai@gmail.com';
$contact_phone = defined('CONTACT_PHONE_FULL') ? CONTACT_PHONE_FULL : '+91 94450 88028';
