<?php

namespace App\Controllers;

use App\Models\GroupModel;
use App\Models\TaskModel;
use App\Models\PreferencesModel;
use DateTime;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class HomeController extends BaseController
{

	public function choicePage() {
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}

		$type = session()->get("homePage");

		if ($type) {
			return redirect()->to('/home/'.$type);
		}
		else {
			return redirect()->to('/home/recap');
		}
	}

	public function index()
	{
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}

		$this->getTasks("home");
	}

	public function priority()
	{
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}

		$this->getTasks("priority");
	}

	public function state()
	{
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}

		$this->getTasks("state");
	}

	public function deadLine()
	{
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}

		$this->getTasks("deadLine");
	}

	public function groups()
	{
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}

		$this->getTasks("groups");
	}

	public function getTasks($type)
	{
		session()->remove("homePage");

		if ($type == "home")
			session()->set("homePage", "recap");
		else 
			session()->set("homePage", $type);

		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}

		helper('form');

		// Récupérer tous les paramètres GET existants
		$existingParams = $this->request->getGet();

		// Paramètres par défaut ou nouveaux paramètres
		$dateRange = (new DateTime())->modify('-6 days')->format('Y-m-d');
		if ($type == "deadLine") {
			$dateRange = (new DateTime())->format('Y-m-d'); 
		}

		$defaultStates = ["blocked", "inProgress", "notStarted", "finished"];
		$date = $existingParams['date'] ?? $dateRange;
		$page = $this->request->getGet('page') ?? 1;

		$filters = session()->get("filters");

		if ($filters && count($this->request->getGet()) == 0) {
			$priority = $existingParams['priority'] ?? $filters["priority"];
			$states = $existingParams['states'] ?? $filters['states'];
			$sort = $existingParams['sort'] ?? $filters['sort'];
			$sortOrder = $existingParams['sort_order'] ?? $filters['sort_order'];
		}
		else {
			$priority =  $existingParams['priority'] ?? null;
			$states = $existingParams['states'] ?? $defaultStates;
			$sort = $existingParams['sort'] ?? 'deadline';
			$sortOrder = $existingParams['sort_order'] ?? 'asc';
		}

		$filters = [
			"priority" => $priority,
			"states" => $states,
			"sort" => $sort,
			"sort_order" => $sortOrder
		];
		session()->set("filters", $filters);

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

		// Récupération des préférences
		$preferencesModel = new PreferencesModel();
		$preferences = $preferencesModel->getPreferencesByIdAccount($id_account);
		$nb = $preferences['displayed_days_in_calendar'];
		$perPage =  (int)$preferences['rows_per_page'];
		
		$tasks = match ($type) {
			'priority' => $taskModel->getTasksByPriority($id_account, $priority, $translatedStates, $sort, $sortOrder, $perPage, $page),
			'state' => $taskModel->getTasksByCurrentState($id_account, $priority, $translatedStates, $sort, $sortOrder, $perPage, $page),
			'deadLine' => $taskModel->getTasksByDeadline($date, $nb, $id_account, $priority, $translatedStates, $sort, $sortOrder),
			'groups' => $taskModel->getTasksByGroupName($id_account, $priority, $translatedStates, $sort, $sortOrder, $perPage, $page),
			default => $taskModel->getTasksByDateRange($date, $nb, $id_account, $priority, $translatedStates, $sort, $sortOrder),
		};

		$pager = \Config\Services::pager();


		// Passer les données à la vue
		echo view('layout/header');
		echo view('layout/navbar');
		echo view('pages/home/' . ($type == 'deadLine' ? 'home' : $type), [
			'tasks' => $tasks,
			'date' => $date,
			'nb' => $nb,
			'pager' => $pager,
			'filters' => [
				'start_date' => $date,
				'priority' => $priority,
				'states' => $states,
				'sort' => $sort,
				'sortOrder' => $sortOrder
			],
			'queryParams' => $existingParams,
			'preferences' => $preferences,
		]);
		echo view('layout/footer');
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

			if ($exportType == 'recap') {
				$sheetTitle = 'Recapitulatif des tâches ';
				$filename = 'Taches_Recapitulatif.xlsx';
			} else { // $exportType == 'deadLine'
				$sheetTitle = 'Tâches par Echeance ';
				$filename = 'Taches_par_Echeance.xlsx';
			}

			$sheet = $spreadsheet->createSheet();
			$sheet->setTitle($sheetTitle);

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

			$spreadsheet->removeSheetByIndex(0); // deletes default sheet created on init

		} else if ($exportType == 'priority' || $exportType == 'state') {

			if ($exportType == 'priority') {
				$sheetTitle = 'Tâches de priorité ';
				$filename = 'Taches_par_Priorité.xlsx';
			} else {
				$sheetTitle = 'Tâches d\'état ';
				$filename = 'Taches_par_Etat.xlsx';
			}

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
				foreach (range('A', 'F') as $columnID) {
					$sheet->getColumnDimension($columnID)->setAutoSize(true);
				}
			}

			$spreadsheet->removeSheetByIndex(0); // deletes default sheet created on init

		} else if ($exportType == 'groups') {

			$sheetTitle = 'Tâches par Groupe';
			$filename = 'Taches_par_Groupe.xlsx';

			$sheet = $spreadsheet->createSheet();
			$sheet->setTitle($sheetTitle);

			$sheet->setCellValue('A1', 'Groupe');
			$sheet->setCellValue('B1', 'ID Tache');
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

			$spreadsheet->removeSheetByIndex(0); // deletes default sheet created on init

		}

		foreach (range('A', 'F') as $columnID) {
			$sheet->getColumnDimension($columnID)->setAutoSize(true);
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		header('Content-Type: text/html; charset=UTF-8');

		$writer = new Xlsx($spreadsheet);

		$writer->save('php://output');
		exit;
	}
}
