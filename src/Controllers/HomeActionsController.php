<?php

namespace App\Controllers;

use App\Models\TaskModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeActionsController
{
    private TaskModel $model;

    public function __construct(TaskModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response) : ResponseInterface
    {
        $task = $request->getParsedBody();
        if (isset($task['taskName'])){
            $this->model->addTask($task['taskName']);
        }
        else if (isset($task['done'])){
            $this->model->markAsDone($task['done']);
        }
        return $response->withHeader('Location', '/')->withStatus(301);
    }
}