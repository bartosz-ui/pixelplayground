<?php require 'session.php'; ?>
<!DOCTYPE html>
<html lang="nl">

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
                <section class="updates-grid">
                    <article class="update-card">
                        <h3>
                            Online Leaderboards
                        </h3>
                        <p>
                            Vergelijk jouw scores met andere spelers
                            en klim naar de top van de ranglijst.
                        </p>
                    </article>

                    <article class="update-card">
                        <h3>
                            Nieuwe Retro Games
                        </h3>
                        <p>
                            Binnenkort voegen we meer klassieke arcade games toe.
                        </p>
                    </article>

                    <article class="update-card">
                        <h3>
                            Profielen & Achievements
                        </h3>
                        <p>
                            Verdien achievements en houd je statistieken bij.
                        </p>
                    </article>
                </section>
            </h2>

            <section class="games-grid">

                <article class="game-card">
                    <a href="connect4.php" style="text-decoration: none; color: inherit;">
                        <img src="images\connect.jpg" alt="Connect 4">

                        <section class="game-card__content">
                            <h3>Vier op een rij</h3>

                            <p>
                                Zet vier van dezelfde kleur op een rij en win!
                            </p>
                        </section>
                    </a>
                </article>

                <article class="game-card">
                    <img src="images\wordle.png" alt="Wordle">
                    <a href="wordle.php" style="text-decoration: none; color: inherit;">
                        <section class="game-card__content"> 
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