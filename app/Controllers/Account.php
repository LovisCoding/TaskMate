<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Produit extends BaseController
{
	public function __construct()
	{
		//Chargement du helper Form
		helper(['form']);
	}
	public function index()
	{
		
		echo view('account/index');
	}
	public function save()
	{
		$isValid = $this->validate([
			'nom' => 'trim|required|min_length[3]|max_length[12]',
			'password' => 'trim|required|min_length[6]|max_length[20]',
			'password2' => 'trim|required|min_length[6]|max_length[20]|matches[password]',
			'age' => 'trim|required|integer|greater_than[18]|less_than[120]',
			'mail' => 'trim|required|min_length[6]|max_length[50]|valid_email',
			'site' => 'trim|required|min_length[6]|max_length[254]',
		]);
		if (!$isValid) {
			return view('produit/index', [
				'validation' => \Config\Services::validation()
			]);
		} else {
			$request = \Config\Services::request();
			$data['produit'] = $request->getPost();
			return view('produit/success', $data);
		}
	}
}
