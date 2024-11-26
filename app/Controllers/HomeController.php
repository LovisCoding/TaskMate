<?php

namespace App\Controllers;

use App\Models\TaskModel;

class HomeController extends BaseController
{
	public function index() : void
	{
		echo view('layout/header');
		echo view('layout/navbar');

		$dateStart = $this->request->getPost('dateStart') ?? '2024-11-27';
		$days = $this->request->getPost('days') ?? 7;

		$session = session();
		$id_account = $session->get("id");
		$taskModel = new TaskModel();
		$tasks = $taskModel->getTasksByDateRange($dateStart, $days, $id_account);

		// $tasks = $taskModel->getTasksByPriority($id_account);

		// $tasks = $taskModel->getTasksByCurrentState($id_account);

		// $tasks = $taskModel->getTasksByDeadline($dateStart, $days, $id_account);


		//var_dump($tasks);
		echo view('pages/home/home', ['tasks' => $tasks]);
		echo view('layout/footer') ;
	}
}
