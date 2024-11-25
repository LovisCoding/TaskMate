<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'Comment';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'comment',
        'id_task',
    ];

    protected $useTimestamps = false;

    /**
     * Récupère tous les commentaires associés à une tâche spécifique.
     */
    public function getCommentsByTask($taskId)
    {
        return $this->where('id_task', $taskId)->findAll();
    }
}
