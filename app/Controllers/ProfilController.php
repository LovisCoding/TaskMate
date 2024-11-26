<?php

namespace App\Controllers;

use App\Models\AccountModel;

class ProfilController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        helper(['form']);

        echo view('layout/header');
        echo view('layout/navbar');

        $session = session();
        $accountModel = new AccountModel();
        $account = $accountModel->where("id", $session->get("id"))->first();
        $data = [];

        if ($account) {
            $data = [
                "name" => $account["name"],
                "email" => $account["email"]
            ];
        }


        echo view('pages/profil', $data);
        echo view('layout/footer');
    }

    public function updateName()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }


        helper(['form']);
        $session = session();
        $accountModel = new AccountModel();

        $id = $session->get("id");
        $name = $this->request->getPost('name');

        $accountModel->update($id, ['name' => $name]);

        return redirect()->to('/profil')->with('message', 'Les modifications ont été enregistrées.');
    }

    public function resetPassword()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $id = session()->get("id");
        $accountModel = new AccountModel();
        $account = $accountModel->where("id", $id)->first();

        if ($account) {

            $token = bin2hex(random_bytes(16));
            session()->set("updatePassword_$token", $token);

            $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $accountModel->set('reset_token', $token)
                ->set('reset_token_expiration', $expiration)
                ->update($account['id']);

            $resetLink = site_url("/forgot-password/reset-password/$token");
            $message = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe: $resetLink";

            $emailService = \Config\Services::email();

            $from = 'mail.taskmate@gmail.com';

            $emailService->setTo($account["email"]);
            $emailService->setFrom($from);
            $emailService->setSubject('Réinitialisation de mot de passe');
            $emailService->setMessage($message);
            if ($emailService->send()) {
                return redirect()->to('/profil')->with('success', 'Un mail vient de vous être envoyé. Veuillez accéder au lien fourni.');
            } else {
                return redirect()->to('/profil')->with('error', 'Échec de l\'envoi de l\'email. Veuillez réessayer.');
            }
        } else {
            return redirect()->to('/profil')->with('error', 'L\'adresse email fournie est invalide.');
        }
    }

    public function logout()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $session = session();
        $session->destroy();

        return redirect()->to('/'); // Redirige vers la page d'accueil ou de connexion
    }

    public function deleteAccount()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $session = session();
        $accountModel = new AccountModel();

        $id = $session->get("id");
        $accountModel->delete($id);

        $session->destroy();

        return redirect()->to('/')->with('success', 'Votre compte a été supprimé.');
    }
}
