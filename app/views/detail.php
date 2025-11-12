<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails</title>
</head>

<body>
    <div>
        <?php if ($film) : ?>

            <h1>Detail du film</h1>
            <img src="<?= $film->getCover(); ?>" alt="<?= $film->getNom(); ?><">
            <p><?= $film->getNom(); ?></p>
            <p>Synopsis : <?= $film->getSynopsis(); ?></p>
        <?php else: ?>
            <p>Film introuvable</p>
        <?php endif; ?>

    </div>
    <h2>Séance</h2>
    <?php foreach ($diffusion as $dif): ?>

        <p><?= $dif->getDate_diffusion(); ?></p>
    <?php endforeach; ?>

</body>

</html>