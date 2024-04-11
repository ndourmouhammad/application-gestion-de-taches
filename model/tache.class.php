<?php

require_once('./config.php');
require_once('validation.trait.php');
class Tache
{
    use Validation;
    
    private $libelle;
    private $description;
    private $date;
    private $priorite;
    private $etat;
    private $connexion;

    public function __construct($libelle, $description, $date, $priorite, $etat, $connexion)
    {
       
        $this->libelle = $libelle;
        $this->description = $description;
        $this->date = $date;
        $this->priorite = $priorite;
        $this->etat = $etat;
        $this->connexion = $connexion;
    }

   public function ajouterTache($libelle, $description, $date, $priorite, $etat)
{
    // Vérifier si la session est démarrée
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    try {
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['utilisateur']) && isset($_SESSION['utilisateur']['id'])) {
            // Récupérer l'ID de l'utilisateur à partir de la session
            $id_utilisateur = $_SESSION['utilisateur']['id'];

            $sql = 'INSERT INTO taches (id_utilisateur, libelle, description, date, priorite, etat) VALUES (:id_utilisateur, :libelle, :description, :date, :priorite, :etat)';
            $req = $this->connexion->prepare($sql);
            $req->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            $req->bindValue(':libelle', $libelle);
            $req->bindValue(':description', $description);
            $req->bindValue(':date', $date);
            $req->bindValue(':priorite', $priorite);
            $req->bindValue(':etat', $etat);
            $req->execute();

            // Redirection après l'ajout de la tâche
            header("Location: index.php");
            exit();
        } else {
            // Gérer le cas où l'utilisateur n'est pas connecté
            // Redirection, affichage d'un message d'erreur, etc.
            header("Location: index.php?page=connecter");
            exit();
        }
    } catch (PDOException $e) {
        // Gestion des erreurs
        die('Erreur lors de la création des tâches : ' . $e->getMessage());
    }
}

// Fonction pour mettre à jour l'état d'une tâche
public function marquerTacheTerminee($id)
{
    try {
        // Préparer la requête SQL pour mettre à jour l'état de la tâche
        $sql = "UPDATE taches SET etat = 'terminé' WHERE id = :id";
        $req = $this->connexion->prepare($sql);
        
        // Liaison des paramètres
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Exécuter la requête
        $req->execute();
        
        // Pas de redirection ici
    } catch (PDOException $e) {
        // Gérer les erreurs de base de données
        die("Erreur lors de la mise à jour de l'état de la tâche : " . $e->getMessage());
    }
}

public function delete($id)
    {

        $sql = 'DELETE FROM taches WHERE id = :id';
        $req = $this->connexion->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        header("location: index.php");
        exit();
    }

    
}