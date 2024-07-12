<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "devgil";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

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


// total user 
// Retrieve total number of users
$countQuery = "SELECT COUNT(*) AS total_users FROM users";
$result = $conn->query($countQuery);

$totalUsers = 0; // Default value in case the query fails
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalUsers = $row['total_users'];
}


?>
