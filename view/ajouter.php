<?php
// Démarrer la session
session_start();
// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['utilisateur'])) {
    // Récupère les informations de l'utilisateur
    $utilisateur = $_SESSION['utilisateur'];
} else {
    // Redirige l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: index.php?page=connecter");
    exit(); // Assure que le script s'arrête après la redirection
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/ajouter.css">
    <title>Ajouter une tâche</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">Gestionnaire de tâches</a>
            </div>
            <div class="user-info">
                <span>Bienvenue, <?= $utilisateur['prenom']; ?> <?= $utilisateur['nom']; ?></span>
                <a href="index.php?page=deconnecter">Déconnexion</a>
            </div>
        </nav>
    </header>
    <div class="container">
        <h1>Ajouter une tâche</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="libelle">Libellé :</label>
                <input type="text" id="libelle" name="libelle" required>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" rows="5" cols="33"></textarea>
            </div>

            <div class="form-group">
                <label for="priorite">Priorité :</label>
                <select id="priorite" name="priorite" required>
                    <option value="faible">faible</option>
                    <option value="moyenne">moyenne</option>
                    <option value="élevée">élevée</option>
                </select>
            </div>

            <div class="form-group">
                <label for="etat">État :</label>
                <select id="etat" name="etat" required>
                    <option value="à faire">à faire</option>
                    <option value="en cours">en cours</option>
                    <option value="terminé">terminé</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date d'échéance :</label>
                <input type="datetime-local" id="date" name="date" required>
            </div>

            <input type="hidden" name="id_utilisateur" value="<?= $utilisateur['id']; ?>">

            <div class="form-group">
                <input type="submit" value="Ajouter">
            </div>
        </form>
    </div>
</body>
</html>
