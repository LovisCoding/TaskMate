<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $comments = [
            ['comment' => 'La cuisine est impeccable maintenant.', 'id_task' => 1],
            ['comment' => 'Il faudrait nettoyer le four plus souvent.', 'id_task' => 1],
            ['comment' => 'Les vêtements blancs sont déjà pliés.', 'id_task' => 2],
            ['comment' => 'Il reste encore une machine à faire.', 'id_task' => 2],
            ['comment' => 'Le formulaire de connexion est presque prêt.', 'id_task' => 6],
            ['comment' => 'Ajouter la validation côté client.', 'id_task' => 6],
        ];

        $this->db->table('comment')->insertBatch($comments);
    }
}
