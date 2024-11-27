<?php

namespace App\Controllers;

use DateTime;

class Task extends BaseController
{
	public function index() : void
	{
		$date = $this->request->getGet('date');
		$dateI = new DateTime($date);
		helper("form");

		echo view('layout/header');
		echo view('layout/navbar');
		echo view('pages/task', [ 'date' => $dateI ]); 
		echo view('layout/footer') ;
	}
}