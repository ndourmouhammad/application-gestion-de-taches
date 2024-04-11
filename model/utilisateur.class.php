<?php

require_once('./config.php');
require_once('validation.trait.php');

class Utilisateur
{
    use Validation;

    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $telephone;
    private $adresse;
    private $connexion;

    public function __construct($nom, $prenom, $email, $mdp, $telephone, $adresse, $connexion)
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

    public function deconnexion()
    {
        // Démarrer la session si ce n'est pas déjà fait
        session_start();

        // Détruire toutes les données de session
        session_destroy();

        // Rediriger vers une page après la déconnexion, par exemple la page de connexion
        header("Location: index.php?page=connecter");
        exit(); // Assure que le script s'arrête après la redirection
    }


    public function listerTaches()
{
    try {
        // Démarrer la session si ce n'est pas déjà fait
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['utilisateur']) && isset($_SESSION['utilisateur']['id'])) {
            $userId = $_SESSION['utilisateur']['id'];

            // Préparer la requête SQL pour récupérer les tâches de l'utilisateur connecté
            $sql = "SELECT * FROM taches WHERE id_utilisateur = :userId";
            $req = $this->connexion->prepare($sql);
            $req->bindValue(':userId', $userId);
            $req->execute();

            // Récupérer toutes les tâches de l'utilisateur sous forme de tableau associatif
            $taches = $req->fetchAll(PDO::FETCH_OBJ);

            return $taches;
        } else {
            // Gérer le cas où aucun utilisateur n'est connecté
            // Par exemple, rediriger vers la page de connexion
            header("Location: index.php?page=connecter");
            exit();
        }
    } catch (PDOException $e) {
        // Gestion des erreurs
        die('Erreur lors de la récupération des tâches : ' . $e->getMessage());
    }
}
}
