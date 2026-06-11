<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Profiel - Pixel Playground</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <main class="profile-page">
        <section class="profile-container">
            <!-- Profiel Header -->
            <header class="profile-header">
                <section class="profile-avatar">
                    <span class="avatar-initial">F</span>
                </section>
                <section class="profile-info-header">
                    <h1>Welkom terug!</h1>
                    <p class="username">@freek</p>
                </section>
            </header>

            <!-- Profiel Tabs -->
            <nav class="profile-tabs">
                <button class="tab-button active" data-tab="info">Profielgegevens</button>
                <button class="tab-button" data-tab="stats">Statistieken</button>
                <button class="tab-button" data-tab="settings">Instellingen</button>
            </nav>

            <!-- Profielgegevens Tab -->
            <article id="info" class="tab-content active">
                <form class="profile-form">
                    <section class="form-group">
                        <label for="username">Gebruikersnaam</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="freek"
                            disabled>
                    </section>

                    <section class="form-group">
                        <label for="email">E-mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="freek@example.com"
                            placeholder="Voer je e-mail in">
                    </section>

                    <section class="form-group">
                        <label for="display-name">Weergavenaam</label>
                        <input
                            type="text"
                            id="display-name"
                            name="display_name"
                            value="Freek"
                            placeholder="Voer je weergavenaam in">
                    </section>

                    <section class="form-group">
                        <label for="bio">Biografie</label>
                        <textarea
                            id="bio"
                            name="bio"
                            placeholder="Vertel iets over jezelf..."
                            rows="4">Gamer en retro speller!</textarea>
                    </section>

                    <button type="submit" class="btn btn--primary">Opslaan</button>
                </form>
            </article>

            <!-- Statistieken Tab -->
            <article id="stats" class="tab-content">
                <section class="stats-grid">
                    <section class="stat-card">
                        <p class="stat-value">42</p>
                        <p class="stat-label">Spellen Gespeeld</p>
                    </section>
                    <section class="stat-card">
                        <p class="stat-value">8750</p>
                        <p class="stat-label">Totale Punten</p>
                    </section>
                    <section class="stat-card">
                        <p class="stat-value">12</p>
                        <p class="stat-label">Plaats in Ranking</p>
                    </section>
                    <section class="stat-card">
                        <p class="stat-value">94</p>
                        <p class="stat-label">Voltooide Achievements</p>
                    </section>
                </section>
            </article>

            <!-- Instellingen Tab -->
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
        </section>

    </main>

    <?php include 'footer.php'; ?>

    <script src="script/profile.js"></script>

</body>

</html>