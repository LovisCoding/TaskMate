<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TaskDependenciesSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'id_mother_task' => rand(1, 20),
                'id_child_task' => rand(1, 20),
            ];
        }

        // Avoid circular dependencies
        $filteredData = array_filter($data, function ($item) {
            return $item['id_mother_task'] !== $item['id_child_task'];
        });

        $this->db->table('taskdependencies')->insertBatch($filteredData);
    }
}
