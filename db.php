<?php
$dsn = 'mysql:host=localhost;dbname=mountaingoats_support;charset=utf8mb4';
$username = 'root'; // Standaardgebruikersnaam voor XAMPP
$password = ''; // Laat leeg als er geen wachtwoord is ingesteld

try {
    $pdo = new PDO($dsn, $username, $password);
    // Stel foutmodushantering in
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage());
}
?>
<!-- Ticketoverzicht -->
<section class="ticket-list">
        <h2>Ingediende Tickets</h2>
        <?php
        // Databaseverbinding
        include 'db.php';

        // Query om tickets op te halen
        $sql = "SELECT * FROM tickets ORDER BY created_at DESC";
        $result = $conn->query($sql);

        // Controleer of er resultaten zijn
        if ($result->num_rows > 0) {
            // Tickets weergeven
            while ($row = $result->fetch_assoc()) {
                echo "<div class='ticket'>";
                echo "<h3>Onderwerp: " . htmlspecialchars($row['subject']) . "</h3>";
                echo "<p>Beschrijving: " . htmlspecialchars($row['description']) . "</p>";
                echo "<span>Status: " . htmlspecialchars($row['status']) . "</span>";
                echo "</div>";
            }
        } else {
            echo "<p>Er zijn nog geen tickets ingediend.</p>";
        }

        // Sluit de databaseverbinding
        $conn->close();
        ?>