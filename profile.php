<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel - Pixel Playground</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<main class="register-page">

    <form class="register-form">

        <h1>Register</h1>

        <label for="username">Gebruikersnaam</label>
        <input 
            type="text"
            id="username"
            name="username"
            placeholder="Voer je gebruikersnaam in"
        >

        <label for="email">E-mail</label>
        <input 
            type="email"
            id="email"
            name="email"
            placeholder="Voer je e-mail in"
        >

        <label for="password">Wachtwoord</label>
        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Voer je wachtwoord in"
        >

        <button type="submit" class="btn btn--primary">
            Registreren
        </button>

        <p class="login-link">
            Heb je al een account?
            <a href="login.php">Log hier in</a>
        </p>

    </form>

</main>

<?php include 'footer.php'; ?>


</body>
</html>