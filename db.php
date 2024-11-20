<?php
$host = "localhost"; // Of de server die je gebruikt
$dbname = "mountaingoats_db"; // Je database naam
$username = "root"; // Standaard gebruikersnaam voor phpMyAdmin
$password = ""; // Standaard wachtwoord voor phpMyAdmin (meestal leeg)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Foutmeldingen
} catch (PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
}
?>
