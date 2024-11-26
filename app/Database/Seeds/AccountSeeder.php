<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => password_hash('password' . $i, PASSWORD_BCRYPT),
                'created_at' => date('Y-m-d H:i:s'),
                'reset_token' => null,
                'reset_token_expiration' => null
            ];
        }

        $this->db->table('account')->insertBatch($data);
    }
}
