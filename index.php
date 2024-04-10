<?php

// Inclusion des fichiers de contrôleur
require_once('./controller/utilisateur.php');
require_once('./controller/tache.php');

// Vérification de la page demandée
if (isset($_GET['page'])) {
    $page = $_GET['page'];

    switch ($page) {
        case 'add-user':
            // Vérification des données du formulaire d'inscription
            if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['mdp']) || empty($_POST['telephone']) || empty($_POST['adresse'])) {
                // Affichage du formulaire d'inscription
                include_once('./view/inscription.php');
            } else {
                // Inscription de l'utilisateur si tous les champs sont remplis
                inscrireUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['telephone'], $_POST['adresse']);
            }
            break;

        case 'connecter':
            // Affichage du formulaire de connexion
            connecter();
            break;

        case 'deconnecter':
            // Déconnexion de l'utilisateur
            deconnexion();
            break;

        case 'add-task':
            // Vérification des données du formulaire d'ajout de tâche
            if (empty($_POST['libelle']) || empty($_POST['description']) || empty($_POST['date']) || empty($_POST['priorite']) || empty($_POST['etat'])) {
                // Affichage du formulaire d'ajout de tâche
                include_once('./view/ajouter.php');
            } else {
                // Ajout de la tâche si tous les champs sont remplis
                ajoutTache($_POST['id_utilisateur'], $_POST['libelle'], $_POST['description'], $_POST['date'], $_POST['priorite'], $_POST['etat']);
            }
            break;

        case 'update-task':
            // Vérification de la présence de l'ID de la tâche dans l'URL
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                // Modification de la tâche avec l'ID spécifié
                modifierTache($id);
            } 

        default:
            // Si la page demandée n'est pas reconnue, afficher la liste des tâches par défaut
            lister();
            break;
    }
} else {
    // Si aucune page spécifiée, afficher la liste des tâches par défaut
    lister();
}
