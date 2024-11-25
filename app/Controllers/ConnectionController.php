<?php

namespace App\Controllers;
use App\Models\AccountModel;

class ConnectionController extends BaseController
{
	public function index()
	{
		helper(['form']);
	
		$data = [
			'success' => session()->getFlashdata('success'),
			'error' => session()->getFlashdata('error'),
		];
	
		echo view('pages/connection', $data);
	}
	

	public function register()
	{
		helper(['form']);
		
		$data = [
			'success' => session()->getFlashdata('success'),
			'error' => session()->getFlashdata('error'),
		];
	
		echo view('pages/register', $data);
	}
	

	public function forgotPassword()
	{
		helper(['form']);
		echo view('pages/forgotPassword');
	}



	public function connection()
	{
		$session = session();
		$userModel = new AccountModel();
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');
		$data = $userModel->getAccountByEmail($email);
		var_dump($data);
		if ($data) {
			$pass = $data['password'];
			echo $pass;
			echo $password;
			$authenticatePassword = password_verify($password, $pass);
			echo $authenticatePassword;
			if ($authenticatePassword) {
				$ses_data = [
					'id' => $data['id'],
					'name' => $data['name'],
					'email' => $data['email'],
				];
				$session->set($ses_data);
				return redirect()->to('/home');
			} else {
				$session->setFlashdata('msg', 'Ce mot de passe est incorrect.');
				return redirect()->to('/');
			}
		} else {
			$session->setFlashdata('msg', 'Cet email n\'existe pas.');
			return redirect()->to('/');
		}
	}

	public function deconnection()
	{

	}

	

}
