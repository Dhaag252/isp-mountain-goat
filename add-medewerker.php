<?php
// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mountaingoats_support";

// Maak de verbinding
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Voor het toevoegen van een medewerker
$wachtwoord = $_POST['wachtwoord'];

// Gebruik password_hash om het wachtwoord veilig op te slaan
$hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);

// SQL query om de medewerker toe te voegen aan de database
$sql = "INSERT INTO medewerkers (gebruikersnaam, email, wachtwoord, rol) 
        VALUES ('$gebruikersnaam', '$email', '$hashed_password', '$rol')";


// Verkrijg de gegevens uit het formulier
$gebruikersnaam = $_POST['username'];
$email = $_POST['email'];
$wachtwoord = $_POST['password']; // Zorg ervoor dat je het wachtwoord later hash't
$rol = $_POST['role'];

// Beveilig wachtwoord (gebruik password_hash om wachtwoord veilig op te slaan)
$hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);

// SQL query om de medewerker toe te voegen aan de database
$sql = "INSERT INTO medewerkers (gebruikersnaam, email, wachtwoord, rol) 
        VALUES ('$gebruikersnaam', '$email', '$hashed_password', '$rol')";

if ($conn->query($sql) === TRUE) {
    echo "Nieuwe medewerker toegevoegd.";
} else {
    echo "Fout: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
