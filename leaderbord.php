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

<div class="leaderboard">

        <h2>Leaderboard</h2>

        <table>
            <tr>
                <th>#</th>
                <th>Speler</th>
                <th>Score</th>
            </tr>

            <tr>
                <td class="rank">1</td>
                <td>Alex</td>
                <td>2500</td>
            </tr>

            <tr>
                <td class="rank">2</td>
                <td>Emma</td>
                <td>2100</td>
            </tr>

            <tr>
                <td class="rank">3</td>
                <td>Noah</td>
                <td>1800</td>
            </tr>

            <tr>
                <td class="rank">4</td>
                <td>Sophia</td>
                <td>1500</td>
            </tr>

            <tr>
                <td class="rank">5</td>
                <td>Liam</td>
                <td>1200</td>
            </tr>
        </table>

    </div>
    <footer class="site-footer">
        <p>
            &copy; <?php echo date("Y"); ?> Pixel Playground.
            Alle rechten voorbehouden.
        </p>
    </footer>

</body>

</html>