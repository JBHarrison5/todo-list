<?php
declare(strict_types=1);

use App\Controllers\AllCompletedTasksController;
use App\Controllers\CompletedActionsController;
use App\Controllers\DisplayEditController;
use App\Controllers\EditController;
use App\Controllers\HomeActionsController;
use App\Controllers\AllTasksController;
use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $container = $app->getContainer();


    $app->get('/', AllTasksController::class);
    $app->post('/', HomeActionsController::class);
    $app->get('/completed', AllCompletedTasksController::class);
    $app->post('/completed', CompletedActionsController::class);
    $app->get('/edit/{id}', DisplayEditController::class);
    $app->post('/edit/{id}', EditController::class);
};
