<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'comment' => [
                'type' => 'TEXT',
            ],
            'id_task' => [
                'type' => 'INT'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_task', 'Task', 'id_task', 'CASCADE', 'CASCADE');
        $this->forge->createTable('comment');
    }

    public function down()
    {
        $this->forge->dropTable('comment', true);
    }
}
