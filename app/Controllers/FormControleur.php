<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FormControleur extends BaseController
{
	public function __construct()
	{
		//Chargement du helper Form
		helper(['form']); 	
		
	}
	public function index()
	{
		echo view('formulaire');
	}
	public function traitement()
	{
		// Charger la bibliothèque de validation
		$validation = \Config\Services::validation();
		$donnees = [
			'identifiant' => 'required|min_length[3]|max_length[20]',
			'email' => 'required|valid_email',
		];
		if ($this->validate($donnees)) {
			// Les données du formulaire sont valides, vous pouvez les traiter ici.
			echo 'Formulaire soumis avec succès!';
		} else {
			// Afficher à nouveau le formulaire avec les erreurs de validation.
			echo view('formulaire');
		}
	}
}
