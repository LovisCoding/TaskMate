<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class APITaskController extends ResourceController
{
    protected $modelName = 'App\Models\TaskModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }
  
}