<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'Task';
    protected $primaryKey = 'id_task';

    protected $allowedFields = [
        'name',
        'description',
        'current_state',
        'priority',
        'start_date',
        'end_date',
        'id_group',
    ];

    protected $useTimestamps = false;

    /**
     * Récupère toutes les tâches avec leurs groupes associés.
     */
    public function getTasksWithGroups()
    {
        return $this->select('Task.*, Group.name AS group_name')
                    ->join('Group', 'Task.id_group = Group.id', 'left')
                    ->findAll();
    }

    /**
     * Récupère les tâches par priorité.
     */
    public function getTasksByPriority($priority)
    {
        return $this->where('priority', $priority)->findAll();
    }
}
