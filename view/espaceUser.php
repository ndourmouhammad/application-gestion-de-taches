<?php
// Démarrer la session
//session_start();
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
    <a href="#"><?= $utilisateur['prenom']; ?> <?= $utilisateur['nom']; ?></a>
        <a href="index.php?page=deconnecter">Déconnexion</a>
    </nav>
    <div class="container">
        <h1>Mes tâches</h1>
        <table>
            <tr>
                <th>Tâche</th>
                <th>Description</th>
                <th>Date d'échéance</th>
                <th>Priorité</th>
                <th>Etat</th>
            </tr>
            <?php foreach ($taches as $tache) : ?>
                    <tr>
                        <td><?= $tache->libelle ?></td>
                        <td><?= $tache->description ?></td>
                        <td><?= $tache->date ?></td>
                        <td><?= $tache->priorite ?></td>
                        <td><?= $tache->etat ?></td>
                        
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
  
</header>
</body>
</html>
