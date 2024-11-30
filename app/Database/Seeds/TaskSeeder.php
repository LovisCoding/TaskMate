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
            ['id_account' => 1, 'name' => 'Organiser le garage', 'description' => 'Trier les vieux cartons et les outils dans le garage.', 'current_state' => 'Bloquée', 'priority' => 4, 'start_date' => null, 'deadline' => '2024-12-15', 'end_date' => null, 'id_group' => 1],

            
            // Groupe 2 : Projet : Développement de site web
            ['id_account' => 1, 'name' => 'Créer le design de la page d\'accueil', 'description' => 'Créer des maquettes pour la page d\'accueil.', 'current_state' => 'Terminée', 'priority' => 1, 'start_date' => '2024-11-10', 'deadline' => '2024-11-15', 'end_date' => '2024-11-15', 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Implémenter le système d\'authentification', 'description' => 'Développer la fonctionnalité de connexion et d\'inscription des utilisateurs.', 'current_state' => 'En cours', 'priority' => 2, 'start_date' => '2024-11-25', 'deadline' => '2024-12-05', 'end_date' => null, 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Créer le schéma de la base de données', 'description' => 'Concevoir et optimiser la base de données pour le projet.', 'current_state' => 'Pas commencée', 'priority' => 3, 'start_date' => null, 'deadline' => '2024-12-10', 'end_date' => null, 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Écrire des tests unitaires pour le backend', 'description' => 'Vérifier que les fonctions backend fonctionnent correctement.', 'current_state' => 'Pas commencée', 'priority' => 4, 'start_date' => null, 'deadline' => '2024-12-15', 'end_date' => null, 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Configurer l\'hébergement sur AWS', 'description' => 'Déployer le site web sur un serveur AWS.', 'current_state' => 'Terminée', 'priority' => 1, 'start_date' => '2024-11-18', 'deadline' => '2024-11-22', 'end_date' => '2024-11-22', 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Optimiser les performances du site', 'description' => 'Analyser et réduire les temps de chargement des pages.', 'current_state' => 'Terminée', 'priority' => 2, 'start_date' => '2024-11-19', 'deadline' => '2024-11-23', 'end_date' => '2024-11-23', 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Intégrer un service de paiement', 'description' => 'Mettre en place un système de paiement Stripe.', 'current_state' => 'Terminée', 'priority' => 3, 'start_date' => '2024-11-20', 'deadline' => '2024-11-25', 'end_date' => '2024-11-27', 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Ajouter des animations CSS', 'description' => 'Ajouter des transitions pour rendre le site plus interactif.', 'current_state' => 'Terminée', 'priority' => 4, 'start_date' => '2024-11-21', 'deadline' => '2024-11-26', 'end_date' => '2024-11-26', 'id_group' => 2],
            ['id_account' => 1, 'name' => 'Corriger les bugs critiques', 'description' => 'Résoudre les problèmes majeurs détectés lors des tests.', 'current_state' => 'Terminée', 'priority' => 1, 'start_date' => '2024-11-22', 'deadline' => '2024-11-27', 'end_date' => '2024-11-29', 'id_group' => 2],

            // Groupe 3 : Objectifs de fitness
            ['id_account' => 1, 'name' => 'Courir 5 km', 'description' => 'Terminer une course de 5 km en moins de 30 minutes.', 'current_state' => 'Terminée', 'priority' => 1, 'start_date' => '2024-11-05', 'deadline' => '2024-11-06', 'end_date' => '2024-11-06', 'id_group' => 3],
            ['id_account' => 1, 'name' => 'S\'inscrire à un cours de yoga', 'description' => 'Participer à une session de yoga pour débutants.', 'current_state' => 'En cours', 'priority' => 2, 'start_date' => '2024-11-27', 'deadline' => '2024-12-03', 'end_date' => null, 'id_group' => 3],
            ['id_account' => 1, 'name' => 'Acheter des équipements de sport', 'description' => 'Acheter des haltères et un tapis de yoga.', 'current_state' => 'Pas commencée', 'priority' => 3, 'start_date' => null, 'deadline' => '2024-12-10', 'end_date' => null, 'id_group' => 3],

            // Groupe 4 : Objectifs d'apprentissage
            ['id_account' => 1, 'name' => 'Lire un livre sur JavaScript', 'description' => 'Terminer le livre "Eloquent JavaScript".', 'current_state' => 'Pas commencée', 'priority' => 1, 'start_date' => null, 'deadline' => '2024-12-20', 'end_date' => null, 'id_group' => 4],
            ['id_account' => 1, 'name' => 'Suivre un cours Python en ligne', 'description' => 'Terminer le cours Python pour débutants sur Coursera.', 'current_state' => 'En cours', 'priority' => 2, 'start_date' => '2024-11-25', 'deadline' => '2024-12-18', 'end_date' => null, 'id_group' => 4],
            ['id_account' => 1, 'name' => 'Écrire un article de blog sur le développement web', 'description' => 'Partager des idées sur les derniers frameworks JavaScript.', 'current_state' => 'Bloquée', 'priority' => 3, 'start_date' => null, 'deadline' => '2024-12-15', 'end_date' => null, 'id_group' => 4],

            // Groupe 5 : TaskMate Presentation : TASKS
            ['id_account' => 1, 'name' => 'Tâche en cours à bloquer', 'description' => 'Ceci est la description de la tâche en cours pour la présentation de TaskMate ', 'current_state' => 'En cours', 'priority' => 2, 'start_date' => '2024-12-01', 'deadline' => '2024-12-02', 'end_date' => null, 'id_group' => 5],
            ['id_account' => 1, 'name' => 'Tâche pas commencée à bloquer', 'description' => 'Ceci est la description de la tâche pas commencée pour la présentation de TaskMate ', 'current_state' => 'Pas commencée', 'priority' => 3, 'start_date' => null, 'deadline' => '2024-12-04', 'end_date' => null, 'id_group' => 5],
        

            // Groupe 6 : TaskMate Presentation : CONCENTRATION
            ['id_account' => 1, 'name' => 'Tâche 1 du groupe concentration', 'description' => 'Ceci est la description de la tâche 1 du groupe de concentration pour la présentation de TaskMate', 'current_state' => 'Pas commencée', 'priority' => 4, 'start_date' => null, 'deadline' => '2024-12-04', 'end_date' => null, 'id_group' => 6],
            ['id_account' => 1, 'name' => 'Tâche 2 du groupe concentration', 'description' => 'Ceci est la description de la tâche 2 du groupe de concentration pour la présentation de TaskMate', 'current_state' => 'Pas commencée', 'priority' => 3, 'start_date' => null, 'deadline' => '2024-12-04', 'end_date' => null, 'id_group' => 6],
            ['id_account' => 1, 'name' => 'Tâche 3 du groupe concentration', 'description' => 'Ceci est la description de la tâche 3 du groupe de concentration pour la présentation de TaskMate', 'current_state' => 'Pas commencée', 'priority' => 3, 'start_date' => null, 'deadline' => '2024-12-05', 'end_date' => null, 'id_group' => 6],

            // Groupe à créer : TaskMate Presentation : GROUPS
            ['id_account' => 1, 'name' => 'Tâche 1 du groupe test', 'description' => 'Ceci est la description de la tâche 1 du groupe de test pour la présentation de TaskMate', 'current_state' => 'Pas commencée', 'priority' => 4, 'start_date' => null, 'deadline' => '2024-12-04', 'end_date' => null, 'id_group' => null],
            ['id_account' => 1, 'name' => 'Tâche 2 du groupe test', 'description' => 'Ceci est la description de la tâche 2 du groupe de test pour la présentation de TaskMate', 'current_state' => 'En cours', 'priority' => 3, 'start_date' => '2024-12-01', 'deadline' => '2024-12-04', 'end_date' => null, 'id_group' => null],
            ['id_account' => 1, 'name' => 'Tâche 3 du groupe test', 'description' => 'Ceci est la description de la tâche 3 du groupe de test pour la présentation de TaskMate', 'current_state' => 'Pas commencée', 'priority' => 3, 'start_date' => null, 'deadline' => '2024-12-05', 'end_date' => null, 'id_group' => null],



        
        ];

        $this->db->table('task')->insertBatch($tasks);
    }
}
