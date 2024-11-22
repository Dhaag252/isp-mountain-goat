<?php
// Verbind met de database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mountaingoats_support";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check of formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg de gegevens van het formulier
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $onderwerp = $_POST['onderwerp'];
    $beschrijving = $_POST['beschrijving'];

    // Voer de SQL-query uit om het ticket in te voegen
    $sql = "INSERT INTO tickets (naam, email, onderwerp, beschrijving, status) 
            VALUES ('$naam', '$email', '$onderwerp', '$beschrijving', 'open')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Ticket succesvol ingediend. <a href='index.html'>Terug naar Home</a></p>";
    } else {
        echo "<p>Fout: " . $conn->error . "</p>";
    }
}

// Sluit de databaseverbinding
$conn->close();
?>
