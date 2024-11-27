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
}