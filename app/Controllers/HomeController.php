<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index() : void
    {
        echo view('layout/header');
        echo view('layout/navbar');
        echo view('pages/home/home');
        echo view('layout/footer') ;
    }
}
