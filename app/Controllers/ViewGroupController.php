<?php

namespace App\Controllers;

class ViewGroupController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('pages/viewGroup');
        echo view('layout/footer');
    }
	public function create() {
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}

		$listTask = $this->request->getPost();
		$groupModel = new \App\Models\GroupModel();
		echo $groupModel->createGroupAndUpdateTasks(
			session()->get('id'), 
			$listTask['group_name'], 
			array_map('intval', 
			$listTask['task_ids']
			)
		);
		
	}
}
