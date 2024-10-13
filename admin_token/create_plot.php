<?php
include '../dist/connection.php';
session_start();

  $target_dir = "./uploads/";
  $uploadOk = 1;
  
  // Check if directory exists, if not, create it
  if (!is_dir($target_dir)) {
      if (!mkdir($target_dir, 0777, true)) {
          die('Failed to create directories...');
      }
  }
  
  // Function to handle file upload
  function uploadFile($fileInputName, $target_dir) {
      if(isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
          $target_file = $target_dir . basename($_FILES[$fileInputName]["name"]);
          
          // Move the uploaded file to the target directory
          if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file)) {
              return basename($_FILES[$fileInputName]["name"]);
          } else {
              echo "Sorry, there was an error moving your file: " . htmlspecialchars(basename($_FILES[$fileInputName]["name"])) . ".<br>";
              return null;
          }
      } else {
          echo "No file was uploaded for " . htmlspecialchars($fileInputName) . ".<br>";
          return null;
      }
  }
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $title = $_POST['title'];
      $link = $_POST['link'];
      $plotName = $_POST['plot_name'];
      
      $profileIcon = uploadFile("profile_icon", $target_dir);
      $thumbnailImage = uploadFile("thumbnail_image", $target_dir);
  
      if ($profileIcon && $thumbnailImage) {
          // Save to database
          $plotquery = "INSERT INTO plot (title, link, plot_name, profile_icon, thumbnail_image) VALUES (?, ?, ?, ?, ?)";
          $stmt = $conn->prepare($plotquery);
          $stmt->bind_param('sssss', $title, $link, $plotName, $profileIcon, $thumbnailImage);
          
          if ($stmt->execute()) {
              echo "Data and files uploaded and saved to database successfully.";
          } else {
              echo "Error saving to database: " . $stmt->error;
          }
  
          $stmt->close();
      }
  }
  
  $conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>add plot</title>
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
include '../admin_token/navigation.php';
?>
  <div class="flex flex-row flex-wrap h-screen">
  <?php
  include '../admin_token/sidebar.php';
  ?>

  <!-- start content -->
   <div class="flex-1 p-6 bg-gray-100">
   <h2>Add New Plot</h2>
   <form action="create_plot.php" method="post" enctype="multipart/form-data">
                <label>Title:</label><br>
                <input type="text" name="title" required><br><br>

                <label>Link:</label><br>
                <input type="text" name="link" required><br><br>

                <label>Plot Name:</label><br>
                <input type="text" name="plot_name" required><br><br>

                <label>Profile Icon:</label><br>
                <input type="file" name="profile_icon" accept="image/*"><br><br>

                <label>Thumbnail Image:</label><br>
                <input type="file" name="thumbnail_image" accept="image/*"><br><br>

                <input type="submit" value="Add Plot">
            </form>
   
      </div>

   </div>
</body>

</html>