<?php

namespace App\Controllers;

class ProfilController extends BaseController
{
	public function index() : void
	{
		echo view('layout/header');
		echo view('layout/navbar');
		echo view('pages/profil'); 
		echo view('layout/footer') ;
	}
}