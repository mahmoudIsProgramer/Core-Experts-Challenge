<?php

use app\controllers\SiteController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';
$app = new Application(dirname(__DIR__));
// site routes
$app->router->get('/', [SiteController::class, 'home']);
// api routes
$app->router->get('/api/get-repos', [SiteController::class, 'getRepositories']);

$app->run();
