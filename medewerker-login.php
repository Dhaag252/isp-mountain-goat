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
