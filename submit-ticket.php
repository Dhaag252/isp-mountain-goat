<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticket Indienen - Mountain Goats</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="container">
      <div class="logo-container">
        <img src="images/mountain-goats-logo.png" alt="Mountain Goats Logo" class="logo">
      </div>
      <h1>Mountain Goats Ticketsysteem</h1>
      <nav class="nav">
        <a href="index.html">Home</a>
        <a href="knowledgebase.html">Kennisbank</a>
        <a href="submit-ticket.php">Ticket Indienen</a>
        <a href="contact.html">Contact</a>
      </nav>
    </div>
  </header>

  <!-- Main Section -->
  <main class="main">
    <div class="container">
      <section class="ticket-form">
        <h2>Dien een Ticket In</h2>
        <!-- Formulier voor het indienen van een ticket -->
        <form action="submit-ticket.php" method="POST" class="form">
          <label for="name">Naam</label>
          <input type="text" id="name" name="name" placeholder="Voer je naam in" required>

          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" placeholder="Voer je e-mailadres in" required>

          <label for="subject">Onderwerp</label>
          <input type="text" id="subject" name="subject" placeholder="Onderwerp van je ticket" required>

          <label for="description">Beschrijving</label>
          <textarea id="description" name="description" placeholder="Geef een gedetailleerde beschrijving" rows="5" required></textarea>

          <button type="submit" class="button">Verstuur Ticket</button>
        </form>
      </section>

      <!-- Melding na succesvol ticket -->
      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          // Verwerk het formulier en geef een bevestiging weer
          echo '<section class="ticket-confirmation">';
          echo '<h3>Bedankt voor je ticket!</h3>';
          echo '<p>Je ticket is succesvol ingediend. We nemen zo snel mogelijk contact met je op.</p>';
          echo '</section>';
      }
      ?>
      
      <!-- Terug naar Home Knop -->
      <section class="back-button">
        <a href="index.html" class="button back-button">Terug naar Home</a>
      </section>

    </div>
  </main>

  
</body>
</html>
