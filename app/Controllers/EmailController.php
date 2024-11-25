<?php

namespace App\Controllers;

class EmailController extends BaseController
{
	public function index()
	{
		//Librairie Email
		$email = \Config\Services::email();
		
		// Paramètres de l'e-mail
		$to = $this->request->getPost('to');
		$from = 'mail.taskmate@gmail.fr';
		$subject = 'Création de votre compte TaskMate !';
		$message = "Bonjour,
		
		Merci de vous être inscrit à TaskMate, votre plateforme de gestion de tâches intuitive et performante.
		
		Pour activer votre compte, cliquez sur le lien suivant :
		" . htmlspecialchars($activationLink) . "
		
		Si vous n'avez pas créé de compte sur TaskMate, ignorez simplement cet email.
		
		Cordialement,
		L'équipe TaskMate
		";
		

		// Préparation de l'e-mail
		$email->setTo($to);
		$email->setFrom($from);
		$email->setSubject($subject);
		$email->setMessage($message);
		// Envoyer l'e-mail
		if ($email->send()) {
			echo 'E-mail envoyé avec succès.';
		} else {
			echo 'Échec de l\'envoi de l\'e-mail. Erreur : ' . $email->printDebugger(['headers']);
		}
	}
}
