<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
	protected $table = 'group';
	protected $primaryKey = 'id';

	protected $allowedFields = ['name'];

	protected $useTimestamps = false;

	/**
	 * Récupère tous les groupes avec leurs tâches associées.
	 */
	public function getGroupsWithTasks()
	{
		return $this->select('Group.*, Task.name AS task_name')
					->join('Task', 'Group.id = Task.id_group', 'left')
					->findAll();
	}
	public function createGroupAndUpdateTasks(int $id_account, string $groupName, array $tasksIds)
	{
		$params = [
            'p_id_account' => $id_account,
            'p_group_name' => $groupName,
            'p_task_ids' => $tasksIds
        ];

        // Appeler la fonction SQL avec les paramètres nécessaires
        $query = $this->query('
            SELECT create_group_and_assign_tasks(:p_id_account, :p_group_name, :p_task_ids)
        ', $params);

        // Vous pouvez vérifier la réponse si nécessaire, ou gérer les erreurs ici
        return $query->getResult();

	}
}