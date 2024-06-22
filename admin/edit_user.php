<?php
include '../dist/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $profile_image = $_POST['profile_image'];

    $updateQuery = "UPDATE users SET email='$email', password='$password', role='$role', profile_image='$profile_image' WHERE id=$id";
    if ($conn->query($updateQuery) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $selectQuery = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($selectQuery);
    $row = $result->fetch_assoc();
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
<form method="POST" action="edit_user.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
    Password: <input type="password" name="password" value="<?php echo $row['password']; ?>" required><br>
    Role: <input type="text" name="role" value="<?php echo $row['role']; ?>" required><br>
    Profile Image: <input type="text" name="profile_image" value="<?php echo $row['profile_image']; ?>" required><br>
    <input type="submit" value="Update User">
</form>
</body>
</html>