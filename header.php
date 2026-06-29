<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$loggedIn = isset($_SESSION['username']);
?>
<header class="site-header">
    <div>
        <a href="index.php" class="brand-link">
            <img src="images/logo%20pixelplayground.webp" alt="Retro Games" class="brand-logo">
        </a>
    </div>

    <div>
        <form>
            <label for="search-input" class="visually-hidden">Zoek</label>
            <div class="search-input-wrap">
                <span class="search-icon">&#128269;</span>
                <input id="search-input" type="search" name="q" placeholder="zoeken" class="search-input">
            </div>
        </form>
    </div>

    <nav class="header__nav" aria-label="Hoofdmenu">
        <a href="index.php">home</a>
        <a href="games.php">games</a>
        <a href="leaderbord.php">leaderbord</a>
    </nav>

    <div class="header__actions">
        <?php if ($loggedIn): ?>
            <a href="profile.php" class="profile-badge" aria-label="Profiel"><?php echo htmlspecialchars(strtoupper(substr($_SESSION['username'], 0, 1))); ?></a>
            <a href="logout.php" class="btn btn--secondary">uitloggen</a>
        <?php else: ?>
            <a href="register.php" class="btn btn--primary">registreren</a>
            <a href="inloggen.php" class="profile-badge" aria-label="Profiel">F</a>
        <?php endif; ?>
    </div>
</header>