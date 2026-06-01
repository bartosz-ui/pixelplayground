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

    <main>

        <section class="featured-games">
            <h2 class="section-title">Onze games</h2>
            <section class="games-grid">

                <article class="game-card">
                    <a href="connect4.php" style="text-decoration: none; color: inherit;">
                        <img src="images\connect.jpg" alt="Connect 4">

                        <div class="game-card__content">
                            <h3>Vier op een rij</h3>

                            <p>
                                Zet vier van dezelfde kleur op een rij en win!
                            </p>
                        </div>
                    </a>
                </article>

                <article class="game-card">
                    <img src="images\wordle.png" alt="Wordle">

                    <div class="game-card__content">
                        <h3>Wordle</h3>

                        <p>
                            Raad het woord in zo min mogelijk pogingen.
                        </p>
                    </div>
                </article>
                <article class="game-card">
                    <img src="images\boterkaasei.png" alt="Boter kaas en eieren">

                    <div class="game-card__content">
                        <h3>Boter, Kaas en Eieren</h3>

                        <p>
                            Speel de klassieke tic-tac-toe tegen je vrienden!
                        </p>

                        <span class="coming-soon">Coming Soon</span>
                    </div>
                </article>

                <article class="game-card">
                    <img src="images\galgje.jpg" alt="Galgje">

                    <div class="game-card__content">
                        <h3>Galgje</h3>

                        <p>
                            Raad het verborgen woord voordat het te laat is.
                        </p>

                        <span class="coming-soon">Coming Soon</span>
                    </div>
                </article>
            </section>

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