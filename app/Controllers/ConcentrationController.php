<?php

namespace App\Controllers;


use App\Models\CommentModel;
use App\Models\TaskDependenciesModel;
use App\Models\TaskModel;
use DateTime;

class ConcentrationController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $idTask = "15";

        $date = null;
        $taskModel = new TaskModel();

        $title = "Titre de la tâche";
        $description = "Description de la tâche";
        $priority = 2;
        $state = "Pas commencée";

        $commentaries = [];
        $blockList = [];
        $isBlockedList = [];

        $perPage = 3;
        $currentPage = $this->request->getVar('page') ?? 1;

        $task = $taskModel->where("id_task", $idTask)->first();


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
            'pager' => $commentModel->getPaginatedByTask($perPage, $idTask)
        ];

        $data = [
            'id' => $idTask,
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'date' => $dateI,
            'state' => $state,
            'commentaires' => $comments,
            'blockList' => $blockList,
            'isBlockedList' => $isBlockedList,
            'pager' => $commentModel->pager
        ];

        // helper(['form']);

        // $data = [
        //     'success' => session()->getFlashdata('success'),
        //     'error' => session()->getFlashdata('error'),
        // ];

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('pages/concentration/concentrationPage', ['data' => $data]);
        echo view('layout/footer');
    }

    public function validateConcentration() {

        echo "Donova mon amoureux <3";

    }
}
