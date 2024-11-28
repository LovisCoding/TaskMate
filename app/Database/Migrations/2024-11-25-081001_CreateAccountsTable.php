<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id' => [
        //         'type' => 'INT',
        //         'auto_increment' => true
        //     ],
        //     'name' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'email' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //         'unique' => true
        //     ],
        //     'password' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'created_at' => [
        //         'type' => 'DATETIME',
        //         'null' => true,
        //         'default' => date('Y-m-d H:i:s')
        //     ],
        //     'reset_token' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //         'null' => true
        //     ],
        //     'reset_token_expiration' => [
        //         'type' => 'DATETIME',
        //         'null' => true
        //     ]
        // ]);
        // echo "exec: account\n";
        // $this->forge->addKey('id', true);
        // $this->forge->createTable('account');
    }

    public function down()
    {
        $this->forge->dropTable('account', true);
    }
}
