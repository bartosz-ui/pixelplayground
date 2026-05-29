<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pixelplayground - Registreren</title>

    <link rel="stylesheet" href="style/style.css?v=2">
    <script src="script/script.js" defer></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <main>
        <article class="register-section">
            <h2>Registreren</h2>
            <form action="register.php" method="post" class="register-form">
                <label for="new-username">Gebruikersnaam:</label>
                <input type="text" id="new-username" name="username" required>
                <label for="new-email">E-mail:</label>
                <input type="email" id="new-email" name="email" required>
                <label for="new-password">Wachtwoord:</label>
                <input type="password" id="new-password" name="password" required>
                <button type="submit" class="btn btn--primary">Registreer</button>
            </form>

            <p>Heb je al een account? <button id="open-login" class="btn btn--primary">Inloggen</button></p>
        </article>
    </main>

    <!-- Modal / Pop-up for login -->
    <article class="modal-overlay" id="login-modal" aria-hidden="true">
        <article class="modal">
            <button class="modal-close" id="close-login" aria-label="Sluit">×</button>
            <form action="inloggen.php" method="post" class="login-form">
                <h2>Inloggen</h2>

                <label for="username">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="btn btn--primary">Inloggen</button>
                <p>Heb je nog geen account? <a href="register.php">Registreer hier</a></p>
            </form>
        </article>
    </article>


    <footer class="site-footer">
        <p>
            &copy; <?php echo date("Y"); ?> Pixel Playground.
            Alle rechten voorbehouden.
        </p>
    </footer>

</body>

</html>