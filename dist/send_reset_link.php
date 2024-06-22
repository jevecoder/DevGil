<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // Generate a random token
    $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token expires in 1 hour

    // Store the token and expiry in the database
    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE email = ?");
    $stmt->bind_param('sss', $token, $expiry, $email);
    if ($stmt->execute()) {
        // Send email with the reset link
        $reset_link = "http://yourdomain.com/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: $reset_link";
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "A password reset link has been sent to your email.";
        } else {
            echo "Failed to send the password reset link.";
        }
    } else {
        echo "Failed to process the request.";
    }
}
?>
