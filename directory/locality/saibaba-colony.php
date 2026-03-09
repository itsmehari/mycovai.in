<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../../core/omr-connect.php';
$locality = 'Saibaba Colony';
$locality_slug = 'saibaba-colony';
require __DIR__ . '/locality-template.php';
