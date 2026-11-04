<?php
session_start();

// Controllo sicurezza: se l'utente non è loggato, reindirizza al Login
if (!isset($_SESSION['nome'])) {
    header("Location: Login.php");
    exit();
}

// Inizializziamo le recensioni del blog in sessione se non esistono ancora
if (!isset($_SESSION['recensioni_blog'])) {
    $_SESSION['recensioni_blog'] = [
        [
            "utente" => "Marco88",
            "titolo" => "Sito fantastico!",
            "voto" => "5/5",
            "data" => "14 Ottobre 2026",
            "commento" => "La grafica dark-mode con dettagli neon è spettacolare! Trovo la cronologia delle console davvero ben organizzata e facile da consultare."
        ],
        [
            "utente" => "Elena_Retro",
            "titolo" => "Un tuffo nel passato",
            "voto" => "5/5",
            "data" => "10 Ottobre 2026",
            "commento" => "Ottimo lavoro con gli articoli. La navigazione è velocissima e la sezione dedicata ai videogiochi anni '80 è fatta benissimo."
        ]
    ];
}

// Se l'utente invia una nuova recensione sul blog
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['invia_recensione'])) {
    $nuova_recensione = [
        "utente" => $_SESSION['nome'],
        "titolo" => htmlspecialchars($_POST['titolo']),
        "voto" => htmlspecialchars($_POST['voto']) . "/5",
        "data" => date("d/m/Y"),
        "commento" => htmlspecialchars($_POST['commento'])
    ];

    // Inseriamo la nuova recensione all'inizio dell'array
    array_unshift($_SESSION['recensioni_blog'], $nuova_recensione);
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valuta il Blog - RetroGaming.it</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- NAVIGAZIONE SUPERIORE -->
    <header class="navbar">
        <div class="logo">RetroGaming.it</div>
        <nav class="nav-links">
            <a href="Home.php">Home</a>
            <a href="Recensioni.php" class="active">Recensioni Blog</a>
            <a href="Console.php">Console</a>
            <a href="VideoGiochi.php">Video Giochi</a>
        </nav>
        <div class="user-info">
            <span>Ciao, <strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong>!</span>
            <a href="Logut.php" class="btn-logout">Esci</a>
        </div>
    </header>

    <!-- CONTENUTO PRINCIPALE -->
    <main class="main-container">
        <h1 class="section-title">Cosa pensano gli utenti del nostro Blog</h1>
        <p style="color: #aaa; margin-bottom: 30px;">Lascia un feedback sulla tua esperienza su RetroGaming.it per aiutarci a migliorare!</p>

        <!-- FORM PER LASCIARE UNA RECENSIONE SUL SITO -->
        <div class="gen-section" style="margin-bottom: 30px; border-left: 4px solid #00ffcc;">
            <h2 class="gen-title">Lascia la tua Recensione sul Blog</h2>
            <form action="Recensioni.php" method="POST" style="margin-top: 15px; display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <label style="color: #ccc; font-size: 14px; display: block; margin-bottom: 5px;">Titolo del feedback:</label>
                        <input type="text" name="titolo" placeholder="Es. Bellissima grafica e ottimi contenuti!" required style="width: 100%; padding: 10px; background-color: #222; border: 1px solid #333; color: #fff; border-radius: 6px;">
                    </div>
                    <div style="width: 160px;">
                        <label style="color: #ccc; font-size: 14px; display: block; margin-bottom: 5px;">Valutazione Sito:</label>
                        <select name="voto" required style="width: 100%; padding: 10px; background-color: #222; border: 1px solid #333; color: #fff; border-radius: 6px;">
                            <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                            <option value="4">⭐⭐⭐⭐ (4/5)</option>
                            <option value="3">⭐⭐⭐ (3/5)</option>
                            <option value="2">⭐⭐ (2/5)</option>
                            <option value="1">⭐ (1/5)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label style="color: #ccc; font-size: 14px; display: block; margin-bottom: 5px;">La tua opinione sul blog:</label>
                    <textarea name="commento" rows="4" placeholder="Cosa ti piace del sito o cosa potremmo migliorare?" required style="width: 100%; padding: 10px; background-color: #222; border: 1px solid #333; color: #fff; border-radius: 6px; resize: vertical;"></textarea>
                </div>

                <button type="submit" name="invia_recensione" style="align-self: flex-start; background-color: #00ffcc; color: #121212; border: none; font-weight: bold; padding: 12px 24px; border-radius: 6px; cursor: pointer; transition: 0.2s;">
                    Pubblica Recensione
                </button>
            </form>
        </div>

        <!-- LISTA DELLE RECENSIONI SUL BLOG -->
        <h2 style="color: #fff; font-size: 20px; margin-bottom: 20px;">Opinioni degli utenti (<?php echo count($_SESSION['recensioni_blog']); ?>)</h2>

        <div class="generazioni-container">
            <?php foreach ($_SESSION['recensioni_blog'] as $rec): ?>
                <div class="gen-section">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 10px; margin-bottom: 8px;">
                        <div>
                            <h2 class="gen-title" style="margin: 0; font-size: 18px; color: #fff;"><?php echo htmlspecialchars($rec['titolo']); ?></h2>
                            <span style="color: #777; font-size: 12px;">Recensione inviata da <strong><?php echo htmlspecialchars($rec['utente']); ?></strong> il <?php echo $rec['data']; ?></span>
                        </div>
                        <div style="background-color: #222; color: #00ffcc; font-weight: bold; padding: 4px 12px; border-radius: 6px; font-size: 14px; border: 1px solid #00ffcc;">
                            <?php echo $rec['voto']; ?>
                        </div>
                    </div>
                    <p style="color: #ccc; font-size: 14px; line-height: 1.6; margin-top: 10px;"><?php echo htmlspecialchars($rec['commento']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 RetroGaming.it — Tutti i diritti riservati.</p>
    </footer>

</body>
</html>