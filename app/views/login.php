<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <h1>Connectez-vous</h1>

    <form action="" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Se connecter</button>
    </form>
    <br><br><a href="/user/register">S'inscrire</a>
    <br><br><a href="/<?= ROOT_APP_PATH ?>">Retour à l'acceuil</a>
</body>

</html>