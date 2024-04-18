<?php

namespace App\Controllers;

use App\Models\TaskModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class CompletedActionsController
{
    private TaskModel $model;

    public function __construct(TaskModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $taskId = $request->getParsedBody()['delete'];
        $this->model->deleteTask($taskId);
        return $response->withHeader('Location', '/completed')->withStatus(301);
    }
}