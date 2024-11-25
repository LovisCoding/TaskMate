<?php

namespace App\Controllers;

class EmailController extends BaseController
{
	public function sendConfirmAccountMail()
	{
		// Récupérer les données depuis le formulaire
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Générer un token unique
        $token = bin2hex(random_bytes(16));
        
        // Sauvegarder temporairement les données (en session ou dans une table temporaire)
        session()->set("registration_$token", [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        ]);
        
        // Lien de confirmation
        $confirmAccountLink = site_url("email/confirmAccount/$token");
        
        // Envoyer l'email
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setFrom('mail.taskmate@gmail.com', 'TaskMate');
        $emailService->setSubject('Création de votre compte TaskMate !');
        $emailService->setMessage("
            Bonjour $name,
            
            Merci de vous être inscrit à TaskMate, votre plateforme de gestion de tâches intuitive et performante.
            
            Pour activer votre compte, cliquez sur le lien suivant :
            $confirmAccountLink
            
            Si vous n'avez pas créé de compte sur TaskMate, ignorez simplement cet email.
            
            Cordialement,
            L'équipe TaskMate
        ");
        
        if ($emailService->send()) {
            return redirect()->to('/')->with('success', 'Un email de confirmation a été envoyé. Veuillez vérifier votre boîte de réception.');
        } else {
            return redirect()->back()->with('error', 'Échec de l\'envoi de l\'email. Veuillez réessayer.');
        }
	}

    public function confirmAccount($token)
    {
        // Vérifier si le token existe
        $registrationData = session()->get("registration_$token");
        
        if (!$registrationData) {
            return redirect()->to('/')->with('error', 'Lien invalide ou expiré.');
        }
        
        // Sauvegarder les données dans la base de données
        $accountModel = new \App\Models\AccountModel();
        $accountModel->insert([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => $registrationData['password'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        
        // Supprimer les données temporaires
        session()->remove("registration_$token");
        
        // Définir un message de succès dans la session
        session()->setFlashdata('success', 'Votre compte a bien été créé. Vous pouvez maintenant vous connecter.');
        
        // Rediriger vers la page de connexion
        return redirect()->to('auth/login');
    }
    
}
