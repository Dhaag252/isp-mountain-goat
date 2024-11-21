<?php
// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verkrijg de formuliergegevens
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Verzend de e-mail
    $to = "jouw_email@domein.com"; // Vervang door je eigen e-mailadres
    $headers = "From: " . $email;
    $email_subject = "Nieuw contactbericht: " . $subject;
    $email_message = "Naam: $name\nE-mail: $email\nOnderwerp: $subject\n\nBericht:\n$message";

    // E-mail verzenden
    if (mail($to, $email_subject, $email_message, $headers)) {
        $success_message = "Je bericht is succesvol verzonden!";
    } else {
        $error_message = "Er is een fout opgetreden bij het verzenden van je bericht. Probeer het opnieuw.";
    }
}
?>