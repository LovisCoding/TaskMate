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

	public function forgotPassword()
	{
		helper(['form']);
		echo view('pages/forgotPassword');
	}

	public function resetPassword()
	{
		helper(['form']);
		$token = $this->request->getGet('token');
		$data = ['token' => $token];
		echo view('pages/resetPassword', $data);
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

			$resetLink = site_url("reset-password/$token");
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
}
