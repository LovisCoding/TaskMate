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

	/**
	 * Récupère toutes les tâches bloquables ou bloquantes par rapport à une tâche donnée.
	 *
	 * @param int $taskId L'ID de la tâche.
	 * @param string $relationColumn La colonne à utiliser pour la relation ('id_mother_task' ou 'id_child_task').
	 * @return array Liste des tâches possibles en fonction de la relation.
	 */
	private function getTasksByRelation($taskId, $relationColumn)
	{
		// Valide la colonne pour éviter les erreurs
		if (!in_array($relationColumn, ['id_mother_task', 'id_child_task'])) {
			throw new \InvalidArgumentException("Invalid relation column: $relationColumn");
		}

		// Récupère les tâches associées par la relation inverse
		$relatedTaskIds = $this->select($relationColumn === 'id_mother_task' ? 'id_child_task' : 'id_mother_task')
			->where($relationColumn, $taskId)
			->findAll();

		// Extraire les IDs et ajouter la tâche elle-même dans la liste des exclusions
		$relatedTaskIds = array_column($relatedTaskIds, $relationColumn === 'id_mother_task' ? 'id_child_task' : 'id_mother_task');
		$relatedTaskIds[] = $taskId;

		// Si aucune tâche n'est associée, renvoyer toutes les tâches sauf la tâche elle-même
		if (empty($relatedTaskIds)) {
			return $this->db->table('task')
				->where('id_task !=', $taskId)
				->get()
				->getResultArray();
		}

		// Sinon, exclure les tâches déjà associées et la tâche elle-même
		return $this->db->table('task')
			->where('id_task !=', $taskId)
			->whereNotIn('id_task', $relatedTaskIds)
			->get()
			->getResultArray();
	}

	/**
	 * Récupère toutes les tâches qui peuvent être bloquées par une tâche spécifique.
	 *
	 * @param int $taskId L'ID de la tâche pour laquelle on veut trouver des tâches bloquables.
	 * @return array Liste des tâches possibles à bloquer.
	 */
	public function getPossibleTasksToBlock($taskId)
	{
		return $this->getTasksByRelation($taskId, 'id_mother_task');
	}

	/**
	 * Récupère toutes les tâches qui peuvent bloquer une tâche spécifique.
	 *
	 * @param int $taskId L'ID de la tâche pour laquelle on veut trouver des tâches pouvant la bloquer.
	 * @return array Liste des tâches possibles à bloquer cette tâche.
	 */
	public function getPossibleTasksToBeBlockedBy($taskId)
	{
		return $this->getTasksByRelation($taskId, 'id_child_task');
	}
}