<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskDependenciesModel extends Model
{
    protected $table = 'taskdependencies';

    protected $allowedFields = [
        'id_mother_task',
        'id_child_task',
    ];

    protected $useTimestamps = false;

    /**
     * Récupère toutes les tâches parentes d'une tâche spécifique.
     */
    public function getParentDependencies($taskId)
    {
        return $this->where('id_child_task', $taskId)->findAll();
    }

    /**
     * Récupère toutes les tâches enfants d'une tâche spécifique.
     */
    public function getChildDependencies($taskId)
    {
        return $this->where('id_mother_task', $taskId)->findAll();
    }
}
