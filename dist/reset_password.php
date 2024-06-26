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
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT); // Hash the new password

    // Update the user's password in the database
    $updatePassword = "UPDATE users SET password='$hashedPassword', reset_token=NULL, reset_code=NULL, token_expiry=NULL WHERE email='$email'";
    if ($conn->query($updatePassword)) {
        echo "<script>
                alert('Password has been reset successfully.');
                window.location.href = '/DevGil/dist/login.php';
              </script>";
        unset($_SESSION['email']); // Clear the email from the session
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
</head>
<body>
    <h2>Reset Password</h2>
    <form method="post" action="reset_password.php">
        <input type="password" name="new_password" placeholder="Enter your new password" required>
        <button type="submit" name="resetPassword">Reset Password</button>
    </form>
</body>
</html>
