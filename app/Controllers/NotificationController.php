<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\TaskModel;

class NotificationController extends BaseController{

	public function __construct() {
        if ($this->request->getIPAddress() !== "127.0.0.1") {
            return redirect()->to('/')->with('error', 'Access denied. This controller is accessible only from localhost.');
        }
	}

	public function index()
	{
		
		$accountModel = new AccountModel();
		$taskModel = new TaskModel();
		$accounts = $accountModel->getAllAccounts();

		foreach ($accounts as $account) {

			$emailService = \Config\Services::email();

			$tasks = $taskModel->getTasksWhichAreNotTerminated($account['id']);
			$data = [];
			foreach ($tasks as $task) {
				$data[$task['deadline']][] = $task['name'];
			}
	
			$from = 'mail.taskmate@gmail.com';
			$email = $account['email'];
			$message = view('email/Notification', [ 'data' => $data ]);
	
			$emailService->setTo($email);
			$emailService->setFrom($from);
			$emailService->setSubject('Vous avez des tâches en retard !');
			$emailService->setMessage($message);
			$emailService->send();

		}

	}
}