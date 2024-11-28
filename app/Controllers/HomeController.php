<?php

namespace App\Controllers;

use App\Models\TaskModel;
use DateTime;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HomeController extends BaseController
{
	public function index()
	{
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}

		$this->getTasks("home");
	}

	// composer require phpoffice/phpspreadsheet
	public function exportData()
	{
		$exportType = $this->request->getPost('exportType');
		$data = $this->request->getPost('tasks[]');


		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$filename = "";

		if ($exportType == 'recap' || $exportType == 'deadLine') {

			if ($exportType == 'recap') $filename = 'Taches_Recapitulatif.xlsx';
			if ($exportType == 'deadLine') $filename = 'Taches_par_Echeance.xlsx';

			$sheet->setCellValue('A1', 'Date');
			$sheet->setCellValue('B1', 'ID Task');
			$sheet->setCellValue('C1', 'Nom');
			$sheet->setCellValue('D1', 'Description');
			$sheet->setCellValue('E1', 'Priorité');
			$sheet->setCellValue('F1', 'État actuel');

			$row = 2;

			foreach ($data as $date => $taskList) {
				$sheet->setCellValue('A' . $row, $date);
				foreach ($taskList as $task) {
					$sheet->setCellValue('B' . $row, $task['id_task']);
					$sheet->setCellValue('C' . $row, $task['name']);
					$sheet->setCellValue('D' . $row, $task['description']);
					$sheet->setCellValue('E' . $row, $task['priority'] . '/4');
					$sheet->setCellValue('F' . $row, $task['current_state']);
					$row++;
				}
			}
		} else if ($exportType == 'priority' || $exportType == 'state') {
			
			if ($exportType == 'priority') {
				$sheetTitle = 'Tâches de priorité ';
				$filename = 'Taches_par_Priorité.xlsx';
			} else {
				$sheetTitle = 'Tâches d\'état ';
				$filename = 'Taches_par_Etat.xlsx';
			}

			$spreadsheet = new Spreadsheet();

			foreach ($data as $key => $tasks) {
				$sheet = $spreadsheet->createSheet();
			   
				$sheet->setTitle($sheetTitle . $key);

				$sheet->setCellValue('A1', 'Name');
				$sheet->setCellValue('B1', 'Description');
				$sheet->setCellValue('C1', 'Priority');
				$sheet->setCellValue('D1', 'Current State');
				$sheet->setCellValue('E1', 'ID Task');

				$row = 2;
				foreach ($tasks as $task) {
					$sheet->setCellValue('A' . $row, $task['name']);
					$sheet->setCellValue('B' . $row, $task['description']);
					$sheet->setCellValue('C' . $row, $task['priority']);
					$sheet->setCellValue('D' . $row, $task['current_state']);
					$sheet->setCellValue('E' . $row, $task['id_task']);
					$row++;
				}
			}

			$spreadsheet->removeSheetByIndex(0); // deletes default sheet created on init
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		header('Content-Type: text/html; charset=UTF-8');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');
		exit;
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
		$perPage = 5;
		$page = $existingParams['page'] ?? 1;

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
			'priority' => $taskModel->getTasksByPriority($id_account, $priority, $translatedStates, $sort, $sortOrder, $perPage, $page),
			'state' => $taskModel->getTasksByCurrentState($id_account, $priority, $translatedStates, $sort, $sortOrder),
			'deadLine' => $taskModel->getTasksByDeadline($date, $nb, $id_account, $priority, $translatedStates, $sort, $sortOrder),
			default => $taskModel->getTasksByDateRange($date, $nb, $id_account, $priority, $translatedStates, $sort, $sortOrder),
		};

		// foreach ($tasks as $date => $subTasks) {
		// 	if (is_array($subTasks)) {
		// 		// Appliquer la pagination sur chaque sous-tableau de tâches
		// 		$tasks[$date] = array_slice($subTasks, ($page - 1) * $perPage, $perPage);
		// 	}
		// }

		// Passer les données à la vue
		echo view('layout/header');
		echo view('layout/navbar');
		echo view('pages/home/' . ($type == 'deadLine' ? 'home' : $type), [
			'tasks' => $tasks,
			'date' => $date,
			'nb' => $nb,
			'pager' => $taskModel->pager,
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
