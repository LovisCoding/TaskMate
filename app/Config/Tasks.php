<?php

namespace Config;

use App\Models\AccountModel;
use App\Models\PreferencesModel;
use App\Models\TaskModel;
use CodeIgniter\Tasks\Config\Tasks as BaseTasks;
use CodeIgniter\Tasks\Scheduler;

class Tasks extends BaseTasks
{
	public bool $enabled = true;
	
    /**
     * Register any tasks within this method for the application.
     *
     * @param Scheduler $schedule
     */
    public function init(Scheduler $schedule)
    {
        $schedule->call(function() {

			$accountModel = new AccountModel();
			$taskModel = new TaskModel();
			$preferencesModel = new PreferencesModel();
			$accounts = $accountModel->getAllAccounts();
			$emailService = \Config\Services::email();
			$emailService->mailType = "html";
	
			foreach ($accounts as $account) {
	
				$pref = $preferencesModel->getPreferencesByIdAccount($account['id']);
				$days = 7;

				if ( $pref !== null ) $days = $pref['days_reminder_deadline'];

				$tasks = $taskModel->getTasksWhichAreNotTerminatedAndStartDays($account['id'], $days);
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
	
			$emailService->mailType = 'text';
		})->everyMinute();
	}
}