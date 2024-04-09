<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/login.css">
    <title>Gestionnaire de tâches</title>
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <form action="" method="post">
            <p>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </p>
            <p>
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" required>
            </p>
            <input type="submit" value="Connexion">
        </form>
        <p>Vous n'avez pas de compte ? <a href="index.php?page=add-user">Inscrivez-vous ici</a>.</p>
    </div>
</body>
</html>
