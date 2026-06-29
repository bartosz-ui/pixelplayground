<?php
session_start();
require 'db.php';

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Vul gebruikersnaam en wachtwoord in.';
    } else {
        try {
            $stmt = $pdo->prepare('SELECT id, username, password_hash, email FROM users WHERE username = ?');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if (!$user || !password_verify($password, $user['password_hash'])) {
                $error = 'Onjuiste gebruikersnaam of wachtwoord.';
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                header('Location: profile.php');
                exit;
            }
        } catch (Exception $e) {
            $error = 'Fout bij inloggen: ' . $e->getMessage();
        }
    }
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

    <form action="inloggen.php" method="post" class="login-form">
        <h2>Inloggen</h2>

        <?php if ($error): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
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
