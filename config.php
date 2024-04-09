<?php

define('DSN', 'mysql:host=localhost;dbname=gestion_taches;charset=utf8');
define('USER', 'root');
define('PASSWORD', '');

try {
    $connexion = new PDO(DSN, USER, PASSWORD);
    
} catch (PDOException $e) {
    die('Erreur : '.$e->getMessage());
}
