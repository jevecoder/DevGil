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
    <title>User Management</title>
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

<?php
include '../admin/navigation.php';
?>
<div class="flex flex-row flex-wrap h-screen">
<?php
include '../admin/sidebar.php';
?>


 <!-- start content -->
 <div class="flex-1 p-6 bg-gray-100">

 <button type="button" class="mb-4 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"><a href="./create_user.php">create</a></button>
 <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Role
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr class='border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700'>
                            <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                " . $row["id"] . "
                            </th>
                            <td class='px-6 py-4'>
                                " . $row["email"] . "
                            </td>
                            <td class='px-6 py-4'>
                                " . $row["role"] . "
                            </td>
                            <td class='px-6 py-4'>
                                <a href='edit_user.php?id=" . $row["id"] . "' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Edit</a>
                                <a href='delete_user.php?id=" . $row["id"] . "' class='ml-4 font-medium text-red-600 dark:text-red-500 hover:underline'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr class='border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700'>
                        <td colspan='4' class='px-6 py-4 text-center'>
                            No results found.
                        </td>
                      </tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
   <!-- card 1-->



   </div>
   <!-- end content  -->
</div>
<!-- end sidebaa -->
</body>
</html>