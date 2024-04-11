<?php

trait Validation
{
    public function validerNom($nom)
    {
        if (!empty($nom) && htmlspecialchars(strip_tags(trim($nom)))) {
            $regex = '/^[A-Za-z\s]+$/u';
            return preg_match($regex, $nom);
        } else {
            return false; // Le champ est vide, donc invalide
        }
    }

    public function validerEmail($email)
    {
        if (!empty($email) && htmlspecialchars(strip_tags(trim($email)))) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        } else {
            return false;
        }
    }

    public function validerTelephone($telephone)
    {
        // Expression régulière pour vérifier le format du numéro de téléphone
        $pattern = "/^(78|77|76|70|75)\d{7}$/";

        // Supprimer les espaces
        $telephone = str_replace(" ", "", $telephone);

        // Vérifier si le numéro correspond au format attendu
        if (preg_match($pattern, $telephone) && htmlspecialchars(strip_tags(trim($telephone))))  {
            return true;
        } else {
            return false;
        }
    }

    public function valider_mot_de_passe($mot_de_passe) {
        // Vérifier si le mot de passe a au moins 8 caractères
        if (strlen($mot_de_passe) >= 8 && htmlspecialchars(strip_tags(trim($mot_de_passe)))) {
            return true;
        } else {
            return false;
        }
    }

    function sanitize_string($chaine) {
        // Supprimer les caractères spéciaux potentiellement dangereux
        $chaine = htmlspecialchars($chaine, ENT_QUOTES, 'UTF-8');
        // Échapper les caractères pour éviter les injections SQL
        $chaine = addslashes($chaine);
        return $chaine;
    }
}
