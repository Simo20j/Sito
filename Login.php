<?php
session_start();

$host = getenv('DB_HOST') ?: 'localhost';
$db   = 'utenti';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $passwordInserita = $_POST['password'];

        $sql = "SELECT * FROM registrazioni WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $utente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utente && password_verify($passwordInserita, $utente['password'])) {
            $_SESSION['nome'] = $utente['nome'];
            $_SESSION['email'] = $utente['email'];
            header("Location: Home.php");
            exit();
        } else {
            // Reindirizza al login aggiungendo un parametro di errore nell'URL
            header("Location: Login?errore=1");
            exit();
        }
    }

} catch (PDOException $e) {
    header("Location: Login.html?errore=db");
    exit();
}
?>