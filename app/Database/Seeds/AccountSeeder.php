<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => "TaskMate",
            'email' => "mail.taskmate@gmail.com",
            'password' => password_hash('TaskMate', PASSWORD_BCRYPT),
            'created_at' => date('Y-m-d H:i:s'),
            'reset_token' => null,
            'reset_token_expiration' => null
        ];

        $this->db->table('account')->insertBatch($data);
    }
}
