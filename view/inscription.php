<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/register.css">
    <title>Gestionnaire de tâches</title>
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form action="" method="post">
            <p>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </p>
            <p>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </p>
            <p>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </p>
            <p>
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" required>
            </p>
            <p>
                <label for="telephone">Téléphone :</label>
                <input type="tel" id="telephone" name="telephone" required>
            </p>
            <p>
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required>
            </p>
            <input type="submit" value="Inscription">
        </form>
        <p>Déjà inscrit ? <a href="index.php?page=connecter">Connectez-vous ici</a>.</p>
    </div>
</body>
</html>
