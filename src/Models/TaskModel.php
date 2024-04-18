<?php

declare(strict_types=1);


namespace App\Models;


use PDO;

class TaskModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllIncompleteTasks(): array
    {
        $query = $this->db->prepare(
            'SELECT `id`, `task_name`, `done`, `created`
            FROM `tasks`
            WHERE `done` = 0');
        $query->execute();
        return $query->fetchAll();
    }

    public function addTask(string $taskName): void
    {
        $query = $this->db->prepare(
            'INSERT INTO `tasks` (`task_name`, `done`)
            VALUES(:taskName, 0)'
        );
        $query->bindParam(':taskName', $taskName);
        $query->execute();
    }

    public function markAsDone(int $id): void
    {
        $query = $this->db->prepare(
            'UPDATE `tasks` SET `done` = 1 WHERE `id` = :id'
        );
        $query->bindParam(':id', $id);
        $query->execute();
    }

    //try and integrate this with incomplete tasks (lots of repetition)
    public function getAllCompletedTasks(): array
    {
        $query = $this->db->prepare(
            'SELECT `id`, `task_name`, `done`, `created`
            FROM `tasks`
            WHERE `done` = 1'
        );
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteTask($id): void
    {
        $query = $this->db->prepare(
            'DELETE FROM `tasks` WHERE `id`=:id'
        );
        $query->bindParam(':id', $id);
        $query->execute();
    }

    public function getSpecificTask(int $id): array
    {
        $query = $this->db->prepare(
            'SELECT `id`, `task_name`, `done`
            FROM `tasks` WHERE `id` = :id'
        );
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function editTask(int $id, string $taskName): void
    {
        $query = $this->db->prepare(
            'UPDATE `tasks` SET `task_name` = :taskName
            WHERE `id`= :id'
        );
        $query->bindParam(':id', $id);
        $query->bindParam(':taskName', $taskName);
        $query->execute();
    }

}