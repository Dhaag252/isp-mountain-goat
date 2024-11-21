<?php
// Haal het artikel ID op uit de URL
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];
} else {
    echo "Geen artikel gevonden.";
    exit;
}

// Databaseverbinding
$host = 'localhost';
$dbname = 'mountaingoats_support';
$username = 'root';
$password = '';

try {
    // Maak verbinding met de database
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Verbinding mislukt: " . $conn->connect_error);
    }

    // Haal het specifieke artikel op uit de database
    $sql = "SELECT * FROM articles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $article_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();
    
    // Als het artikel niet bestaat
    if (!$article) {
        echo "Artikel niet gevonden.";
        exit;
    }
} catch (Exception $e) {
    echo "Fout: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> - Mountain Goats</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="header">
    <div class="container">
      <h1>Mountain Goats Kennisbank</h1>
      <nav class="nav">
        <a href="index.html">Home</a>
        <a href="knowledge.php">Kennisbank</a>
        <a href="submit-ticket.php">Ticket Indienen</a>
        <a href="contact.html">Contact</a>
      </nav>
    </div>
  </header>

  <main class="main">
    <div class="container">
      <h2><?php echo htmlspecialchars($article['title']); ?></h2>
      <p><em>Geplaatst op: <?php echo $article['date_published']; ?></em></p>
      <div class="article-content">
        <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
      </div>
      <a href="knowledge.php" class="button">Terug naar Kennisbank</a>
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
