<?php

require_once('./controller/utilisateur.php');


if (isset($_GET['page'])) {
    if ($_GET['page'] == 'add-user') {
        if (empty($_POST['nom']) || empty($_POST['prenom'] || empty($_POST['email']) || empty($_POST['telephone']) || empty($_POST['adresse']))) {
            include('view/inscription.php');
        } else {
            inscrireUser($nom, $prenom, $email, $telephone, $adresse);
        }
    }
}
else {
    
    inscrireUser($nom, $prenom, $email, $telephone, $adresse);
}