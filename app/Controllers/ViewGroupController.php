<?php

namespace App\Controllers;

use App\Models\GroupModel;
use App\Models\TaskModel;

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
	public function create()
	{
		if (!session()->get('isLoggedIn')) {
			return redirect()->to('/');
		}

		$groupModel = new GroupModel();

		$idAccount = intval(session()->get("id"));

		$groupList = $this->request->getPost();

		$groupName = $groupList['group_name'];
		$tasksList = $groupList['task'];

		if (empty($idAccount) || empty($groupName) || empty($tasksList)) {
			return redirect()->to('/home/recap');
		}

		$groupModel->createGroupAndUpdateTasks($idAccount, $groupName, $tasksList);
		return redirect()->to('/home/recap');
	}
}