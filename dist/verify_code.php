<?php
session_start();
include 'connection.php'; // Include your database connection file

$message = ''; // Initialize an empty message variable

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

    // Query to check if the reset code is valid and not expired
    $checkCode = "SELECT * FROM users WHERE email='$email' AND reset_code='$resetCode' AND token_expiry > CURRENT_TIMESTAMP";
    
    // Execute the query
    $result = $conn->query($checkCode);

    // Check if there's an error in the query execution
    if (!$result) {
        echo "Error: " . $conn->error;
        exit(); // Add appropriate error handling logic here
    }

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Code is valid, set session variable to indicate success
        $_SESSION['reset_code_verified'] = true;
        
        // Redirect to reset password page with success message
        header("Location: reset_password.php?verified=true");
        exit();
    } else {
        // Invalid reset code or expired
        $message = "Invalid reset code or the code has expired.";
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
    <?php if (!empty($message)) : ?>
        <div style="color: red;"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="post" action="verify_code.php">
        <input type="text" name="reset_code" placeholder="Enter the reset code" required>
        <button type="submit" name="verifyCode">Verify Code</button>
    </form>
</body>
</html>
