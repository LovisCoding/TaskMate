<?php

namespace App\Controllers;

use DateTime;

class TaskController extends BaseController
{
    public function index() : void
    {
        $date = $this->request->getGet('date');
        $dateI = new DateTime($date);
        helper("form");

        $data = [
            'id' => 'ID0',
            'title' => 'Titre de la tâche',
            'description' => 'Description de la tâche',
            'priority' => 3,
            'date' => $dateI,
            'state' => 'En cours',
            'commentaries' => [
                'Commentaire 1',
                'Commentaire 2',
                'Commentaire 3',
            ],
            'blockList' => [
                [
                    'id' => 'ID1',
                    'name' => 'TASK_NAME_1',
                    'isChecked' => true
                ],
                [
                    'id' => 'ID2',
                    'name' => 'TASK_NAME_2',
                    'isChecked' => true
                ],
                [
                    'id' => 'ID3',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => true
                ],
                [
                    'id' => 'ID4',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => false
                ],
                [
                    'id' => 'ID5',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => false
                ],
                [
                    'id' => 'ID6',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => false
                ],
                [
                    'id' => 'ID7',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => false
                ],
                [
                    'id' => 'ID8',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => false
                ],
                [
                    'id' => 'ID9',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => false
                ]
            ],
            'isBlockedList' => [
                [
                    'id' => 'ID1',
                    'name' => 'TASK_NAME_1',
                    'isChecked' => false
                ],
                [
                    'id' => 'ID2',
                    'name' => 'TASK_NAME_2',
                    'isChecked' => false
                ],
                [
                    'id' => 'ID3',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => false
                ],
                [
                    'id' => 'ID4',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => true
                ],
                [
                    'id' => 'ID5',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => true
                ],
                [
                    'id' => 'ID6',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => true
                ],
                [
                    'id' => 'ID7',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => true
                ],
                [
                    'id' => 'ID8',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => true
                ],
                [
                    'id' => 'ID9',
                    'name' => 'TASK_NAME_3',
                    'isChecked' => true
                ]
            ]
        ];

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('pages/viewTask/Task',  $data ); 
        echo view('layout/footer') ;
    }

    public function validateTask($id) {
        $name = $this->request->getPost('task_name');
        $desc = $this->request->getPost('task_desc');
        $priority = $this->request->getPost('task_priority');
        $date = $this->request->getPost('task_date');
        $state = $this->request->getPost('task_state');
        $commentaries = $this->request->getPost('task_commentaries[]');
        $isBlockedList = $this->request->getPost('task_isBlockedList[]');
        $blockList = $this->request->getPost('task_blockList[]');


        var_dump($id);
    }

}
