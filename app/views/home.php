<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlloCiné</title>
</head>

<body>
    <h1>AlloCiné</h1>

    <div class="login">
        <a href="/user/login">Se connecter</a>
        <a href="/user/register">S'inscrire</a>
    </div>

    <section class="film-card">

        <?php foreach ($films as $film): ?>
            <div>
                <h2><?= $film->getTitre(); ?></h2>
                <p><?= $film->getReal(); ?></p>
                <p><?= monthYear($film->getDate_sortie()); ?></p>
                <p><?= $film->getGenre(); ?></p>

                <!-- <img src="<?= $film->getCover(); ?>" alt="<?= $film->getTitre(); ?>"> -->

                <a href="film/detail/<?= $film->getId(); ?>"><img src="<?= $film->getCover(); ?>" alt="<?= $film->getTitre(); ?>"></a>
            </div>
        <?php endforeach; ?>

    </section>
</body>

</html>