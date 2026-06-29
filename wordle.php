<?php require 'session.php'; ?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordle - Pixel Playground</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/wordle.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <main class="wordle-page">
        <section class="wordle-container">
            <h1>Wordle</h1>

            <section class="game-controls">
                <button class="btn btn--primary" id="newGameBtn">Nieuw spel</button>
                <select id="difficulty" class="btn">
                    <option value="normal">Normaal (standaard lijst)</option>
                </select>
                <button class="btn" id="saveWordleBtn">💾 Opslaan</button>
                <button class="btn" id="loadWordleBtn">📂 Laden</button>
                <button class="btn" id="clearWordleBtn">🗑️ Verwijderen</button>
            </section>

            <section class="game-status" id="gameStatus" style="display:none;">
                <p id="statusText"></p>
                <button class="btn btn--secondary" id="resetBtn">Speel opnieuw</button>
            </section>

            <section class="game-board" id="gameBoard">
            </section>

            <section class="keyboard" id="keyboard">

            </section>

            <section class="game-info">
            </section>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <script src="script/badges.js"></script>
    <script src="script/wordle.js"></script>

</body>

</html>