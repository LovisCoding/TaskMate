<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Development',
                'id_account' => 1
            ],[
                'name' => 'Marketing',
                'id_account' => 1
            ],[
                'name' => 'Sales',
                'id_account' => 1
            ],[
                'name' => 'HR',
                'id_account' => 1
            ],[
                'name' => 'Support',
                'id_account' => 1
            ],
        ];

        $this->db->table('group')->insertBatch($data);
    }
}
