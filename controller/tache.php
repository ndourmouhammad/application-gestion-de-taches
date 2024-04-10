<?php

require_once('./model/tache.class.php');


$libelle = '';
$description = '';
$date = '';
$priorite = '';
$etat = '';

$tache  = new Tache($libelle, $description, $date, $priorite, $etat,  $connexion);

function ajoutTache($id, $libelle, $description, $date, $priorite, $etat)
{
    global $tache;

    $id = $_POST['id_utilisateur'];
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $priorite = $_POST['priorite'];
    $etat = $_POST['etat'];

    $ajout = $tache->ajouterTache($libelle, $description, $date, $priorite, $etat);
    include_once('./view/ajouter.php');
}