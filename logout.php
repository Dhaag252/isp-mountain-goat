<?php
// Start de sessie
session_start();

// Verwijder alle sessievariabelen
session_unset();

// Vernietig de sessie
session_destroy();

// Redirect naar de loginpagina
header("Location: medewerker-login.php");
exit();
?>
