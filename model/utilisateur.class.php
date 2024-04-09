<?php

require_once('./config.php');

class Utilisateur
{
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $adresse;
    private $connexion;

    public function __construct($nom, $prenom, $email, $telephone, $adresse, $connexion)
    {
        $this->connexion = $connexion;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
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


    public function inscription($nom, $prenom, $email, $telephone, $adresse)
    {
        
        try {
            $sql = "INSERT INTO Utilisateur (nom, prenom, email, telephone, adresse) VALUES (:nom, :prenom, :email, :telephone, :adresse)";
            $req = $this->connexion->prepare($sql);
            $req->bindValue(':nom', $nom);
            $req->bindValue(':prenom', $prenom);
            $req->bindValue(':email', $email);
            $req->bindValue(':adresse', $adresse);
            $req->bindValue(':telephone', $telephone, PDO::PARAM_INT);
            $req->execute();

            header("location: index.php");
            exit();
        } catch (PDOException $e) {

            die('Erreur lors de l\'inscription : ' . $e->getMessage());
        }
    }
}
