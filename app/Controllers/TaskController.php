<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\TaskDependenciesModel;
use App\Models\TaskModel;
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
        $date = null;
        $taskModel = new TaskModel();

        $title = "Titre de la tâche";
        $description = "Description de la tâche";
        $priority = 2;
        $state = "Pas commencée";
        $started = false;

        $commentaries = [];
        $blockList = [];
        $isBlockedList = [];

        $perPage = 3;
        $currentPage = $this->request->getVar('page') ?? 1;

        $task = $taskModel->where("id_task", $idTask)->first();

        if ($idTask != -1 && !$task) {
            return redirect()->to('/home/recap');
        }

        $commentModel = new CommentModel();

        if ($task) {
            $date = $task["deadline"];
            $commentaries = $commentModel
                ->select('id, comment')  // Ajoutez l'ID du commentaire ici
                ->where("id_task", $idTask)
                ->limit($perPage, ($currentPage - 1) * $perPage)
                ->get()
                ->getResultArray();

            // Optionnel : Vous pouvez ajouter l'ID au tableau de commentaires
            // Ici, vous ajoutez chaque commentaire avec son ID
            $commentaries = array_map(function ($comment) {
                return [
                    'id' => $comment['id'],    // Ajoutez l'ID du commentaire
                    'comment' => $comment['comment'] // Gardez le texte du commentaire
                ];
            }, $commentaries);


            $tasks = $taskModel->findAll(); // Récupère toutes les tâches
            $taskDependenciesModel = new TaskDependenciesModel();
            
            // Obtenez les dépendances : toutes les tâches enfants liées à une tâche mère.
            $allChildTasks = $taskDependenciesModel->findColumn('id_child_task') ?? [];
            
            // Filtrer les tâches pour exclure celles qui correspondent à `idTask` ou qui ont une tâche mère.
            $filteredTasks = array_filter($tasks, function ($task) use ($idTask, $allChildTasks) {
                return $task['id_task'] != $idTask // Exclure la tâche actuelle
                    && !in_array($task['id_task'], $allChildTasks); // Exclure les tâches ayant une tâche mère
            });
            
            // Construire le résultat final
            $blockList = array_map(function ($task) {
                return [
                    'id' => $task['id_task'],
                    'name' => $task['name'],
                    'isChecked' => false // Par défaut, aucune tâche n'est cochée
                ];
            }, $filteredTasks);

            $motherTasks = $taskDependenciesModel
            ->where('id_child_task', $idTask)
            ->findColumn('id_mother_task'); // Tâches mères de `idTask`
        
            // Trouver tous les enfants de la tâche actuelle
            $childTasks = $taskDependenciesModel
                ->where('id_mother_task', $idTask)
                ->findColumn('id_child_task') ?? []; // Liste des tâches enfants
            
            if ($motherTasks) {
                $isBlockedList = array_map(function ($task) use ($motherTasks, $idTask, $childTasks) {
                    // Exclure `idTask` lui-même et vérifier si un enfant est bloqué
                    $isBlocked = in_array($task['id_task'], $motherTasks) || in_array($task['id_task'], $childTasks);
                    if ($task['id_task'] != $idTask && !$isBlocked) {
                        return [
                            'id' => $task['id_task'],
                            'name' => $task['name'],
                            'isChecked' => in_array($task['id_task'], $motherTasks) // `true` si présent dans les dépendances
                        ];
                    }
                    return null; // Exclure la tâche si elle est bloquée ou si c'est elle-même
                }, $tasks);
            
                // Filtrer les tâches nulles
                $isBlockedList = array_filter($isBlockedList);
            }
            
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
                        'id' => $task['id_task'], // Assurez-vous que 'id_task' est correct
                        'name' => $task['name'],  // Assurez-vous que 'name' est correct
                        'isChecked' => false // Par défaut, aucune tâche n'est cochée
                    ];
                }
                return null; // Retourne null si c'est la tâche à exclure
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
                    'id' => $task['id_task'], // Assurez-vous que 'id_task' est le bon champ
                    'name' => $task['name'],  // Assurez-vous que 'name' est le bon champ
                    'isChecked' => false      // Par défaut, aucune tâche n'est cochée
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

            $now = (new DateTime())->format('Y-m-d');

            if ($action == "complete") {
                $end_date = $now;
                $state = "Terminée";
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


            // Construire le tableau de données pour l'insertion
            $taskData = [
                'id_account' => $idAccount,
                'name' => $name,
                'description' => $desc,
                'priority' => $priority,
                'deadline' => $date,
                'current_state' => $state,
                'start_date' => $start_date,
                'end_date' => $end_date
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

            $commentModel = new CommentModel();
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

            $blockList = $this->request->getPost("task_blockList");
            if (!empty($blockList)) {
                $taskDependenciesModel = new TaskDependenciesModel();

                $taskDependenciesModel->where("id_mother_task", $newId)->delete();

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
            if (!empty($isBlockedList)) {
                $taskDependenciesModel = new TaskDependenciesModel();

                $taskDependenciesModel->where("id_child_task", $newId)->delete();

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


            // Redirection après insertion/mise à jour
            return redirect()->to('/task/' . $newId);
        }
    }
}
