<?php
// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mountaingoats_support";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer of de verbinding is gelukt
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Haal het ticket-ID op uit de URL
if (isset($_GET['id'])) {
    $ticket_id = $_GET['id'];

    // Update de status van het ticket naar 'behandeld'
    $sql = "UPDATE tickets SET status='behandeld' WHERE id=$ticket_id";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Ticket succesvol behandeld. <a href='dashboard.php'>Terug naar dashboard</a></p>";
    } else {
        echo "<p>Er is een fout opgetreden bij het behandelen van het ticket: " . $conn->error . "</p>";
    }
} else {
    echo "<p>Geen ticket-ID gevonden.</p>";
}

$conn->close();
?>
