<?php
// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mountaingoats_support";  // Zorg ervoor dat dit je database naam is

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query om alle tickets op te halen
$sql = "SELECT * FROM tickets ORDER BY datum_ingediend DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medewerker Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="header">
        <div class="container">
            <h1>Mountain Goats - Medewerker Dashboard</h1>
            <nav class="nav">
                <a href="index.html">Home</a>
                <a href="submit-ticket.php">Ticket Indienen</a>
                <a href="contact.html">Contact</a>
            </nav>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <h2>Open Tickets</h2>
            <?php
            if ($result->num_rows > 0) {
                // Toon elk ticket
                while($row = $result->fetch_assoc()) {
                    echo "<div class='ticket'>";
                    echo "<h3>" . $row['onderwerp'] . "</h3>";
                    echo "<p><strong>Naam:</strong> " . $row['naam'] . "</p>";
                    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                    echo "<p><strong>Beschrijving:</strong> " . $row['beschrijving'] . "</p>";
                    echo "<p><strong>Status:</strong> " . $row['status'] . "</p>";
                    echo "<button class='button'>Behandel Ticket</button>"; // Behandelknop
                    echo "</div>";
                }
            } else {
                echo "<p>Geen open tickets.</p>";
            }
            ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Mountain Goats Support. Alle rechten voorbehouden.</p>
        </div>
    </footer>

</body>
</html>

<?php
// Sluit de verbinding
$conn->close();
?>
