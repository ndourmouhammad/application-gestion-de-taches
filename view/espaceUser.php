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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/user.css">
    <title>Gestionnaire des tâches</title>
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
    <main>
        <div class="container">
            <h1>Mes Tâches</h1>
            <a href="index.php?page=add-task" class="btn-add-task">Ajouter une tâche</a>
            <table>
                <thead>
                    <tr>
                        <th>Tâche</th>
                        <th>Description</th>
                        <th>Date d'échéance</th>
                        <th>Priorité</th>
                        <th>État</th>
                        <th>Marquer comme terminé</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($taches as $tache) : ?>
                        <tr>
                            <td><?= $tache->libelle ?></td>
                            <td><?= $tache->description ?></td>
                            <td><?= $tache->date ?></td>
                            <td><?= $tache->priorite ?></td>
                            <td><?= $tache->etat ?></td>
                            <td><a href="index.php?page=update-task&id=<?= $tache->id ?>"><img src="./public/img/done.svg"></a></td>
                            <td><a href="#"><img src="./public/img/trash.svg"></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>