<?php
include '../dist/connection.php';
session_start();

// Check if likeness ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $likeness_id = $_GET['id']; // Declare and sanitize $likeness_id here before using it

    // Fetch likeness details from database
    $query = "SELECT * FROM likeness WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $likeness_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch likeness data
        $row = $result->fetch_assoc();
        $thumbnailImage = $row['thumbnail_image']; // This should be the filename or path stored in the database
        $likenessTitle = $row['title'];
        $description = $row['description'];
    } else {
        die("Error: likeness not found for ID $likeness_id.");
    }

    $stmt->close();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $thumbnailImage = isset($_FILES['thumbnail_image']['name']) ? $_FILES['thumbnail_image']['name'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $likenessId = isset($_POST['id']) ? $_POST['id'] : '';
    
    // Validate likeness ID
    if (empty($likenessId)) {
        die("Error: likeness ID not provided. Please provide a valid likeness ID.");
    }

    // Handle file uploads for thumbnail_image
    $thumbnailImagePath = '';
    if ($thumbnailImage != '') {
        $thumbnailImageTmpName = $_FILES['thumbnail_image']['tmp_name'];
        $thumbnailImagePath = './uploads/' . basename($thumbnailImage); // Correct path
        move_uploaded_file($thumbnailImageTmpName, $thumbnailImagePath);
    }
    $likenessId = isset($_POST['id']) ? $_POST['id'] : '';
    if (!empty($likenessId)) {
        // Update existing likeness
        $query = "UPDATE likeness 
                  SET thumbnail_image = ?, title = ?, description = ?
                  WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssi', $thumbnailImage, $title, $description, $likenessId);
        $stmt->execute();
        $stmt->close();
        echo "likeness updated successfully.";
    } else {
        // Insert into database if likenessId is empty (though it should not be empty in update scenario)
        $query = "INSERT INTO likeness (thumbnail_image, title, description) 
                  VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $thumbnailImage, $title, $description, $likenessId);
        $stmt->execute();
        $stmt->close();

        echo "New likeness added successfully.";
    }

    // Redirect or display success message
    header("Location: likeness.php"); // Replace with appropriate redirect
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
  <title>add likeness</title>
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
  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>

<body class="">
<?php
include '../admin_token/navigation.php';
?>
  <div class="flex flex-row flex-wrap h-screen">
  <?php
  include '../admin_token/sidebar.php';
  ?>

  <!-- start content -->
   <div class="flex-1 p-6">
   <!-- HTML Form for editing or adding a likeness -->
<form action="edit_likeness.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
<p>Current Thumbnail Image: <?php echo isset($thumbnailImage) ? $thumbnailImage : 'No file uploaded'; ?></p>
<input type="file" name="thumbnail_image" accept="image/*">
    <input type="text" name="title" placeholder="Title" value="<?php echo isset($likenessTitle) ? htmlspecialchars($likenessTitle) : ''; ?>">
    <textarea name="description" id="description" rows="10" cols="80" placeholder="description" value="<?php echo isset($description) ? htmlspecialchars($description) : ''; ?>"></textarea>
    <!-- Display current profile_icon and thumbnail_image -->
    <input type="submit" name="submit" value="Update">
</form>
<script>
        // Replace the <textarea id="description"> with a CKEditor instance.
        CKEDITOR.replace('description');
    </script>
      </div>

   </div>
</body>

</html>