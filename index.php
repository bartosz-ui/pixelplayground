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

        <h1 class="hero__title">
            Welkom bij Pixel Playground
        </h1>

        <p class="hero__subtitle">
            Duik in de wereld van retro gaming en herbeleef de klassiekers!
        </p>

        <a href="games.php" class="btn btn--primary">
            Ontdek onze games
        </a>

    </section>

    <section class="about-section">

        <h2 class="section-title">
            Over Pixel Playground
        </h2>

        <p class="about-text">
            Pixel Playground is dé plek voor liefhebbers van klassieke games,
            retro uitdagingen en competitieve highscores.
        </p>

        <p class="about-text">
            Speel direct in je browser, daag vrienden uit en ontdek
            nieuwe klassiekers in een moderne arcade stijl.
        </p>

    </section>

    <section class="featured-games">

        <h2 class="section-title">
            Uitgelichte Games
        </h2>

        <div class="games-grid">



            <article class="game-card">

                <img src="images\boterkaasei.png" alt="Boter kaas en eieren">

                <div class="game-card__content">

                    <h3>Boter, Kaas en Eieren</h3>

                    <p>
                        De klassieke tic-tac-toe ervaring komt binnenkort naar Pixel Playground.
                    </p>

                    <span class="coming-soon">
                        Coming Soon
                    </span>

                </div>

            </article>

            <article class="game-card">

                <img src="images/galgje.jpg" alt="Galgje">

                <div class="game-card__content">

                    <h3>Galgje</h3>

                    <p>
                        Raad het woord voordat de galg compleet is.
                    </p>

                    <span class="coming-soon">
                        Coming Soon
                    </span>

                </div>

            </article>

        </div>

    </section>

    <section class="updates-section">

        <h2 class="section-title">
            Binnenkort Beschikbaar
        </h2>

        <div class="updates-grid">

            <div class="update-card">

                <h3>
                    Online Leaderboards
                </h3>

                <p>
                    Vergelijk jouw scores met andere spelers
                    en klim naar de top van de ranglijst.
                </p>

            </div>

            <div class="update-card">

                <h3>
                    Nieuwe Retro Games
                </h3>

                <p>
                    Binnenkort voegen we meer klassieke arcade games toe.
                </p>

            </div>

            <div class="update-card">

                <h3>
                    Profielen & Achievements
                </h3>

                <p>
                    Verdien achievements en houd je statistieken bij.
                </p>

            </div>

        </div>

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