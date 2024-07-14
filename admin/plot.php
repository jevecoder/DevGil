<?php
include '../dist/connection.php';
session_start();


// Initialize variables
$plotTitle = '';
$link = '';
$plotName = '';
$profileIcon = '';
$thumbnailImage = '';

// Check if plot ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $plot_id = $_GET['id']; // Sanitize $plot_id here if needed

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
        $profileIcon = $row['profile_icon']; // Ensure this is the correct column name from your database
        $thumbnailImage = $row['thumbnail_image']; // Ensure this is the correct column name from your database
    } else {
        die("Error: Plot not found for ID $plot_id.");
    }

    $stmt->close();
}

// Check if form is submitted for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete']) && $_POST['delete'] == 'delete') {
        $plotId = isset($_POST['id']) ? $_POST['id'] : '';

        // Delete plot from database
        $query = "DELETE FROM plot WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $plotId);
        $stmt->execute();
        $stmt->close();

        // Redirect to plot list or wherever appropriate
        header("Location: plot.php"); // Replace with appropriate redirect
        exit();
    }
}
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
     <a href="create_plot.php">
     <div class="mb-5 button_slide slide_right">Create Plot</div>
    </a>
  <style>
    .button_slide {
  color: #000;
  border-radius: 0px;
  padding: 10px;
  display: inline-block;
  font-family: "Lucida Console", Monaco, monospace;
  font-size: 14px;
  letter-spacing: 1px;
  cursor: pointer;
  box-shadow: inset 0 0 0 0 #000;
  -webkit-transition: ease-out 0.4s;
  -moz-transition: ease-out 0.4s;
  transition: ease-out 2s;
}

.slide_right:hover {
  box-shadow: inset 400px 0 0 0 #000;
  color:aliceblue
}

  </style>
   <div class="grid gap-8 lg:gap-16 sm:grid-rows-2 md:grid-cols-3 lg:grid-cols-4 sm:place-items-center">

           <?php
            // Query to retrieve plot data
$query = "SELECT * FROM plot";
$result = $conn->query($query);

// Display data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
           echo"
          <div class='text-center text-white'>
          
            <div class='main'>
                <!-- image   -->
               
            <div class='bg-cover cardp' style='background-image: url(\"./uploads/" . htmlspecialchars($row['thumbnail_image']) . "\")'>
                <div class='fl'>
                  <div class='fullscreen'>
                    <svg viewBox='0 0 100 100' class='fullscreen_svg'>
                      <path d='M3.563-.004a3.573 3.573 0 0 0-3.527 4.09l-.004-.02v28.141c0 1.973 1.602 3.57 3.57 3.57s3.57-1.598 3.57-3.57V12.218v.004l22.461 22.461a3.571 3.571 0 0 0 6.093-2.527c0-.988-.398-1.879-1.047-2.523L12.218 7.172h19.989c1.973 0 3.57-1.602 3.57-3.57s-1.598-3.57-3.57-3.57H4.035a3.008 3.008 0 0 0-.473-.035zM96.333 0l-.398.035.02-.004h-28.16a3.569 3.569 0 0 0-3.57 3.57 3.569 3.569 0 0 0 3.57 3.57h19.989L65.323 29.632a3.555 3.555 0 0 0-1.047 2.523 3.571 3.571 0 0 0 6.093 2.527L92.83 12.221v19.985a3.569 3.569 0 0 0 3.57 3.57 3.569 3.569 0 0 0 3.57-3.57V4.034v.004a3.569 3.569 0 0 0-3.539-4.043l-.105.004zM3.548 64.23A3.573 3.573 0 0 0 .029 67.8v28.626-.004l.016.305-.004-.016.004.059v-.012l.039.289-.004-.023.023.121-.004-.023c.074.348.191.656.34.938l-.008-.02.055.098-.008-.02.148.242-.008-.012.055.082-.008-.012c.199.285.43.531.688.742l.008.008.031.027.004.004c.582.461 1.32.742 2.121.762h.004l.078.004h28.61a3.569 3.569 0 0 0 3.57-3.57 3.569 3.569 0 0 0-3.57-3.57H12.224l22.461-22.461a3.569 3.569 0 0 0-2.492-6.125l-.105.004h.008a3.562 3.562 0 0 0-2.453 1.074L7.182 87.778V67.793a3.571 3.571 0 0 0-3.57-3.57h-.055.004zm92.805 0a3.573 3.573 0 0 0-3.519 3.57v19.993-.004L70.373 65.328a3.553 3.553 0 0 0-2.559-1.082h-.004a3.573 3.573 0 0 0-3.566 3.57c0 1.004.414 1.91 1.082 2.555l22.461 22.461H67.802a3.57 3.57 0 1 0 0 7.14h28.606c.375 0 .742-.059 1.082-.168l-.023.008.027-.012-.02.008.352-.129-.023.008.039-.02-.02.008.32-.156-.02.008.023-.016-.008.008c.184-.102.34-.207.488-.32l-.008.008.137-.113-.008.004.223-.211.008-.008c.156-.164.301-.34.422-.535l.008-.016-.008.016.008-.02.164-.285.008-.02-.008.016.008-.02c.098-.188.184-.406.246-.633l.008-.023-.004.008.008-.023a3.44 3.44 0 0 0 .121-.852v-.004l.004-.078V67.804a3.569 3.569 0 0 0-3.57-3.57h-.055.004z'></path>
                    </svg>
                  </div>
                </div>
                <div class='card_content'>
                  <label class='switch_738'>
                    <input type='checkbox' class='chk_738'>
                    <!-- <span class='slider_738'></span> -->
                  </label>
                </div>
                <div class='card_back'></div>
            </div>
      
            <!-- image  -->
              <div class='data'>
                <div class='img'>
                  <div class='bg-cover cardp' style='background-image: url(\"./uploads/" . htmlspecialchars($row['profile_icon']) . "\")'></div>
                </div>
                <div class='overflow-hidden w-44 textp text-clip'>
                <div class='text_m'>" . htmlspecialchars($row['title']) . "</div>
                <div class='text_s'><a href='" . htmlspecialchars($row['link']) . "' target='_blank' class='text-white hover:text-black'>" . htmlspecialchars($row['link']) . "</a></div>
                </div>
              </div>
              <div class='btns'>
                <!-- <div class='likes'>
                  <svg class='likes_svg' viewBox='-2 0 105 92'>
                    <path d='M85.24 2.67C72.29-3.08 55.75 2.67 50 14.9 44.25 2 27-3.8 14.76 2.67 1.1 9.14-5.37 25 5.42 44.38 13.33 58 27 68.11 50 86.81 73.73 68.11 87.39 58 94.58 44.38c10.79-18.7 4.32-35.24-9.34-41.71Z'></path>
                  </svg><span class='likes_text'>22</span>
                </div>
                <div class='comments'>
                  <svg class='comments_svg' viewBox='-405.9 238 56.3 54.8' title='Comment'>
                    <path d='M-391 291.4c0 1.5 1.2 1.7 1.9 1.2 1.8-1.6 15.9-14.6 15.9-14.6h19.3c3.8 0 4.4-.8 4.4-4.5v-31.1c0-3.7-.8-4.5-4.4-4.5h-47.4c-3.6 0-4.4.9-4.4 4.5v31.1c0 3.7.7 4.4 4.4 4.4h10.4v13.5z'></path>
                  </svg><span class='comments_text'>12</span>
                </div> -->
                <a class='views' href='edit_plot.php?id=" . $row['id'] . "'>Edit</a>
                <button type='button' class='views delete-button' data-id='" . $row['id'] . "'>Delete</button>
                <div class='views'>
                  <svg class='views_svg' viewBox='0 0 30.5 16.5' title='Views'>
                    <path d='M15.3 0C8.9 0 3.3 3.3 0 8.3c3.3 5 8.9 8.3 15.3 8.3s12-3.3 15.3-8.3C27.3 3.3 21.7 0 15.3 0zm0 14.5c-3.4 0-6.2-2.8-6.2-6.2C9 4.8 11.8 2 15.3 2c3.4 0 6.2 2.8 6.2 6.2 0 3.5-2.8 6.3-6.2 6.3z'></path>
                  </svg><span class='views_text'>332</span>
                </div>
              </div>
            </div>
          </div>
          ";
        }
    } else {
      echo "<div class='flex items-center justify-center text-xl font-normal text-black'>No Plots Found!</div>";
    }
    
    $conn->close();
    ?>
<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-full h-full bg-gray-200 bg-opacity-50">
        <div class="max-w-md p-8 bg-white rounded-md shadow-md">
            <p class="mb-4 text-lg font-bold">Are you sure you want to delete this plot?</p>
            <div class="flex justify-end">
                <form id="deleteForm" action="plot.php" method="POST">
                    <input type="hidden" name="id" id="plotIdInput" value="">
                    <input type="hidden" name="delete" value="delete">
                    <button type="submit" class="px-4 py-2 mr-2 text-white bg-red-500 rounded-md">Yes, Delete</button>
                    <button type="button" id="closeModal" class="px-4 py-2 text-gray-800 bg-gray-300 rounded-md">Cancel</button>
                </form>
            </div>
        </div>
    </div>


<script>
        // Modal script to show/hide delete confirmation
        const deleteButtons = document.querySelectorAll('.delete-button');
        const deleteModal = document.getElementById('deleteModal');
        const closeModal = document.getElementById('closeModal');
        const plotIdInput = document.getElementById('plotIdInput');
        const deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const plotId = button.getAttribute('data-id');
                plotIdInput.value = plotId;
                deleteModal.classList.remove('hidden');
            });
        });

        closeModal.addEventListener('click', () => {
            deleteModal.classList.add('hidden');
        });
    </script>

   </div>


   
      </div>

   </div>
</body>

</html>