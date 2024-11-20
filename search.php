<?php
include 'db.php'; // Verbind met de database

if (isset($_GET['query'])) {
    $query = $_GET['query']; // Haal de zoekterm op

    // SQL-query om te zoeken in de titel en content van de artikelen
    $sql = "SELECT * FROM articles WHERE title LIKE :query OR content LIKE :query";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['query' => "%" . $query . "%"]);

    $results = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mountain Goats - Zoekresultaten</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Header -->
  <header class="header">
    <div class="container">
      <img src="Mountaingoats.png" alt="Mountain Goats Logo" class="logo">
      <h1>Mountain Goats Support</h1>
      <nav class="nav">
        <a href="index.html">Home</a>
        <a href="knowledgebase.html">Kennisbank</a>
        <a href="submit-ticket.html">Ticket Indienen</a>
        <a href="contact.html">Contact</a>

        <!-- Zoekfunctie -->
        <form class="search-form" action="search.php" method="get">
          <input 
            type="text" 
            id="search-input" 
            name="query" 
            placeholder="Zoek..." 
            class="search-input">
          <button type="submit" class="search-button">Zoeken</button>
        </form>
      </nav>
    </div>
  </header>

  <!-- Zoekresultaten -->
  <section class="search-results">
    <div class="container">
      <h2>Zoekresultaten</h2>

      <?php
        if (isset($results) && count($results) > 0) {
          foreach ($results as $result) {
            echo "<div class='result-item'>";
            echo "<h3>" . htmlspecialchars($result['title']) . "</h3>";
            echo "<p>" . nl2br(htmlspecialchars($result['content'])) . "</p>";
            echo "</div>";
          }
        } else {
          echo "<p>Geen resultaten gevonden voor de zoekterm: " . htmlspecialchars($query) . "</p>";
        }
      ?>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>&copy; 2024 Mountain Goats Support. Alle rechten voorbehouden.</p>
    </div>
  </footer>
</body>
</html>
