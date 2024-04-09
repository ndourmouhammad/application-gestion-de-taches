<?php

require_once('./model/utilisateur.class.php');

$nom = '';
$prenom = '';
$email = '';
$telephone = 0;
$adresse = '';

$user  = new Utilisateur($nom, $prenom, $email, $telephone, $adresse,$connexion);

function inscrireUser($nom, $prenom, $email, $telephone, $adresse)
{
    global $user;

    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];

    $inscrire = $user->inscription($nom, $prenom, $email, $telephone, $adresse);
    include_once('./view/inscription.php');
}