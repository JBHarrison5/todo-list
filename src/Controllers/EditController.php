<?php

namespace App\Controllers;

use App\Models\TaskModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class EditController
{
    private TaskModel $model;

    public function __construct(TaskModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $newTaskName = $request->getParsedBody()['editedTask'];
        $taskId = $args['id'];
        $this->model->editTask($taskId, $newTaskName);
        return $response->withHeader('Location', '/')->withStatus(301);
    }
}