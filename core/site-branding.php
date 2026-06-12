<?php
/**
 * MyCovai branding helpers — site name, logo path, mail signature.
 */

function covai_site_name(): string
{
    return defined('SITE_NAME') ? (string) SITE_NAME : 'MyCovai';
}

function covai_logo_url(): string
{
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? dirname(__DIR__);
    $candidates = [];
    if (defined('SITE_LOGO_URL') && SITE_LOGO_URL !== '') {
        $candidates[] = SITE_LOGO_URL;
    }
    $candidates[] = '/assets/img/mycovai-logo.svg';
    $candidates[] = '/My-OMR-Logo.jpg';

    foreach ($candidates as $path) {
        if ($path !== '' && is_file($docRoot . $path)) {
            return $path;
        }
    }

    return '/assets/img/mycovai-logo.svg';
}

function covai_mail_team_name(): string
{
    return covai_site_name() . ' Team';
}

function covai_region_label(): string
{
    if (defined('SITE_REGION_SHORT') && SITE_REGION_SHORT !== '') {
        return SITE_REGION_SHORT;
    }
    return 'Coimbatore';
}
