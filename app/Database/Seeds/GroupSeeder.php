<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $groups = [
            ['id_account' => 1, 'name' => 'Tâches ménagères'],
            ['id_account' => 1, 'name' => 'Projet : Développement de site web'],
            ['id_account' => 1, 'name' => 'Objectifs de fitness'],
            ['id_account' => 1, 'name' => 'Objectifs d\'apprentissage'],
            ['id_account' => 1, 'name' => 'TaskMate Presentation : Tasks'],
            ['id_account' => 1, 'name' => 'TaskMate Presentation : Concentration'],
        ];

        $this->db->table('group')->insertBatch($groups);
    }
}
