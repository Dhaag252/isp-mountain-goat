<?php
// Start de sessie om in te loggen
session_start();

// Verbinding met de database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mountaingoats_support";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer of de verbinding is gelukt
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Controleer of de medewerker is ingelogd
if (!isset($_SESSION['medewerker_logged_in'])) {
    header("Location: medewerker-login.html"); // Als niet ingelogd, doorverwijzen naar de loginpagina
    exit();
}

// Haal alle open tickets op
$sql = "SELECT * FROM tickets WHERE status = 'open' ORDER BY datum DESC";
$result = $conn->query($sql);

// Begin de HTML-output
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

  <!-- Header -->
  <header class="header">
    <div class="container">
      <div class="logo-container">
        <img src="logo.png" alt="Mountain Goats Logo" class="logo">
      </div>
      <h1>Medewerker Dashboard</h1>
      <nav class="nav">
        <a href="index.html">Home</a>
        <a href="knowledgebase.html">Kennisbank</a>
        <a href="submit-ticket.html">Ticket Indienen</a>
        <a href="contact.html">Contact</a>
        <a href="over.html">Over</a>
        <a href="logout.php">Uitloggen</a> <!-- Uitloggen knop -->
      </nav>
    </div>
  </header>

  <!-- Main Section -->
  <main class="main">
    <div class="container">
      <h2>Open Tickets</h2>

      <?php
      if ($result->num_rows > 0) {
          // Output tickets
          echo "<table>
                <tr>
                    <th>Ticket ID</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Onderwerp</th>
                    <th>Beschrijving</th>
                    <th>Datum</th>
                    <th>Status</th>
                    <th>Acties</th>
                </tr>";
          while($row = $result->fetch_assoc()) {
              echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['naam'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['onderwerp'] . "</td>
                    <td>" . $row['beschrijving'] . "</td>
                    <td>" . $row['datum'] . "</td>
                    <td>" . $row['status'] . "</td>
                    <td><a href='behandel-ticket.php?id=" . $row['id'] . "'>Behandelen</a></td>
                    </tr>";
          }
          echo "</table>";
      } else {
          echo "<p>Er zijn geen open tickets.</p>";
      }
      ?>

    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>&copy; 2024 Mountain Goats Support. Alle rechten voorbehouden.</p>
    </div>
  </footer>

</body>
</html>

<?php
// Sluit de databaseverbinding
$conn->close();
?>
