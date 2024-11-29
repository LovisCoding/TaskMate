<?php

namespace App\Controllers;


use App\Models\CommentModel;
use App\Models\TaskDependenciesModel;
use App\Models\TaskModel;
use App\Models\PreferencesModel;
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
        $idAccount = intval(session()->get("id"));

        if (!$idAccount) {
            return redirect()->to('/');
        }

        if (!$session->get("tasksConcentration")) {
            $tasksConcentration = $taskModel->getTasksConcentration();
        } else {
            $tasksConcentration = $session->get("tasksConcentration");
        }

        $commentaries = [];

        $preferencesModel = new PreferencesModel();
        $preferences = $preferencesModel->getPreferencesByIdAccount($idAccount);
        $perPage =  (int)$preferences['rows_per_page'];

        $currentPage = $this->request->getVar('page') ?? 1;

        $now = (new DateTime())->format('Y-m-d');

        if (count($tasksConcentration) == 0) {
            $session->remove("tasksConcentration");
            return redirect()->to('/home/recap');
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

            $commentaries = array_map(function ($comment) {
                return [
                    'id' => $comment['id'],
                    'comment' => $comment['comment'] 
                ];
            }, $commentaries);

            $title = $task["name"];
            $description = $task["description"];
            $priority = $task["priority"];
            $state = $task["current_state"];
        } else {
            $session->remove("tasksConcentration");
            return redirect()->to('/home/recap');
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

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('pages/concentration/concentrationPage', ['data' => $data]);
        echo view('layout/footer');
    }

    public function validateConcentration()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $taskModel = new TaskModel();
        $tasksConcentration = [];

        $session = session();
        $idAccount = intval(session()->get("id"));

        if (!$idAccount) {
            return redirect()->to('/');
        }

        if (!$session->get("tasksConcentration")) {
            $tasksConcentration = $taskModel->getTasksConcentration();
        } else {
            $tasksConcentration = $session->get("tasksConcentration");
        }


        $action = $this->request->getPost("action");
        $now = (new DateTime())->format('Y-m-d');

        if ($action == "complete" || $action == "ignore") {
            $task = array_shift($tasksConcentration);

            if ($action == "complete") {
                $taskModel->update($task["id_task"], [
                    "end_date" => $now,
                    "current_state" => "Terminée"
                ]);
            } else if ($action == "ignore") {
                $taskModel->update($task["id_task"], [
                    "start_date" => null,
                    "current_state" => "Pas commencée"
                ]);
            }
        }

        $session->remove("tasksConcentration");
        $session->set("tasksConcentration", $tasksConcentration);

        return redirect()->to('/concentration');
    }
}
