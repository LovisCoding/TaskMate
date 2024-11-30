<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $tasks = [
            // Groupe 1 : Tâches ménagères
            ['id_account' => 1, 'name' => 'Nettoyer la cuisine', 'description' => 'Nettoyage complet de la cuisine, y compris les étagères et le four.', 'current_state' => 'Terminée', 'priority' => 1, 'start_date' => '2024-11-20', 'deadline' => '2024-11-22', 'end_date' => '2024-11-22', 'id_group' => 1],
            ['id_account' => 1, 'name' => 'Faire la lessive', 'description' => 'Laver et plier les vêtements pour la semaine.', 'current_state' => 'En cours', 'priority' => 2, 'start_date' => '2024-11-28', 'deadline' => '2024-12-01', 'end_date' => null, 'id_group' => 1],
            ['id_account' => 1, 'name' => 'Réparer le robinet qui fuit', 'description' => 'Réparation du robinet de cuisine qui goutte.', 'current_state' => 'Pas commencée', 'priority' => 3, 'start_date' => null, 'deadline' => '2024-12-05', 'end_date' => null, 'id_group' => 1],
            ['id_account' => 1, 'name' => 'Organiser le garage', 'description' => 'Trier les vieux cartons et les outils dans le garage.', 'current_state' => 'Bloquée', 'priority' => 3, 'start_date' => null, 'deadline' => '2024-12-15', 'end_date' => null, 'id_group' => 1],

            // Groupe 2 : Projet : Développement de site web
            ['id_account' => 1, 'name' => 'Créer le design de la page d\'accueil', 'description' => 'Créer des maquettes pour la page d\'accueil.', 'current_state' => 'Terminée', 'priority' => 1, 'start_date' => '2024-11-10', 'deadline' => '2024-11-15', 'end_date' => '2024-11-15', 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Implémenter le système d\'authentification', 'description' => 'Développer la fonctionnalité de connexion et d\'inscription des utilisateurs.', 'current_state' => 'En cours', 'priority' => 1, 'start_date' => '2024-11-25', 'deadline' => '2024-12-05', 'end_date' => null, 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Créer le schéma de la base de données', 'description' => 'Concevoir et optimiser la base de données pour le projet.', 'current_state' => 'Pas commencée', 'priority' => 2, 'start_date' => null, 'deadline' => '2024-12-10', 'end_date' => null, 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Écrire des tests unitaires pour le backend', 'description' => 'Vérifier que les fonctions backend fonctionnent correctement.', 'current_state' => 'Pas commencée', 'priority' => 2, 'start_date' => null, 'deadline' => '2024-12-15', 'end_date' => null, 'id_group' => 2],

            // Groupe 3 : Objectifs de fitness
            ['id_account' => 1, 'name' => 'Courir 5 km', 'description' => 'Terminer une course de 5 km en moins de 30 minutes.', 'current_state' => 'Terminée', 'priority' => 1, 'start_date' => '2024-11-05', 'deadline' => '2024-11-06', 'end_date' => '2024-11-06', 'id_group' => 3],
            ['id_account' => 1, 'name' => 'S\'inscrire à un cours de yoga', 'description' => 'Participer à une session de yoga pour débutants.', 'current_state' => 'En cours', 'priority' => 2, 'start_date' => '2024-11-27', 'deadline' => '2024-12-03', 'end_date' => null, 'id_group' => 3],
            ['id_account' => 1, 'name' => 'Acheter des équipements de sport', 'description' => 'Acheter des haltères et un tapis de yoga.', 'current_state' => 'Pas commencée', 'priority' => 3, 'start_date' => null, 'deadline' => '2024-12-10', 'end_date' => null, 'id_group' => 3],

            // Groupe 4 : Objectifs d'apprentissage
            ['id_account' => 1, 'name' => 'Lire un livre sur JavaScript', 'description' => 'Terminer le livre "Eloquent JavaScript".', 'current_state' => 'Pas commencée', 'priority' => 1, 'start_date' => null, 'deadline' => '2024-12-20', 'end_date' => null, 'id_group' => 4],
            ['id_account' => 1, 'name' => 'Suivre un cours Python en ligne', 'description' => 'Terminer le cours Python pour débutants sur Coursera.', 'current_state' => 'En cours', 'priority' => 1, 'start_date' => '2024-11-25', 'deadline' => '2024-12-18', 'end_date' => null, 'id_group' => 4],
            ['id_account' => 1, 'name' => 'Écrire un article de blog sur le développement web', 'description' => 'Partager des idées sur les derniers frameworks JavaScript.', 'current_state' => 'Bloquée', 'priority' => 2, 'start_date' => null, 'deadline' => '2024-12-15', 'end_date' => null, 'id_group' => 4],
        ];

        $this->db->table('task')->insertBatch($tasks);
    }
}
