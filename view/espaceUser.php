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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire des tâches</title>
</head>
<body>
<header>
    <nav class="navbar1">
        <a href="index.php">Mes tâches</a>
        <a href="addIdea.php">Ajouter une tâche</a>
    </nav>
    <nav class="navbar2">
        <a href="index.php?page=deconnecter">Déconnexion</a>
        <!-- Affiche le nom de l'utilisateur -->
        <a href="#"><?= $utilisateur['prenom'] . ' ' . $utilisateur['nom']; ?></a>
    </nav>
    <p>
        <?php
        // Parcourir et afficher les utilisateurs
    foreach ($utilisateurs as $utilisateur) {
        echo $utilisateur['nom'] . ' ' . $utilisateur['prenom'] . ' - ' . $utilisateur['email'] . '<br>';
    }
        ?>
    </p>
</header>
</body>
</html>
