<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_account' => [
                'type' => 'INT'
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ]
        ]);
        echo "exec: group\n";
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_account', 'account', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('group');
    }

    public function down()
    {
        $this->forge->dropTable('"group"', true);
    }
}
