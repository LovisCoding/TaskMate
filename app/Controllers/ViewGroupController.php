<?php

namespace App\Controllers;

class ViewGroupController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('pages/viewGroup');
        echo view('layout/footer');
    }
}
