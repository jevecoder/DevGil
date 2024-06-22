<?php
// session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bg-black">
    <h1 class="font-bold text-9xl text-black h-96 w-96">hello
        <?php
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email']; // Corrected this line
            $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"); // Corrected the table name syntax
            while ($row = mysqli_fetch_array($query)) {
                echo htmlspecialchars($row['email']); // Added htmlspecialchars for security
            }
        }
        ?>
    </h1>
</body>
</html>
