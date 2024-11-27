<?php

namespace App\Controllers;

use App\Models\TaskModel;
use DateTime;

class HomeController extends BaseController
{
    public function index()
    {
       $this->getTasks("home");
    }

    public function priority()
    {
        $this->getTasks("priority");
    }

    public function state()
    {
        $this->getTasks("state");
    }

    public function deadLine()
    {
        $this->getTasks("deadLine");
    }

    public function getTasks($type) 
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        helper('form');

        echo view('layout/header');
        echo view('layout/navbar');

        // Récupérer les filtres de la requête (GET ou POST)
        $date = $this->request->getGet('date') ?? (new DateTime())->modify('-7 days')->format('Y-m-d');
        $nb = $this->request->getGet('nb') ?? 7;
        $endDate = $this->request->getGet('end_date');
        $taskGroups = $this->request->getGet('task_groups') ?? null;
        $priority = $this->request->getGet('priority') ?? null;
        $states = $this->request->getGet('states') ?? [];

        $stateOptions = [
            'late' => 'En retard',
            'inProgress' => 'En cours',
            'notStarted' => 'Pas commencée',
            'finished' => 'Terminée',
            'blocked' => 'Bloquée'
        ];

        $statesFrench = array_filter(
            $states,
            fn($state) => isset($stateOptions[$state])
        );

        $translatedStates = array_map(
            fn($state) => $stateOptions[$state],
            $statesFrench
        );

        // Récupération de l'ID de l'utilisateur connecté
        $session = session();
        $id_account = $session->get('id');

        // Récupération des tâches filtrées
        $taskModel = new TaskModel();
        $tasks = [];

        if ($type === "home")
            $tasks = $taskModel->getTasksByDateRange($date, $nb, $id_account, $priority, $translatedStates);

        if ($type === "priority")
            $tasks = $taskModel->getTasksByPriority($id_account, $priority, $translatedStates);

        if ($type === "state")
            $tasks = $taskModel->getTasksByCurrentState($id_account, $priority, $translatedStates);

        if ($type === "deadLine")
            $tasks = $taskModel->getTasksByPriority($id_account, $priority, $translatedStates);


        // Passer les données à la vue
        echo view('pages/home/'.$type, [
            'tasks' => $tasks,
            'date' => $date,
            'nb' => $nb,
            'filters' => [
                'start_date' => $date,
                'end_date' => $endDate,
                'task_groups' => $taskGroups,
                'priority' => $priority,
                'states' => $states
            ]
        ]);
        echo view('layout/footer');
    }
}
