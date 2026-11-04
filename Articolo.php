<?php
session_start();

// Controllo sicurezza: se l'utente non è loggato, reindirizza al Login
if (!isset($_SESSION['nome'])) {
    header("Location: Login.php");
    exit();
}

// Recuperiamo l'ID dell'articolo dall'URL (es. Articolo.php?id=1)
$id_articolo = isset($_GET['id']) ? $_GET['id'] : 1;

// Simuliamo un database di articoli (in futuro potrai prelevarli da MySQL)
$articoli = [
    1 => [
        "titolo" => "Super Mario Bros: La rivoluzione delle piattaforme",
        "tag" => "Console",
        "data" => "12 Ottobre 1985 • di Redazione",
        "testo" => "Rilasciato nel 1985 per il Nintendo Entertainment System (NES), Super Mario Bros. ha ridefinito il genere dei platform. Ideato da Shigeru Miyamoto, il gioco ha introdotto meccaniche di scorrimento laterale fluide, power-up iconici come il Super Fungo e il Fiore di Fuoco, e un level design magistrale che insegnava al giocatore le regole senza bisogno di tutorial testuali.<br><br>Ha inoltre rappresentato la salvezza per l'industria dei videogiochi dopo la grande crisi del mercato americano del 1983, consacrando Nintendo come leader globale del settore e rendendo Mario l'icona immortale che conosciamo oggi."
    ],
    2 => [
        "titolo" => "Street Fighter II: L'epoca d'oro dei cabinati",
        "tag" => "Arcade",
        "data" => "08 Marzo 1991 • di Redazione",
        "testo" => "Quando Capcom lanciò Street Fighter II nelle sale giochi nel 1991, il mondo dei cabinati cambiò per sempre. Non si trattava più solo di superare punteggi contro il computer, ma di sfidare direttamente la persona seduta accanto.<br><br>Con l'introduzione di mosse speciali eseguite tramite combinazioni di comandi, un roster di lottatori provenienti da tutto il mondo (da Ryu a Chun-Li) e un sistema di combattimento profondo e bilanciato, SFII ha dato ufficialmente vita al fenomeno globale dei giochi picchiaduro, riempiendo le sale giochi di intere generazioni di appassionati."
    ],
    3 => [
        "titolo" => "Sega Mega Drive vs Super Nintendo",
        "tag" => "16-Bit",
        "data" => "15 Novembre 1992 • di Redazione",
        "testo" => "La prima grande 'Console War' della storia moderna ha visto scontrarsi due giganti assoluti dell'era dei 16-bit: da una parte il Sega Mega Drive (Genesis negli USA), aggressivo e veloce con la sua mascotte Sonic; dall'altra il Super Nintendo (SNES), forte di una palette colori superiore, un chip audio rivoluzionario e capolavori senza tempo come Super Mario World e The Legend of Zelda: A Link to the Past.<br><br>Questa rivalità feroce non solo ha spinto l'hardware e la creatività degli sviluppatori al limite, ma ha anche dato forma al marketing videoludico moderno, dividendo i giocatori in fazioni contraffatte che resistono ancora oggi nei cuori dei retro-gamer."
    ]
];

// Se l'ID richiesto non esiste, impostiamo il primo come fallback
$articoloCorrente = isset($articoli[$id_articolo]) ? $articoli[$id_articolo] : $articoli[1];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($articoloCorrente['titolo']); ?> - RetroGaming.it</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- NAVIGAZIONE SUPERIORE -->
    <header class="navbar">
        <div class="logo">RetroGaming.it</div>
        <nav class="nav-links">
            <a href="Home.php">Home</a>
            <a href="#">Recensioni</a>
            <a href="#">Console</a>
            <a href="#">Classici Arcade</a>
        </nav>
        <div class="user-info">
            <span>Ciao, <strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong>!</span>
            <a href="Logout.php" class="btn-logout">Esci</a>
        </div>
    </header>

    <!-- CONTENUTO ARTICOLO COMPLETO -->
    <main class="main-container">
        <div class="articolo-box">
            <a href="Home.php" class="back-link">&larr; Torna alla Home</a>
            <div class="card-tag" style="margin-top: 15px;"><?php echo $articoloCorrente['tag']; ?></div>
            <h1 class="articolo-titolo"><?php echo htmlspecialchars($articoloCorrente['titolo']); ?></h1>
            <p class="card-date"><?php echo $articoloCorrente['data']; ?></p>
            <div class="articolo-testo">
                <?php echo $articoloCorrente['testo']; ?>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 RetroGaming.it — Tutti i diritti riservati.</p>
    </footer>

</body>
</html>