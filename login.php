<?php
// Start de sessie
session_start();

// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mountaingoats_support";

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Foutmelding variabele
$foutmelding = "";

// Controleer of het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Controleer of de 'gebruikersnaam' en 'wachtwoord' in de POST array zitten
    if (isset($_POST['gebruikersnaam']) && isset($_POST['wachtwoord'])) {
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $wachtwoord = $_POST['wachtwoord'];

        // Query om te kijken of de gebruiker bestaat
        $sql = "SELECT * FROM medewerkers WHERE gebruikersnaam = '$gebruikersnaam'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Gebruiker gevonden
            $row = $result->fetch_assoc();
            
            // Vergelijk het ingevoerde wachtwoord met het opgeslagen wachtwoord (gehashed)
            if (password_verify($wachtwoord, $row['wachtwoord'])) {
                // Login geslaagd, sessie starten en doorsturen naar dashboard
                $_SESSION['medewerker_id'] = $row['id'];
                $_SESSION['gebruikersnaam'] = $row['gebruikersnaam'];
                header('Location: medewerker-dashboard.html');
                exit();
            } else {
                // Fout wachtwoord
                $foutmelding = "Onjuist wachtwoord.";
            }
        } else {
            // Geen gebruiker gevonden
            $foutmelding = "Onjuiste gebruikersnaam.";
        }
    } else {
        // Formulier is niet goed ingevuld
        $foutmelding = "Vul zowel gebruikersnaam als wachtwoord in.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Mountain Goats</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="container">
      <h1>Mountain Goats - Medewerker Login</h1>
      <nav class="nav">
        <a href="index.html">Home</a>
        <a href="knowledgebase.html">Kennisbank</a>
        <a href="submit-ticket.html">Ticket Indienen</a>
        <a href="contact.html">Contact</a>
        <a href="over.html">Over</a>
      </nav>
    </div>
  </header>

  <!-- Main Section -->
  <main class="main">
    <div class="container">
      <h2>Inloggen als Medewerker</h2>

      <!-- Login Formulier -->
      <form action="login.php" method="POST" class="form">
        <label for="gebruikersnaam">Gebruikersnaam</label>
        <input type="text" id="gebruikersnaam" name="gebruikersnaam" required>

        <label for="wachtwoord">Wachtwoord</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required>

        <button type="submit" class="button">Inloggen</button>

        <!-- Foutmelding -->
        <?php if (!empty($foutmelding)): ?>
            <div class="error"><?php echo $foutmelding; ?></div>
        <?php endif; ?>
      </form>
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
