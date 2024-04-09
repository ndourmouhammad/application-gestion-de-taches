<?php

require_once('./model/utilisateur.class.php');

$nom = '';
$prenom = '';
$email = '';
$mdp = '';
$telephone = 0;
$adresse = '';

$user  = new Utilisateur($nom, $prenom, $email, $mdp, $telephone, $adresse, $connexion);

function inscrireUser($nom, $prenom, $email, $mdp, $telephone, $adresse)
{
    global $user;


    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];

    $inscrire = $user->inscription($nom, $prenom, $email, $mdp, $telephone, $adresse);
    include_once('./view/inscription.php');
}

function connecter()
{
    global $user;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer et nettoyer les données du formulaire
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $mdp = htmlspecialchars($_POST["mdp"]);

        // Appeler la fonction de connexion
        if ($user->authentification($email, $mdp)) {
            // Rediriger l'utilisateur vers la page d'accueil après l'authentification réussie
            header("Location: index.php");
            exit();
        } else {
            // Afficher un message d'erreur si l'authentification échoue
            echo "Adresse email ou mot de passe incorrect.";
        }
    }

    // Inclure la vue de connexion après la vérification du formulaire (si aucune redirection n'est effectuée)
    include_once('./view/connexion.php');
}

function lister()
{
    global $user;
    // Appel de la méthode pour lister les utilisateurs
    $taches = $user->listerTaches();
    include_once('./view/espaceUser.php');
}

function deconnexion()
{
    global $user;
    
    // Appel de la méthode de déconnexion
    $user->deconnexion();
    include_once('./view/deconnexion.php');
}
