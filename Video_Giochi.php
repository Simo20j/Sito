<?php
session_start();

// Controllo sicurezza: se l'utente non è loggato, reindirizza al Login
if (!isset($_SESSION['nome'])) {
    header("Location: Login.php");
    exit();
}

$era_videogiochi = [
    [
        "era" => "Le Origini e le Sale Giochi (Anni '70)",
        "descrizione" => "La nascita del settore con i primi arcade elettromeccanici e i grandi classici da bar.",
        "giochi" => [
            ["titolo" => "Pong", "anno" => "1972", "piattaforma" => "Arcade / Atari", "descrizione" => "Il videogioco che ha dato inizio all'industria commerciale, simulando il tennistavolo."],
            ["titolo" => "Space Invaders", "anno" => "1978", "piattaforma" => "Arcade / Taito", "descrizione" => "Un fenomeno globale che ha definito il genere degli sparatutto a scorrimento e scatenato una carenza di monete in Giappone."]
        ]
    ],
    [
        "era" => "L'Era d'Oro degli Arcade e 8-bit (Anni '80)",
        "descrizione" => "Personaggi iconici, colonne sonore a 8-bit e il passaggio definitivo nelle case dei giocatori.",
        "giochi" => [
            ["titolo" => "Pac-Man", "anno" => "1980", "piattaforma" => "Arcade / Namco", "descrizione" => "L'icona pop per eccellenza che ha rivoluzionato il gaming introducendo il concetto di mascotte."],
            ["titolo" => "Super Mario Bros.", "anno" => "1985", "piattaforma" => "NES", "descrizione" => "Il capolavoro che ha stabilito i canoni moderni del genere platform e consacrato Nintendo."],
            ["titolo" => "The Legend of Zelda", "anno" => "1986", "piattaforma" => "NES", "descrizione" => "Ha introdotto il concetto di esplorazione libera e salvataggio dei progressi su cartuccia."]
        ]
    ],
    [
        "era" => "La Rivoluzione dei 16-bit (Fine '80 - Anni '90)",
        "descrizione" => "Grafica ricca di colori, sprite dettagliati e la nascita dei picchiaduro competitivi.",
        "giochi" => [
            ["titolo" => "Sonic the Hedgehog", "anno" => "1991", "piattaforma" => "Sega Mega Drive", "descrizione" => "Velocità pura e stile accattivante per la mascotte Sega che ha sfidato il dominio di Mario."],
            ["titolo" => "Street Fighter II", "anno" => "1991", "piattaforma" => "Arcade / SNES", "descrizione" => "Il padre di tutti i picchiaduro a incontri moderni, pioniere della scena competitiva."],
            ["titolo" => "Super Mario World", "anno" => "1990", "piattaforma" => "SNES", "descrizione" => "Uno dei platform 2D più perfetti di sempre, famoso per l'introduzione del dinosauro Yoshi."]
        ]
    ],
    [
        "era" => "Il Passaggio al 3D e il formato CD (Anni '90 - 2000)",
        "descrizione" => "Mondi tridimensionali, narrazione cinematografica e colonne sonore memorizzate su CD-ROM.",
        "giochi" => [
            ["titolo" => "Super Mario 64", "anno" => "1996", "piattaforma" => "Nintendo 64", "descrizione" => "La pietra miliare che ha insegnato a tutta l'industria come gestire il movimento 3D e la telecamera."],
            ["titolo" => "Final Fantasy VII", "anno" => "1997", "piattaforma" => "PlayStation", "descrizione" => "L'JRPG che ha sdoganato il genere in Occidente grazie a filmati in computer grafica e una trama epica."],
            ["titolo" => "Metal Gear Solid", "anno" => "1998", "piattaforma" => "PlayStation", "descrizione" => "Il capolavoro stealth di Hideo Kojima che ha unito il videogioco alla regia cinematografica."]
        ]
    ],
    [
        "era" => "L'Alba del Nuovo Millennio (Anno 2000)",
        "descrizione" => "L'evoluzione verso mondi aperti e meccaniche di gioco sempre più complesse.",
        "giochi" => [
            ["titolo" => "Diablo II", "anno" => "2000", "piattaforma" => "PC", "descrizione" => "Uno degli action RPG più influenti della storia, famoso per la sua atmosfera cupa e il sistema di loot."],
            ["titolo" => "The Sims", "anno" => "2000", "piattaforma" => "PC", "descrizione" => "La rivoluzione dei simulatori di vita ideata da Will Wright che ha conquistato milioni di giocatori nel mondo."]
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronologia Video Giochi - RetroGaming.it</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- NAVIGAZIONE SUPERIORE -->
    <header class="navbar">
        <div class="logo">RetroGaming.it</div>
        <nav class="nav-links">
            <a href="Home.php">Home</a>
            <a href="#">Recensioni</a>
            <a href="Console.php">Console</a>
            <a href="Video_Giochi.php" class="active">Video Giochi</a>
        </nav>
        <div class="user-info">
            <span>Ciao, <strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong>!</span>
            <a href="Logut.php" class="btn-logout">Esci</a>
        </div>
    </header>

    <!-- CONTENUTO PRINCIPALE -->
    <main class="main-container">

            <!-- BARRA DI RICERCA INTERATTIVA (AGGIUNGI QUESTO) -->
                <div class="search-container">
                 <input type="text" id="searchInput" class="search-input" placeholder="🔍 Cerca una console, un anno o un'era in tempo reale...">
                 </div>

        <h1 class="section-title">Cronologia dei Video Giochi (1972 - 2000)</h1>
        <p style="color: #aaa; margin-bottom: 30px;">I titoli leggendari che hanno segnato le varie epoche videoludiche, dalle sale giochi ai grandi classici per casa.</p>

        <div class="generazioni-container">
            <?php foreach ($era_videogiochi as $era): ?>
                <div class="gen-section">
                    <h2 class="gen-title"><?php echo htmlspecialchars($era['era']); ?></h2>
                    <p class="gen-desc"><?php echo htmlspecialchars($era['descrizione']); ?></p>
                    
                    <div class="console-grid">
                        <?php foreach ($era['giochi'] as $g): ?>
                            <div class="console-card">
                                <div class="console-header">
                                    <span class="console-year"><?php echo $g['anno']; ?></span>
                                    <span class="console-badge"><?php echo htmlspecialchars($g['piattaforma']); ?></span>
                                </div>
                                <h3><?php echo htmlspecialchars($g['titolo']); ?></h3>
                                <p><?php echo htmlspecialchars($g['descrizione']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- STRUTTURA POP-UP MODALE (AGGIUNGI QUESTO) -->
         <div id="infoModal" class="modal-overlay">
            <div class="modal-content">
                 <span class="close-modal">&times;</span>
                <h2 id="modalTitle" style="color: #00ffcc; margin-top: 0;"></h2>
                <div id="modalBody"></div>
            </div>
        </div>


    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 RetroGaming.it — Tutti i diritti riservati.</p>
    </footer>

    <script src="script.js"></script>

</body>
</html>