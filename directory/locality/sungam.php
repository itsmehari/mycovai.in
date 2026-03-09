<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../../core/omr-connect.php';
$locality = 'Sungam';
$locality_slug = 'sungam';
require __DIR__ . '/locality-template.php';
