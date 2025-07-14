<?php
// db.php — Connexion à la base MySQL avec PDO

$host = 'localhost';         
$dbname = 'microenseignement'; 
$username = 'root';         
$password = '';             

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Active les erreurs PDO sous forme d'exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
