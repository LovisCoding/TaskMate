<?php

namespace App\Controllers;

class EmailController extends BaseController
{
    public function sendConfirmAccountMail()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

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
        $accountModel = new \App\Models\AccountModel();
        $accountModel->insert([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => $registrationData['password'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    
        session()->remove("registration_$token");
    
        return redirect()->to('/')->with('success', 'Votre compte a bien été créé. Vous pouvez maintenant vous connecter.');
    }
    
}
