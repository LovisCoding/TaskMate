<?php

namespace App\Controllers;

use DateTime;
use App\Models\AccountModel;

class EmailController extends BaseController
{
	public function sendConfirmAccountMail()
	{

		// Définir les règles de validation
		$rules = [
			'name' => 'required|min_length[3]',
			'email' => 'required|valid_email',
			'password' => 'required|min_length[8]',
			'confirm_password' => 'required|matches[password]',
		];

		
		// Valider les données envoyées par le formulaire
		if (!$this->validate($rules)) {
			return redirect()->to('/auth/register')
				->withInput() // Pour conserver les valeurs déjà saisies
				->with('validation', $this->validator); // Passer les erreurs de validation
		}
		$name = $this->request->getPost('name');
		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');
		$email = $this->request->getPost('email');

		
		$accountModel = new AccountModel();
		$existingUser = $accountModel->getAccountByEmail($email);

		if ($existingUser) {
			return redirect()->to('/auth/register')->with('error', 'Un compte existe déjà avec cette adresse email.');
		}
		// Générer un token unique
		$token = bin2hex(random_bytes(16));

		// Sauvegarder temporairement les données dans la session
		session()->set("registration_$token", [
			'name' => $name,
			'email' => $email,
			'password' => password_hash($password, PASSWORD_BCRYPT),
		]);

		// Préparer et envoyer l'email
		$confirmAccountLink = site_url("email/confirmAccount/$token");
		$emailService = \Config\Services::email();
		$emailService->setTo($email);
		$emailService->setFrom('mail.taskmate@gmail.com', 'TaskMate');
		$emailService->setSubject('Création de votre compte TaskMate !');
		$emailService->setMessage("
			Bonjour $name,
			
			Merci de vous être inscrit à TaskMate.
			Pour activer votre compte, cliquez sur le lien suivant :
			$confirmAccountLink
			
			Si vous n'avez pas créé de compte, ignorez cet email.
			
			Cordialement,
			L'équipe TaskMate
		");

		if ($emailService->send()) {
			return redirect()->to('/auth/register')->with('success', 'Un email de confirmation a été envoyé. Veuillez vérifier votre boîte de réception.');
		} else {
			return redirect()->to('/auth/register')->with('error', 'Échec de l\'envoi de l\'email. Veuillez réessayer.');
		}
	}

	public function confirmAccount($token)
	{
		$registrationData = session()->get("registration_$token");

		if (!$registrationData) {
			return redirect()->to('/auth/register')->with('error', 'Lien invalide ou expiré.');
		}

		// Enregistrer les données dans la base de données
		$accountModel = new AccountModel();
		$accountModel->createAccount($registrationData);

		session()->remove("registration_$token");

		return redirect()->to('/')->with('success', 'Votre compte a bien été créé. Vous pouvez maintenant vous connecter.');
	}

	public function sendResetLink()
	{
		$email = $this->request->getPost('email');
		$userModel = new AccountModel();
		$user = $userModel->getAccountByEmail($email);

		$email = $this->request->getPost('email');
		if ($user) {

			$token = bin2hex(random_bytes(16));
			session()->set("updatePassword_$token", $token);

			$expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

			$userModel->set('reset_token', $token)
				->set('reset_token_expiration', $expiration)
				->update($user['id']);

			$resetLink = site_url("/forgot-password/reset-password/$token");
			$message = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe: $resetLink";

			$emailService = \Config\Services::email();

			$from = 'mail.taskmate@gmail.com';

			$emailService->setTo($email);
			$emailService->setFrom($from, 'TaskMate');
			$emailService->setSubject('Réinitialisation de mot de passe');
			$emailService->setMessage($message);

			if ($emailService->send()) {
				return redirect()->to('/')->with('success', 'Un mail vient de vous être envoyé. Veuillez accéder au lien fourni.');
			} else {
				return redirect()->to('/auth/forgot-password')->with('error', 'Échec de l\'envoi de l\'email. Veuillez réessayer.');
			}
		} else {
			return redirect()->to('/auth/forgot-password')->with('error', 'L\'adresse email fournie est invalide.');
		}
	}

	public function resetPassword($token)
	{
		helper('form');
		// Vérifier le token dans la session
		if (!session()->get("updatePassword_$token")) {
			return redirect()->to('/');
		}
	
		// Si tout est ok, charger la vue avec le token
		echo view('pages/resetPassword', ['token' => $token]);
	}
	
	public function updatePassword()
	{
		helper('form');	
		// Récupérer le token
		$token = $this->request->getPost('token');
	
		// Définir les règles de validation
		$rules = [
			'password' => 'required|min_length[8]',
			'confirm_password' => 'required|matches[password]',
		];
	
		// Valider les données
		if (!$this->validate($rules)) {
			return redirect()->to('/forgot-password/reset-password/'.$token)
				->withInput() // Pour garder les anciennes valeurs saisies
				->with('validation', $this->validator); // Passer les erreurs de validation
		}
	
		echo $token."\n";		// Récupérer les mots de passe
		$password = $this->request->getPost('password');
		$confirmPassword = $this->request->getPost('confirm_password');
	
		// Charger le modèle de l'utilisateur
		$userModel = new AccountModel();
		$user = $userModel->where('reset_token', $token)
			->where('reset_token_expiration >=', date('Y-m-d H:i:s'))
			->first();

		var_dump($user);
	
		// Vérifier si l'utilisateur existe et si les mots de passe correspondent
		if ($user && $password === $confirmPassword) {
			// Hasher le mot de passe
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			
			// Mettre à jour le mot de passe et réinitialiser le token
			$userModel->set('password', $hashedPassword)
				->set('reset_token', null)
				->set('reset_token_expiration', null)
				->update($user['id']);
	
			// Success message
			session()->setFlashdata('success', 'Mot de passe réinitialisé avec succès.');
			return redirect()->to('/');
		} else {
			// Erreur si les mots de passe ne correspondent pas
			session()->setFlashdata('error', 'Erreur lors de la réinitialisation du mot de passe.');
			return redirect()->back()->withInput();
		}
	}
	
}