<?php
session_start();
include 'connection.php'; // Include your database connection file
$to = "recipient@example.com";
$subject = "Test Email";
$message = "This is a test email.";

$headers = "From: jerillabagnoy6@gmail.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
?>
