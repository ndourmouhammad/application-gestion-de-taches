<?php

require_once('./config.php');

class Utilisateur
{
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $telephone;
    private $adresse;
    private $connexion;

    public function __construct($nom, $prenom, $email, $mdp , $telephone, $adresse, $connexion)
    {
        $this->connexion = $connexion;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($n_nom)
    {
        $this->nom = $n_nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($n_prenom)
    {
        $this->prenom = $n_prenom;
    }


    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($n_email)
    {
        $this->email = $n_email;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }
    public function setTelephone($n_telephone)
    {
        $this->telephone = $n_telephone;
    }
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function setAdresse($n_adresse)
    {
        $this->adresse = $n_adresse;
    }


    public function inscription($nom, $prenom, $email, $mdp, $telephone, $adresse)
{
    try {
        // Hacher le mot de passe
        $mdp_hache = password_hash($mdp, PASSWORD_DEFAULT);

        // Préparer la requête SQL
        $sql = "INSERT INTO Utilisateur (nom, prenom, email, mdp, telephone, adresse) VALUES (:nom, :prenom, :email, :mdp, :telephone, :adresse)";
        $req = $this->connexion->prepare($sql);

        // Liaison des valeurs avec les paramètres de la requête
        $req->bindValue(':nom', $nom);
        $req->bindValue(':prenom', $prenom);
        $req->bindValue(':email', $email);
        $req->bindValue(':mdp', $mdp_hache); // Utilisation du mot de passe haché
        $req->bindValue(':adresse', $adresse);
        $req->bindValue(':telephone', $telephone, PDO::PARAM_INT);

        // Exécution de la requête
        $req->execute();

        // Redirection après l'inscription
        header("location: index.php");
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs
        die('Erreur lors de l\'inscription : ' . $e->getMessage());
    }
}


    public function authentification($email, $mdp)
    {
        try {
            // Requête SQL avec des paramètres de requête nommés
            $sql = "SELECT * FROM Utilisateur WHERE email = :email";
            $req = $this->connexion->prepare($sql);
            $req->bindParam(':email', $email);
            $req->execute();
            
            // Récupération de l'utilisateur
            $utilisateur = $req->fetch(PDO::FETCH_ASSOC);
            
            // Vérification du mot de passe
            if ($utilisateur && password_verify($mdp, $utilisateur['mdp'])) {
                // Démarrage de la session
                session_start();
                $_SESSION['utilisateur'] = $utilisateur;
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Gestion des erreurs de requête
            die('Erreur lors de l\'authentification : ' . $e->getMessage());
        }
    }
    
    public function listerUtilisateurs()
{
    try {
        // Préparer la requête SQL pour récupérer tous les utilisateurs
        $sql = "SELECT * FROM Utilisateur";
        $req = $this->connexion->query($sql);
        
        // Récupérer tous les utilisateurs sous forme de tableau associatif
        $utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $utilisateurs;
    } catch (PDOException $e) {
        // Gestion des erreurs
        die('Erreur lors de la récupération des utilisateurs : ' . $e->getMessage());
    }
}

}
