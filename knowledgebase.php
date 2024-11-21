<?php
// Ophalen van de artikel-ID uit de URL
$article_id = $_GET['id'] ?? null;

// Controleer of er een artikel-ID is en laad het artikel
if ($article_id) {
    // Zorg ervoor dat het artikel bestend bestaat
    $article_file = "articles/{$article_id}.html"; // Zorg ervoor dat je de artikelen in de map 'articles' plaatst
    if (file_exists($article_file)) {
        $article_content = file_get_contents($article_file);
    } else {
        $article_content = "Artikel niet gevonden.";
    }
} else {
    $article_content = "Selecteer een artikel om te lezen.";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kennisbank - Mountain Goats Support</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="container">
      <div class="logo-container">
        <img src="images/mountain-goats-logo.png" alt="Mountain Goats Logo" class="logo">
      </div>
      <h1>Mountain Goats Kennisbank</h1>
      <nav class="nav">
        <a href="index.html">Home</a>
        <a href="knowledgebase.php">Kennisbank</a>
        <a href="submit-ticket.php">Ticket Indienen</a>
        <a href="contact.html">Contact</a>
      </nav>
    </div>
  </header>

  <!-- Main Section -->
  <main class="main">
    <div class="container">
      <!-- Kennisbank Artikelen Lijst -->
      <section class="article-list">
        <h2>Beschikbare Artikelen</h2>
        <ul>
          <li><a href="knowledgebase.php?id=article1">Wachtwoordproblemen</a></li>
          <li><a href="knowledgebase.php?id=article2">Account Herstellen</a></li>
          <li><a href="knowledgebase.php?id=article3">Problemen met Verbinding</a></li>
          <li><a href="knowledgebase.php?id=article4">Veelgestelde Vragen</a></li>
          <!-- Voeg hier meer artikelen toe -->
        </ul>
      </section>

      <!-- Artikel Inhoud -->
      <section class="article-content">
        <h2>Artikel Inhoud</h2>
        <div class="article-text">
          <?php echo $article_content; ?>
        </div>
      </section>
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
