<?php
session_start();
include 'connection.php'; // Include your database connection file

if (!isset($_SESSION['email'])) {
    header("Location: forgot_password.php");
    exit();
}

// Handle the password reset
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resetPassword'])) {
    $email = $_SESSION['email'];
    $newPassword = $conn->real_escape_string($_POST['new_password']);
    $confirmPassword = $conn->real_escape_string($_POST['confirm_password']);

    // Check if passwords match
    if ($newPassword !== $confirmPassword) {
        echo "<script>
                alert('Passwords do not match.');
                window.location.href = '/DevGil/dist/reset_password.php';
              </script>";
        exit();
    }

    // Hash the new password using md5
    $hashedPassword = md5($newPassword);

    // Update the user's password in the database
    $updatePassword = "UPDATE users SET password='$hashedPassword', reset_token=NULL, reset_code=NULL, token_expiry=NULL WHERE email='$email'";
    if ($conn->query($updatePassword)) {
        echo "<script>
                alert('Password has been reset successfully.');
                window.location.href = '/DevGil/index.php'; // Redirect to your desired page
              </script>";
        unset($_SESSION['email']); // Clear the email from the session after successful password change
        exit(); // Ensure no further execution after redirection
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" href="./dist/public/LOGO.png" type="image/icon type">
    <!-- Include your stylesheets and scripts here -->
</head>
<body>
    <h2>Reset Password</h2>
    <form method="post" action="reset_password.php">
        <input type="password" name="new_password" id="new_password" placeholder="Enter your new password" required onkeyup="checkPasswordStrength()"/>
        <br>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your new password" required>
        <br>
        <button type="submit" name="resetPassword">Reset Password</button>
        <!-- Password strength indicators and messages -->
    </form>
    <!-- Include your JavaScript for password strength checking -->
</body>
</html>
