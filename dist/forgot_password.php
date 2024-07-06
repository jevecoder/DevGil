<?php
session_start();
include 'connection.php'; // Include your database connection file

// PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Set default timezone
date_default_timezone_set('Asia/Manila'); // Set this to your 

// Verify current time
echo "Current PHP Time: " . date('Y-m-d H:i:s') . "<br>";

// Subukan magpadala ng email
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['forgotPassword'])) {
    $email = $conn->real_escape_string($_POST['email']);

    // Check if email exists in database
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        // Generate a random token and reset code
        $token = bin2hex(random_bytes(50));
        $resetCode = generateRandomString(6); // Generate a 6-character reset code
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour

        // Update the user's record with the token, reset code, and expiry time
        $updateQuery = "UPDATE users SET reset_token='$token', reset_code='$resetCode', token_expiry='$expiry' WHERE email='$email'";
        if ($conn->query($updateQuery)) {
            // Send email with the reset code
            $subject = "Password Reset Code";
            $message = "Your password reset code is: $resetCode";

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jerillabagnoy6@gmail.com';
                $mail->Password = 'trtq tlyj ubpx antk';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('jerillabagnoy6@gmail.com', 'Jeril Gil Labagnoy');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(false);
                $mail->Subject = $subject;
                $mail->Body = $message;

                $mail->send();

                $_SESSION['email'] = $email; // Store email in session

                echo "<script>
                        alert('Password reset code sent to your email.');
                        window.location.href = '/DevGil/dist/verify_code.php';
                      </script>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "<script>
                alert('Email not found.');
                window.location.href = '/DevGil/dist/forgot_password.php';
              </script>";
    }
}

// Function to generate random string for reset code
function generateRandomString($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="post" action="forgot_password.php">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit" name="forgotPassword">Send Reset Code</button>
    </form>
</body>
</html>
