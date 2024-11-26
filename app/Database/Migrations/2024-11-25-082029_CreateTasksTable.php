<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTasksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_task' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'id_account' => [
                'type' => 'INT'
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'current_state' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'priority' => [
                'type' => 'INT',
                'null' => true,
            ],
            'start_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'id_group' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_task', true);
        $this->forge->addForeignKey('id_account', 'Account', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_group', 'Group', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('task');
    }

    public function down()
    {
        $this->forge->dropTable('task', true);
    }
}
