<?php
require 'db.php';

$rows = [];
$error = null;

try {
    $result = $pdo->query(
        'SELECT player_name, connect4_rank, connect4_score, wordle_rank, wordle_score FROM leaderboard ORDER BY connect4_rank ASC'
    );

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pixelplayground</title>

    <link rel="stylesheet" href="style/style.css?v=2">
    <script src="script/script.js" defer></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <article class="leaderboard">

        <h2>Leaderboard</h2>

        <?php if ($error): ?>
            <div class="error-message">Fout bij laden van leaderboard: <?php echo htmlspecialchars($error); ?></div>
        <?php elseif (empty($rows)): ?>
            <p>Er zijn nog geen scores beschikbaar. Voeg data toe in phpMyAdmin of gebruik een SQL-query.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Speler</th>
                    <th>Vier op een Rij Rank</th>
                    <th>Vier op een Rij Score</th>
                    <th>Wordle Rank</th>
                    <th>Wordle Score</th>
                </tr>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['player_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['connect4_rank']); ?></td>
                        <td><?php echo htmlspecialchars($row['connect4_score']); ?></td>
                        <td><?php echo htmlspecialchars($row['wordle_rank']); ?></td>
                        <td><?php echo htmlspecialchars($row['wordle_score']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </article>

    <footer class="site-footer">
        <p>
            &copy; <?php echo date("Y"); ?> Pixel Playground.
            Alle rechten voorbehouden.
        </p>
    </footer>

</body>

</html>