<?php

namespace App\Controllers;
use App\Models\AccountModel;

class ConnectionController extends BaseController
{
	public function index()
	{
		if (session()->get("isLoggedIn")) {
			return redirect()->to('/home/recap');
		}

		helper(['form']);

		$data = [
			'success' => session()->getFlashdata('success'),
			'error' => session()->getFlashdata('error'),
		];

		echo view('pages/connection', $data);
	}

	public function register()
	{
		if (session()->get("isLoggedIn")) {
			redirect()->to('/home/recap');
		}

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

		if ($data) {
			$pass = $data['password'];
			$authenticatePassword = password_verify($password, $pass);

			if ($authenticatePassword) {
				$ses_data = [
					'id' => $data['id'],
					'name' => $data['name'],
					'email' => $data['email'],
					'isLoggedIn' => true,
				];
				$session->set($ses_data);
				return redirect()->to('/home/recap');
			} else {
				$session->setFlashdata('error', 'Ce mot de passe est incorrect.');
				return redirect()->to('/');
			}
		} else {
			$session->setFlashdata('error', 'Cet email n\'existe pas.');
			return redirect()->to('/');
		}
	}
}