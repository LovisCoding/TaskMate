<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $states=['Terminé', 'En cours', 'Bloqué', 'Pas commencé'];
        $data = [];
        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'id_account' => 1,
                'name' => "Task $i",
                'description' => "This is the description for Task $i",
                'current_state' => $states[$i%4],
                'priority' => rand(1, 4),
                'start_date' => date('Y-m-d', strtotime("-$i days")),
                'end_date' => date('Y-m-d', strtotime("+$i days")),
                'id_group' => rand(1, 5),
            ];
        }

        $this->db->table('task')->insertBatch($data);
    }
}
