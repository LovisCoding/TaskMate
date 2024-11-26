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

        helper('form');

        echo view('layout/header');
        echo view('layout/navbar');

        // Récupérer les filtres de la requête (GET ou POST)
        $date = $this->request->getGet('start_date') ?? (new DateTime())->format('Y-m-d');
        $endDate = $this->request->getGet('end_date');
        $taskGroups = $this->request->getGet('task_groups') ?? null;
        $priority = $this->request->getGet('priority') ?? null;
        $states = $this->request->getGet('states') ?? [];


        // Gestion des états sous forme de tableau (plusieurs cases à cocher possibles)
        $states = $this->request->getGet('states') ?? [];

        // Nombre de jours pour les tâches (calculé à partir des dates si disponible)
        $nb = $endDate 
            ? (new DateTime($endDate))->diff(new DateTime($date))->days + 1 
            : 7;

        // Récupération de l'ID de l'utilisateur connecté
        $session = session();
        $id_account = $session->get('id');

        // Récupération des tâches filtrées
        $taskModel = new TaskModel();
        $tasks = $taskModel->getTasksByDateRange($date, $nb, $id_account, $priority, $states);

        // Passer les données à la vue
        echo view('pages/home/home', [
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
