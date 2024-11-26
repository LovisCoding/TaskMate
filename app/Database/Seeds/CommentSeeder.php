<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 50; $i++) {
            $data[] = [
                'comment' => "This is comment $i",
                'id_task' => rand(1, 20),
            ];
        }

        $this->db->table('comment')->insertBatch($data);
    }
}
