<?php
include '../dist/connection.php';
session_start();

// Check if plot ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $plot_id = $_GET['id']; // Declare and sanitize $plot_id here before using it

    // Fetch plot details from database
    $query = "SELECT * FROM plot WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $plot_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch plot data
        $row = $result->fetch_assoc();
        $plotTitle = $row['title'];
        $link = $row['link'];
        $plotName = $row['plot_name'];
        $profileIcon = $row['profile_icon']; // This should be the filename or path stored in the database
        $thumbnailImage = $row['thumbnail_image']; // This should be the filename or path stored in the database
    } else {
        die("Error: Plot not found for ID $plot_id.");
    }

    $stmt->close();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $link = isset($_POST['link']) ? $_POST['link'] : '';
    $plotName = isset($_POST['plot_name']) ? $_POST['plot_name'] : '';
    $profileIcon = isset($_FILES['profile_icon']['name']) ? $_FILES['profile_icon']['name'] : '';
    $thumbnailImage = isset($_FILES['thumbnail_image']['name']) ? $_FILES['thumbnail_image']['name'] : '';
    $plotId = isset($_POST['id']) ? $_POST['id'] : '';
    
    // Validate plot ID
    if (empty($plotId)) {
        die("Error: Plot ID not provided. Please provide a valid plot ID.");
    }

    // Handle file uploads for profile_icon
    $profileIconPath = '';
    if ($profileIcon != '') {
        $profileIconTmpName = $_FILES['profile_icon']['tmp_name'];
        $profileIconPath = './uploads/' . $profileIcon;
        move_uploaded_file($profileIconTmpName, $profileIconPath);
    }

    // Handle file uploads for thumbnail_image
    $thumbnailImagePath = '';
    if ($thumbnailImage != '') {
        $thumbnailImageTmpName = $_FILES['thumbnail_image']['tmp_name'];
        $thumbnailImagePath = './uploads/' . basename($thumbnailImage); // Correct path
        move_uploaded_file($thumbnailImageTmpName, $thumbnailImagePath);
    }
    $plotId = isset($_POST['id']) ? $_POST['id'] : '';
    if (!empty($plotId)) {
        // Update existing plot
        $query = "UPDATE plot 
                  SET title = ?, link = ?, plot_name = ?, profile_icon = ?, thumbnail_image = ?
                  WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssi', $title, $link, $plotName, $profileIcon, $thumbnailImage, $plotId);
        $stmt->execute();
        $stmt->close();
        echo "Plot updated successfully.";
    } else {
        // Insert into database if plotId is empty (though it should not be empty in update scenario)
        $query = "INSERT INTO plot (title, link, plot_name, profile_icon, thumbnail_image) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $title, $link, $plotName, $profileIconPath, $thumbnailImagePath);
        $stmt->execute();
        $stmt->close();

        echo "New plot added successfully.";
    }

    // Redirect or display success message
    header("Location: plot.php"); // Replace with appropriate redirect
    exit();
}

// Close database connection
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
  <link href="../dist/src/input.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="../js/script.js"></script>
</head>

<body class="">
<?php
include '../admin/navigation.php';
?>
  <div class="flex flex-row flex-wrap h-screen">
  <?php
  include '../admin/sidebar.php';
  ?>

  <!-- start content -->
   <div class="flex-1 p-6">
   <!-- HTML Form for editing or adding a plot -->
<form action="edit_plot.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    <input type="text" name="title" placeholder="Title" value="<?php echo isset($plotTitle) ? htmlspecialchars($plotTitle) : ''; ?>">
    <input type="text" name="link" placeholder="Link" value="<?php echo isset($link) ? htmlspecialchars($link) : ''; ?>">
    <input type="text" name="plot_name" placeholder="Plot Name" value="<?php echo isset($plotName) ? htmlspecialchars($plotName) : ''; ?>">
    <!-- Display current profile_icon and thumbnail_image -->
    <p>Current Profile Icon: <?php echo isset($profileIcon) ? $profileIcon : 'No file uploaded'; ?></p>
    <input type="file" name="profile_icon" accept="image/*">
    <p>Current Thumbnail Image: <?php echo isset($thumbnailImage) ? $thumbnailImage : 'No file uploaded'; ?></p>
    <input type="file" name="thumbnail_image" accept="image/*">
    <input type="submit" name="submit" value="Update">
</form>
      </div>

   </div>
</body>

</html>