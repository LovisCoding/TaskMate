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

            ['comment' => 'Commentaire 1', 'id_task' => 20],
            ['comment' => 'Commentaire 2', 'id_task' => 20],
            ['comment' => 'Commentaire 3', 'id_task' => 20],
            ['comment' => 'Commentaire 4', 'id_task' => 20],
            ['comment' => 'Commentaire 5', 'id_task' => 20],
            ['comment' => 'Commentaire 6', 'id_task' => 20],
            ['comment' => 'Commentaire 7', 'id_task' => 20],
            ['comment' => 'Commentaire 8', 'id_task' => 20],
            ['comment' => 'Commentaire 9', 'id_task' => 20],
            ['comment' => 'Commentaire 10', 'id_task' => 20],
            ['comment' => 'Commentaire 11', 'id_task' => 20],
            ['comment' => 'Commentaire 12', 'id_task' => 20],

            ['comment' => 'Commentaire 1', 'id_task' => 21],
            ['comment' => 'Commentaire 2', 'id_task' => 21],
            ['comment' => 'Commentaire 3', 'id_task' => 21],
            ['comment' => 'Commentaire 4', 'id_task' => 21],
            ['comment' => 'Commentaire 5', 'id_task' => 21],
            ['comment' => 'Commentaire 6', 'id_task' => 21],
            ['comment' => 'Commentaire 7', 'id_task' => 21],
            ['comment' => 'Commentaire 8', 'id_task' => 21],
            ['comment' => 'Commentaire 9', 'id_task' => 21],
            ['comment' => 'Commentaire 10', 'id_task' => 21],
            ['comment' => 'Commentaire 11', 'id_task' => 21],
            ['comment' => 'Commentaire 12', 'id_task' => 21],

            ['comment' => 'Commentaire 1', 'id_task' => 25],
            ['comment' => 'Commentaire 2', 'id_task' => 25],
            ['comment' => 'Commentaire 3', 'id_task' => 25],
            ['comment' => 'Commentaire 4', 'id_task' => 25],
            ['comment' => 'Commentaire 5', 'id_task' => 25],
            ['comment' => 'Commentaire 6', 'id_task' => 25],
            ['comment' => 'Commentaire 7', 'id_task' => 25],
            ['comment' => 'Commentaire 8', 'id_task' => 25],
            ['comment' => 'Commentaire 9', 'id_task' => 25],
            ['comment' => 'Commentaire 10', 'id_task' => 25],
            ['comment' => 'Commentaire 11', 'id_task' => 25],
            ['comment' => 'Commentaire 12', 'id_task' => 25],
        ];

        $this->db->table('comment')->insertBatch($comments);
    }
}
