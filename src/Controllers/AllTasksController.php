<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Factories\RendererFactory;
use App\Models\CoursesModel;
use App\Models\TaskModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class AllTasksController
{
    private TaskModel $model;
    private PhpRenderer $renderer;

    // Here, the parameter is automatically supplied by the Dependency Injection Container based on the type hint
    public function __construct(TaskModel $model, PhpRenderer $renderer)
    {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $tasks = $this->model->getAllIncompleteTasks();
        return $this->renderer->render($response, 'index.phtml', ['tasks'=>$tasks]);
    }
}