<?php
// Database verbinding
$host = 'localhost';
$dbname = 'mountaingoats_support';
$username = 'root';
$password = '';

try {
    // Maak verbinding met de database
    $conn = new mysqli($host, $username, $password, $dbname);
    
    // Controleer of de verbinding succesvol is
    if ($conn->connect_error) {
        die("Verbinding mislukt: " . $conn->connect_error);
    }

    // Haal de zoekterm op uit de URL
    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        $searchTerm = $conn->real_escape_string($searchTerm); // Veilig maken van de zoekterm

        // Zoek naar artikelen die de zoekterm bevatten
        $sql = "SELECT * FROM articles WHERE title LIKE '%$searchTerm%' OR content LIKE '%$searchTerm%' ORDER BY date_published DESC";
        $result = $conn->query($sql);
    } else {
        $result = null;
    }

    // Sluit de databaseverbinding
    $conn->close();
} catch (Exception $e) {
    echo "Fout: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoekresultaten - Mountain Goats Support</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Header -->
  <header class="header">
    <div class="container">
      <h1>Zoekresultaten voor: <?php echo htmlspecialchars($searchTerm); ?></h1>
      <nav class="nav">
        <a href="index.html">Home</a>
        <a href="knowledge.html" class="active">Kennisbank</a>
        <a href="submit-ticket.php">Ticket Indienen</a>
        <a href="contact.html">Contact</a>
      </nav>
    </div>
  </header>

  <!-- Main Section -->
  <main class="main">
    <div class="container">
      <h2>Artikelen</h2>

      <?php if ($result && $result->num_rows > 0): ?>
        <!-- Artikelen weergeven -->
        <section class="article-list">
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="article">
              <h4>
                <!-- Link naar artikel detailpagina -->
                <a href="submit-ticket.php?article_id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['title']); ?></a>
              </h4>
              <p><?php echo substr(htmlspecialchars($row['content']), 0, 150); ?>...</p>
              <a href="submit-ticket.php?article_id=<?php echo $row['id']; ?>" class="button">Stel een vraag over dit artikel</a>
            </div>
          <?php endwhile; ?>
        </section>
      <?php else: ?>
        <p>Geen artikelen gevonden die overeenkomen met "<?php echo htmlspecialchars($searchTerm); ?>".</p>
      <?php endif; ?>
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
