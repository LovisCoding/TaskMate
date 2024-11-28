<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTaskDependenciesTable extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_mother_task' => [
        //         'type' => 'INT',
        //     ],
        //     'id_child_task' => [
        //         'type' => 'INT',
        //     ],
        // ]);
        // echo "exec: taskDependencies\n";
        // $this->forge->addKey(['id_mother_task', 'id_child_task'], true);
        // $this->forge->addForeignKey('id_mother_task', 'task', 'id_task', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_child_task', 'task', 'id_task', 'CASCADE', 'CASCADE');
        // $this->forge->createTable('taskdependencies');
    }

    public function down()
    {
        $this->forge->dropTable('taskdependencies', true);
    }
}
