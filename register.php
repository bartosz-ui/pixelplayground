<?php
require 'session.php';
require 'db.php';

$username = '';
$email = '';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $email === '' || $password === '') {
        $error = 'Vul alle velden in.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Ongeldig e-mailadres.';
    } else {
        try {
            $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
            $stmt->bind_param('ss', $username, $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = 'Gebruikersnaam of e-mail bestaat al.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $insert = $pdo->prepare('INSERT INTO users (username, email, password_hash, created_at) VALUES (?, ?, ?, NOW())');
                $insert->bind_param('sss', $username, $email, $hash);
                $insert->execute();
                $success = 'Registratie gelukt! Je kunt nu inloggen.';
                $username = '';
                $email = '';
            }
        } catch (Exception $e) {
            $error = 'Fout bij registreren: ' . $e->getMessage();
        }
    }
}
?>

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

            <?php if ($error): ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success-message"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>

            <form action="register.php" method="post" class="register-form">
                <label for="new-username">Gebruikersnaam:</label>
                <input type="text" id="new-username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                <label for="new-email">E-mail:</label>
                <input type="email" id="new-email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                <label for="new-password">Wachtwoord:</label>
                <input type="password" id="new-password" name="password" required>
                <button type="submit" class="btn btn--primary">Registreer</button>
            </form>

            <p>Heb je al een account? <a href="inloggen.php" class="inloggen">Inloggen</a></p>
        </article>
    </main>

    <footer class="site-footer">
        <p>
            &copy; <?php echo date("Y"); ?> Pixel Playground.
            Alle rechten voorbehouden.
        </p>
    </footer>

</body>

</html>
