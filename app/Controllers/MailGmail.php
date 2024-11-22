<?php

namespace App\Controllers;

class MailYahoo extends BaseController
{
	public function index()
	{
		//Librairie Email
		$email = \Config\Services::email();
		// Paramètres de l'e-mail
		$to = 'arthurlecomtefr@gmail.com';
		$from = 'arthurlecomtefr@gmail.com';
		$subject = 'Test1';
		$message = 'Contenu de l\'e-mail';
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
