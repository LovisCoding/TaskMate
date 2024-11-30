<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class APITaskController extends ResourceController
{
    protected $modelName = 'App\Models\TaskModel';
    protected $format    = 'json';

    public function index()
    {
        $idAccount = session()->get("id");
        return $this->respond($this->model->where("id_account", $idAccount)->findAll());
    }
  
}