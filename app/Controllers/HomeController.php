<?php

namespace App\Controllers;

use App\Models\TaskModel;
use DateTime;

class HomeController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

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

        // Récupérer tous les paramètres GET existants
        $existingParams = $this->request->getGet();

        // Paramètres par défaut ou nouveaux paramètres
        $date = $existingParams['date'] ?? (new DateTime())->modify('-7 days')->format('Y-m-d');
        $nb = $existingParams['nb'] ?? 7;
        $endDate = $existingParams['end_date'] ?? null;
        $taskGroups = $existingParams['task_groups'] ?? null;
        $priority = $existingParams['priority'] ?? null;
        $states = $existingParams['states'] ?? [];
        $sort = $existingParams['sort'] ?? 'deadline';
        $sortOrder = $existingParams['sort_order'] ?? 'asc';

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

        $tasks = match ($type) {
            'priority' => $taskModel->getTasksByPriority($id_account, $priority, $translatedStates, $sort, $sortOrder),
            'state' => $taskModel->getTasksByCurrentState($id_account, $priority, $translatedStates, $sort, $sortOrder),
            'deadLine' => $taskModel->getTasksByDeadline($date, $nb, $id_account, $priority, $translatedStates, $sort, $sortOrder),
            default => $taskModel->getTasksByDateRange($date, $nb, $id_account, $priority, $translatedStates, $sort, $sortOrder),
        };

        // Passer les données à la vue
        echo view('layout/header');
        echo view('layout/navbar');
        echo view('pages/home/' . ($type == 'deadLine' ? 'home' : $type), [
            'tasks' => $tasks,
            'date' => $date,
            'nb' => $nb,
            'filters' => [
                'start_date' => $date,
                'end_date' => $endDate,
                'task_groups' => $taskGroups,
                'priority' => $priority,
                'states' => $states,
                'sort' => $sort,
                'sortOrder' => $sortOrder
            ],
            'queryParams' => $existingParams
        ]);
        echo view('layout/footer');
    }
}
