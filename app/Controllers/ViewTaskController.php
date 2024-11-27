<?php

namespace App\Controllers;

class ViewTaskController extends BaseController
{
	public function index() : void
	{
		echo view('layout/header');
		echo view('layout/navbar');
		echo view('pages/viewTask/viewTask');
		echo view('layout/footer') ;
	}
}
