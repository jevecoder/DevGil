<?php
session_start();
include 'connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verifyCode'])) {
    if (!isset($_SESSION['email'])) {
        echo "<script>
                alert('Session expired. Please request a new reset code.');
                window.location.href = '/DevGil/dist/forgot_password.php';
              </script>";
        exit();
    }

    $email = $_SESSION['email'];
    $resetCode = $conn->real_escape_string($_POST['reset_code']);

    $checkCode = "SELECT * FROM users WHERE email='$email' AND reset_code='$resetCode' AND token_expiry > NOW()";
    $result = $conn->query($checkCode);

    if ($result->num_rows > 0) {
        // Code is valid, redirect to reset_password.php
        header("Location: reset_password.php");
        exit();
    } else {
        // Invalid reset code or expired
        echo "<script>
                alert('Invalid reset code or the code has expired.');
                window.location.href = '/DevGil/dist/verify_code.php';
              </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code</title>
</head>
<body>
    <h2>Verify Code</h2>
    <form method="post" action="verify_code.php">
        <input type="text" name="reset_code" placeholder="Enter the reset code" required>
        <button type="submit" name="verifyCode">Verify Code</button>
    </form>
</body>
</html>
