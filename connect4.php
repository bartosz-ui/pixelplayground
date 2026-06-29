<?php require 'session.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vier op een rij - Pixel Playground</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/connect4.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="connect4-page">
    <section class="connect4-container">
        <h1>Vier op een rij</h1>
        
        <section class="game-controls">
            <button class="btn btn--primary" onclick="startNewGame('pvp')">
                🎮 Tegen elkaar spelen
            </button>
            <button class="btn btn--primary" onclick="startNewGame('pve')">
                🤖 Tegen AI spelen
            </button>
            <button class="btn" id="saveGameBtn">💾 Opslaan</button>
            <button class="btn" id="loadGameBtn">📂 Laden</button>
            <button class="btn" id="clearSaveBtn">🗑️ Verwijderen</button>
        </section>

        <section class="game-status" id="gameStatus" style="display: none;">
            <p id="statusText"></p>
            <button class="btn btn--secondary" onclick="resetGame()">Nieuw spel</button>
        </section>

        <section class="game-board" id="gameBoard">
            <!-- Board wordt gegenereerd met JavaScript -->
        </section>

        <section class="game-info">
            <article class="player-info">
                <h3>Speler 1 (Rood)</h3>
                <p id="player1Score">Winsten: 0</p>
            </article>
            <article class="player-info">
                <h3 id="player2Title">Speler 2 (Geel)</h3>
                <p id="player2Score">Winsten: 0</p>
            </article>
        </section>
    </section>
</main>

<?php include 'footer.php'; ?>

<script src="script/badges.js"></script>
<script src="script/connect4.js"></script>
</body>
</html>
