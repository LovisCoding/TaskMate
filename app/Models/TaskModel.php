<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
	protected $table = 'task';
	protected $primaryKey = 'id_task';

	protected $allowedFields = [
		'id_account',
		'name',
		'description',
		'current_state',
		'priority',
		'start_date',
		'end_date',
		'deadline',
		'id_group'
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
	public function getQueryFiltered($priority = null, $states = []) {
		$query = $this;
		if ($priority) {
			$query->where('priority', $priority);
		}

		if (!empty($states)) {
			$query->whereIn('current_state', $states);
		}

		return $query;

	}

	/**
	 * Récupère les tâches entre une plage de dates et les organise par jour.
	 *
	 * @param string $startDate La date de début au format 'Y-m-d'.
	 * @param int $days Le nombre de jours à partir de la date de début.
	 * @return array Tableau associatif avec la date en clé et les tâches en valeur.
	 */

	public function getTasksByDateRange($startDate, $days, $idAccount, $priority = null, $states = [], $sort = 'deadline', $sortOrder = 'asc')
	{
		$days -= 1;
		$endDate = date('Y-m-d', strtotime("$startDate +$days days")); // Calcul de la date de fin

		$query = $this->where("id_account", $idAccount);
		if ($priority) {
			$query->where('priority', $priority);
		}

		if (!empty($states)) {
			$query->whereIn('current_state', $states);
		}

		// Récupérer toutes les tâches dont les dates chevauchent la plage demandée
		$query->groupStart()
			->where("start_date <=", $endDate)
			->where("end_date >=", $startDate)
			->groupEnd()
			->orGroupStart()
			->where("end_date", null) // Date de fin non définie
			->groupEnd();


		$tasks = $query->orderBy($sort, $sortOrder)->findAll();

		// Préparer le tableau associatif
		$result = [];

		// Initialiser les dates dans le tableau associatif
		for ($i = 0; $i <= $days; $i++) {
			$currentDate = date('Y-m-d', strtotime("$startDate +$i days"));
			$result[$currentDate] = []; // Clé initialisée avec un tableau vide
		}

		// Organiser les tâches par jour
		foreach ($tasks as $task) {
			$taskStartDate = new \DateTime($task['start_date']);
			$taskEndDate = isset($task['end_date']) ? new \DateTime($task['end_date']) : null;

			foreach ($result as $date => $tasksOnDate) {
				$currentDate = new \DateTime($date);

				// Vérifier si la tâche est active à cette date
				if (
					$currentDate >= $taskStartDate &&
					($taskEndDate === null || $currentDate <= $taskEndDate)
				) {
					$result[$date][] = $task;
				}
			}
		}

		return $result;
	}

	/**
	 * Récupère les tâches par priorité.
	 */
	public function getTasksByPriority($idAccount, $priority = null, $states = [], $sort = 'deadline', $sortOrder = 'asc')
	{
		$result = [];

		for ($i = 4; $i > 0; $i--) {
			$query = $this->getQueryFiltered($priority, $states);
			$tasks = $query->where("id_account", $idAccount)
				->where("priority", $i)
				->orderBy($sort, $sortOrder)
				->findAll();
			$result[$i] =  $tasks;
		}

		return $result;
	}

	/**
	 * Récupère les tâches et les organise par état actuel (current_state).
	 *
	 * @return array Tableau associatif avec les états comme clés et les tâches comme valeurs.
	 */
	public function getTasksByCurrentState($idAccount, $priority = null, $statesFilters = [], $sort = 'deadline', $sortOrder = 'asc')
	{
		$states = ['En retard', 'En cours', 'Pas commencée', 'Terminée', 'Bloquée'];

		foreach ($states as $s) {
			$query = $this->getQueryFiltered($priority, $statesFilters);
			$tasks = $query->where("id_account", $idAccount)
				->where("current_state", $s)
				->orderBy($sort, $sortOrder)
				->findAll();
			$result[$s] =  $tasks;
		}

		return $result;
	}

	/**
	 * Récupère les tâches entre une plage de dates et les organise par Deadline.
	 *
	 * @param string $startDate La date de début au format 'Y-m-d'.
	 * @param int $days Le nombre de jours à partir de la date de début.
	 * @return array Tableau associatif avec la date en clé et les tâches en valeur.
	 */
	public function getTasksByDeadline($startDate, $days, $idAccount, $priority = null, $states = [], $sort = 'deadline', $sortOrder = 'asc')
	{
		// Initialiser les dates dans le tableau associatif
		for ($i = 0; $i < $days; $i++) {
			$currentDate = date('Y-m-d', strtotime("$startDate +$i days"));
			$currentDateHour = date('Y-m-d H:i:s', strtotime("$startDate +$i days"));

			$query = $this->getQueryFiltered($priority, $states);
			$tasks = $query->where("id_account", $idAccount)
				->where("deadline", $currentDateHour)
				->orderBy($sort, $sortOrder)
				->findAll();

			$result[$currentDate] = $tasks;
		}

		return $result;
	}
}