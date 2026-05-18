<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pixelplayground</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="script/script.js" defer></script>
        <?php include 'header.php'; ?>
</head>
<body>

    <main class="site-main">
        <section class="hero">
            <h1 class="hero__title">Welkom bij Pixel Playground</h1>
            <p class="hero__subtitle">Duik in de wereld van retro gaming en herbeleef de klassiekers!</p>
            <a href="games.php" class="btn btn--primary">Ontdek onze games</a>
        </section>

        <section class="featured-games">
            <h2 class="section-title">Uitgelichte Games</h2>
            <div class="game-grid">
                <div class="game-card">
                    <img src="images/game1.webp" alt="Game 1" class="game-card__image">
                    <h3 class="game-card__title">vier op een rij</h3>
                    <p class="game-card__description">Een platformer vol avontuur en pixel-perfect actie.</p>
                    <a href="#" class="btn btn--secondary">Speel nu</a>
                </div>
                <div class="game-card">
                    <img src="images/game2.webp" alt="Game 2" class="game-card__image">
                    <h3 class="game-card__title">wordle</h3>
                    <p class="game-card__description">Raad het woord in zo min mogelijk pogingen.</p>
                    <a href="#" class="btn btn--secondary">Speel nu</a>
                </div>
            </div>
        </section>
    </main>
<?php include 'footer.php'; ?>
</body>
</html>
