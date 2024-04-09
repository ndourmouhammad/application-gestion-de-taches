<?php

require_once('./controller/utilisateur.php');

// Vérifie si une page est spécifiée dans l'URL
if (isset($_GET['page'])) {
    if ($_GET['page'] == 'add-user') {
        if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['telephone']) || empty($_POST['adresse'])) {
            // Si des champs sont vides, afficher le formulaire d'inscription
            include_once('./view/inscription.php');
        } else {
            // Si tous les champs sont remplis, inscrire l'utilisateur
            inscrireUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['telephone'], $_POST['adresse']);
        }
    } elseif ($_GET['page'] == 'connecter') {
        // Afficher le formulaire de connexion
        connecter();
    } 
} else {
    // Si aucune page spécifiée, afficher le formulaire de connexion par défaut
    lister();
}
