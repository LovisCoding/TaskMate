<?php

namespace App\Controllers;
use App\Models\AccountModel;

class ConnectionController extends BaseController
{
	public function index()
	{
		helper(['form']);
		echo view('pages/connection');
	}

	public function register()
	{
		helper(['form']);
		echo view('pages/register');
	}

	public function connection()
	{
		$session = session();
		$userModel = new AccountModel();
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');
		$data = $userModel->where('email', $email)->first();
		if ($data) {
			$pass = $data['password'];
			$authenticatePassword = password_verify($password, $pass);
			if ($authenticatePassword) {
				$ses_data = [
					'id' => $data['id'],
					'name' => $data['name'],
					'email' => $data['email'],
				];
				$session->set($ses_data);
				return redirect()->to('/home');
			} else {
				$session->setFlashdata('msg', 'Mot de passe incorrect.');
				return redirect()->to('/');
			}
		} else {
			$session->setFlashdata('msg', 'Email existe pas.');
			return redirect()->to('/signin');
		}
	}

	public function deconnection()
	{

	}
}