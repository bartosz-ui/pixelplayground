<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pixelplayground</title>

    <link rel="stylesheet" href="style/style.css">
    <script src="script/script.js" defer></script>
</head>

<body>

    <?php include 'header.php'; ?>

<main id="index-main">

    <section class="hero">
        <h1 class="hero__title">Welkom bij Pixel Playground</h1>

        <p class="hero__subtitle">
            Duik in de wereld van retro gaming en herbeleef de klassiekers!
        </p>

        <a href="games.php" class="btn btn--primary">
            Ontdek onze games
        </a>
    </section>
</main>
    <footer class="site-footer">
        <p>
            &copy; <?php echo date("Y"); ?> Pixel Playground.
            Alle rechten voorbehouden.
        </p>
    </footer>

</body>

</html>