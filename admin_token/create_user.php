<?php
include '../dist/connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $profile_image = $_POST['profile_image'];

  $insertQuery = "INSERT INTO users (email, password, role, profile_image) VALUES ('$email', '$password', '$role', '$profile_image')";
  if ($conn->query($insertQuery) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $insertQuery . "<br>" . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="icon" href="../dist/public/LOGO.png" type="image/icon type">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Victor+Mono:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script>
    document.documentElement.classList.add('js')
  </script>
  <link href="../dist/output.css" rel="stylesheet">
  <link href="../src/input.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="../js/script.js"></script>
</head>
<body>
<form method="POST" action="create_user.php">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Role: <input type="text" name="role" required><br>
    Profile Image: <input type="text" name="profile_image" required><br>
    <input type="submit" value="Add User">
</form>
</body>
</html>