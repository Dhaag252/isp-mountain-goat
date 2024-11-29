<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Controleer of medewerker bestaat
    $query = "SELECT * FROM medewerkers WHERE username='$username' AND password=MD5('$password')";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $_SESSION['medewerker'] = $username;
        header('Location: medewerker-dashboard.php');
        exit();
    } else {
        echo "<p>Onjuiste inloggegevens. Probeer opnieuw.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medewerker Login - Mountain Goats Support</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="container">
      <div class="logo-container">
        <img src="logo.png" alt="Mountain Goats Logo" class="logo">
      </div>
      <h1>Mountain Goats Support - Medewerker Login</h1>
      <nav class="nav">
        <a href="index.html">Home</a>
        <a href="Manuals.html">Manuals</a>
        <a href="faq.html" >FAQ</a>
        <a href="Support.html">Support</a>
        <a href="Downloads.html">Downloads</a>
      </nav>
    </div>
  </header>

  <!-- Main Section -->
  <main class="main">
    <div class="container">
      <h2>Login als Medewerker</h2>
      <form action="login.php" method="POST">
        <label for="username">Gebruikersnaam</label>
        <input type="text" id="username" name="username" placeholder="Voer je gebruikersnaam in" required>

        <label for="password">Wachtwoord</label>
        <input type="password" id="password" name="password" placeholder="Voer je wachtwoord in" required>

        <button type="submit" class="button">Inloggen</button>
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
