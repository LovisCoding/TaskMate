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
		
		echo view('produit/index');
	}
	public function save()
	{
		$isValid = $this->validate([
			'nom' => 'trim|required|min_length[3]|max_length[12]',
			'categ' => 'trim|required|min_length[3]|max_length[12]',
			'prix' => 'trim|required|integer|greater_than[18]|less_than[120]',
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
