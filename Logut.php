<?php
// Attiva il buffer di output per evitare errori di intestazione
ob_start();

session_start();
session_unset();
session_destroy();

// Reindirizza alla pagina di login (assicurati che il file si chiami Login.php o correggilo se ha un altro nome)
header("Location: Login");
exit();

ob_end_flush();
?>