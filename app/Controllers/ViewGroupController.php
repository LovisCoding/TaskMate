<?php

namespace App\Controllers;

class ViewGroupController extends BaseController
{
	public function index() 
	{
		echo view('layout/header');
		echo view('layout/navbar');
		echo view('pages/viewGroup');
		echo view('layout/footer') ;
	}
}
