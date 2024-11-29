<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TaskDependenciesSeeder extends Seeder
{
    public function run()
    {
        $dependencies = [
            ['id_mother_task' => 3, 'id_child_task' => 4],  // Réparer le robinet qui fuit dépend de Organiser le garage
            ['id_mother_task' => 7, 'id_child_task' => 8],  // Implémenter le système d'authentification dépend de Créer le schéma de la base de données
        ];

        $this->db->table('taskdependencies')->insertBatch($dependencies);
    }
}
