<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine project root based on file structure
// 1. Check for standard structure (Local / UAT)
if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    $projectRoot = __DIR__.'/..';
} 
// 2. Fallback to secure production structure
else {
    $projectRoot = __DIR__.'/../batch42cu';
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $projectRoot.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $projectRoot.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once $projectRoot.'/bootstrap/app.php';

$app->handleRequest(Request::capture());
