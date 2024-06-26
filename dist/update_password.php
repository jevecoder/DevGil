<?php
session_start();
include 'connection.php'; // Include your database connection file


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resetPassword'])) {
    $token = $conn->real_escape_string($_POST['token']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords
    if ($new_password != $confirm_password) {
        echo "Passwords do not match.";
    } elseif (strlen($new_password) < 8) {
        echo "Password must be at least 8 characters long.";
    } else {
        // Hash the password
        $hashed_password = md5($new_password); // Consider using password_hash() for better security

        // Update user's password and clear the token fields
        $updatePasswordQuery = "UPDATE users SET password='$hashed_password', reset_token=NULL, token_expiry=NULL WHERE reset_token='$token'";
        if ($conn->query($updatePasswordQuery)) {
            echo "<script>alert('Password updated successfully.'); window.location.href = '/DevGil/index.php';</script>";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }
}
?>
