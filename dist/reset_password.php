<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];
    // Validate the token and check the expiry
    $stmt = $conn->prepare("SELECT email FROM users WHERE reset_token = ? AND reset_expiry > NOW()");
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
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
            <form action="reset_password.php" method="post">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <button type="submit">Reset Password</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Invalid or expired token.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'], $_POST['new_password'])) {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE reset_token = ?");
    $stmt->bind_param('ss', $new_password, $token);
    if ($stmt->execute()) {
        echo "Your password has been reset successfully.";
    } else {
        echo "Failed to reset the password.";
    }
}
?>
