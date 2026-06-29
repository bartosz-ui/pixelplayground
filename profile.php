<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: inloggen.php');
    exit;
}

$user = null;
$stats = null;
$error = '';

try {
    $stmt = $pdo->prepare('SELECT username, email, created_at FROM users WHERE id = ?');
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $statsStmt = $pdo->prepare('SELECT connect4_rank, connect4_score, wordle_rank, wordle_score FROM leaderboard WHERE player_name = ?');
        $statsStmt->bind_param('s', $user['username']);
        $statsStmt->execute();
        $stats = $statsStmt->get_result()->fetch_assoc();
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
    <title>Mijn Profiel - Pixel Playground</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/badges.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <main class="profile-page">
        <section class="profile-container">
            <?php if ($error): ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if (!$user): ?>
                <p>Gebruiker niet gevonden.</p>
            <?php else: ?>
                <header class="profile-header">
                    <section class="profile-avatar">
                        <span class="avatar-initial"><?php echo htmlspecialchars(strtoupper(substr($user['username'], 0, 1))); ?></span>
                    </section>
                    <section class="profile-info-header">
                        <h1>Welkom terug!</h1>
                        <p class="username">@<?php echo htmlspecialchars($user['username']); ?></p>
                    </section>
                </header>

                <nav class="profile-tabs">
                    <button class="tab-button active" data-tab="info">Profielgegevens</button>
                    <button class="tab-button" data-tab="stats">Statistieken</button>
                    <button class="tab-button" data-tab="settings">Instellingen</button>
                </nav>

                <article id="info" class="tab-content active">
                    <form class="profile-form">
                        <section class="form-group">
                            <label for="username">Gebruikersnaam</label>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="<?php echo htmlspecialchars($user['username']); ?>"
                                disabled>
                        </section>

                        <section class="form-group">
                            <label for="email">E-mail</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?php echo htmlspecialchars($user['email']); ?>"
                                placeholder="Voer je e-mail in">
                        </section>

                        <section class="form-group">
                            <label for="display-name">Weergavenaam</label>
                            <input
                                type="text"
                                id="display-name"
                                name="display_name"
                                value="<?php echo htmlspecialchars($user['username']); ?>"
                                placeholder="Voer je weergavenaam in">
                        </section>

                        <section class="form-group">
                            <label for="bio">Biografie</label>
                            <textarea
                                id="bio"
                                name="bio"
                                placeholder="Vertel iets over jezelf..."
                                rows="4"></textarea>
                        </section>

                        <button type="button" class="btn btn--primary">Opslaan</button>
                    </form>
                </article>

                <article id="stats" class="tab-content">
                    <section class="stats-grid">
                        <section class="stat-card">
                            <p class="stat-value"><?php echo $stats ? htmlspecialchars($stats['connect4_score']) : '0'; ?></p>
                            <p class="stat-label">Vier op een Rij Score</p>
                        </section>
                        <section class="stat-card">
                            <p class="stat-value"><?php echo $stats ? htmlspecialchars($stats['wordle_score']) : '0'; ?></p>
                            <p class="stat-label">Wordle Score</p>
                        </section>
                        <section class="stat-card">
                            <p class="stat-value"><?php echo $stats ? htmlspecialchars($stats['connect4_rank']) : '-'; ?></p>
                            <p class="stat-label">Vier op een Rij Rank</p>
                        </section>
                        <section class="stat-card">
                            <p class="stat-value"><?php echo $stats ? htmlspecialchars($stats['wordle_rank']) : '-'; ?></p>
                            <p class="stat-label">Wordle Rank</p>
                        </section>
                    </section>

                    <h2 style="margin-top:30px;text-align:center;color:var(--text-primary);">Badges</h2>
                    <div class="badges-container" id="profileBadges"></div>
                </article>

                <article id="settings" class="tab-content">
                    <form class="settings-form">
                        <section class="settings-group">
                            <label>
                                <input type="checkbox" name="notifications" checked>
                                Push notificaties inschakelen
                            </label>
                        </section>

                        <section class="settings-group">
                            <label>
                                <input type="checkbox" name="dark-mode" checked>
                                Donkere modus
                            </label>
                        </section>

                        <section class="settings-group">
                            <label>
                                <input type="checkbox" name="privacy">
                                Profiel openbaar maken
                            </label>
                        </section>

                        <button type="submit" class="btn btn--primary">Instellingen Opslaan</button>
                    </form>

                    <section class="danger-zone">
                        <h3>Gevaarlijke Zone</h3>
                        <button type="button" class="btn btn--danger">Account Verwijderen</button>
                        <button type="button" class="btn btn--secondary">Wachtwoord Wijzigen</button>
                    </section>
                </article>
            <?php endif; ?>
        </section>

    </main>

    <?php include 'footer.php'; ?>

    <script src="script/badges.js"></script>
    <script src="script/profile.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
            try {
                const name = getOrAskPlayerName('profile');
                renderBadges('#profileBadges', name);
            } catch(e) {}
        });
    </script>

</body>

</html>
