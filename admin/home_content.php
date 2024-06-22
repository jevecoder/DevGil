<?php
include '../dist/connection.php';
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
  
    // Query to retrieve user data including profile image
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $profile_image = $row['profile_image']; // Retrieve profile image from database
        // You may also retrieve other user information here like username, etc.
    }
  }
  $selectQuery = "SELECT * FROM users";
  $result = $conn->query($selectQuery);
  // creaate user
  // $insertQuery = "INSERT INTO users (email, password, role, profile_image) VALUES ('$email', '$password', '$role', '$profile_image')";
  //     if ($conn->query($insertQuery) === TRUE) {
  //         echo "New record created successfully";
  //     } else {
  //         echo "Error: " . $insertQuery . "<br>" . $conn->error;
  //     }
  

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Admin</title>
  <link rel="icon" href="../dist/public/LOGO.png" type="image/icon type">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
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
<?php
include '../admin/navigation.php';
?>
  <div class="h-screen flex flex-row flex-wrap">
  <?php
  include '../admin/sidebar.php';
  ?>

  <!-- start content -->
   <div class="bg-gray-100 flex-1 p-6">

   
      </div>

   </div>
</body>

</html>