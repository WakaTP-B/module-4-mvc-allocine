<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
</head>

<body>
    <h1>Inscription</h1>

    <form action="" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">S'inscrire</button>
    </form>

    <?php if (!empty($error)) : ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>

    <?php if (!empty($success)) : ?>
        <p style="color:green"><?= $success ?></p>
    <?php endif; ?>

    <br><br><a href="/user/login">Se connecter</a>
    <br><br><a href="/<?= ROOT_APP_PATH ?>">Retour à l'acceuil</a>
</body>

</html>