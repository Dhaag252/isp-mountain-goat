<?php
session_start();
if (!isset($_SESSION['medewerker'])) {
    header('Location: medewerker-login.php');
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $ticket_id = intval($_GET['id']);

    // Haal ticket op
    $query = "SELECT * FROM tickets WHERE id=$ticket_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $ticket = $result->fetch_assoc();
    } else {
        echo "Ticket niet gevonden.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $medewerker_opmerking = $conn->real_escape_string($_POST['medewerker_opmerking']);

    // Update ticket
    $update_query = "UPDATE tickets SET status='$status', medewerker_opmerking='$medewerker_opmerking' WHERE id=$ticket_id";
    $conn->query($update_query);

    echo "<p>Ticket bijgewerkt!</p>";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticket Behandelen</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="header">
    <div class="container">
      <h1>Ticket Behandelen</h1>
    </div>
  </header>

  <main class="main">
    <div class="container">
      <h2>Details Ticket #<?= htmlspecialchars($ticket['id']) ?></h2>
      <p><strong>Naam:</strong> <?= htmlspecialchars($ticket['name']) ?></p>
      <p><strong>Onderwerp:</strong> <?= htmlspecialchars($ticket['subject']) ?></p>
      <p><strong>Beschrijving:</strong> <?= htmlspecialchars($ticket['description']) ?></p>

      <form method="POST">
        <label for="status">Status</label>
        <select id="status" name="status">
          <option value="Open" <?= $ticket['status'] == 'Open' ? 'selected' : '' ?>>Open</option>
          <option value="Bezig" <?= $ticket['status'] == 'Bezig' ? 'selected' : '' ?>>Bezig</option>
          <option value="Gesloten" <?= $ticket['status'] == 'Gesloten' ? 'selected' : '' ?>>Gesloten</option>
        </select>

        <label for="medewerker_opmerking">Opmerking</label>
        <textarea id="medewerker_opmerking" name="medewerker_opmerking"><?= htmlspecialchars($ticket['medewerker_opmerking']) ?></textarea>

        <button type="submit" class="button">Opslaan</button>
      </form>
    </div>
  </main>
</body>
</html>
