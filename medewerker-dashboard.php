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

// Verwerking van acties (openen, sluiten, reageren)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $ticket_id = $_POST['ticket_id'];
        $action = $_POST['action'];

        if ($action == 'open') {
            // Update ticket status naar "Open"
            $update_sql = "UPDATE tickets SET status='Open' WHERE id='$ticket_id'";
            $conn->query($update_sql);
        } elseif ($action == 'close') {
            // Update ticket status naar "Gesloten"
            $update_sql = "UPDATE tickets SET status='Gesloten' WHERE id='$ticket_id'";
            $conn->query($update_sql);
        } elseif ($action == 'reply') {
            // Voeg reactie toe aan ticket
            $reply = $_POST['reply'];
            $insert_sql = "INSERT INTO reacties (ticket_id, reactie) VALUES ('$ticket_id', '$reply')";
            $conn->query($insert_sql);
        }
    }
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
    <title>Medewerker Dashboard - Mountain Goats Support</title>
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
                <a href="logout.php" class="button nav-button">Logout</a>
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

                    // Knoppen voor acties
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='ticket_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit' name='action' value='open' class='button'>Openen</button>";
                    echo "<button type='submit' name='action' value='close' class='button'>Sluiten</button>";
                    echo "<button type='button' class='button' onclick='showReplyForm(" . $row['id'] . ")'>Reageer</button>";
                    echo "</form>";

                    // Reactieformulier (verstopt totdat de 'Reageer' knop wordt ingedrukt)
                    echo "<div id='reply-form-" . $row['id'] . "' class='reply-form' style='display:none;'>";
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='ticket_id' value='" . $row['id'] . "'>";
                    echo "<textarea name='reply' required placeholder='Voer hier je reactie in'></textarea>";
                    echo "<button type='submit' name='action' value='reply' class='button'>Reageer</button>";
                    echo "</form>";
                    echo "</div>";
                    
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

    <script>
        function showReplyForm(ticketId) {
            var replyForm = document.getElementById('reply-form-' + ticketId);
            if (replyForm.style.display === 'none') {
                replyForm.style.display = 'block';
            } else {
                replyForm.style.display = 'none';
            }
        }
    </script>

</body>
</html>

<?php
// Sluit de verbinding
$conn->close();
?>
