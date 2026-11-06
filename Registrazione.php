<?php
// Dati di connessione al database locale
$host = getenv('DB_HOST') ?: 'localhost';
$db   = 'utenti';     // Nome del tuo database
$user = 'root';
$pass = '';

try {
    // Connessione al database tramite PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Controlla se la pagina è stata aperta inviando il form tramite POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Recupera i dati inviati dal form \
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $passwordInChiaro = $_POST['password'];

        // Cifriamo la password per sicurezza (mai salvarla in chiaro nel DB!)
        $passwordCifrata = password_hash($passwordInChiaro, PASSWORD_DEFAULT);

        // Query SQL con i segnaposto corretti
        $sql = "INSERT INTO registrazioni (nome, cognome, email, password) VALUES (:nome, :cognome, :email, :password)";
        
        $stmt = $pdo->prepare($sql);
        
        // Esegue la query passando i dati
        $stmt->execute([
            'nome' => $nome,
            'cognome' => $cognome,
            'email' => $email,
            'password' => $passwordCifrata
        ]);

    // Se tutto va bene, reindirizza con successo=1
        header("Location: Registrazione.html?successo=1");
        exit();

    }

} catch (PDOException $e) {
    // Gestione degli errori (es. email già duplicata)
if ($e->getCode() == 23000) {
    header("Location: Registrazione.html?errore=esistente");
    exit();
} else {
    header("Location: Registrazione.html?errore=db");
    exit();
}
}
?>