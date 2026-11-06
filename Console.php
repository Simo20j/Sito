<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: Login.php");
    exit();
}

$generazioni = [
    [
        "generazione" => "Prima Generazione (1972)",
        "descrizione" => "L'alba dei videogiochi domestici, sistemi basati su circuiti analogici.",
        "console" => [
            ["nome" => "Magnavox Odyssey", "anno" => "1972", "tipo" => "Hardware analogico", "descrizione" => "La prima console per videogiochi casalinga della storia, ideata da Ralph Baer."]
        ]
    ],
    [
        "generazione" => "Seconda Generazione (1976 - 1982)",
        "descrizione" => "L'introduzione delle cartucce intercambiabili e dei microprocessori.",
        "console" => [
            ["nome" => "Atari 2600", "anno" => "1977", "tipo" => "8-bit", "descrizione" => "La console che ha reso celebre l'uso delle cartucce e ha definito un'intera epoca."]
        ]
    ],
    [
        "generazione" => "Terza Generazione (1983 - 1987) - Era 8-bit",
        "descrizione" => "Il risveglio dell'industria dopo la crisi del 1983, dominata da Nintendo e Sega.",
        "console" => [
            ["nome" => "Nintendo NES (Famicom)", "anno" => "1983", "tipo" => "8-bit", "descrizione" => "Ha salvato il mercato globale introducendo capolavori immortali come Super Mario Bros."],
            ["nome" => "Sega Master System", "anno" => "1985", "tipo" => "8-bit", "descrizione" => "La risposta diretta di Sega al dominio incontrastato del NES."]
        ]
    ],
    [
        "generazione" => "Quarta Generazione (1987 - 1993) - Era 16-bit",
        "descrizione" => "La famosissima 'Console War' tra grafica a 16-bit, colori brillanti e velocità.",
        "console" => [
            ["nome" => "NEC PC Engine (TurboGrafx-16)", "anno" => "1987", "tipo" => "16-bit", "descrizione" => "Una delle prime console a 16-bit compatta e potente."],
            ["nome" => "Sega Mega Drive (Genesis)", "anno" => "1988", "tipo" => "16-bit", "descrizione" => "Il celebre 16-bit di casa Sega reso iconico dalla velocità e da Sonic."],
            ["nome" => "Super Nintendo (SNES)", "anno" => "1990", "tipo" => "16-bit", "descrizione" => "Il capolavoro Nintendo con palette cromatica avanzata e chip sonoro rivoluzionario."]
        ]
    ],
    [
        "generazione" => "Quinta Generazione (1994 - 1998) - Era 32/64-bit e CD",
        "descrizione" => "Il passaggio epocale alla grafica tridimensionale (3D) e ai supporti in CD-ROM.",
        "console" => [
            ["nome" => "Sony PlayStation", "anno" => "1994", "tipo" => "32-bit / CD", "descrizione" => "Il debutto trionfale di Sony che ha consacrato il formato CD-ROM."],
            ["nome" => "Sega Saturn", "anno" => "1994", "tipo" => "32-bit / CD", "descrizione" => "Console focalizzata sull'eccellenza dei conversioni arcade."],
            ["nome" => "Nintendo 64", "anno" => "1996", "tipo" => "64-bit", "descrizione" => "La rivoluzione del 3D poligonale con levette analogiche e capolavori storici."]
        ]
    ],
    [
        "generazione" => "Sesta Generazione (1998 - 2000+)",
        "descrizione" => "L'era moderna del retro-gaming avanzato, con lettori DVD e connettività di rete.",
        "console" => [
            ["nome" => "Sega Dreamcast", "anno" => "1998", "tipo" => "128-bit", "descrizione" => "Pioniera del gioco online e ultima console prodotta da Sega."],
            ["nome" => "Sony PlayStation 2", "anno" => "2000", "tipo" => "128-bit / DVD", "descrizione" => "La console più venduta della storia, dotata di lettore DVD integrato."]
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronologia Console - RetroGaming.it</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- NAVIGAZIONE SUPERIORE -->
    <header class="navbar">
        <div class="logo">RetroGaming.it</div>
        <nav class="nav-links">
            <a href="Home.php">Home</a>
            <a href="Recensioni.php">Recensioni</a>
            <a href="Console.php" class="active">Console</a>
            <a href="Video_Giochi.php">Video Giochi</a>
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
    
        <h1 class="section-title">Cronologia delle Console (1972 - 2000)</h1>
        <p style="color: #aaa; margin-bottom: 30px;">Tutte le piattaforme che hanno fatto la storia, suddivise per generazioni ed ere tecnologiche.</p>

        <div class="generazioni-container">
            <?php foreach ($generazioni as $gen): ?>
                <div class="gen-section">
                    <h2 class="gen-title"><?php echo htmlspecialchars($gen['generazione']); ?></h2>
                    <p class="gen-desc"><?php echo htmlspecialchars($gen['descrizione']); ?></p>
                    
                    <div class="console-grid">
                        <?php foreach ($gen['console'] as $c): ?>
                            <div class="console-card">
                                <div class="console-header">
                                    <span class="console-year"><?php echo $c['anno']; ?></span>
                                    <span class="console-badge"><?php echo $c['tipo']; ?></span>
                                </div>
                                <h3><?php echo htmlspecialchars($c['nome']); ?></h3>
                                <p><?php echo htmlspecialchars($c['descrizione']); ?></p>
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

    <script src="Script.js"></script>                        

</body>
</html>