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

<form action="inloggen.php" method="post" class="login-form">
    <h2>Inloggen</h2>

    <label for="username">Gebruikersnaam:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Wachtwoord:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit" class="btn btn--primary">Inloggen</button>
    <p>Heb je nog geen account? <a href="register.php">Registreer hier</a></p>
</form>


    <footer class="site-footer">
        <p>
            &copy; <?php echo date("Y"); ?> Pixel Playground.
            Alle rechten voorbehouden.
        </p>
    </footer>

</body>

</html>