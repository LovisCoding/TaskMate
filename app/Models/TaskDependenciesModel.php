<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskDependenciesModel extends Model
{
    protected $table = 'taskdependencies';
    protected $primaryKey = null; // Pas de clé primaire unique
    protected $useAutoIncrement = false; // Désactive l'auto-incrémentation
    protected $allowedFields = ['id_mother_task', 'id_child_task']; // Colonnes autorisées

    /**
     * Insertion personnalisée pour gérer une clé composite.
     *
     * @param int $motherTaskId
     * @param int $childTaskId
     * @return bool Succès de l'opération
     */
    public function addDependency(int $motherTaskId, int $childTaskId): bool
    {
        $data = [
            'id_mother_task' => $motherTaskId,
            'id_child_task' => $childTaskId,
        ];

        // Validation pour éviter les doublons
        $exists = $this->where($data)->first();
        if ($exists) {
            return false; // Dépendance déjà existante
        }

        return (bool) $this->db->table($this->table)->insert($data);
    }

    /**
     * Supprime une dépendance entre deux tâches.
     *
     * @param int $motherTaskId L'ID de la tâche mère.
     * @param int $childTaskId L'ID de la tâche enfant.
     * @return bool Succès de l'opération.
     */
    public function removeDependency(int $motherTaskId, int $childTaskId): bool
    {
        return $this->where('id_mother_task', $motherTaskId)
            ->where('id_child_task', $childTaskId)
            ->delete();
    }

    /**
     * Récupère toutes les tâches enfants d'une tâche mère.
     *
     * @param int $motherTaskId L'ID de la tâche mère.
     * @return array Liste des tâches enfants.
     */
    public function getChildTasks(int $motherTaskId): array
    {
        return $this->where('id_mother_task', $motherTaskId)
            ->findAll();
    }

    /**
     * Récupère toutes les tâches mères d'une tâche enfant.
     *
     * @param int $childTaskId L'ID de la tâche enfant.
     * @return array Liste des tâches mères.
     */
    public function getMotherTasks(int $childTaskId): array
    {
        return $this->where('id_child_task', $childTaskId)
            ->findAll();
    }
}
