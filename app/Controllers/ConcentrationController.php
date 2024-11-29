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

        $taskModel = new TaskModel();

        $tasksConcentration = [];
        $session = session();

        if (!$session->get("tasksConcentration")) {
            $tasksConcentration = $taskModel->getTasksConcentration();
        }
        else {
            $tasksConcentration = $session->get("tasksConcentration");
        }

        $commentaries = [];

        $perPage = 2;
        $currentPage = $this->request->getVar('page') ?? 1;

        $action = $this->request->getGet("action");
        $now = (new DateTime())->format('Y-m-d');

        if ($action == "complete" || $action == "ignore") {
            $task = array_shift($tasksConcentration);

            if ($action == "complete") {
                $taskModel->update($task["id_task"], [
                    "end_date" => $now,
                    "current_state" => "Terminée"
                ]);
            }
            else if ($action == "ignore") {
                $taskModel->update($task["id_task"], [
                    "start_date" => null,
                    "current_state" => "Pas commencée"
                ]);
            }

            if (count($tasksConcentration) == 0) {
                $session->remove("tasksConcentration");
                return redirect()->to('/home/recap');
    
            }
        }

        
        $task = $tasksConcentration[0]; 

        $commentModel = new CommentModel();

        if ($task) {
            $idTask = $task['id_task'];

            $taskModel->update($idTask, [
                "current_state" => "En cours",
                "start_date" => $now
            ]);

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



            $title = $task["name"];
            $description = $task["description"];
            $priority = $task["priority"];
            $state = $task["current_state"];
        } else {
            if ($action == 'complete' || $action == 'ignore') {
                $session->remove("tasksConcentration");
                // Pas de tâches dispo
                return redirect()->to('/home/recap');  
            }


        }

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
            'state' => $state,
            'commentaires' => $comments,
            'pager' => $commentModel->pager
        ];

        $session->remove("tasksConcentration");
        $session->set("tasksConcentration", $tasksConcentration);

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
