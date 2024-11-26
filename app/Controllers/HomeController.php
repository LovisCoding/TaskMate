<?php

namespace App\Controllers;

use App\Models\TaskModel;
use DateTime;

class HomeController extends BaseController
{
	public function index() : void
	{
		echo view('layout/header');
		echo view('layout/navbar');

		$date = $this->request->getGet('date') ?? new DateTime();
		$nb = $this->request->getGet('nb') ?? 4;

		$session = session();
		$id_account = $session->get("id");
		$taskModel = new TaskModel();
		$tasks = $taskModel->getTasksByDateRange($date, $nb, $id_account);

		// $tasks = $taskModel->getTasksByPriority($id_account);

		// $tasks = $taskModel->getTasksByCurrentState($id_account);

		// $tasks = $taskModel->getTasksByDeadline($dateStart, $days, $id_account);


		//var_dump($tasks);
		echo view('pages/home/home', ['tasks' => $tasks, 'date' => $date, 'nb' => $nb]);
		echo view('layout/footer') ;
	}
}
