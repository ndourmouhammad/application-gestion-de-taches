<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <label for="prenom">Prenom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </p>
            <p>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </p>
            <p>
                <label for="telephone">Telephone :</label>
                <input type="tel" id="telephone" name="telephone" required>
            </p>
            <p>
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required>
            </p>
            <input type="submit" value="inscription">
        </form>
    </div>
</body>
</html>