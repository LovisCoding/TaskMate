<?php

namespace App\Controllers;

use App\Models\TaskDependenciesModel;
use App\Models\TaskModel;
use DateTime;

class HomeController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        echo view('layout/header');
        echo view('layout/navbar');

        $date = $this->request->getGet('date') ?? (new DateTime())->format('Y-m-d');
        $nb = $this->request->getGet('nb') ?? 7;

		$session = session();
		$id_account = $session->get("id");
		$taskModel = new TaskModel();
		$tasks = $taskModel->getTasksByDateRange($date, $nb, $id_account);

		// $tasks = $taskModel->getTasksByPriority($id_account);

		// $tasks = $taskModel->getTasksByCurrentState($id_account);

		// $tasks = $taskModel->getTasksByDeadline($dateStart, $days, $id_account);

        // $taskDependenciesModel = new TaskDependenciesModel();
        // $tasks = $taskDependenciesModel->getPossibleTasksToBeBlockedBy(6);

        echo view('pages/home/home', ['tasks' => $tasks, 'date' => $date, "nb" => $nb]);
        echo view('layout/footer') ;
    }
}
