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
        $date = null;
        $taskModel = new TaskModel();

        $title = "Titre de la tâche";
        $description = "Description de la tâche";
        $priority = 2;
        $state = "Pas commencée";

        $commentaries = [];
        $blockList = [];
        $isBlockedList = [];

        $perPage = 3    ;
        $currentPage = $this->request->getVar('page') ?? 1;

        $task = $taskModel->where("id_task", $idTask)->first();

        if ($idTask != -1 && !$task) {
            return redirect()->to('/home/recap');
        }

        if ($task) {
            $date = $task["deadline"];
            $commentModel = new CommentModel();
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




            $tasks = $taskModel->findAll();
            $taskDependenciesModel = new TaskDependenciesModel();
            // Obtenez tous les `id_child_task` pour ce `id_mother_task`.
            $childTasks = $taskDependenciesModel
                ->where('id_mother_task', $idTask)
                ->findColumn('id_child_task') ?? []; // Retourne un tableau vide si aucun résultat.

            if ($childTasks) {
                $blockList = array_map(function ($task) use ($childTasks) {
                    return [
                        'id' => $task['id_task'],
                        'name' => $task['name'],
                        'isChecked' => in_array($task['id_task'], $childTasks) // `true` si présent dans les dépendances.
                    ];
                }, $tasks);
            }


            $motherTasks = $taskDependenciesModel
                ->where('id_child_task', $idTask)
                ->findColumn('id_mother_task');

            if ($motherTasks) {
                $isBlockedList = array_map(function ($task) use ($motherTasks) {
                    return [
                        'id' => $task['id_task'],
                        'name' => $task['name'],
                        'isChecked' => in_array($task['id_task'], $motherTasks) // `true` si présent dans les dépendances
                    ];
                }, $tasks);
            }
            $title = $task["name"];
            $description = $task["description"];
            $priority = $task["priority"];
            $state = $task["current_state"];
        } else {
            $date = $this->request->getGet('date');
        }

        if (!$blockList) {
            $tasks = $taskModel->findAll();
            $blockList = array_map(function ($task) {
                return [
                    'id' => $task['id_task'], // Remplacez 'id_task' par la clé réelle correspondant à l'identifiant dans votre base de données
                    'name' => $task['name'],  // Remplacez 'name' par la clé réelle correspondant au nom de la tâche
                    'isChecked' => false
                ];
            }, $tasks);
        }

        if (!$isBlockedList) {
            $tasks = $taskModel->findAll();
            $isBlockedList = array_map(function ($task) {
                return [
                    'id' => $task['id_task'], // Remplacez 'id_task' par la clé réelle correspondant à l'identifiant dans votre base de données
                    'name' => $task['name'],  // Remplacez 'name' par la clé réelle correspondant au nom de la tâche
                    'isChecked' => false
                ];
            }, $tasks);
        }

        $dateI = new DateTime($date);
        helper("form");

        $comments = [
            'items' => $commentaries,
            'pager' => $commentModel->getPaginatedByTask($perPage, $idTask),
        ];

        $data = [
            'id' => $idTask,
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'date' => $dateI,
            'state' => $state,
            'commentaries' => $comments,
            'blockList' => $blockList,
            'isBlockedList' => $isBlockedList
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
            return redirect()->to('/home/recap')->with('success', 'Tâche supprimée avec succès.');
        } else {
            // Récupérer les données du formulaire
            $name = $this->request->getPost('task_name');
            $desc = $this->request->getPost('task_desc');
            $priority = $this->request->getPost('task_priority');
            $date = $this->request->getPost('task_date');
            $state = $this->request->getPost('task_state');
            $start_date = null;
            $end_date = null;

            $now = (new DateTime())->format('Y-m-d');

            if ($action == "complete") {
                $end_date = $now;
                $state = "Terminée";
            }

            if ($action == "start") {
                $start_date = $now;
                $state = "En cours";
            }

            $idAccount = intval(session()->get("id"));

            // Validation des données (facultatif)
            if (empty($name) || empty($desc) || empty($priority) || empty($date) || empty($state) || empty($idAccount)) {
                return redirect()->back()->with('error', 'Tous les champs sont obligatoires.');
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
                    return redirect()->back()->with('error', 'Erreur lors de l\'ajout de la tâche.');
                }
            } else {
                // Cas d'une mise à jour
                $taskModel->update($id, $taskData);
            }

            // Gestion des commentaires, blockList, etc. (si nécessaires)
            // $commentaries = $this->request->getPost('task_commentaries');
            // var_dump($commentaries);    
            // if (!empty($commentaries)) {
            //     $commentModel = new CommentModel();
            //     foreach ($commentaries as $comment) {
            //         $commentModel->insert([
            //             'id_task' => $taskId ?? $id,
            //             'comment' => $comment
            //         ]);
            //     }
            // }

            $blockList = $this->request->getPost("task_blockList");
            if (!empty($blockList)) {
                $newId = $taskId ?? $id;

                $taskDependenciesModel = new TaskDependenciesModel();

                // $taskDependenciesModel->where("id_mother_task", $newId)->delete();

                foreach ($blockList as $taskBlockId) {

                    if ($newId && $taskBlockId) {
                        $data = [
                            'id_mother_task' => $newId,
                            'id_child_task' => $taskBlockId
                        ];
                        var_dump($data);
                        $taskDependenciesModel->insert($data);
                    };
                }
            }


            // Redirection après insertion/mise à jour
            // return redirect()->to('/task/' . $newId)->with('success', 'Tâche sauvegardée avec succès.');
        }
    }
}
