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

	// TODO
	public function sendResetLink()
	{
		$email = $this->request->getPost('email');
		$userModel = new AccountModel();
		$user = $userModel->where('email', $email)->first();

		$email = $this->request->getPost('email');
		echo 'Adresse e-mail soumise : ' . $email;
		if ($user) {

			$token = bin2hex(random_bytes(16));
			$expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
			$userModel->set('reset_token', $token)
				->set('reset_token_expiration', $expiration)
				->update($user['id']);

			$resetLink = site_url("/forgot-password/reset-password/$token");
			$message = "Cliquez sur le lien suivant pour réinitialiser MDP: $resetLink";

			$emailService = \Config\Services::email();

			$from = 'mail.taskmate@gmail.com';

			$emailService->setTo($email);
			$emailService->setFrom($from);
			$emailService->setSubject('Réinitialisation de mot de passe');
			$emailService->setMessage($message);
			if ($emailService->send()) {
				echo ' E-mail envoyé avec succès.';
			} else {
				echo $emailService->printDebugger();
			}
		} else {
			echo ' Adresse e-mail non valide.';
		}
	}

	public function resetPassword($token) {
		echo "Donova: ".$token."\n";

	}

	public function updatePassword() {
		$token = $this->request->getPost('token');
		$password = $this->request->getPost('password');
		$confirmPassword = $this->request->getPost('confirm_password');

		$userModel = new AccountModel();
		$user = $userModel->where('reset_token', $token)
			->where('reset_token_expiration >', date('Y-m-d H:i:s'))
			->first();
		if ($user && $password === $confirmPassword) {

			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			$userModel->set('password', $hashedPassword)
				->set('reset_token', null)
				->set('reset_token_expiration', null)
				->update($user['id']);

			session()->setFlashdata('msg', [
				'text' => 'Mot de passe réinitialisé avec succès.',
				'class' => 'alert alert-success'
			]);
			return redirect()->to('/');
		} else {
			session()->setFlashdata('msg', 'Erreur lors de la réinitialisation du mot de passe.');
			return redirect()->back();
		}
	}

}
