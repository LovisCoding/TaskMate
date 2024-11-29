<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

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
	public function getQueryFiltered($priority = null, $states = [])
	{
		$query = $this;
		if ($priority) {
			$query->where('priority', $priority);
		}

		if (!empty($states)) {
			$query->whereIn('current_state', $states);
		}

		return $query;
	}

	public function createRetardTasks($tasks)
	{

		$tasks = array_map(function ($task) {
			$today = new \DateTime(); // Date actuelle
			$deadline = new \DateTime($task['deadline']);
			$endDate = isset($task['end_date']) ? new \DateTime($task['end_date']) : null;

			if ($endDate) {
				$delay = $endDate->diff($deadline)->days;
				$task['retard'] = $delay > 0 ? $delay : null;
			} else {
				$delay = $today->diff($deadline)->days;
				$task['retard'] = $delay > 0 ? $delay : null;
			}

			return $task;
		}, $tasks);

		return $tasks;
	}


	public function getTasksWhichAreNotTerminatedAndStartDays($idAccount, $nbDays)
	{
		$date = new DateTime();
		$date->modify("+$nbDays days");
		$query = $this
			->where('deadline <', $date->format('Y-m-d H:i:s'))
			->where('current_state !=', 'Terminée')
			->where('id_account', $idAccount);
		$tasks = $query->orderBy('deadline', 'asc')->findAll();
		return $tasks;
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
		if ($sort == 'current_state') {
			$tasks = $this->sortTasksByStateAndRetard($tasks, $sortOrder);
		}

		// Préparer le tableau associatif
		$result = [];

		// Initialiser les dates dans le tableau associatif
		for ($i = 0; $i <= $days; $i++) {
			$currentDate = date('Y-m-d', strtotime("$startDate +$i days"));
			$result[$currentDate] = []; // Clé initialisée avec un tableau vide
		}

		$tasks = $this->createRetardTasks($tasks);

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
	 * Récupère les tâches et les organise par état actuel (current_state).
	 *
	 * @return array Tableau associatif avec les états comme clés et les tâches comme valeurs.
	 */
	public function getCountByPriority($idAccount, $priority = null, $statesFilters = [], $sort = 'deadline', $sortOrder = 'asc')
	{
		$result = [];

		for ($i = 1; $i <= 4; $i++) {

			$query = $this->getQueryFiltered($priority, $statesFilters)
				->where("id_account", $idAccount)
				->where("priority", $i)
				->orderBy($sort, $sortOrder);

			$result[$i] = $query->countAllResults();
		}

		asort($result);

		return $result;
	}

	/**
	 * Récupère les tâches par priorité.
	 */
	public function getTasksByPriority($idAccount, $priority = null, $states = [], $sort = 'deadline', $sortOrder = 'asc', $perPage = 5, $currentPage = 1)
	{
		// Récupérer les priorités triées par nombre de résultats
		$priorities = array_keys($this->getCountByPriority($idAccount, $priority, $states, $sort, $sortOrder));

		$result = [];

		// Boucle sur chaque priorité triée
		foreach ($priorities as $p) {
			// On s'assure que $p est un entier
			$i = (int) $p;

			// Préparer la requête en utilisant where pour une seule priorité
			$query = $this->getQueryFiltered($priority, $states)
				->where("id_account", $idAccount)
				->where("priority", $i)  // On passe ici un entier à la méthode where
				->orderBy($sort, $sortOrder);

			// Exécuter la pagination
			$tasks = $query->paginate($perPage, 'default', $currentPage);

			// Traiter les tâches récupérées (par exemple, pour les retards)
			$tasks = $this->createRetardTasks($tasks);


			// Appliquer le tri spécifique uniquement si le sort est 'current_state'
			if ($sort == 'current_state') {
				$tasks = $this->sortTasksByStateAndRetard($tasks, $sortOrder);
			}


			// Ajouter les tâches au résultat final en associant à chaque priorité
			$result[$i] = $tasks;
		}

		return $result;
	}

	/**
	 * Récupère les tâches et les organise par état actuel (current_state).
	 *
	 * @return array Tableau associatif avec les états comme clés et les tâches comme valeurs.
	 */
	public function getCountByCurrentState($idAccount, $priority = null, $statesFilters = [], $sort = 'deadline', $sortOrder = 'asc')
	{
		// Définir les états
		$states = ['Bloquée', 'Pas commencée', 'En cours', 'Terminée'];

		// Créer et exécuter les requêtes pour chaque état
		foreach ($states as $s) {
			// Créer la requête pour chaque état
			$query = $this->getQueryFiltered($priority, $statesFilters)
				->where("id_account", $idAccount)
				->where("current_state", $s)
				->orderBy($sort, $sortOrder);

			$result[$s] = $query->countAllResults();
		}

		asort($result);

		// Retourner le tableau des résultats
		return $result;
	}


	/**
	 * Récupère les tâches et les organise par état actuel (current_state).
	 *
	 * @return array Tableau associatif avec les états comme clés et les tâches comme valeurs.
	 */
	public function getTasksByCurrentState($idAccount, $priority = null, $statesFilters = [], $sort = 'deadline', $sortOrder = 'asc', $perPage = 5, $currentPage = 1)
	{
		$states = array_keys($this->getCountByCurrentState($idAccount, $priority, $statesFilters, $sort, $sortOrder, $sortOrder));

		$result = [];

		// Créer et exécuter les requêtes pour chaque état
		foreach ($states as $s) {
			// Créer la requête pour chaque état
			$query = $this->getQueryFiltered($priority, $statesFilters)
				->where("id_account", $idAccount)
				->where("current_state", $s)
				->orderBy($sort, $sortOrder);


			$tasks = $query->paginate($perPage, 'default', $currentPage);

			$tasks = $this->createRetardTasks($tasks);

			if ($sort == 'current_state') {
				$tasks = $this->sortTasksByStateAndRetard($tasks, $sortOrder);
			}

			$result[$s] = $tasks;
		}

		// Retourner le tableau des résultats
		return $result;
	}




	// public function getTasksByCurrentState($idAccount, $priority = null, $statesFilters = [], $sort = 'deadline', $sortOrder = 'asc', $perPage = 5, $currentPage = 1)
	// {
	// 	$states = ['En retard', 'En cours', 'Pas commencée', 'Terminée', 'Bloquée'];

	// 	$query = $this->getQueryFiltered($priority, $statesFilters);
	// 	$tasks = [];

	// 	// Pour chaque état, on applique les filtres et récupère les tâches
	// 	foreach ($states as $s) {
	// 		// Appliquez la pagination sur la requête
	// 		$query->where("id_account", $idAccount)
	// 			->where("current_state", $s)
	// 			->orderBy($sort, $sortOrder);

	// 		$tasks = $this->createRetardTasks($tasks);


	// 		// Récupérer les tâches pour une page donnée
	// 		$tasks[$s] = $query->paginate($perPage, 'default', $currentPage);
	// 	}

	// 	// Retourner les tâches avec la pagination
	// 	return $tasks;
	// }


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

			$tasks = $this->createRetardTasks($tasks);

			if ($sort == 'current_state') {
				$tasks = $this->sortTasksByStateAndRetard($tasks, $sortOrder);
			}

			$result[$currentDate] = $tasks;
		}

		return $result;
	}

	public function getTasksByGroupName($idAccount, $priority = null, $states = [], $sort = 'deadline', $sortOrder = 'asc', $perPage = 5, $currentPage = 1)
	{
		$result = [];

		// 1. Filtrer les groupes qui ont des tâches
		$groupModel = new GroupModel();

		// Jointure pour récupérer uniquement les groupes ayant des tâches
		$groupsQuery = $groupModel
			->select('group.id, group.name') // Sélectionner l'id et le nom du groupe
			->join('task', 'task.id_group = group.id', 'inner') // Joindre la table des tâches
			->where('group.id_account', $idAccount) // Filtrer par l'utilisateur (id_account)
			->groupBy('group.id') // Grouper par id de groupe pour éviter les doublons
			->orderBy('group.name', 'asc'); // Trier les groupes par nom

		// 2. Pagination des groupes
		$groups = $groupsQuery->paginate($perPage, 'default', $currentPage);

		// 3. Pour chaque groupe récupéré, récupérer les tâches associées
		foreach ($groups as $group) {
			// Récupérer toutes les tâches de ce groupe
			$tasks = $this->getQueryFiltered($priority, $states)
				->where('id_group', $group['id'])
				->where('id_account', $idAccount)
				->orderBy($sort, $sortOrder)
				->findAll();
			
			$tasks = $this->createRetardTasks($tasks);

			if ($sort == 'current_state') {
				$tasks = $this->sortTasksByStateAndRetard($tasks, $sortOrder);
			}

			// Ajouter les tâches transformées à notre résultat
			$groupName = $group['name']; // Nom du groupe
			$result[$groupName] = $tasks;
		}

		// Retourner les groupes paginés avec leurs tâches respectives et l'objet de pagination
		return $result;
	}




	public function getTasksConcentration()
	{
		return $this->where("current_state", "Pas commencée")
			->orderBy("priority", "DESC")
			->orderBy("deadline")
			->findAll();
	}


	private function sortTasksByStateAndRetard(array $tasks, string $sortOrder = 'desc')
	{
		// Définir un ordre de tri pour les états
		$stateOrder = [
			'En cours' => 0,
			'Pas commencée' => 1,
			'Bloquée' => 2,
			'Terminée' => 3,
		];

		// Fonction de comparaison pour usort
		usort($tasks, function ($a, $b) use ($stateOrder, $sortOrder) {
			// Trier d'abord par retard
			$aRetard = isset($a['retard']) ? $a['retard'] : 0;
			$bRetard = isset($b['retard']) ? $b['retard'] : 0;

			// Comparer les retards : ajuster l'ordre en fonction de $sortOrder
			if ($aRetard !== $bRetard) {
				return ($sortOrder === 'desc') ? ($bRetard - $aRetard) : ($aRetard - $bRetard);
			}

			// Si les retards sont égaux, trier par current_state
			$aStateOrder = $stateOrder[$a['current_state']] ?? 999;
			$bStateOrder = $stateOrder[$b['current_state']] ?? 999;

			// Comparer les états en fonction de $sortOrder
			return ($sortOrder === 'desc') ? ($bStateOrder - $aStateOrder) : ($aStateOrder - $bStateOrder);
		});

		return $tasks;
	}
	public function getTasks() {
		return $this->findAll();
	}
}
