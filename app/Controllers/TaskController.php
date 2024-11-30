<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\TaskDependenciesModel;
use App\Models\TaskModel;
use App\Models\PreferencesModel;
use DateTime;

class TaskController extends BaseController
{

	public function insert(): void
	{
		$this->index(-1);
	}

	public function index($idTask = -1)
	{
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}


        $page = $this->request->getVar('page');
        if ($page && $idTask !== -1) {
            $this->validateTask($idTask);
        }

		$date = null;

		$title = null;
		$description = null;
		$priority = 1;
		$state = "Pas commencée";
		$started = false;

		$commentaries = [];
		$blockList = [];
		$isBlockedList = [];

		$idAccount = intval(session()->get("id"));

        $preferencesModel = new PreferencesModel();
		$preferences = $preferencesModel->getPreferencesByIdAccount($idAccount);
		$perPage =  (int)$preferences['rows_per_page'];		
		$currentPage = $this->request->getVar('page') ?? 1;

        $taskModel = new TaskModel();
        $task = $taskModel->where("id_task", $idTask)->first();

		if ($idTask != -1 && !$task) {
			return redirect()->to('/home/recap');
		}

		$commentModel = new CommentModel();

		if ($task) {
			$date = $task["deadline"];
			$commentaries = $commentModel
				->select('id, comment')
				->where("id_task", $idTask)
				->limit($perPage, ($currentPage - 1) * $perPage)
				->orderBy("id", "desc")
				->get()
				->getResultArray();

			$commentaries = array_map(function ($comment) {
				return [
					'id' => $comment['id'],
					'comment' => $comment['comment']
				];
			}, $commentaries);

			$tasks = $taskModel->findAll(); // Récupère toutes les tâches
			$taskDependenciesModel = new TaskDependenciesModel();

			$childTasks = $taskDependenciesModel->where("id_mother_task", $idTask)->findColumn('id_child_task') ?? [];
			$motherTasks = $taskDependenciesModel->where("id_child_task", $idTask)->findColumn('id_mother_task') ?? [];
			
			// Filtrer les tâches pour exclure celles qui correspondent à `idTask` ou qui nous bloque déjà
			$filteredTasks = array_filter($tasks, function ($task) use ($idTask, $motherTasks) {
				return $task['id_task'] != $idTask 
					&& !in_array($task['id_task'], $motherTasks); 
			});

			// Construire le résultat final
			$blockList = array_map(function ($task) use ($childTasks) {
				return [
					'id' => $task['id_task'],
					'name' => $task['name'],
					'isChecked' => in_array($task['id_task'], $childTasks)
				];
			}, $filteredTasks);

			// Filtrer les tâches pour exclure celles qui correspondent à `idTask` ou qui nous bloque déjà
			$filteredTasks = array_filter($tasks, function ($task) use ($idTask, $childTasks) {
				return $task['id_task'] != $idTask 
					&& !in_array($task['id_task'], $childTasks); 
			});

			$isBlockedList = array_map(function ($task) use ($motherTasks) {
				return [
					'id' => $task['id_task'],
					'name' => $task['name'],
					'isChecked' => in_array($task['id_task'], $motherTasks)
				];
			}, $filteredTasks);
			
			$title = $task["name"];
			$description = $task["description"];
			$priority = $task["priority"];
			$state = $task["current_state"];
			$started = $task["current_state"] == "En cours";
		} else {
			$date = $this->request->getGet('date');
		}

		if (!$blockList) {
			$tasks = $taskModel->findAll(); // Récupérer toutes les tâches

			$blockList = array_map(function ($task) use ($idTask) {
				// Exclure la tâche elle-même (idTask)
				if ($task['id_task'] != $idTask) {
					return [
						'id' => $task['id_task'],
						'name' => $task['name'],
						'isChecked' => false
					];
				}
				return null;
			}, $tasks);
			
			// Filtrer pour enlever les valeurs nulles
			$blockList = array_filter($blockList);
		}

		if (!$isBlockedList) {
			$tasks = $taskModel->findAll(); // Récupérer toutes les tâches

			// Filtrer les tâches pour exclure celle avec l'idTask spécifié
			$filteredTasks = array_filter($tasks, function ($task) use ($idTask) {
				return $task['id_task'] != $idTask; // Exclure la tâche ayant l'id $idTask
			});
			
			// Construire la liste après filtrage
			$isBlockedList = array_map(function ($task) {
				return [
					'id' => $task['id_task'],
					'name' => $task['name'],
					'isChecked' => false
				];
			}, $filteredTasks);
			
		}

		$sortByIsChecked = function ($a, $b) {
			return $b['isChecked'] <=> $a['isChecked'];
		};
		
		// Trier les deux listes
		usort($blockList, $sortByIsChecked);
		usort($isBlockedList, $sortByIsChecked);

		$dateI = new DateTime($date);
		helper("form");

		$comments = [
			'items' => $commentaries,
			'pager' => $commentModel->getPaginatedByTask($perPage, $idTask)
		];

		$data = [
			'id' => $idTask,
			'title' => $title,
			'description' => $description,
			'priority' => $priority,
			'date' => $dateI,
			'state' => $state,
			'commentaries' => $comments,
			'started' => $started,
			'blockList' => $blockList,
			'isBlockedList' => $isBlockedList,
			'pager' => $commentModel->pager
		];

		echo view('layout/header');
		echo view('layout/navbar');
		echo view('pages/viewTask/Task',  $data);
		echo view('layout/footer');
	}

	public function validateTask($id)
	{
		$action = $this->request->getPost('action');
		$taskModel = new TaskModel();

		$deleteCommentary = $this->request->getPost('DeleteCommentary');
		$commentModel = new CommentModel();


		if ($deleteCommentary != null && isset($deleteCommentary)) {
			$comment = $commentModel->delete($deleteCommentary);
            return redirect()->to('/task/' . $id);
		}


		if ($action && $action === "delete") {

			$taskModel->delete($id);
			return redirect()->to('/home/recap');
		} else {

			// Récupérer les données du formulaire
			$name = $this->request->getPost('task_name');
			$desc = $this->request->getPost('task_desc');
			$priority = $this->request->getPost('task_priority');
			$date = $this->request->getPost('task_date');
			$state = $this->request->getPost('task_state');
			$started = $this->request->getPost('taskIsStarted');
			$start_date = null;
			$end_date = null;
			$taskGroupId = $this->request->getPost('task_group');

			if ($id == -1) {
				$state = "Pas commencée";
			}
			else {
				$task = $taskModel->where("id_task", $id)->first();
				if ($task) {
					$start_date = $task['start_date'];
					$end_date = $task['end_date'];
				}
			}
 

			$now = (new DateTime())->format('Y-m-d');

			if ($action == "complete") {
				$end_date = $now;
				$state = "Terminée";

				$taskDependenciesModel = new TaskDependenciesModel();


				$childTasks = $taskDependenciesModel->where("id_mother_task", $id)->select("id_child_task")->findAll();

				// réaffectation de l'ancien state avant d'etre bloquée
				foreach($childTasks as $childId) {

					$task = $taskModel->where("id_task", $childId)->first();
					if ($task['start_date'])
						$old_state = $task['end_date'] ? "Terminée" : "En cours";
					else 
						$old_state = "Pas commencée";


					$taskModel->update((int) $childId, [
						"current_state" => $old_state
					]);

					dd($task);
				}
				
				$taskDependenciesModel->where("id_mother_task", $id)->delete();
			}
			else if ($started) {
				$start_date = $now;
				$state = "En cours";
			}

			$idAccount = intval(session()->get("id"));

			// Validation des données (facultatif)
			if (empty($name) || empty($desc) || empty($priority) || empty($date) || empty($state) || empty($idAccount)) {
				return redirect()->back();
			}

			$taskGroupId = $taskGroupId === "" ? null : $taskGroupId;

			// Construire le tableau de données pour l'insertion
			$taskData = [
				'id_account' => $idAccount,
				'name' => $name,
				'description' => $desc,
				'priority' => $priority,
				'deadline' => $date,
				'current_state' => $state,
				'start_date' => $start_date,
				'end_date' => $end_date,
				'id_group' => $taskGroupId
			];

			// Insertion ou mise à jour
			if ($id == -1) {
				// Cas d'une nouvelle tâche
				if ($taskModel->insert($taskData)) {
					$taskId = $taskModel->getInsertID(); // Récupérer l'ID inséré
				} else {
					return redirect()->back();
				}
			} else {
				// Cas d'une mise à jour
				$taskModel->update($id, $taskData);
			}

			$newId = $taskId ?? $id;

			$addCommentary = $this->request->getPost("addCommentary");

			if ($addCommentary) {
				$commentModel->insert([
					'comment' => '',
					'id_task' => $newId
				]);
			}

			// Gestion des commentaires, blockList, etc. (si nécessaires)
			$commentaries = $this->request->getPost('task_commentaries');
			$commentaries_id = $this->request->getPost('task_commentaries_id');
			if (!empty($commentaries) && !empty($commentaries_id) && count($commentaries) == count($commentaries_id)) {
				for ($i=0 ; $i<count($commentaries) ; $i++) {
					$strComment = $commentaries[$i];
					$idComment = $commentaries_id[$i];

					$commentModel->update($idComment, [
						'comment' => $strComment
					]);
				}
			}

			$taskDependenciesModel = new TaskDependenciesModel();


			$blockList = $this->request->getPost("task_blockList");

			$childTasks = $taskDependenciesModel->where("id_mother_task", $newId)->select("id_child_task")->findAll();

			// réaffectation de l'ancien state avant d'etre bloquée
			foreach($childTasks as $childId) {
				$task = $taskModel->where("id_task", $childId)->first();
				if ($task['start_date'])
					$old_state = $task['end_date'] ? "Terminée" : "En cours";
				else 
					$old_state = "Pas commencée";
			

				$taskModel->update($childId, [
					"current_state" => $old_state
				]);
			}

			$taskDependenciesModel->where("id_mother_task", $newId)->delete();

			if ($blockList != null) {


				foreach ($blockList as $taskBlockId) {

					if ($newId && $taskBlockId) {
						$taskDependenciesModel->addDependency($newId, $taskBlockId);

						$taskModel->update($taskBlockId, [
							"current_state" => "Bloquée"
						]);
					};
				}
			}

			$isBlockedList = $this->request->getPost("task_isBlockedList");
			
			$taskDependenciesModel->where("id_child_task", $newId)->delete();

			if ($isBlockedList != null) {

				if (count($isBlockedList) > 0) {
					$taskModel->update($newId, [
						"current_state" => "Bloquée"
					]);
				}
				foreach ($isBlockedList as $taskBlockId) {

					if ($newId && $taskBlockId) {
						$taskDependenciesModel->addDependency($taskBlockId, $newId);
						
					};
				}
			}
			else {
				$task = $taskModel->where("id_task", $newId)->first();
				if ($task['start_date'])
					$old_state = $task['end_date'] ? "Terminée" : "En cours";
				else 
					$old_state = "Pas commencée";
				
				$taskModel->update($newId, [
					"start_date" => $task["start_date"],
					"current_state" => $old_state,
					"end_date" => $task["end_date"]
				]);
			}


            // Redirection après insertion/mise à jour
            return redirect()->to('/task/' . $newId);
        }
		
    }
	public function getTasks() {

		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}
		$taskModel = new TaskModel();
		$tasks = $taskModel->findAll();
		return json_encode($tasks) ;
	}
}
