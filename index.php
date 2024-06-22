<?php
session_start();
include './dist/connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Devgil</title>
  <link rel="icon" href="./dist/public/LOGO.png" type="image/icon type">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Victor+Mono:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script>
    document.documentElement.classList.add('js')
  </script>
  <link href="./dist/output.css" rel="stylesheet">
  <link href="./src/input.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="./js/script.js"></script>
  <style>
    /* modal validation  */
    .modalv {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modalv-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 500px;
      text-align: center;
    }

    .closev {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .closev:hover,
    .closev:focus {
      text-decoration: none;
      cursor: pointer;
    }
  </style>

</head>

<body class="relative h-full bg-gray-100">
  <!-- Hidden modal dialog -->
  <div id="myModalv" class="modalv">
    <div class="rounded-lg shadow-xl modalv-content">
      <!-- <span class="closev">&times;</span> -->
      <div class="px-4 pt-2 pb-2 bg-white sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
            <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
          </div>
          <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Alert!</h3>
            <div class="mt-2">
              <p id="modalvMessage" class="text-sm text-gray-500"></p>
            </div>
          </div>
        </div>
      </div>
      <div class=" sm:flex sm:flex-row-reverse sm:px-6">
        <button type="button" class="inline-flex justify-center w-full px-3 py-2 text-sm font-semibold text-white bg-red-600 rounded-md shadow-sm closev hover:bg-red-500 sm:ml-3 sm:w-auto">Confirm</button>
      </div>

    </div>
  </div>
  <?php
// Assuming $conn is your database connection

$message = ""; // Initialize message variable
$redirectUrl = "/DevGil/index.php"; // Default redirect URL

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signUp'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } elseif ($password != $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        // Check if email already exists in database
        $checkEmail = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($checkEmail);

        if ($result->num_rows > 0) {
            $message = "Email Address Already Exists!";
        } else {
            // Process file upload if $_FILES['profile_image'] is set and valid
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK && isset($_FILES['profile_image']['tmp_name'])) {
                $profile_image = file_get_contents($_FILES['profile_image']['tmp_name']);

                // Check if the uploaded file is an image
                $mime_type = mime_content_type($_FILES['profile_image']['tmp_name']);
                if (strpos($mime_type, 'image') === false) {
                    $message = "Uploaded file is not an image.";
                    echo $_FILES['profile_image']['error']; // Output the error code
echo $_FILES['profile_image']['tmp_name']; // Output the temporary file name
echo $_FILES['profile_image']['name']; // Output the original file name
echo $_FILES['profile_image']['size']; // Output the file size

                } else {
                    $profile_image = $conn->real_escape_string($profile_image);

                    // Insert into database including profile image
                    $password = md5($password); // Consider using a more secure hashing method like password_hash()
                    $role = 'user'; // Default role is user

                    $insertQuery = "INSERT INTO users (email, password, role, profile_image) VALUES ('$email', '$password', '$role', '$profile_image')";
                    if ($conn->query($insertQuery) === TRUE) {
                        $message = "User registered successfully.";
                    } else {
                        $message = "Error: " . $conn->error;
                    }
                }
            } else {
                $message = "Failed to upload profile image.";
            }
        }
    }
}

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role']; // Save role in session

        // Example: Display profile image after login
    // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['profile_image']) . '" alt="Profile Image">';

        if ($row['role'] == 'admin') {
            $message = "Admin login successful.";
            $redirectUrl = "/DevGil/admin/admin_dashboard.php"; // Admin dashboard
        } else {
            $message = "User login successful.";
            $redirectUrl = "/DevGil/index.php"; // User home
        }
    } else {
        $message = "Incorrect email or password.";
        $redirectUrl = "/DevGil/index.php"; // Redirect to index by default on error
    }
    // JavaScript to show modal dialog with message and redirect
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalv = document.getElementById('myModalv');
        var modalvMessage = document.getElementById('modalvMessage');
        var closevBtn = document.getElementsByClassName('closev')[0];

        modalv.style.display = 'block';
        modalvMessage.innerText = '$message';

        closevBtn.onclick = function() {
            modalv.style.display = 'none';
            window.location.href = '$redirectUrl'; // Redirect based on role
        }

        window.onclick = function(event) {
            if (event.target == modalv) {
                modalv.style.display = 'none';
                window.location.href = '$redirectUrl'; // Redirect based on role
            }
        }
    });
</script>";

}


?>


  <!-- home page -->
  <div>
    <div class="fixed inset-0 z-50 w-full h-full loader opacity-90">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 66 66" height="100px" width="100px" class="spinner">
        <circle stroke="url(#gradient)" r="20" cy="33" cx="33" stroke-width="1" fill="transparent" class="path"></circle>
        <linearGradient id="gradient">
          <stop stop-opacity="1" stop-color="#fe0000" offset="0%"></stop>
          <stop stop-opacity="0" stop-color="#af3dff" offset="100%"></stop>
        </linearGradient>
      </svg>
    </div>
  </div>

  <script>
    window.addEventListener('load', function() {
      // Kunin ang element ng loader
      var loader = document.querySelector('.loader');

      // Itago ang loader pagkatapos ng page load
      loader.style.display = 'none';
    });
  </script>
  <!-- message -->
  <button class="fixed z-10 inline-flex items-center justify-center p-0 m-0 text-sm font-medium leading-5 normal-case bg-red-900 rounded-full opacity-50 cursor-pointer message bottom-4 left-4 disabled:pointer-events-none disabled:opacity-50 w-9 h-9 hover:bg-red-500 bg-none hover:text-gray-900" type="button" aria-haspopup="dialog" aria-expanded="false" data-state="closed">
    <svg xmlns=" http://www.w3.org/2000/svg" width="20" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="block text-white align-middle border-gray-200">
      <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" class="border-gray-200">
      </path>
    </svg>
  </button>

  <div class="h-full">
    <div class="fixed z-10 flex flex-row items-end justify-end h-full gap-4 bottom-4 right-7">
      <!-- Facebook -->
      <a href="#" title="Share on Facebook">
        <svg class="text-white opacity-50 fill-red-900 hover:opacity-100" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 50 50">
          <path d="M25,2C12.318,2,2,12.317,2,25s10.318,23,23,23c12.683,0,23-10.317,23-23S37.683,2,25,2z M32,16h-3.29 C26.772,16,26,16.455,26,17.806V21h6l-1,5h-5v13h-6V26h-3v-5h3v-2.774C20,14.001,21.686,11,26.581,11C29.203,11,32,12,32,12V16z">
          </path>
        </svg>
      </a>

      <!-- WhatsApp -->
      <a href="#" title="Share on WhatsApp">
        <svg class="opacity-50 fill-red-900 hover:opacity-100" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 50 50">
          <path d="M25,2C12.318,2,2,12.318,2,25c0,3.96,1.023,7.854,2.963,11.29L2.037,46.73c-0.096,0.343-0.003,0.711,0.245,0.966 C2.473,47.893,2.733,48,3,48c0.08,0,0.161-0.01,0.24-0.029l10.896-2.699C17.463,47.058,21.21,48,25,48c12.682,0,23-10.318,23-23 S37.682,2,25,2z M36.57,33.116c-0.492,1.362-2.852,2.605-3.986,2.772c-1.018,0.149-2.306,0.213-3.72-0.231 c-0.857-0.27-1.957-0.628-3.366-1.229c-5.923-2.526-9.791-8.415-10.087-8.804C15.116,25.235,13,22.463,13,19.594 s1.525-4.28,2.067-4.864c0.542-0.584,1.181-0.73,1.575-0.73s0.787,0.005,1.132,0.021c0.363,0.018,0.85-0.137,1.329,1.001 c0.492,1.168,1.673,4.037,1.819,4.33c0.148,0.292,0.246,0.633,0.05,1.022c-0.196,0.389-0.294,0.632-0.59,0.973 s-0.62,0.76-0.886,1.022c-0.296,0.291-0.603,0.606-0.259,1.19c0.344,0.584,1.529,2.493,3.285,4.039 c2.255,1.986,4.158,2.602,4.748,2.894c0.59,0.292,0.935,0.243,1.279-0.146c0.344-0.39,1.476-1.703,1.869-2.286 s0.787-0.487,1.329-0.292c0.542,0.194,3.445,1.604,4.035,1.896c0.59,0.292,0.984,0.438,1.132,0.681 C37.062,30.587,37.062,31.755,36.57,33.116z">
          </path>
        </svg>
      </a>
    </div>
  </div>


  <nav class="fixed top-0 left-0 z-20 w-full bg-white border-b border-gray-300 shadow-xl">
    <div class="relative flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
      <a href="" class="flex items-center">
        <img src="./dist/public/LOGO.png" class="absolute w-24 h-24" alt="Flowbite Logo">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"></span>
      </a>
      <!-- Mobile Navigation Button -->
      <button id="mobileMenuButton" class="md:hidden" onclick="toggleMobileMenu()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
        <ul class="flex flex-col p-4 mt-4 font-medium border rounded-lg md:p-0 md:flex-row md:space-x-8 md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <!-- Navigation Links -->
          <li class="hover:text-[#ff3939] text-sm text-gray-800 font-semibold">
            <a href="#home">Home</a>
          </li>
          <li class="hover:text-[#ff3939] text-sm text-gray-800 font-semibold">
            <a href="#about">About</a>
          </li>
          <li class="hover:text-[#ff3939] text-sm text-gray-800 font-semibold">
            <a href="#projects">Projects</a>
          </li>
          <li class="hover:text-[#ff3939] text-sm text-gray-800 font-semibold">
            <a href="#contact">Contact</a>
          </li>
          <li class="hover:text-[#ff3939] text-sm text-gray-800 font-semibold">
            <a href="#contact">Certificate</a>
          </li>
          <li class="hover:text-[#ff3939] text-sm text-gray-800 font-semibold">
            <?php
            if (isset($_SESSION['email'])) {
              $email = $_SESSION['email']; // Corrected this line
              $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"); // Corrected the table name syntax
              while ($row = mysqli_fetch_array($query)) {
                echo htmlspecialchars($row['email']); // Added htmlspecialchars for security
              }
            }
            ?>
            <!-- <a href="./dist/logout.php" class="text-xl font-bold text-white">Logout</a> -->
          </li>
          <li class="hover:text-[#ff3939] text-sm text-gray-800 font-semibold">
          <?php
          if (isset($_SESSION['role']) == 'admin') {
            echo '<a href="./admin/admin_dashboard.php">Dashboard</a>';
          } else {
            echo '';
          }
          ?>
          </li>
        </ul>

      </div>
      <!-- Modal Trigger Button -->
      <div class="hidden md:flex md:order-2">
        <button id="buttonlogin">
          <?php
          if (isset($_SESSION['email'])) {
            echo '<a href="./dist/logout.php" class="p-12 text-sm font-semibold text-gray-800">Logout</a>';
          } else {
            echo '<p class="text-sm font-semibold text-gray-800">Admin</p>';
          }
          ?>
        </button>
      </div>

      <!-- Login Modal -->
      <div id="loginModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 modal-overlay"></div>

        <div class="modal-container bg-white rounded h-[486px] w-[1000px] shadow-lg z-50 ">
          <!-- Add your modal content here -->



          <div class="grid justify-center grid-cols-3 overflow-hidden">
            <div class="hidden h-full bg-cover lg:block lg:w-11/12" style="background-image:url('./dist/public/login-side.png')">
            </div>

            <!-- sign in -->
            <div class="container col-span-2" id="container">
              <div class="form-container sign-up-container">
                <form class="slides" action="" method="post" enctype="multipart/form-data">
                  <h1>Create Account</h1>
                  <label for="profile_image">Profile Image:</label>
  <input type="file" id="profile_image" name="profile_image" accept="image/*" required>
                  <div class="mt-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700">Email Address</label>
                    <input class="block w-full px-4 py-2 text-gray-700 bg-gray-200 border border-gray-300 rounded appearance-none focus:outline-none focus:shadow-outline" type="email" name="email" required />
                  </div>
                  <div class="mt-4">
                    <div class="flex justify-center">
                      <label class="block mb-2 text-sm font-bold text-gray-700">Password</label>
                    </div>
                    <input class="block w-full px-4 py-2 text-gray-700 bg-gray-200 border border-gray-300 rounded appearance-none focus:outline-none focus:shadow-outline" type="password" name="password" required />
                  </div>
                  <div class="mt-4">
                    <div class="flex justify-center">
                      <label class="block mb-2 text-sm font-bold text-gray-700">Confirm Password</label>
                    </div>
                    <input class="block w-full px-4 py-2 text-gray-700 bg-gray-200 border border-gray-300 rounded appearance-none focus:outline-none focus:shadow-outline" type="password" name="confirm_password" required />
                  </div>
                  <div class="flex items-start mt-3">
                    <div class="flex items-center h-5">
                      <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 bg-gray-100 border border-gray-900 rounded focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                    </div>
                    <div class="ml-3 text-xs">
                      <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                    </div>
                  </div>
                  <button type="submit" value="sign up" name="signUp" class="w-full px-4 py-2 mt-2 font-bold text-white bg-gray-700 rounded hover:bg-red-600">Signup</button>
                </form>
              </div>


              <!-- login -->
              <div class="form-container sign-in-container">
                <form class="slides" action="" method="post">
                  <h1>Login</h1>
                  <div class="social-container">
                    <p class="text-xl text-center text-gray-600"></p>
                    <a href="#" class="flex items-center justify-center mt-4 text-white rounded-lg shadow-md hover:bg-gray-100">
                      <div class="px-4 py-3">
                        <svg class="w-4 h-4" viewBox="0 0 40 40">
                          <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.045 27.2142 24.3525 30 20 30C14.4775 30 10 25.5225 10 20C10 14.4775 14.4775 9.99999 20 9.99999C22.5492 9.99999 24.8683 10.9617 26.6342 12.5325L31.3483 7.81833C28.3717 5.04416 24.39 3.33333 20 3.33333C10.7958 3.33333 3.33335 10.7958 3.33335 20C3.33335 29.2042 10.7958 36.6667 20 36.6667C29.2042 36.6667 36.6667 29.2042 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#FFC107" />
                          <path d="M5.25497 12.2425L10.7308 16.2583C12.2125 12.59 15.8008 9.99999 20 9.99999C22.5491 9.99999 24.8683 10.9617 26.6341 12.5325L31.3483 7.81833C28.3716 5.04416 24.39 3.33333 20 3.33333C13.5983 3.33333 8.04663 6.94749 5.25497 12.2425Z" fill="#FF3D00" />
                          <path d="M20 36.6667C24.305 36.6667 28.2167 35.0192 31.1742 32.34L26.0159 27.975C24.3425 29.2425 22.2625 30 20 30C15.665 30 11.9842 27.2359 10.5975 23.3784L5.16254 27.5659C7.92087 32.9634 13.5225 36.6667 20 36.6667Z" fill="#4CAF50" />
                          <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.7592 25.1975 27.56 26.805 26.0133 27.9758C26.0142 27.975 26.015 27.975 26.0158 27.9742L31.1742 32.3392C30.8092 32.6708 36.6667 28.3333 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#1976D2" />
                        </svg>
                      </div>
                      <h1 class="w-5/6 px-4 py-3 font-bold text-center text-gray-600">Sign in with Google</h1>
                    </a>
                  </div>
                  <div class="mt-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700">Email Address</label>
                    <input class="block w-full px-4 py-2 text-gray-700 bg-gray-200 border border-gray-300 rounded appearance-none focus:outline-none focus:shadow-outline" type="email" name="email" required />
                  </div>
                  <div class="mt-4">
                    <div class="flex justify-center">
                      <label class="block mb-2 text-sm font-bold text-gray-700">Password</label>
                    </div>
                    <input class="block w-full px-4 py-2 text-gray-700 bg-gray-200 border border-gray-300 rounded appearance-none focus:outline-none focus:shadow-outline" type="password" name="password" required />
                  </div>
                  <div class="mt-4">
                    <a href="#" class="text-xs text-gray-500">Forget Password?</a>
                  </div>
                  <button type="submit" value="sign in" name="signIn" class="w-full px-4 py-2 mt-2 font-bold text-white bg-gray-700 rounded hover:bg-red-600">Login</button>
                </form>
              </div>
              <div class="overlay-container">
                <div class="overlay">
                  <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="flex items-center justify-around px-4 py-2 mt-2 font-bold text-white bg-gray-700 rounded ghost w-36 hover:bg-green-600" id="signIn">
                      <div class="mt-2 arrow">
                        <span></span>
                        <span></span>
                        <span></span>
                      </div>
                      <div class="mr-5">Login</div>
                    </button>

                  </div>
                  <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="flex justify-around px-4 py-2 mt-2 font-bold text-white bg-gray-700 rounded ghost w-36 hover:bg-green-600" id="signUp">
                      <div class="ml-4">Sign Up</div>
                      <div class="mt-2 arrows">
                        <span></span>
                        <span></span>
                        <span></span>
                      </div>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- login -->

            <script>
              const signUpButton = document.getElementById('signUp');
              const signInButton = document.getElementById('signIn');
              const container = document.getElementById('container');

              signUpButton.addEventListener('click', () => {
                container.classList.add("right-panel-active");
              });

              signInButton.addEventListener('click', () => {
                container.classList.remove("right-panel-active");
              });
            </script>

          </div>



        </div>
      </div>
      <script>
        // Open Login Modal with animation
        document.getElementById('buttonlogin').addEventListener('click', function() {
          var modal = document.getElementById('loginModal');
          modal.classList.remove('hidden');
          modal.classList.add('fadeIn'); // Add fadeIn animation class
        });

        // Close Login Modal with animation
        document.querySelectorAll('.modal-close').forEach(function(element) {
          element.addEventListener('click', function() {
            var modal = document.getElementById('loginModal');
            modal.classList.remove('fadeIn'); // Remove fadeIn animation class
            modal.classList.add('hidden');
          });
        });

        // Close Login Modal when clicking outside of modal content
        document.querySelector('.modal-overlay').addEventListener('click', function() {
          var modal = document.getElementById('loginModal');
          modal.classList.remove('fadeIn'); // Remove fadeIn animation class
          modal.classList.add('hidden');
        });
      </script>

    </div>
    <!-- Mobile Navigation Menu -->
    <div class="md:hidden" id="mobileMenu" style="display: none;">
      <ul class="flex flex-col items-center justify-center p-4 mt-4 font-medium border rounded-lg md:p-0 md:flex-row md:space-x-8 md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li class="hover:text-[#ff3939] text-white">
          <a href="#home">Home</a>
        </li>
        <li class="hover:text-[#ff3939] text-white">
          <a href="#about">About</a>
        </li>
        <li class="hover:text-[#ff3939] text-white">
          <a href="#projects">Projects</a>
        </li>
        <li class="hover:text-[#ff3939] text-white">
          <a href="#contact">Contact</a>
        </li>
        <div class="">
          <button id="buttonlogin">
            Login
          </button>
        </div>
      </ul>
    </div>

    <script>
      function toggleMobileMenu() {
        var mobileMenu = document.getElementById("mobileMenu");
        mobileMenu.style.display = (mobileMenu.style.display === "none" || mobileMenu.style.display === "") ? "block" : "none";
      }
    </script>
  </nav>

  <div id="home" class="lg:h-full lg:pt-[69px] sm:pt-[58px]">
    <header class="relative bg-gray-900 w-full h-[600px]">

      <div class="slideshow-container">

        <div class="relative">
          <div class="mySlides fade">
            <img class="w-full h-[600px] opacity-30" src="./dist/public/bg1.jpeg" alt="Image">
            <div class="absolute text-white transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
              <p class="font-bold lg:text-6xl sm:text-4xl lg:w-[1000px] text-center animate__animated animate__fadeInUp">Welcome to my Portfolio</p>
            </div>
          </div>
        </div>

        <div class="relative">
          <div class="mySlides fade">
            <img class="w-full h-[600px] opacity-30" src="./dist/public/bg2.jpeg">
            <div class="absolute text-white transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
              <p class="font-bold lg:text-6xl sm:text-4xl lg:w-[1000px] text-center animate__animated animate__fadeInUp">Hello, I'am Jeril , Focusing on Functional Elements Creating Beautiful Design Experience.</p>
            </div>
          </div>
        </div>

      </div>
      <br>

      <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
          let i;
          let slides = document.getElementsByClassName("mySlides");
          // let dots = document.getElementsByClassName("dot"); // I-comment out o tanggalin ito
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          slideIndex++;
          if (slideIndex > slides.length) {
            slideIndex = 1
          }
          // I-comment out ang sumusunod na lines
          /*
          for (i = 0; i < dots.length; i++) {
              dots[i].className = dots[i].className.replace(" active", "");
          }
          */
          slides[slideIndex - 1].style.display = "block";
          // I-comment out ang sumusunod na line
          // dots[slideIndex-1].className += " active";
          setTimeout(showSlides, 5000);
        }
      </script>
    </header>

    <section class="bg-gray-100 dark:bg-gray-900">
      <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7 delay-[300ms] duration-[600ms] taos:translate-x-[-50px] taos:opacity-0" data-taos-offset="400">
          <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">About Me</h1>
          <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">I'm Jeril, and I really want to do front-end development. I have experience using HTML, CSS, JavaScript, Tailwind, Laravel, Livewire, Rappasoft PowerGrid, animation, Bootstrap, Figma, and I can also work on network-related tasks.</p>
          <a href="#" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
            Get started
            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </a>
          <a href="#next" id="downloadButton" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
            Download CV
          </a>
          <script>
            document.getElementById("downloadButton").addEventListener("click", function() {
              // Gumawa ng link para sa PDF file
              var pdfFile = './public/JERIL RESUME.pdf';
              var link = document.createElement('a');
              link.href = pdfFile;

              // Itakda ang pangalan ng file para sa download
              link.download = encodeURIComponent('JERIL RESUME.pdf');

              // Idagdag ang link sa dokumento at i-click ito
              document.body.appendChild(link);
              link.click();

              // Alisin ang link pagkatapos ng pag-click
              document.body.removeChild(link);
            });
            d
          </script>
        </div>
        <div class="flex pt-2 lg:mt-0 lg:col-span-5 sm:justify-center">
          <img src="./dist/public/profile.png" class="delay-[300ms] duration-[600ms] taos:translate-x-[50px] taos:opacity-0" data-taos-offset="400">
        </div>
      </div>
    </section>

    <section>
      <div class="p-2 bg-gray-100 delay-[300ms] duration-[600ms] taos:translate-y-[200px] taos:opacity-0" data-taos-offset="300">
        <p class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">Project Comply</p>
      </div>
      <div class="grid gap-2 bg-gray-100 lg:grid-cols-4 sm:grid-cols-2 p-7 delay-[300ms] duration-[600ms] taos:translate-y-[200px] taos:opacity-0" data-taos-offset="300">

        <div class="flex items-center justify-center">
          <button style="background-image: url('./dist/public/ECOMMERCE.jpg')" class="bg-center bg-cover card" id="cards">
            <div class="bg-black h-[248px] w-[184px] opacity-75">
              <div class="card-info">
                <div class="card-avatar"></div>
                <div class="font-mono text-base font-bold text-white">THE GIL OF GAMERS</div>
                <div class="text-white card-subtitle">ECOMMERCE</div>
              </div>
              <ul class="card-social">
                <li class="card-social__item">
                  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 9h3l-.375 3H14v9h-3.89v-9H8V9h2.11V6.984c0-1.312.327-2.304.984-2.976C11.75 3.336 12.844 3 14.375 3H17v3h-1.594c-.594 0-.976.094-1.148.281-.172.188-.258.5-.258.938V9z"></path>
                  </svg>
                </li>
                <li class="card-social__item">
                  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.875 7.5v.563c0 3.28-1.18 6.257-3.54 8.93C14.978 19.663 11.845 21 7.938 21c-2.5 0-4.812-.687-6.937-2.063.5.063.86.094 1.078.094 2.094 0 3.969-.656 5.625-1.968a4.563 4.563 0 0 1-2.625-.915 4.294 4.294 0 0 1-1.594-2.226c.375.062.657.094.844.094.313 0 .719-.063 1.219-.188-1.031-.219-1.899-.742-2.602-1.57a4.32 4.32 0 0 1-1.054-2.883c.687.328 1.375.516 2.062.516C2.61 9.016 1.938 7.75 1.938 6.094c0-.782.203-1.531.609-2.25 2.406 2.969 5.515 4.547 9.328 4.734-.063-.219-.094-.562-.094-1.031 0-1.281.438-2.36 1.313-3.234C13.969 3.437 15.047 3 16.328 3s2.375.484 3.281 1.453c.938-.156 1.907-.531 2.907-1.125-.313 1.094-.985 1.938-2.016 2.531.969-.093 1.844-.328 2.625-.703-.563.875-1.312 1.656-2.25 2.344z"></path>
                  </svg>
                </li>
                <li class="card-social__item">
                  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.547 3c.406 0 .75.133 1.031.398.281.266.422.602.422 1.008v15.047c0 .406-.14.766-.422 1.078a1.335 1.335 0 0 1-1.031.469h-15c-.406 0-.766-.156-1.078-.469C3.156 20.22 3 19.86 3 19.453V4.406c0-.406.148-.742.445-1.008C3.742 3.133 4.11 3 4.547 3h15zM8.578 18V9.984H6V18h2.578zM7.36 8.766c.407 0 .743-.133 1.008-.399a1.31 1.31 0 0 0 .399-.96c0-.407-.125-.743-.375-1.009C8.14 6.133 7.813 6 7.406 6c-.406 0-.742.133-1.008.398C6.133 6.664 6 7 6 7.406c0 .375.125.696.375.961.25.266.578.399.984.399zM18 18v-4.688c0-1.156-.273-2.03-.82-2.624-.547-.594-1.258-.891-2.133-.891-.938 0-1.719.437-2.344 1.312V9.984h-2.578V18h2.578v-4.547c0-.312.031-.531.094-.656.25-.625.687-.938 1.312-.938.875 0 1.313.578 1.313 1.735V18H18z"></path>
                  </svg>
                </li>
              </ul>
            </div>
          </button>
        </div>

        <div class="flex items-center justify-center">
          <button style="background-image: url('./dist/public/gallery.jpg')" class="bg-center bg-cover card" id="cards">
          <div class="bg-black h-[248px] w-[184px] opacity-75">
            <div class="card-info">
              <div class="card-avatar"></div>
              <div class="font-mono text-base font-bold text-white">BLOGS</div>
              <div class="text-white card-subtitle">GALLERY</div>
            </div>
            <ul class="card-social">
              <li class="card-social__item">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14 9h3l-.375 3H14v9h-3.89v-9H8V9h2.11V6.984c0-1.312.327-2.304.984-2.976C11.75 3.336 12.844 3 14.375 3H17v3h-1.594c-.594 0-.976.094-1.148.281-.172.188-.258.5-.258.938V9z"></path>
                </svg>
              </li>
              <li class="card-social__item">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M20.875 7.5v.563c0 3.28-1.18 6.257-3.54 8.93C14.978 19.663 11.845 21 7.938 21c-2.5 0-4.812-.687-6.937-2.063.5.063.86.094 1.078.094 2.094 0 3.969-.656 5.625-1.968a4.563 4.563 0 0 1-2.625-.915 4.294 4.294 0 0 1-1.594-2.226c.375.062.657.094.844.094.313 0 .719-.063 1.219-.188-1.031-.219-1.899-.742-2.602-1.57a4.32 4.32 0 0 1-1.054-2.883c.687.328 1.375.516 2.062.516C2.61 9.016 1.938 7.75 1.938 6.094c0-.782.203-1.531.609-2.25 2.406 2.969 5.515 4.547 9.328 4.734-.063-.219-.094-.562-.094-1.031 0-1.281.438-2.36 1.313-3.234C13.969 3.437 15.047 3 16.328 3s2.375.484 3.281 1.453c.938-.156 1.907-.531 2.907-1.125-.313 1.094-.985 1.938-2.016 2.531.969-.093 1.844-.328 2.625-.703-.563.875-1.312 1.656-2.25 2.344z"></path>
                </svg>
              </li>
              <li class="card-social__item">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.547 3c.406 0 .75.133 1.031.398.281.266.422.602.422 1.008v15.047c0 .406-.14.766-.422 1.078a1.335 1.335 0 0 1-1.031.469h-15c-.406 0-.766-.156-1.078-.469C3.156 20.22 3 19.86 3 19.453V4.406c0-.406.148-.742.445-1.008C3.742 3.133 4.11 3 4.547 3h15zM8.578 18V9.984H6V18h2.578zM7.36 8.766c.407 0 .743-.133 1.008-.399a1.31 1.31 0 0 0 .399-.96c0-.407-.125-.743-.375-1.009C8.14 6.133 7.813 6 7.406 6c-.406 0-.742.133-1.008.398C6.133 6.664 6 7 6 7.406c0 .375.125.696.375.961.25.266.578.399.984.399zM18 18v-4.688c0-1.156-.273-2.03-.82-2.624-.547-.594-1.258-.891-2.133-.891-.938 0-1.719.437-2.344 1.312V9.984h-2.578V18h2.578v-4.547c0-.312.031-.531.094-.656.25-.625.687-.938 1.312-.938.875 0 1.313.578 1.313 1.735V18H18z"></path>
                </svg>
              </li>
            </ul>
          </div>
          </button>
        </div>

        <div class="flex items-center justify-center">
          <button style="background-image: url('./dist/public/source.jpg')" class="bg-center bg-cover card" id="cards">
          <div class="bg-black h-[248px] w-[184px] opacity-75">  
          <div class="card-info">
              <div class="card-avatar"></div>
              <div class="font-mono text-base font-bold text-white">DEVGIL PROJECTS</div>
              <div class="text-white card-subtitle">REFERENCE</div>
            </div>
            <ul class="card-social">
              <li class="card-social__item">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14 9h3l-.375 3H14v9h-3.89v-9H8V9h2.11V6.984c0-1.312.327-2.304.984-2.976C11.75 3.336 12.844 3 14.375 3H17v3h-1.594c-.594 0-.976.094-1.148.281-.172.188-.258.5-.258.938V9z"></path>
                </svg>
              </li>
              <li class="card-social__item">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M20.875 7.5v.563c0 3.28-1.18 6.257-3.54 8.93C14.978 19.663 11.845 21 7.938 21c-2.5 0-4.812-.687-6.937-2.063.5.063.86.094 1.078.094 2.094 0 3.969-.656 5.625-1.968a4.563 4.563 0 0 1-2.625-.915 4.294 4.294 0 0 1-1.594-2.226c.375.062.657.094.844.094.313 0 .719-.063 1.219-.188-1.031-.219-1.899-.742-2.602-1.57a4.32 4.32 0 0 1-1.054-2.883c.687.328 1.375.516 2.062.516C2.61 9.016 1.938 7.75 1.938 6.094c0-.782.203-1.531.609-2.25 2.406 2.969 5.515 4.547 9.328 4.734-.063-.219-.094-.562-.094-1.031 0-1.281.438-2.36 1.313-3.234C13.969 3.437 15.047 3 16.328 3s2.375.484 3.281 1.453c.938-.156 1.907-.531 2.907-1.125-.313 1.094-.985 1.938-2.016 2.531.969-.093 1.844-.328 2.625-.703-.563.875-1.312 1.656-2.25 2.344z"></path>
                </svg>
              </li>
              <li class="card-social__item">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.547 3c.406 0 .75.133 1.031.398.281.266.422.602.422 1.008v15.047c0 .406-.14.766-.422 1.078a1.335 1.335 0 0 1-1.031.469h-15c-.406 0-.766-.156-1.078-.469C3.156 20.22 3 19.86 3 19.453V4.406c0-.406.148-.742.445-1.008C3.742 3.133 4.11 3 4.547 3h15zM8.578 18V9.984H6V18h2.578zM7.36 8.766c.407 0 .743-.133 1.008-.399a1.31 1.31 0 0 0 .399-.96c0-.407-.125-.743-.375-1.009C8.14 6.133 7.813 6 7.406 6c-.406 0-.742.133-1.008.398C6.133 6.664 6 7 6 7.406c0 .375.125.696.375.961.25.266.578.399.984.399zM18 18v-4.688c0-1.156-.273-2.03-.82-2.624-.547-.594-1.258-.891-2.133-.891-.938 0-1.719.437-2.344 1.312V9.984h-2.578V18h2.578v-4.547c0-.312.031-.531.094-.656.25-.625.687-.938 1.312-.938.875 0 1.313.578 1.313 1.735V18H18z"></path>
                </svg>
              </li>
            </ul>
          </div>
          </button>
        </div>

        <div class="flex items-center justify-center">
          <button style="background-image: url('./dist/public/game.jpg')" class="bg-center bg-cover card" id="cards">
          <div class="bg-black h-[248px] w-[184px] opacity-75">   
          <div class="card-info">
              <div class="card-avatar"></div>
              <div class="font-mono text-base font-bold text-white">LIVE VIEW</div>
              <div class="text-white card-subtitle">GAME VIDEO</div>
            </div>
            <ul class="card-social">
              <li class="card-social__item">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14 9h3l-.375 3H14v9h-3.89v-9H8V9h2.11V6.984c0-1.312.327-2.304.984-2.976C11.75 3.336 12.844 3 14.375 3H17v3h-1.594c-.594 0-.976.094-1.148.281-.172.188-.258.5-.258.938V9z"></path>
                </svg>
              </li>
              <li class="card-social__item">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M20.875 7.5v.563c0 3.28-1.18 6.257-3.54 8.93C14.978 19.663 11.845 21 7.938 21c-2.5 0-4.812-.687-6.937-2.063.5.063.86.094 1.078.094 2.094 0 3.969-.656 5.625-1.968a4.563 4.563 0 0 1-2.625-.915 4.294 4.294 0 0 1-1.594-2.226c.375.062.657.094.844.094.313 0 .719-.063 1.219-.188-1.031-.219-1.899-.742-2.602-1.57a4.32 4.32 0 0 1-1.054-2.883c.687.328 1.375.516 2.062.516C2.61 9.016 1.938 7.75 1.938 6.094c0-.782.203-1.531.609-2.25 2.406 2.969 5.515 4.547 9.328 4.734-.063-.219-.094-.562-.094-1.031 0-1.281.438-2.36 1.313-3.234C13.969 3.437 15.047 3 16.328 3s2.375.484 3.281 1.453c.938-.156 1.907-.531 2.907-1.125-.313 1.094-.985 1.938-2.016 2.531.969-.093 1.844-.328 2.625-.703-.563.875-1.312 1.656-2.25 2.344z"></path>
                </svg>
              </li>
              <li class="card-social__item">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.547 3c.406 0 .75.133 1.031.398.281.266.422.602.422 1.008v15.047c0 .406-.14.766-.422 1.078a1.335 1.335 0 0 1-1.031.469h-15c-.406 0-.766-.156-1.078-.469C3.156 20.22 3 19.86 3 19.453V4.406c0-.406.148-.742.445-1.008C3.742 3.133 4.11 3 4.547 3h15zM8.578 18V9.984H6V18h2.578zM7.36 8.766c.407 0 .743-.133 1.008-.399a1.31 1.31 0 0 0 .399-.96c0-.407-.125-.743-.375-1.009C8.14 6.133 7.813 6 7.406 6c-.406 0-.742.133-1.008.398C6.133 6.664 6 7 6 7.406c0 .375.125.696.375.961.25.266.578.399.984.399zM18 18v-4.688c0-1.156-.273-2.03-.82-2.624-.547-.594-1.258-.891-2.133-.891-.938 0-1.719.437-2.344 1.312V9.984h-2.578V18h2.578v-4.547c0-.312.031-.531.094-.656.25-.625.687-.938 1.312-.938.875 0 1.313.578 1.313 1.735V18H18z"></path>
                </svg>
              </li>
            </ul>
          </div>
          </button>
        </div>

      </div>
    </section>


  </div>

  <!-- home page end  -->








  <!-- about  -->
  <div id="about" class="h-full pt-[69px]">
    <section class="bg-gray-100 dark:bg-gray-900">
      <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6 delay-[300ms] duration-[600ms] taos:translate-y-[200px] taos:opacity-0" data-taos-offset="300">
        <figure class="max-w-screen-md mx-auto">
          <blockquote>
            <p class="text-2xl font-medium text-gray-900 dark:text-white"> I'm a front end developer with 1 year of experience in web development. I've worked on a variety of projects for clients in the Students. I'm passionate about creating great user experiences and have a strong understanding of usability and accessibility standards.</p>
        </figure>
      </div>
    </section>

    <!-- component -->

    <div class="grid grid-cols-1 md:grid-cols-2 delay-[300ms] duration-[600ms] taos:translate-y-[200px] taos:opacity-0" data-taos-offset="300">
      <div class="">
        <img class="object-cover object-top h-full " src="./dist/public/seller.jpg" alt="">
      </div>
      <div class="flex p-10 bg-gray-100">
        <div class="max-w-lg mt-auto mb-auto">
          <h1 class="text-3xl uppercase">Jeril GIl A, Labagnoy</h1>
          <p class="mb-5 font-semibold">Front-end Developer</p>
          <p>"Hello, have a nice day! and I offer website development services. You can contact me, and we can discuss and agree on the pricing. I also provide computer repair services. Additionally, I have various technologies for sale, so you can explore them on my websites. Thank you for visiting my portfolio. Feel free to hire me for your job offers."</p>
          <button class="py-3 mt-6 text-white bg-black rounded-md px-7">Email Me</button>
        </div>
      </div>
    </div>

    <div class="flex items-center justify-center w-full mb-10 bg-gray-900 mt-28 profile-skills">
      <div class="hidden w-4/12 h-52 md:flex sm:flex delay-[300ms] duration-[600ms] taos:[transform:translate3d(-200px,200px,0)] taos:opacity-0" data-taos-offset="300">
        <p class="font-mono text-lg font-bold text-white">Here, you can see all the progress of my skills. If you have any questions, you can contact me through my email. Thank you.</p>
      </div>
      <div class="delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0" data-taos-offset="400">
        <input type="checkbox" id="sk1">
        <label for="sk1"></label>
        <ul class="skills skills1">
          <li class="sk-cms"><span>CMS</span></li>
          <li class="sk-dtb"><span>DDBB</span></li>
          <li class="sk-dis"><span>Design</span></li>
          <li class="sk-pro"><span>Programing</span></li>
          <li class="sk-ani"><span>Animation</span></li>
          <li class="more">
            <input type="checkbox" id="more-con"><label for="more-con"></label>
            <div><span>PHOTO</span><span>API</span><span>MAPS</span><span>VIDEO</span><span>CHARTS</span><span>RWD</span></div>
          </li>
        </ul>
      </div>

      <div class="delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0" data-taos-offset="400">
        <input type="checkbox" id="sk2">
        <label for="sk2"></label>
        <ul class="skills skills2">
          <li class="sk-gim"><span>Gimp</span></li>
          <li class="sk-ado"><span>Adobe&nbsp;CC</span></li>
          <li class="sk-not"><span>Notepad++</span></li>
          <li class="sk-tri"><span>Tridion</span></li>
          <li class="sk-wor"><span>Wordpress</span></li>
          <li class="more">
            <input type="checkbox" id="more-pro"><label for="more-pro"></label>
            <div><span>JOOMLA</span><span>DRUPAL</span><span>JIRA</span><span>TRELLO</span><span>FILEZILLA</span><span>GIT</span></div>
          </li>
        </ul>
      </div>

      <div class="delay-[300ms] duration-[600ms] taos:scale-[0.6] taos:opacity-0" data-taos-offset="400">
        <input type="checkbox" id="sk3">
        <label for="sk3"></label>
        <ul class="skills skills3">
          <li class="sk-css"><span>CSS</span></li>
          <li class="sk-htm"><span>HTML</span></li>
          <li class="sk-jav"><span>JS</span></li>
          <li class="sk-php"><span>PHP</span></li>
          <li class="sk-sql"><span>SQL</span></li>
          <li class="more">
            <input type="checkbox" id="more-len"><label for="more-len"></label>
            <div><span>XHTML</span><span>XSL</span><span>XML</span><span>JSON</span><span>PUG</span><span>SASS</span></div>
          </li>
        </ul>
      </div>
    </div>

    <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>
    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.data('skillDisplay', () => ({
          skills: [{
              'title': 'HTML',
              'percent': '95',
            },
            {
              'title': 'CSS',
              'percent': '70',
            },
            {
              'title': 'Tailwind CSS',
              'percent': '90',
            },
            {
              'title': 'JavaScript',
              'percent': '70',
            },
            {
              'title': 'Alpine JS',
              'percent': '80',
            }, {
              'title': 'PHP',
              'percent': '65',
            }, {
              'title': 'Laravel',
              'percent': '75',
            }
          ],
          currentSkill: {
            'title': 'HTML',
            'percent': '95',
          }
        }));
      });
    </script>

  </div>

  <!-- about end  -->


  <!-- projects  -->
  <div id="projects" class="h-full pt-[69px]">
    <section class="bg-gray-100 dark:bg-gray-900 delay-[300ms] duration-[600ms] taos:translate-y-[200px] taos:opacity-0" data-taos-offset="300">
      <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
        <div class="max-w-screen-sm mx-auto mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">My Projects</h2>
          <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Explore the whole collection of my open-source web templates and elements built with the utility classes from Tailwind css javascript laravel structure</p>
        </div>

        <div class="grid gap-8 lg:gap-16 sm:grid-rows-2 md:grid-cols-3 lg:grid-cols-4 sm:place-items-center">
          <div class="text-center text-gray-500 dark:text-gray-400">
            <div class="main">
              <div class="cardp">
                <div class="fl">
                  <div class="fullscreen">
                    <svg viewBox="0 0 100 100" class="fullscreen_svg">
                      <path d="M3.563-.004a3.573 3.573 0 0 0-3.527 4.09l-.004-.02v28.141c0 1.973 1.602 3.57 3.57 3.57s3.57-1.598 3.57-3.57V12.218v.004l22.461 22.461a3.571 3.571 0 0 0 6.093-2.527c0-.988-.398-1.879-1.047-2.523L12.218 7.172h19.989c1.973 0 3.57-1.602 3.57-3.57s-1.598-3.57-3.57-3.57H4.035a3.008 3.008 0 0 0-.473-.035zM96.333 0l-.398.035.02-.004h-28.16a3.569 3.569 0 0 0-3.57 3.57 3.569 3.569 0 0 0 3.57 3.57h19.989L65.323 29.632a3.555 3.555 0 0 0-1.047 2.523 3.571 3.571 0 0 0 6.093 2.527L92.83 12.221v19.985a3.569 3.569 0 0 0 3.57 3.57 3.569 3.569 0 0 0 3.57-3.57V4.034v.004a3.569 3.569 0 0 0-3.539-4.043l-.105.004zM3.548 64.23A3.573 3.573 0 0 0 .029 67.8v28.626-.004l.016.305-.004-.016.004.059v-.012l.039.289-.004-.023.023.121-.004-.023c.074.348.191.656.34.938l-.008-.02.055.098-.008-.02.148.242-.008-.012.055.082-.008-.012c.199.285.43.531.688.742l.008.008.031.027.004.004c.582.461 1.32.742 2.121.762h.004l.078.004h28.61a3.569 3.569 0 0 0 3.57-3.57 3.569 3.569 0 0 0-3.57-3.57H12.224l22.461-22.461a3.569 3.569 0 0 0-2.492-6.125l-.105.004h.008a3.562 3.562 0 0 0-2.453 1.074L7.182 87.778V67.793a3.571 3.571 0 0 0-3.57-3.57h-.055.004zm92.805 0a3.573 3.573 0 0 0-3.519 3.57v19.993-.004L70.373 65.328a3.553 3.553 0 0 0-2.559-1.082h-.004a3.573 3.573 0 0 0-3.566 3.57c0 1.004.414 1.91 1.082 2.555l22.461 22.461H67.802a3.57 3.57 0 1 0 0 7.14h28.606c.375 0 .742-.059 1.082-.168l-.023.008.027-.012-.02.008.352-.129-.023.008.039-.02-.02.008.32-.156-.02.008.023-.016-.008.008c.184-.102.34-.207.488-.32l-.008.008.137-.113-.008.004.223-.211.008-.008c.156-.164.301-.34.422-.535l.008-.016-.008.016.008-.02.164-.285.008-.02-.008.016.008-.02c.098-.188.184-.406.246-.633l.008-.023-.004.008.008-.023a3.44 3.44 0 0 0 .121-.852v-.004l.004-.078V67.804a3.569 3.569 0 0 0-3.57-3.57h-.055.004z"></path>
                    </svg>
                  </div>
                </div>
                <div class="card_content">
                  <label class="switch_738">
                    <input type="checkbox" class="chk_738">
                    <span class="slider_738"></span>
                  </label>
                </div>
                <div class="card_back"></div>
              </div>
              <div class="data">
                <div class="img">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 80 80">
                    <g stroke-width="2.00" fill="none" stroke-linecap="butt">
                      <path stroke="#59afb1" d="M 14.06 0.00
                        Q 13.33 4.09 13.93 7.52
                        A 1.04 1.02 -78.7 0 0 14.37 8.19
                        L 32.87 20.19"></path>
                      <path stroke="#4fa6a8" d="M 32.87 20.19
                        L 42.25 26.79"></path>
                      <path stroke="#69cbc0" d="M 42.25 26.79
                        C 41.40 28.26 24.14 34.92 21.32 36.20"></path>
                      <path stroke="#6fcdbb" d="M 21.32 36.20
                        Q 15.81 38.21 11.00 41.21"></path>
                      <path stroke="#5ec8ab" d="M 11.00 41.21
                        L 9.75 40.96"></path>
                      <path stroke="#5cae9e" d="M 9.75 40.96
                        Q 5.99 37.71 1.71 35.19
                        A 1.00 1.00 0.0 0 0 0.22 35.85
                        L 0.00 36.94"></path>
                      <path stroke="#3190a6" d="M 79.95 6.12
                        L 62.46 11.32"></path>
                      <path stroke="#3a96a3" d="M 62.46 11.32
                        Q 47.42 14.67 32.87 20.19"></path>
                      <path stroke="#22a3be" d="M 80.00 11.06
                        L 64.50 17.46"></path>
                      <path stroke="#28879d" d="M 64.50 17.46
                        L 62.46 11.32"></path>
                      <path stroke="#2ba9bb" d="M 64.50 17.46
                        L 43.00 26.96"></path>
                      <path stroke="#4ab2b2" d="M 43.00 26.96
                        L 42.25 26.79"></path>
                      <path stroke="#45ced3" d="M 80.00 52.31
                        Q 71.64 45.91 62.46 40.67"></path>
                      <path stroke="#13636e" d="M 62.46 40.67
                        Q 62.43 36.88 58.50 36.79"></path>
                      <path stroke="#45ced3" d="M 58.50 36.79
                        Q 50.07 32.95 43.00 26.96"></path>
                      <path stroke="#326b65" d="M 58.50 36.79
                        Q 55.85 40.04 56.86 44.07
                        C 57.53 46.71 60.02 47.68 61.77 45.19
                        Q 61.91 44.99 61.94 44.74
                        L 62.46 40.67"></path>
                      <path stroke="#59d4b5" d="M 40.81 79.86
                        Q 46.22 74.94 52.34 70.94
                        A 1.00 1.00 0.0 0 0 52.39 69.30
                        Q 44.74 63.65 43.10 62.62
                        Q 34.11 56.98 32.50 55.79"></path>
                      <path stroke="#6ad8c5" d="M 32.50 55.79
                        C 36.74 55.42 30.64 48.79 29.79 47.81
                        C 27.54 45.21 26.34 42.09 24.05 39.44
                        Q 22.66 37.82 21.32 36.20"></path>
                      <path stroke="#326b65" d="M 48.75 39.07
                        A 2.30 2.30 0.0 0 0 46.45 36.77
                        L 46.05 36.77
                        A 2.30 2.30 0.0 0 0 43.75 39.07
                        L 43.75 44.21
                        A 2.30 2.30 0.0 0 0 46.05 46.51
                        L 46.45 46.51
                        A 2.30 2.30 0.0 0 0 48.75 44.21
                        L 48.75 39.07"></path>
                      <path stroke="#326b65" d="M 58.63 54.41
                        C 54.90 57.18 50.72 56.87 46.91 54.39
                        A 1.00 0.99 51.9 0 0 46.04 54.28
                        C 42.37 55.52 43.88 58.13 46.28 59.41
                        Q 53.38 63.20 60.15 58.94
                        C 62.54 57.43 62.47 54.80 59.41 54.23
                        A 1.00 1.00 0.0 0 0 58.63 54.41"></path>
                      <path stroke="#4bb793" d="M 9.75 40.96
                        Q 5.15 43.50 0.05 44.46"></path>
                      <path stroke="#5fd6b0" d="M 32.50 55.79
                        L 11.00 41.21"></path>
                      <path stroke="#48d08e" d="M 11.19 80.00
                        Q 12.51 79.61 11.57 78.67
                        Q 5.99 73.11 1.70 65.70
                        C 1.28 64.97 0.74 64.76 0.00 65.19"></path>
                    </g>
                    <path fill="#6ebfb6" d="M 0.00 0.00
                        L 14.06 0.00
                        Q 13.33 4.09 13.93 7.52
                        A 1.04 1.02 -78.7 0 0 14.37 8.19
                        L 32.87 20.19
                        L 42.25 26.79
                        C 41.40 28.26 24.14 34.92 21.32 36.20
                        Q 15.81 38.21 11.00 41.21
                        L 9.75 40.96
                        Q 5.99 37.71 1.71 35.19
                        A 1.00 1.00 0.0 0 0 0.22 35.85
                        L 0.00 36.94
                        L 0.00 0.00
                        Z"></path>
                    <path fill="#439eac" d="M 14.06 0.00
                        L 80.00 0.00
                        L 79.95 6.12
                        L 62.46 11.32
                        Q 47.42 14.67 32.87 20.19
                        L 14.37 8.19
                        A 1.04 1.02 -78.7 0 1 13.93 7.52
                        Q 13.33 4.09 14.06 0.00
                        Z"></path>
                    <path fill="#1f81a0" d="M 79.95 6.12
                        L 80.00 11.06
                        L 64.50 17.46
                        L 62.46 11.32
                        L 79.95 6.12
                        Z"></path>
                    <path fill="#308d99" d="M 62.46 11.32
                        L 64.50 17.46
                        L 43.00 26.96
                        L 42.25 26.79
                        L 32.87 20.19
                        Q 47.42 14.67 62.46 11.32
                        Z"></path>
                    <path fill="#25c5dc" d="M 80.00 11.06
                        L 80.00 52.31
                        Q 71.64 45.91 62.46 40.67
                        Q 62.43 36.88 58.50 36.79
                        Q 50.07 32.95 43.00 26.96
                        L 64.50 17.46
                        L 80.00 11.06
                        Z"></path>
                    <path fill="#64d6ca" d="M 42.25 26.79
                        L 43.00 26.96
                        Q 50.07 32.95 58.50 36.79
                        Q 55.85 40.04 56.86 44.07
                        C 57.53 46.71 60.02 47.68 61.77 45.19
                        Q 61.91 44.99 61.94 44.74
                        L 62.46 40.67
                        Q 71.64 45.91 80.00 52.31
                        L 80.00 80.00
                        L 40.81 79.86
                        Q 46.22 74.94 52.34 70.94
                        A 1.00 1.00 0.0 0 0 52.39 69.30
                        Q 44.74 63.65 43.10 62.62
                        Q 34.11 56.98 32.50 55.79
                        C 36.74 55.42 30.64 48.79 29.79 47.81
                        C 27.54 45.21 26.34 42.09 24.05 39.44
                        Q 22.66 37.82 21.32 36.20
                        C 24.14 34.92 41.40 28.26 42.25 26.79
                        Z
                        M 48.75 39.07
                        A 2.30 2.30 0.0 0 0 46.45 36.77
                        L 46.05 36.77
                        A 2.30 2.30 0.0 0 0 43.75 39.07
                        L 43.75 44.21
                        A 2.30 2.30 0.0 0 0 46.05 46.51
                        L 46.45 46.51
                        A 2.30 2.30 0.0 0 0 48.75 44.21
                        L 48.75 39.07
                        Z
                        M 58.63 54.41
                        C 54.90 57.18 50.72 56.87 46.91 54.39
                        A 1.00 0.99 51.9 0 0 46.04 54.28
                        C 42.37 55.52 43.88 58.13 46.28 59.41
                        Q 53.38 63.20 60.15 58.94
                        C 62.54 57.43 62.47 54.80 59.41 54.23
                        A 1.00 1.00 0.0 0 0 58.63 54.41
                        Z"></path>
                    <path fill="#499c85" d="M 9.75 40.96
                        Q 5.15 43.50 0.05 44.46
                        L 0.00 36.94
                        L 0.22 35.85
                        A 1.00 1.00 0.0 0 1 1.71 35.19
                        Q 5.99 37.71 9.75 40.96
                        Z"></path>
                    <path fill="#70dac0" d="M 21.32 36.20
                        Q 22.66 37.82 24.05 39.44
                        C 26.34 42.09 27.54 45.21 29.79 47.81
                        C 30.64 48.79 36.74 55.42 32.50 55.79
                        L 11.00 41.21
                        Q 15.81 38.21 21.32 36.20
                        Z"></path>
                    <rect fill="#000000" x="43.75" y="36.77" width="5.00" height="9.74" rx="2.30"></rect>
                    <path fill="#000000" d="M 58.50 36.79
                        Q 62.43 36.88 62.46 40.67
                        L 61.94 44.74
                        Q 61.91 44.99 61.77 45.19
                        C 60.02 47.68 57.53 46.71 56.86 44.07
                        Q 55.85 40.04 58.50 36.79
                        Z"></path>
                    <path fill="#4dd1a0" d="M 9.75 40.96
                        L 11.00 41.21
                        L 32.50 55.79
                        Q 34.11 56.98 43.10 62.62
                        Q 44.74 63.65 52.39 69.30
                        A 1.00 1.00 0.0 0 1 52.34 70.94
                        Q 46.22 74.94 40.81 79.86
                        L 11.19 80.00
                        Q 12.51 79.61 11.57 78.67
                        Q 5.99 73.11 1.70 65.70
                        C 1.28 64.97 0.74 64.76 0.00 65.19
                        L 0.05 44.46
                        Q 5.15 43.50 9.75 40.96
                        Z"></path>
                    <path fill="#000000" d="M 46.91 54.39
                        C 50.72 56.87 54.90 57.18 58.63 54.41
                        A 1.00 1.00 0.0 0 1 59.41 54.23
                        C 62.47 54.80 62.54 57.43 60.15 58.94
                        Q 53.38 63.20 46.28 59.41
                        C 43.88 58.13 42.37 55.52 46.04 54.28
                        A 1.00 0.99 51.9 0 1 46.91 54.39
                        Z"></path>
                    <path fill="#43ce7c" d="M 11.19 80.00
                        L 0.00 80.00
                        L 0.00 65.19
                        C 0.74 64.76 1.28 64.97 1.70 65.70
                        Q 5.99 73.11 11.57 78.67
                        Q 12.51 79.61 11.19 80.00
                        Z"></path>
                  </svg>
                </div>
                <div class="textp">
                  <div class="text_m">CSS Theme Switch</div>
                  <div class="text_s">Praashoo7</div>
                </div>
              </div>
              <div class="btns">
                <div class="likes">
                  <svg class="likes_svg" viewBox="-2 0 105 92">
                    <path d="M85.24 2.67C72.29-3.08 55.75 2.67 50 14.9 44.25 2 27-3.8 14.76 2.67 1.1 9.14-5.37 25 5.42 44.38 13.33 58 27 68.11 50 86.81 73.73 68.11 87.39 58 94.58 44.38c10.79-18.7 4.32-35.24-9.34-41.71Z"></path>
                  </svg><span class="likes_text">22</span>
                </div>
                <div class="comments">
                  <svg class="comments_svg" viewBox="-405.9 238 56.3 54.8" title="Comment">
                    <path d="M-391 291.4c0 1.5 1.2 1.7 1.9 1.2 1.8-1.6 15.9-14.6 15.9-14.6h19.3c3.8 0 4.4-.8 4.4-4.5v-31.1c0-3.7-.8-4.5-4.4-4.5h-47.4c-3.6 0-4.4.9-4.4 4.5v31.1c0 3.7.7 4.4 4.4 4.4h10.4v13.5z"></path>
                  </svg><span class="comments_text">12</span>
                </div>
                <div class="views">
                  <svg class="views_svg" viewBox="0 0 30.5 16.5" title="Views">
                    <path d="M15.3 0C8.9 0 3.3 3.3 0 8.3c3.3 5 8.9 8.3 15.3 8.3s12-3.3 15.3-8.3C27.3 3.3 21.7 0 15.3 0zm0 14.5c-3.4 0-6.2-2.8-6.2-6.2C9 4.8 11.8 2 15.3 2c3.4 0 6.2 2.8 6.2 6.2 0 3.5-2.8 6.3-6.2 6.3z"></path>
                  </svg><span class="views_text">332</span>
                </div>
              </div>
            </div>
          </div>

          <!-- box 2  -->
          <div class="text-center text-gray-500 dark:text-gray-400">
            <div class="main">
              <div class="cardp">
                <div class="fl">
                  <div class="fullscreen">
                    <svg viewBox="0 0 100 100" class="fullscreen_svg">
                      <path d="M3.563-.004a3.573 3.573 0 0 0-3.527 4.09l-.004-.02v28.141c0 1.973 1.602 3.57 3.57 3.57s3.57-1.598 3.57-3.57V12.218v.004l22.461 22.461a3.571 3.571 0 0 0 6.093-2.527c0-.988-.398-1.879-1.047-2.523L12.218 7.172h19.989c1.973 0 3.57-1.602 3.57-3.57s-1.598-3.57-3.57-3.57H4.035a3.008 3.008 0 0 0-.473-.035zM96.333 0l-.398.035.02-.004h-28.16a3.569 3.569 0 0 0-3.57 3.57 3.569 3.569 0 0 0 3.57 3.57h19.989L65.323 29.632a3.555 3.555 0 0 0-1.047 2.523 3.571 3.571 0 0 0 6.093 2.527L92.83 12.221v19.985a3.569 3.569 0 0 0 3.57 3.57 3.569 3.569 0 0 0 3.57-3.57V4.034v.004a3.569 3.569 0 0 0-3.539-4.043l-.105.004zM3.548 64.23A3.573 3.573 0 0 0 .029 67.8v28.626-.004l.016.305-.004-.016.004.059v-.012l.039.289-.004-.023.023.121-.004-.023c.074.348.191.656.34.938l-.008-.02.055.098-.008-.02.148.242-.008-.012.055.082-.008-.012c.199.285.43.531.688.742l.008.008.031.027.004.004c.582.461 1.32.742 2.121.762h.004l.078.004h28.61a3.569 3.569 0 0 0 3.57-3.57 3.569 3.569 0 0 0-3.57-3.57H12.224l22.461-22.461a3.569 3.569 0 0 0-2.492-6.125l-.105.004h.008a3.562 3.562 0 0 0-2.453 1.074L7.182 87.778V67.793a3.571 3.571 0 0 0-3.57-3.57h-.055.004zm92.805 0a3.573 3.573 0 0 0-3.519 3.57v19.993-.004L70.373 65.328a3.553 3.553 0 0 0-2.559-1.082h-.004a3.573 3.573 0 0 0-3.566 3.57c0 1.004.414 1.91 1.082 2.555l22.461 22.461H67.802a3.57 3.57 0 1 0 0 7.14h28.606c.375 0 .742-.059 1.082-.168l-.023.008.027-.012-.02.008.352-.129-.023.008.039-.02-.02.008.32-.156-.02.008.023-.016-.008.008c.184-.102.34-.207.488-.32l-.008.008.137-.113-.008.004.223-.211.008-.008c.156-.164.301-.34.422-.535l.008-.016-.008.016.008-.02.164-.285.008-.02-.008.016.008-.02c.098-.188.184-.406.246-.633l.008-.023-.004.008.008-.023a3.44 3.44 0 0 0 .121-.852v-.004l.004-.078V67.804a3.569 3.569 0 0 0-3.57-3.57h-.055.004z"></path>
                    </svg>
                  </div>
                </div>
                <div class="card_content">
                  <label class="switch_738">
                    <input type="checkbox" class="chk_738">
                    <span class="slider_738"></span>
                  </label>
                </div>
                <div class="card_back"></div>
              </div>
              <div class="data">
                <div class="img">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 80 80">
                    <g stroke-width="2.00" fill="none" stroke-linecap="butt">
                      <path stroke="#59afb1" d="M 14.06 0.00
                        Q 13.33 4.09 13.93 7.52
                        A 1.04 1.02 -78.7 0 0 14.37 8.19
                        L 32.87 20.19"></path>
                      <path stroke="#4fa6a8" d="M 32.87 20.19
                        L 42.25 26.79"></path>
                      <path stroke="#69cbc0" d="M 42.25 26.79
                        C 41.40 28.26 24.14 34.92 21.32 36.20"></path>
                      <path stroke="#6fcdbb" d="M 21.32 36.20
                        Q 15.81 38.21 11.00 41.21"></path>
                      <path stroke="#5ec8ab" d="M 11.00 41.21
                        L 9.75 40.96"></path>
                      <path stroke="#5cae9e" d="M 9.75 40.96
                        Q 5.99 37.71 1.71 35.19
                        A 1.00 1.00 0.0 0 0 0.22 35.85
                        L 0.00 36.94"></path>
                      <path stroke="#3190a6" d="M 79.95 6.12
                        L 62.46 11.32"></path>
                      <path stroke="#3a96a3" d="M 62.46 11.32
                        Q 47.42 14.67 32.87 20.19"></path>
                      <path stroke="#22a3be" d="M 80.00 11.06
                        L 64.50 17.46"></path>
                      <path stroke="#28879d" d="M 64.50 17.46
                        L 62.46 11.32"></path>
                      <path stroke="#2ba9bb" d="M 64.50 17.46
                        L 43.00 26.96"></path>
                      <path stroke="#4ab2b2" d="M 43.00 26.96
                        L 42.25 26.79"></path>
                      <path stroke="#45ced3" d="M 80.00 52.31
                        Q 71.64 45.91 62.46 40.67"></path>
                      <path stroke="#13636e" d="M 62.46 40.67
                        Q 62.43 36.88 58.50 36.79"></path>
                      <path stroke="#45ced3" d="M 58.50 36.79
                        Q 50.07 32.95 43.00 26.96"></path>
                      <path stroke="#326b65" d="M 58.50 36.79
                        Q 55.85 40.04 56.86 44.07
                        C 57.53 46.71 60.02 47.68 61.77 45.19
                        Q 61.91 44.99 61.94 44.74
                        L 62.46 40.67"></path>
                      <path stroke="#59d4b5" d="M 40.81 79.86
                        Q 46.22 74.94 52.34 70.94
                        A 1.00 1.00 0.0 0 0 52.39 69.30
                        Q 44.74 63.65 43.10 62.62
                        Q 34.11 56.98 32.50 55.79"></path>
                      <path stroke="#6ad8c5" d="M 32.50 55.79
                        C 36.74 55.42 30.64 48.79 29.79 47.81
                        C 27.54 45.21 26.34 42.09 24.05 39.44
                        Q 22.66 37.82 21.32 36.20"></path>
                      <path stroke="#326b65" d="M 48.75 39.07
                        A 2.30 2.30 0.0 0 0 46.45 36.77
                        L 46.05 36.77
                        A 2.30 2.30 0.0 0 0 43.75 39.07
                        L 43.75 44.21
                        A 2.30 2.30 0.0 0 0 46.05 46.51
                        L 46.45 46.51
                        A 2.30 2.30 0.0 0 0 48.75 44.21
                        L 48.75 39.07"></path>
                      <path stroke="#326b65" d="M 58.63 54.41
                        C 54.90 57.18 50.72 56.87 46.91 54.39
                        A 1.00 0.99 51.9 0 0 46.04 54.28
                        C 42.37 55.52 43.88 58.13 46.28 59.41
                        Q 53.38 63.20 60.15 58.94
                        C 62.54 57.43 62.47 54.80 59.41 54.23
                        A 1.00 1.00 0.0 0 0 58.63 54.41"></path>
                      <path stroke="#4bb793" d="M 9.75 40.96
                        Q 5.15 43.50 0.05 44.46"></path>
                      <path stroke="#5fd6b0" d="M 32.50 55.79
                        L 11.00 41.21"></path>
                      <path stroke="#48d08e" d="M 11.19 80.00
                        Q 12.51 79.61 11.57 78.67
                        Q 5.99 73.11 1.70 65.70
                        C 1.28 64.97 0.74 64.76 0.00 65.19"></path>
                    </g>
                    <path fill="#6ebfb6" d="M 0.00 0.00
                        L 14.06 0.00
                        Q 13.33 4.09 13.93 7.52
                        A 1.04 1.02 -78.7 0 0 14.37 8.19
                        L 32.87 20.19
                        L 42.25 26.79
                        C 41.40 28.26 24.14 34.92 21.32 36.20
                        Q 15.81 38.21 11.00 41.21
                        L 9.75 40.96
                        Q 5.99 37.71 1.71 35.19
                        A 1.00 1.00 0.0 0 0 0.22 35.85
                        L 0.00 36.94
                        L 0.00 0.00
                        Z"></path>
                    <path fill="#439eac" d="M 14.06 0.00
                        L 80.00 0.00
                        L 79.95 6.12
                        L 62.46 11.32
                        Q 47.42 14.67 32.87 20.19
                        L 14.37 8.19
                        A 1.04 1.02 -78.7 0 1 13.93 7.52
                        Q 13.33 4.09 14.06 0.00
                        Z"></path>
                    <path fill="#1f81a0" d="M 79.95 6.12
                        L 80.00 11.06
                        L 64.50 17.46
                        L 62.46 11.32
                        L 79.95 6.12
                        Z"></path>
                    <path fill="#308d99" d="M 62.46 11.32
                        L 64.50 17.46
                        L 43.00 26.96
                        L 42.25 26.79
                        L 32.87 20.19
                        Q 47.42 14.67 62.46 11.32
                        Z"></path>
                    <path fill="#25c5dc" d="M 80.00 11.06
                        L 80.00 52.31
                        Q 71.64 45.91 62.46 40.67
                        Q 62.43 36.88 58.50 36.79
                        Q 50.07 32.95 43.00 26.96
                        L 64.50 17.46
                        L 80.00 11.06
                        Z"></path>
                    <path fill="#64d6ca" d="M 42.25 26.79
                        L 43.00 26.96
                        Q 50.07 32.95 58.50 36.79
                        Q 55.85 40.04 56.86 44.07
                        C 57.53 46.71 60.02 47.68 61.77 45.19
                        Q 61.91 44.99 61.94 44.74
                        L 62.46 40.67
                        Q 71.64 45.91 80.00 52.31
                        L 80.00 80.00
                        L 40.81 79.86
                        Q 46.22 74.94 52.34 70.94
                        A 1.00 1.00 0.0 0 0 52.39 69.30
                        Q 44.74 63.65 43.10 62.62
                        Q 34.11 56.98 32.50 55.79
                        C 36.74 55.42 30.64 48.79 29.79 47.81
                        C 27.54 45.21 26.34 42.09 24.05 39.44
                        Q 22.66 37.82 21.32 36.20
                        C 24.14 34.92 41.40 28.26 42.25 26.79
                        Z
                        M 48.75 39.07
                        A 2.30 2.30 0.0 0 0 46.45 36.77
                        L 46.05 36.77
                        A 2.30 2.30 0.0 0 0 43.75 39.07
                        L 43.75 44.21
                        A 2.30 2.30 0.0 0 0 46.05 46.51
                        L 46.45 46.51
                        A 2.30 2.30 0.0 0 0 48.75 44.21
                        L 48.75 39.07
                        Z
                        M 58.63 54.41
                        C 54.90 57.18 50.72 56.87 46.91 54.39
                        A 1.00 0.99 51.9 0 0 46.04 54.28
                        C 42.37 55.52 43.88 58.13 46.28 59.41
                        Q 53.38 63.20 60.15 58.94
                        C 62.54 57.43 62.47 54.80 59.41 54.23
                        A 1.00 1.00 0.0 0 0 58.63 54.41
                        Z"></path>
                    <path fill="#499c85" d="M 9.75 40.96
                        Q 5.15 43.50 0.05 44.46
                        L 0.00 36.94
                        L 0.22 35.85
                        A 1.00 1.00 0.0 0 1 1.71 35.19
                        Q 5.99 37.71 9.75 40.96
                        Z"></path>
                    <path fill="#70dac0" d="M 21.32 36.20
                        Q 22.66 37.82 24.05 39.44
                        C 26.34 42.09 27.54 45.21 29.79 47.81
                        C 30.64 48.79 36.74 55.42 32.50 55.79
                        L 11.00 41.21
                        Q 15.81 38.21 21.32 36.20
                        Z"></path>
                    <rect fill="#000000" x="43.75" y="36.77" width="5.00" height="9.74" rx="2.30"></rect>
                    <path fill="#000000" d="M 58.50 36.79
                        Q 62.43 36.88 62.46 40.67
                        L 61.94 44.74
                        Q 61.91 44.99 61.77 45.19
                        C 60.02 47.68 57.53 46.71 56.86 44.07
                        Q 55.85 40.04 58.50 36.79
                        Z"></path>
                    <path fill="#4dd1a0" d="M 9.75 40.96
                        L 11.00 41.21
                        L 32.50 55.79
                        Q 34.11 56.98 43.10 62.62
                        Q 44.74 63.65 52.39 69.30
                        A 1.00 1.00 0.0 0 1 52.34 70.94
                        Q 46.22 74.94 40.81 79.86
                        L 11.19 80.00
                        Q 12.51 79.61 11.57 78.67
                        Q 5.99 73.11 1.70 65.70
                        C 1.28 64.97 0.74 64.76 0.00 65.19
                        L 0.05 44.46
                        Q 5.15 43.50 9.75 40.96
                        Z"></path>
                    <path fill="#000000" d="M 46.91 54.39
                        C 50.72 56.87 54.90 57.18 58.63 54.41
                        A 1.00 1.00 0.0 0 1 59.41 54.23
                        C 62.47 54.80 62.54 57.43 60.15 58.94
                        Q 53.38 63.20 46.28 59.41
                        C 43.88 58.13 42.37 55.52 46.04 54.28
                        A 1.00 0.99 51.9 0 1 46.91 54.39
                        Z"></path>
                    <path fill="#43ce7c" d="M 11.19 80.00
                        L 0.00 80.00
                        L 0.00 65.19
                        C 0.74 64.76 1.28 64.97 1.70 65.70
                        Q 5.99 73.11 11.57 78.67
                        Q 12.51 79.61 11.19 80.00
                        Z"></path>
                  </svg>
                </div>
                <div class="textp">
                  <div class="text_m">CSS Theme Switch</div>
                  <div class="text_s">Praashoo7</div>
                </div>
              </div>
              <div class="btns">
                <div class="likes">
                  <svg class="likes_svg" viewBox="-2 0 105 92">
                    <path d="M85.24 2.67C72.29-3.08 55.75 2.67 50 14.9 44.25 2 27-3.8 14.76 2.67 1.1 9.14-5.37 25 5.42 44.38 13.33 58 27 68.11 50 86.81 73.73 68.11 87.39 58 94.58 44.38c10.79-18.7 4.32-35.24-9.34-41.71Z"></path>
                  </svg><span class="likes_text">22</span>
                </div>
                <div class="comments">
                  <svg class="comments_svg" viewBox="-405.9 238 56.3 54.8" title="Comment">
                    <path d="M-391 291.4c0 1.5 1.2 1.7 1.9 1.2 1.8-1.6 15.9-14.6 15.9-14.6h19.3c3.8 0 4.4-.8 4.4-4.5v-31.1c0-3.7-.8-4.5-4.4-4.5h-47.4c-3.6 0-4.4.9-4.4 4.5v31.1c0 3.7.7 4.4 4.4 4.4h10.4v13.5z"></path>
                  </svg><span class="comments_text">12</span>
                </div>
                <div class="views">
                  <svg class="views_svg" viewBox="0 0 30.5 16.5" title="Views">
                    <path d="M15.3 0C8.9 0 3.3 3.3 0 8.3c3.3 5 8.9 8.3 15.3 8.3s12-3.3 15.3-8.3C27.3 3.3 21.7 0 15.3 0zm0 14.5c-3.4 0-6.2-2.8-6.2-6.2C9 4.8 11.8 2 15.3 2c3.4 0 6.2 2.8 6.2 6.2 0 3.5-2.8 6.3-6.2 6.3z"></path>
                  </svg><span class="views_text">332</span>
                </div>
              </div>
            </div>
          </div>

          <!-- box 3 -->
          <div class="text-center text-gray-500 dark:text-gray-400">
            <div class="main">
              <div class="cardp">
                <div class="fl">
                  <div class="fullscreen">
                    <svg viewBox="0 0 100 100" class="fullscreen_svg">
                      <path d="M3.563-.004a3.573 3.573 0 0 0-3.527 4.09l-.004-.02v28.141c0 1.973 1.602 3.57 3.57 3.57s3.57-1.598 3.57-3.57V12.218v.004l22.461 22.461a3.571 3.571 0 0 0 6.093-2.527c0-.988-.398-1.879-1.047-2.523L12.218 7.172h19.989c1.973 0 3.57-1.602 3.57-3.57s-1.598-3.57-3.57-3.57H4.035a3.008 3.008 0 0 0-.473-.035zM96.333 0l-.398.035.02-.004h-28.16a3.569 3.569 0 0 0-3.57 3.57 3.569 3.569 0 0 0 3.57 3.57h19.989L65.323 29.632a3.555 3.555 0 0 0-1.047 2.523 3.571 3.571 0 0 0 6.093 2.527L92.83 12.221v19.985a3.569 3.569 0 0 0 3.57 3.57 3.569 3.569 0 0 0 3.57-3.57V4.034v.004a3.569 3.569 0 0 0-3.539-4.043l-.105.004zM3.548 64.23A3.573 3.573 0 0 0 .029 67.8v28.626-.004l.016.305-.004-.016.004.059v-.012l.039.289-.004-.023.023.121-.004-.023c.074.348.191.656.34.938l-.008-.02.055.098-.008-.02.148.242-.008-.012.055.082-.008-.012c.199.285.43.531.688.742l.008.008.031.027.004.004c.582.461 1.32.742 2.121.762h.004l.078.004h28.61a3.569 3.569 0 0 0 3.57-3.57 3.569 3.569 0 0 0-3.57-3.57H12.224l22.461-22.461a3.569 3.569 0 0 0-2.492-6.125l-.105.004h.008a3.562 3.562 0 0 0-2.453 1.074L7.182 87.778V67.793a3.571 3.571 0 0 0-3.57-3.57h-.055.004zm92.805 0a3.573 3.573 0 0 0-3.519 3.57v19.993-.004L70.373 65.328a3.553 3.553 0 0 0-2.559-1.082h-.004a3.573 3.573 0 0 0-3.566 3.57c0 1.004.414 1.91 1.082 2.555l22.461 22.461H67.802a3.57 3.57 0 1 0 0 7.14h28.606c.375 0 .742-.059 1.082-.168l-.023.008.027-.012-.02.008.352-.129-.023.008.039-.02-.02.008.32-.156-.02.008.023-.016-.008.008c.184-.102.34-.207.488-.32l-.008.008.137-.113-.008.004.223-.211.008-.008c.156-.164.301-.34.422-.535l.008-.016-.008.016.008-.02.164-.285.008-.02-.008.016.008-.02c.098-.188.184-.406.246-.633l.008-.023-.004.008.008-.023a3.44 3.44 0 0 0 .121-.852v-.004l.004-.078V67.804a3.569 3.569 0 0 0-3.57-3.57h-.055.004z"></path>
                    </svg>
                  </div>
                </div>
                <div class="card_content">
                  <label class="switch_738">
                    <input type="checkbox" class="chk_738">
                    <span class="slider_738"></span>
                  </label>
                </div>
                <div class="card_back"></div>
              </div>
              <div class="data">
                <div class="img">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 80 80">
                    <g stroke-width="2.00" fill="none" stroke-linecap="butt">
                      <path stroke="#59afb1" d="M 14.06 0.00
                        Q 13.33 4.09 13.93 7.52
                        A 1.04 1.02 -78.7 0 0 14.37 8.19
                        L 32.87 20.19"></path>
                      <path stroke="#4fa6a8" d="M 32.87 20.19
                        L 42.25 26.79"></path>
                      <path stroke="#69cbc0" d="M 42.25 26.79
                        C 41.40 28.26 24.14 34.92 21.32 36.20"></path>
                      <path stroke="#6fcdbb" d="M 21.32 36.20
                        Q 15.81 38.21 11.00 41.21"></path>
                      <path stroke="#5ec8ab" d="M 11.00 41.21
                        L 9.75 40.96"></path>
                      <path stroke="#5cae9e" d="M 9.75 40.96
                        Q 5.99 37.71 1.71 35.19
                        A 1.00 1.00 0.0 0 0 0.22 35.85
                        L 0.00 36.94"></path>
                      <path stroke="#3190a6" d="M 79.95 6.12
                        L 62.46 11.32"></path>
                      <path stroke="#3a96a3" d="M 62.46 11.32
                        Q 47.42 14.67 32.87 20.19"></path>
                      <path stroke="#22a3be" d="M 80.00 11.06
                        L 64.50 17.46"></path>
                      <path stroke="#28879d" d="M 64.50 17.46
                        L 62.46 11.32"></path>
                      <path stroke="#2ba9bb" d="M 64.50 17.46
                        L 43.00 26.96"></path>
                      <path stroke="#4ab2b2" d="M 43.00 26.96
                        L 42.25 26.79"></path>
                      <path stroke="#45ced3" d="M 80.00 52.31
                        Q 71.64 45.91 62.46 40.67"></path>
                      <path stroke="#13636e" d="M 62.46 40.67
                        Q 62.43 36.88 58.50 36.79"></path>
                      <path stroke="#45ced3" d="M 58.50 36.79
                        Q 50.07 32.95 43.00 26.96"></path>
                      <path stroke="#326b65" d="M 58.50 36.79
                        Q 55.85 40.04 56.86 44.07
                        C 57.53 46.71 60.02 47.68 61.77 45.19
                        Q 61.91 44.99 61.94 44.74
                        L 62.46 40.67"></path>
                      <path stroke="#59d4b5" d="M 40.81 79.86
                        Q 46.22 74.94 52.34 70.94
                        A 1.00 1.00 0.0 0 0 52.39 69.30
                        Q 44.74 63.65 43.10 62.62
                        Q 34.11 56.98 32.50 55.79"></path>
                      <path stroke="#6ad8c5" d="M 32.50 55.79
                        C 36.74 55.42 30.64 48.79 29.79 47.81
                        C 27.54 45.21 26.34 42.09 24.05 39.44
                        Q 22.66 37.82 21.32 36.20"></path>
                      <path stroke="#326b65" d="M 48.75 39.07
                        A 2.30 2.30 0.0 0 0 46.45 36.77
                        L 46.05 36.77
                        A 2.30 2.30 0.0 0 0 43.75 39.07
                        L 43.75 44.21
                        A 2.30 2.30 0.0 0 0 46.05 46.51
                        L 46.45 46.51
                        A 2.30 2.30 0.0 0 0 48.75 44.21
                        L 48.75 39.07"></path>
                      <path stroke="#326b65" d="M 58.63 54.41
                        C 54.90 57.18 50.72 56.87 46.91 54.39
                        A 1.00 0.99 51.9 0 0 46.04 54.28
                        C 42.37 55.52 43.88 58.13 46.28 59.41
                        Q 53.38 63.20 60.15 58.94
                        C 62.54 57.43 62.47 54.80 59.41 54.23
                        A 1.00 1.00 0.0 0 0 58.63 54.41"></path>
                      <path stroke="#4bb793" d="M 9.75 40.96
                        Q 5.15 43.50 0.05 44.46"></path>
                      <path stroke="#5fd6b0" d="M 32.50 55.79
                        L 11.00 41.21"></path>
                      <path stroke="#48d08e" d="M 11.19 80.00
                        Q 12.51 79.61 11.57 78.67
                        Q 5.99 73.11 1.70 65.70
                        C 1.28 64.97 0.74 64.76 0.00 65.19"></path>
                    </g>
                    <path fill="#6ebfb6" d="M 0.00 0.00
                        L 14.06 0.00
                        Q 13.33 4.09 13.93 7.52
                        A 1.04 1.02 -78.7 0 0 14.37 8.19
                        L 32.87 20.19
                        L 42.25 26.79
                        C 41.40 28.26 24.14 34.92 21.32 36.20
                        Q 15.81 38.21 11.00 41.21
                        L 9.75 40.96
                        Q 5.99 37.71 1.71 35.19
                        A 1.00 1.00 0.0 0 0 0.22 35.85
                        L 0.00 36.94
                        L 0.00 0.00
                        Z"></path>
                    <path fill="#439eac" d="M 14.06 0.00
                        L 80.00 0.00
                        L 79.95 6.12
                        L 62.46 11.32
                        Q 47.42 14.67 32.87 20.19
                        L 14.37 8.19
                        A 1.04 1.02 -78.7 0 1 13.93 7.52
                        Q 13.33 4.09 14.06 0.00
                        Z"></path>
                    <path fill="#1f81a0" d="M 79.95 6.12
                        L 80.00 11.06
                        L 64.50 17.46
                        L 62.46 11.32
                        L 79.95 6.12
                        Z"></path>
                    <path fill="#308d99" d="M 62.46 11.32
                        L 64.50 17.46
                        L 43.00 26.96
                        L 42.25 26.79
                        L 32.87 20.19
                        Q 47.42 14.67 62.46 11.32
                        Z"></path>
                    <path fill="#25c5dc" d="M 80.00 11.06
                        L 80.00 52.31
                        Q 71.64 45.91 62.46 40.67
                        Q 62.43 36.88 58.50 36.79
                        Q 50.07 32.95 43.00 26.96
                        L 64.50 17.46
                        L 80.00 11.06
                        Z"></path>
                    <path fill="#64d6ca" d="M 42.25 26.79
                        L 43.00 26.96
                        Q 50.07 32.95 58.50 36.79
                        Q 55.85 40.04 56.86 44.07
                        C 57.53 46.71 60.02 47.68 61.77 45.19
                        Q 61.91 44.99 61.94 44.74
                        L 62.46 40.67
                        Q 71.64 45.91 80.00 52.31
                        L 80.00 80.00
                        L 40.81 79.86
                        Q 46.22 74.94 52.34 70.94
                        A 1.00 1.00 0.0 0 0 52.39 69.30
                        Q 44.74 63.65 43.10 62.62
                        Q 34.11 56.98 32.50 55.79
                        C 36.74 55.42 30.64 48.79 29.79 47.81
                        C 27.54 45.21 26.34 42.09 24.05 39.44
                        Q 22.66 37.82 21.32 36.20
                        C 24.14 34.92 41.40 28.26 42.25 26.79
                        Z
                        M 48.75 39.07
                        A 2.30 2.30 0.0 0 0 46.45 36.77
                        L 46.05 36.77
                        A 2.30 2.30 0.0 0 0 43.75 39.07
                        L 43.75 44.21
                        A 2.30 2.30 0.0 0 0 46.05 46.51
                        L 46.45 46.51
                        A 2.30 2.30 0.0 0 0 48.75 44.21
                        L 48.75 39.07
                        Z
                        M 58.63 54.41
                        C 54.90 57.18 50.72 56.87 46.91 54.39
                        A 1.00 0.99 51.9 0 0 46.04 54.28
                        C 42.37 55.52 43.88 58.13 46.28 59.41
                        Q 53.38 63.20 60.15 58.94
                        C 62.54 57.43 62.47 54.80 59.41 54.23
                        A 1.00 1.00 0.0 0 0 58.63 54.41
                        Z"></path>
                    <path fill="#499c85" d="M 9.75 40.96
                        Q 5.15 43.50 0.05 44.46
                        L 0.00 36.94
                        L 0.22 35.85
                        A 1.00 1.00 0.0 0 1 1.71 35.19
                        Q 5.99 37.71 9.75 40.96
                        Z"></path>
                    <path fill="#70dac0" d="M 21.32 36.20
                        Q 22.66 37.82 24.05 39.44
                        C 26.34 42.09 27.54 45.21 29.79 47.81
                        C 30.64 48.79 36.74 55.42 32.50 55.79
                        L 11.00 41.21
                        Q 15.81 38.21 21.32 36.20
                        Z"></path>
                    <rect fill="#000000" x="43.75" y="36.77" width="5.00" height="9.74" rx="2.30"></rect>
                    <path fill="#000000" d="M 58.50 36.79
                        Q 62.43 36.88 62.46 40.67
                        L 61.94 44.74
                        Q 61.91 44.99 61.77 45.19
                        C 60.02 47.68 57.53 46.71 56.86 44.07
                        Q 55.85 40.04 58.50 36.79
                        Z"></path>
                    <path fill="#4dd1a0" d="M 9.75 40.96
                        L 11.00 41.21
                        L 32.50 55.79
                        Q 34.11 56.98 43.10 62.62
                        Q 44.74 63.65 52.39 69.30
                        A 1.00 1.00 0.0 0 1 52.34 70.94
                        Q 46.22 74.94 40.81 79.86
                        L 11.19 80.00
                        Q 12.51 79.61 11.57 78.67
                        Q 5.99 73.11 1.70 65.70
                        C 1.28 64.97 0.74 64.76 0.00 65.19
                        L 0.05 44.46
                        Q 5.15 43.50 9.75 40.96
                        Z"></path>
                    <path fill="#000000" d="M 46.91 54.39
                        C 50.72 56.87 54.90 57.18 58.63 54.41
                        A 1.00 1.00 0.0 0 1 59.41 54.23
                        C 62.47 54.80 62.54 57.43 60.15 58.94
                        Q 53.38 63.20 46.28 59.41
                        C 43.88 58.13 42.37 55.52 46.04 54.28
                        A 1.00 0.99 51.9 0 1 46.91 54.39
                        Z"></path>
                    <path fill="#43ce7c" d="M 11.19 80.00
                        L 0.00 80.00
                        L 0.00 65.19
                        C 0.74 64.76 1.28 64.97 1.70 65.70
                        Q 5.99 73.11 11.57 78.67
                        Q 12.51 79.61 11.19 80.00
                        Z"></path>
                  </svg>
                </div>
                <div class="textp">
                  <div class="text_m">CSS Theme Switch</div>
                  <div class="text_s">Praashoo7</div>
                </div>
              </div>
              <div class="btns">
                <div class="likes">
                  <svg class="likes_svg" viewBox="-2 0 105 92">
                    <path d="M85.24 2.67C72.29-3.08 55.75 2.67 50 14.9 44.25 2 27-3.8 14.76 2.67 1.1 9.14-5.37 25 5.42 44.38 13.33 58 27 68.11 50 86.81 73.73 68.11 87.39 58 94.58 44.38c10.79-18.7 4.32-35.24-9.34-41.71Z"></path>
                  </svg><span class="likes_text">22</span>
                </div>
                <div class="comments">
                  <svg class="comments_svg" viewBox="-405.9 238 56.3 54.8" title="Comment">
                    <path d="M-391 291.4c0 1.5 1.2 1.7 1.9 1.2 1.8-1.6 15.9-14.6 15.9-14.6h19.3c3.8 0 4.4-.8 4.4-4.5v-31.1c0-3.7-.8-4.5-4.4-4.5h-47.4c-3.6 0-4.4.9-4.4 4.5v31.1c0 3.7.7 4.4 4.4 4.4h10.4v13.5z"></path>
                  </svg><span class="comments_text">12</span>
                </div>
                <div class="views">
                  <svg class="views_svg" viewBox="0 0 30.5 16.5" title="Views">
                    <path d="M15.3 0C8.9 0 3.3 3.3 0 8.3c3.3 5 8.9 8.3 15.3 8.3s12-3.3 15.3-8.3C27.3 3.3 21.7 0 15.3 0zm0 14.5c-3.4 0-6.2-2.8-6.2-6.2C9 4.8 11.8 2 15.3 2c3.4 0 6.2 2.8 6.2 6.2 0 3.5-2.8 6.3-6.2 6.3z"></path>
                  </svg><span class="views_text">332</span>
                </div>
              </div>
            </div>
          </div>

          <!-- box 4  -->
          <div class="text-center text-gray-500 dark:text-gray-400">
            <div class="main">
              <div class="cardp">
                <div class="fl">
                  <div class="fullscreen">
                    <svg viewBox="0 0 100 100" class="fullscreen_svg">
                      <path d="M3.563-.004a3.573 3.573 0 0 0-3.527 4.09l-.004-.02v28.141c0 1.973 1.602 3.57 3.57 3.57s3.57-1.598 3.57-3.57V12.218v.004l22.461 22.461a3.571 3.571 0 0 0 6.093-2.527c0-.988-.398-1.879-1.047-2.523L12.218 7.172h19.989c1.973 0 3.57-1.602 3.57-3.57s-1.598-3.57-3.57-3.57H4.035a3.008 3.008 0 0 0-.473-.035zM96.333 0l-.398.035.02-.004h-28.16a3.569 3.569 0 0 0-3.57 3.57 3.569 3.569 0 0 0 3.57 3.57h19.989L65.323 29.632a3.555 3.555 0 0 0-1.047 2.523 3.571 3.571 0 0 0 6.093 2.527L92.83 12.221v19.985a3.569 3.569 0 0 0 3.57 3.57 3.569 3.569 0 0 0 3.57-3.57V4.034v.004a3.569 3.569 0 0 0-3.539-4.043l-.105.004zM3.548 64.23A3.573 3.573 0 0 0 .029 67.8v28.626-.004l.016.305-.004-.016.004.059v-.012l.039.289-.004-.023.023.121-.004-.023c.074.348.191.656.34.938l-.008-.02.055.098-.008-.02.148.242-.008-.012.055.082-.008-.012c.199.285.43.531.688.742l.008.008.031.027.004.004c.582.461 1.32.742 2.121.762h.004l.078.004h28.61a3.569 3.569 0 0 0 3.57-3.57 3.569 3.569 0 0 0-3.57-3.57H12.224l22.461-22.461a3.569 3.569 0 0 0-2.492-6.125l-.105.004h.008a3.562 3.562 0 0 0-2.453 1.074L7.182 87.778V67.793a3.571 3.571 0 0 0-3.57-3.57h-.055.004zm92.805 0a3.573 3.573 0 0 0-3.519 3.57v19.993-.004L70.373 65.328a3.553 3.553 0 0 0-2.559-1.082h-.004a3.573 3.573 0 0 0-3.566 3.57c0 1.004.414 1.91 1.082 2.555l22.461 22.461H67.802a3.57 3.57 0 1 0 0 7.14h28.606c.375 0 .742-.059 1.082-.168l-.023.008.027-.012-.02.008.352-.129-.023.008.039-.02-.02.008.32-.156-.02.008.023-.016-.008.008c.184-.102.34-.207.488-.32l-.008.008.137-.113-.008.004.223-.211.008-.008c.156-.164.301-.34.422-.535l.008-.016-.008.016.008-.02.164-.285.008-.02-.008.016.008-.02c.098-.188.184-.406.246-.633l.008-.023-.004.008.008-.023a3.44 3.44 0 0 0 .121-.852v-.004l.004-.078V67.804a3.569 3.569 0 0 0-3.57-3.57h-.055.004z"></path>
                    </svg>
                  </div>
                </div>
                <div class="card_content">
                  <label class="switch_738">
                    <input type="checkbox" class="chk_738">
                    <span class="slider_738"></span>
                  </label>
                </div>
                <div class="card_back"></div>
              </div>
              <div class="data">
                <div class="img">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 80 80">
                    <g stroke-width="2.00" fill="none" stroke-linecap="butt">
                      <path stroke="#59afb1" d="M 14.06 0.00
                        Q 13.33 4.09 13.93 7.52
                        A 1.04 1.02 -78.7 0 0 14.37 8.19
                        L 32.87 20.19"></path>
                      <path stroke="#4fa6a8" d="M 32.87 20.19
                        L 42.25 26.79"></path>
                      <path stroke="#69cbc0" d="M 42.25 26.79
                        C 41.40 28.26 24.14 34.92 21.32 36.20"></path>
                      <path stroke="#6fcdbb" d="M 21.32 36.20
                        Q 15.81 38.21 11.00 41.21"></path>
                      <path stroke="#5ec8ab" d="M 11.00 41.21
                        L 9.75 40.96"></path>
                      <path stroke="#5cae9e" d="M 9.75 40.96
                        Q 5.99 37.71 1.71 35.19
                        A 1.00 1.00 0.0 0 0 0.22 35.85
                        L 0.00 36.94"></path>
                      <path stroke="#3190a6" d="M 79.95 6.12
                        L 62.46 11.32"></path>
                      <path stroke="#3a96a3" d="M 62.46 11.32
                        Q 47.42 14.67 32.87 20.19"></path>
                      <path stroke="#22a3be" d="M 80.00 11.06
                        L 64.50 17.46"></path>
                      <path stroke="#28879d" d="M 64.50 17.46
                        L 62.46 11.32"></path>
                      <path stroke="#2ba9bb" d="M 64.50 17.46
                        L 43.00 26.96"></path>
                      <path stroke="#4ab2b2" d="M 43.00 26.96
                        L 42.25 26.79"></path>
                      <path stroke="#45ced3" d="M 80.00 52.31
                        Q 71.64 45.91 62.46 40.67"></path>
                      <path stroke="#13636e" d="M 62.46 40.67
                        Q 62.43 36.88 58.50 36.79"></path>
                      <path stroke="#45ced3" d="M 58.50 36.79
                        Q 50.07 32.95 43.00 26.96"></path>
                      <path stroke="#326b65" d="M 58.50 36.79
                        Q 55.85 40.04 56.86 44.07
                        C 57.53 46.71 60.02 47.68 61.77 45.19
                        Q 61.91 44.99 61.94 44.74
                        L 62.46 40.67"></path>
                      <path stroke="#59d4b5" d="M 40.81 79.86
                        Q 46.22 74.94 52.34 70.94
                        A 1.00 1.00 0.0 0 0 52.39 69.30
                        Q 44.74 63.65 43.10 62.62
                        Q 34.11 56.98 32.50 55.79"></path>
                      <path stroke="#6ad8c5" d="M 32.50 55.79
                        C 36.74 55.42 30.64 48.79 29.79 47.81
                        C 27.54 45.21 26.34 42.09 24.05 39.44
                        Q 22.66 37.82 21.32 36.20"></path>
                      <path stroke="#326b65" d="M 48.75 39.07
                        A 2.30 2.30 0.0 0 0 46.45 36.77
                        L 46.05 36.77
                        A 2.30 2.30 0.0 0 0 43.75 39.07
                        L 43.75 44.21
                        A 2.30 2.30 0.0 0 0 46.05 46.51
                        L 46.45 46.51
                        A 2.30 2.30 0.0 0 0 48.75 44.21
                        L 48.75 39.07"></path>
                      <path stroke="#326b65" d="M 58.63 54.41
                        C 54.90 57.18 50.72 56.87 46.91 54.39
                        A 1.00 0.99 51.9 0 0 46.04 54.28
                        C 42.37 55.52 43.88 58.13 46.28 59.41
                        Q 53.38 63.20 60.15 58.94
                        C 62.54 57.43 62.47 54.80 59.41 54.23
                        A 1.00 1.00 0.0 0 0 58.63 54.41"></path>
                      <path stroke="#4bb793" d="M 9.75 40.96
                        Q 5.15 43.50 0.05 44.46"></path>
                      <path stroke="#5fd6b0" d="M 32.50 55.79
                        L 11.00 41.21"></path>
                      <path stroke="#48d08e" d="M 11.19 80.00
                        Q 12.51 79.61 11.57 78.67
                        Q 5.99 73.11 1.70 65.70
                        C 1.28 64.97 0.74 64.76 0.00 65.19"></path>
                    </g>
                    <path fill="#6ebfb6" d="M 0.00 0.00
                        L 14.06 0.00
                        Q 13.33 4.09 13.93 7.52
                        A 1.04 1.02 -78.7 0 0 14.37 8.19
                        L 32.87 20.19
                        L 42.25 26.79
                        C 41.40 28.26 24.14 34.92 21.32 36.20
                        Q 15.81 38.21 11.00 41.21
                        L 9.75 40.96
                        Q 5.99 37.71 1.71 35.19
                        A 1.00 1.00 0.0 0 0 0.22 35.85
                        L 0.00 36.94
                        L 0.00 0.00
                        Z"></path>
                    <path fill="#439eac" d="M 14.06 0.00
                        L 80.00 0.00
                        L 79.95 6.12
                        L 62.46 11.32
                        Q 47.42 14.67 32.87 20.19
                        L 14.37 8.19
                        A 1.04 1.02 -78.7 0 1 13.93 7.52
                        Q 13.33 4.09 14.06 0.00
                        Z"></path>
                    <path fill="#1f81a0" d="M 79.95 6.12
                        L 80.00 11.06
                        L 64.50 17.46
                        L 62.46 11.32
                        L 79.95 6.12
                        Z"></path>
                    <path fill="#308d99" d="M 62.46 11.32
                        L 64.50 17.46
                        L 43.00 26.96
                        L 42.25 26.79
                        L 32.87 20.19
                        Q 47.42 14.67 62.46 11.32
                        Z"></path>
                    <path fill="#25c5dc" d="M 80.00 11.06
                        L 80.00 52.31
                        Q 71.64 45.91 62.46 40.67
                        Q 62.43 36.88 58.50 36.79
                        Q 50.07 32.95 43.00 26.96
                        L 64.50 17.46
                        L 80.00 11.06
                        Z"></path>
                    <path fill="#64d6ca" d="M 42.25 26.79
                        L 43.00 26.96
                        Q 50.07 32.95 58.50 36.79
                        Q 55.85 40.04 56.86 44.07
                        C 57.53 46.71 60.02 47.68 61.77 45.19
                        Q 61.91 44.99 61.94 44.74
                        L 62.46 40.67
                        Q 71.64 45.91 80.00 52.31
                        L 80.00 80.00
                        L 40.81 79.86
                        Q 46.22 74.94 52.34 70.94
                        A 1.00 1.00 0.0 0 0 52.39 69.30
                        Q 44.74 63.65 43.10 62.62
                        Q 34.11 56.98 32.50 55.79
                        C 36.74 55.42 30.64 48.79 29.79 47.81
                        C 27.54 45.21 26.34 42.09 24.05 39.44
                        Q 22.66 37.82 21.32 36.20
                        C 24.14 34.92 41.40 28.26 42.25 26.79
                        Z
                        M 48.75 39.07
                        A 2.30 2.30 0.0 0 0 46.45 36.77
                        L 46.05 36.77
                        A 2.30 2.30 0.0 0 0 43.75 39.07
                        L 43.75 44.21
                        A 2.30 2.30 0.0 0 0 46.05 46.51
                        L 46.45 46.51
                        A 2.30 2.30 0.0 0 0 48.75 44.21
                        L 48.75 39.07
                        Z
                        M 58.63 54.41
                        C 54.90 57.18 50.72 56.87 46.91 54.39
                        A 1.00 0.99 51.9 0 0 46.04 54.28
                        C 42.37 55.52 43.88 58.13 46.28 59.41
                        Q 53.38 63.20 60.15 58.94
                        C 62.54 57.43 62.47 54.80 59.41 54.23
                        A 1.00 1.00 0.0 0 0 58.63 54.41
                        Z"></path>
                    <path fill="#499c85" d="M 9.75 40.96
                        Q 5.15 43.50 0.05 44.46
                        L 0.00 36.94
                        L 0.22 35.85
                        A 1.00 1.00 0.0 0 1 1.71 35.19
                        Q 5.99 37.71 9.75 40.96
                        Z"></path>
                    <path fill="#70dac0" d="M 21.32 36.20
                        Q 22.66 37.82 24.05 39.44
                        C 26.34 42.09 27.54 45.21 29.79 47.81
                        C 30.64 48.79 36.74 55.42 32.50 55.79
                        L 11.00 41.21
                        Q 15.81 38.21 21.32 36.20
                        Z"></path>
                    <rect fill="#000000" x="43.75" y="36.77" width="5.00" height="9.74" rx="2.30"></rect>
                    <path fill="#000000" d="M 58.50 36.79
                        Q 62.43 36.88 62.46 40.67
                        L 61.94 44.74
                        Q 61.91 44.99 61.77 45.19
                        C 60.02 47.68 57.53 46.71 56.86 44.07
                        Q 55.85 40.04 58.50 36.79
                        Z"></path>
                    <path fill="#4dd1a0" d="M 9.75 40.96
                        L 11.00 41.21
                        L 32.50 55.79
                        Q 34.11 56.98 43.10 62.62
                        Q 44.74 63.65 52.39 69.30
                        A 1.00 1.00 0.0 0 1 52.34 70.94
                        Q 46.22 74.94 40.81 79.86
                        L 11.19 80.00
                        Q 12.51 79.61 11.57 78.67
                        Q 5.99 73.11 1.70 65.70
                        C 1.28 64.97 0.74 64.76 0.00 65.19
                        L 0.05 44.46
                        Q 5.15 43.50 9.75 40.96
                        Z"></path>
                    <path fill="#000000" d="M 46.91 54.39
                        C 50.72 56.87 54.90 57.18 58.63 54.41
                        A 1.00 1.00 0.0 0 1 59.41 54.23
                        C 62.47 54.80 62.54 57.43 60.15 58.94
                        Q 53.38 63.20 46.28 59.41
                        C 43.88 58.13 42.37 55.52 46.04 54.28
                        A 1.00 0.99 51.9 0 1 46.91 54.39
                        Z"></path>
                    <path fill="#43ce7c" d="M 11.19 80.00
                        L 0.00 80.00
                        L 0.00 65.19
                        C 0.74 64.76 1.28 64.97 1.70 65.70
                        Q 5.99 73.11 11.57 78.67
                        Q 12.51 79.61 11.19 80.00
                        Z"></path>
                  </svg>
                </div>
                <div class="textp">
                  <div class="text_m">CSS Theme Switch</div>
                  <div class="text_s">Praashoo7</div>
                </div>
              </div>
              <div class="btns">
                <div class="likes">
                  <svg class="likes_svg" viewBox="-2 0 105 92">
                    <path d="M85.24 2.67C72.29-3.08 55.75 2.67 50 14.9 44.25 2 27-3.8 14.76 2.67 1.1 9.14-5.37 25 5.42 44.38 13.33 58 27 68.11 50 86.81 73.73 68.11 87.39 58 94.58 44.38c10.79-18.7 4.32-35.24-9.34-41.71Z"></path>
                  </svg><span class="likes_text">22</span>
                </div>
                <div class="comments">
                  <svg class="comments_svg" viewBox="-405.9 238 56.3 54.8" title="Comment">
                    <path d="M-391 291.4c0 1.5 1.2 1.7 1.9 1.2 1.8-1.6 15.9-14.6 15.9-14.6h19.3c3.8 0 4.4-.8 4.4-4.5v-31.1c0-3.7-.8-4.5-4.4-4.5h-47.4c-3.6 0-4.4.9-4.4 4.5v31.1c0 3.7.7 4.4 4.4 4.4h10.4v13.5z"></path>
                  </svg><span class="comments_text">12</span>
                </div>
                <div class="views">
                  <svg class="views_svg" viewBox="0 0 30.5 16.5" title="Views">
                    <path d="M15.3 0C8.9 0 3.3 3.3 0 8.3c3.3 5 8.9 8.3 15.3 8.3s12-3.3 15.3-8.3C27.3 3.3 21.7 0 15.3 0zm0 14.5c-3.4 0-6.2-2.8-6.2-6.2C9 4.8 11.8 2 15.3 2c3.4 0 6.2 2.8 6.2 6.2 0 3.5-2.8 6.3-6.2 6.3z"></path>
                  </svg><span class="views_text">332</span>
                </div>
              </div>
            </div>
          </div>

          <!-- box 5  -->
          <div class="text-center text-gray-500 dark:text-gray-400">
            <div class="main">
              <div class="cardp">
                <div class="fl">
                  <div class="fullscreen">
                    <svg viewBox="0 0 100 100" class="fullscreen_svg">
                      <path d="M3.563-.004a3.573 3.573 0 0 0-3.527 4.09l-.004-.02v28.141c0 1.973 1.602 3.57 3.57 3.57s3.57-1.598 3.57-3.57V12.218v.004l22.461 22.461a3.571 3.571 0 0 0 6.093-2.527c0-.988-.398-1.879-1.047-2.523L12.218 7.172h19.989c1.973 0 3.57-1.602 3.57-3.57s-1.598-3.57-3.57-3.57H4.035a3.008 3.008 0 0 0-.473-.035zM96.333 0l-.398.035.02-.004h-28.16a3.569 3.569 0 0 0-3.57 3.57 3.569 3.569 0 0 0 3.57 3.57h19.989L65.323 29.632a3.555 3.555 0 0 0-1.047 2.523 3.571 3.571 0 0 0 6.093 2.527L92.83 12.221v19.985a3.569 3.569 0 0 0 3.57 3.57 3.569 3.569 0 0 0 3.57-3.57V4.034v.004a3.569 3.569 0 0 0-3.539-4.043l-.105.004zM3.548 64.23A3.573 3.573 0 0 0 .029 67.8v28.626-.004l.016.305-.004-.016.004.059v-.012l.039.289-.004-.023.023.121-.004-.023c.074.348.191.656.34.938l-.008-.02.055.098-.008-.02.148.242-.008-.012.055.082-.008-.012c.199.285.43.531.688.742l.008.008.031.027.004.004c.582.461 1.32.742 2.121.762h.004l.078.004h28.61a3.569 3.569 0 0 0 3.57-3.57 3.569 3.569 0 0 0-3.57-3.57H12.224l22.461-22.461a3.569 3.569 0 0 0-2.492-6.125l-.105.004h.008a3.562 3.562 0 0 0-2.453 1.074L7.182 87.778V67.793a3.571 3.571 0 0 0-3.57-3.57h-.055.004zm92.805 0a3.573 3.573 0 0 0-3.519 3.57v19.993-.004L70.373 65.328a3.553 3.553 0 0 0-2.559-1.082h-.004a3.573 3.573 0 0 0-3.566 3.57c0 1.004.414 1.91 1.082 2.555l22.461 22.461H67.802a3.57 3.57 0 1 0 0 7.14h28.606c.375 0 .742-.059 1.082-.168l-.023.008.027-.012-.02.008.352-.129-.023.008.039-.02-.02.008.32-.156-.02.008.023-.016-.008.008c.184-.102.34-.207.488-.32l-.008.008.137-.113-.008.004.223-.211.008-.008c.156-.164.301-.34.422-.535l.008-.016-.008.016.008-.02.164-.285.008-.02-.008.016.008-.02c.098-.188.184-.406.246-.633l.008-.023-.004.008.008-.023a3.44 3.44 0 0 0 .121-.852v-.004l.004-.078V67.804a3.569 3.569 0 0 0-3.57-3.57h-.055.004z"></path>
                    </svg>
                  </div>
                </div>
                <div class="card_content">
                  <label class="switch_738">
                    <input type="checkbox" class="chk_738">
                    <span class="slider_738"></span>
                  </label>
                </div>
                <div class="card_back"></div>
              </div>
              <div class="data">
                <div class="img">
                  <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 80 80">
                    <g stroke-width="2.00" fill="none" stroke-linecap="butt">
                      <path stroke="#59afb1" d="M 14.06 0.00
                        Q 13.33 4.09 13.93 7.52
                        A 1.04 1.02 -78.7 0 0 14.37 8.19
                        L 32.87 20.19"></path>
                      <path stroke="#4fa6a8" d="M 32.87 20.19
                        L 42.25 26.79"></path>
                      <path stroke="#69cbc0" d="M 42.25 26.79
                        C 41.40 28.26 24.14 34.92 21.32 36.20"></path>
                      <path stroke="#6fcdbb" d="M 21.32 36.20
                        Q 15.81 38.21 11.00 41.21"></path>
                      <path stroke="#5ec8ab" d="M 11.00 41.21
                        L 9.75 40.96"></path>
                      <path stroke="#5cae9e" d="M 9.75 40.96
                        Q 5.99 37.71 1.71 35.19
                        A 1.00 1.00 0.0 0 0 0.22 35.85
                        L 0.00 36.94"></path>
                      <path stroke="#3190a6" d="M 79.95 6.12
                        L 62.46 11.32"></path>
                      <path stroke="#3a96a3" d="M 62.46 11.32
                        Q 47.42 14.67 32.87 20.19"></path>
                      <path stroke="#22a3be" d="M 80.00 11.06
                        L 64.50 17.46"></path>
                      <path stroke="#28879d" d="M 64.50 17.46
                        L 62.46 11.32"></path>
                      <path stroke="#2ba9bb" d="M 64.50 17.46
                        L 43.00 26.96"></path>
                      <path stroke="#4ab2b2" d="M 43.00 26.96
                        L 42.25 26.79"></path>
                      <path stroke="#45ced3" d="M 80.00 52.31
                        Q 71.64 45.91 62.46 40.67"></path>
                      <path stroke="#13636e" d="M 62.46 40.67
                        Q 62.43 36.88 58.50 36.79"></path>
                      <path stroke="#45ced3" d="M 58.50 36.79
                        Q 50.07 32.95 43.00 26.96"></path>
                      <path stroke="#326b65" d="M 58.50 36.79
                        Q 55.85 40.04 56.86 44.07
                        C 57.53 46.71 60.02 47.68 61.77 45.19
                        Q 61.91 44.99 61.94 44.74
                        L 62.46 40.67"></path>
                      <path stroke="#59d4b5" d="M 40.81 79.86
                        Q 46.22 74.94 52.34 70.94
                        A 1.00 1.00 0.0 0 0 52.39 69.30
                        Q 44.74 63.65 43.10 62.62
                        Q 34.11 56.98 32.50 55.79"></path>
                      <path stroke="#6ad8c5" d="M 32.50 55.79
                        C 36.74 55.42 30.64 48.79 29.79 47.81
                        C 27.54 45.21 26.34 42.09 24.05 39.44
                        Q 22.66 37.82 21.32 36.20"></path>
                      <path stroke="#326b65" d="M 48.75 39.07
                        A 2.30 2.30 0.0 0 0 46.45 36.77
                        L 46.05 36.77
                        A 2.30 2.30 0.0 0 0 43.75 39.07
                        L 43.75 44.21
                        A 2.30 2.30 0.0 0 0 46.05 46.51
                        L 46.45 46.51
                        A 2.30 2.30 0.0 0 0 48.75 44.21
                        L 48.75 39.07"></path>
                      <path stroke="#326b65" d="M 58.63 54.41
                        C 54.90 57.18 50.72 56.87 46.91 54.39
                        A 1.00 0.99 51.9 0 0 46.04 54.28
                        C 42.37 55.52 43.88 58.13 46.28 59.41
                        Q 53.38 63.20 60.15 58.94
                        C 62.54 57.43 62.47 54.80 59.41 54.23
                        A 1.00 1.00 0.0 0 0 58.63 54.41"></path>
                      <path stroke="#4bb793" d="M 9.75 40.96
                        Q 5.15 43.50 0.05 44.46"></path>
                      <path stroke="#5fd6b0" d="M 32.50 55.79
                        L 11.00 41.21"></path>
                      <path stroke="#48d08e" d="M 11.19 80.00
                        Q 12.51 79.61 11.57 78.67
                        Q 5.99 73.11 1.70 65.70
                        C 1.28 64.97 0.74 64.76 0.00 65.19"></path>
                    </g>
                    <path fill="#6ebfb6" d="M 0.00 0.00
                        L 14.06 0.00
                        Q 13.33 4.09 13.93 7.52
                        A 1.04 1.02 -78.7 0 0 14.37 8.19
                        L 32.87 20.19
                        L 42.25 26.79
                        C 41.40 28.26 24.14 34.92 21.32 36.20
                        Q 15.81 38.21 11.00 41.21
                        L 9.75 40.96
                        Q 5.99 37.71 1.71 35.19
                        A 1.00 1.00 0.0 0 0 0.22 35.85
                        L 0.00 36.94
                        L 0.00 0.00
                        Z"></path>
                    <path fill="#439eac" d="M 14.06 0.00
                        L 80.00 0.00
                        L 79.95 6.12
                        L 62.46 11.32
                        Q 47.42 14.67 32.87 20.19
                        L 14.37 8.19
                        A 1.04 1.02 -78.7 0 1 13.93 7.52
                        Q 13.33 4.09 14.06 0.00
                        Z"></path>
                    <path fill="#1f81a0" d="M 79.95 6.12
                        L 80.00 11.06
                        L 64.50 17.46
                        L 62.46 11.32
                        L 79.95 6.12
                        Z"></path>
                    <path fill="#308d99" d="M 62.46 11.32
                        L 64.50 17.46
                        L 43.00 26.96
                        L 42.25 26.79
                        L 32.87 20.19
                        Q 47.42 14.67 62.46 11.32
                        Z"></path>
                    <path fill="#25c5dc" d="M 80.00 11.06
                        L 80.00 52.31
                        Q 71.64 45.91 62.46 40.67
                        Q 62.43 36.88 58.50 36.79
                        Q 50.07 32.95 43.00 26.96
                        L 64.50 17.46
                        L 80.00 11.06
                        Z"></path>
                    <path fill="#64d6ca" d="M 42.25 26.79
                        L 43.00 26.96
                        Q 50.07 32.95 58.50 36.79
                        Q 55.85 40.04 56.86 44.07
                        C 57.53 46.71 60.02 47.68 61.77 45.19
                        Q 61.91 44.99 61.94 44.74
                        L 62.46 40.67
                        Q 71.64 45.91 80.00 52.31
                        L 80.00 80.00
                        L 40.81 79.86
                        Q 46.22 74.94 52.34 70.94
                        A 1.00 1.00 0.0 0 0 52.39 69.30
                        Q 44.74 63.65 43.10 62.62
                        Q 34.11 56.98 32.50 55.79
                        C 36.74 55.42 30.64 48.79 29.79 47.81
                        C 27.54 45.21 26.34 42.09 24.05 39.44
                        Q 22.66 37.82 21.32 36.20
                        C 24.14 34.92 41.40 28.26 42.25 26.79
                        Z
                        M 48.75 39.07
                        A 2.30 2.30 0.0 0 0 46.45 36.77
                        L 46.05 36.77
                        A 2.30 2.30 0.0 0 0 43.75 39.07
                        L 43.75 44.21
                        A 2.30 2.30 0.0 0 0 46.05 46.51
                        L 46.45 46.51
                        A 2.30 2.30 0.0 0 0 48.75 44.21
                        L 48.75 39.07
                        Z
                        M 58.63 54.41
                        C 54.90 57.18 50.72 56.87 46.91 54.39
                        A 1.00 0.99 51.9 0 0 46.04 54.28
                        C 42.37 55.52 43.88 58.13 46.28 59.41
                        Q 53.38 63.20 60.15 58.94
                        C 62.54 57.43 62.47 54.80 59.41 54.23
                        A 1.00 1.00 0.0 0 0 58.63 54.41
                        Z"></path>
                    <path fill="#499c85" d="M 9.75 40.96
                        Q 5.15 43.50 0.05 44.46
                        L 0.00 36.94
                        L 0.22 35.85
                        A 1.00 1.00 0.0 0 1 1.71 35.19
                        Q 5.99 37.71 9.75 40.96
                        Z"></path>
                    <path fill="#70dac0" d="M 21.32 36.20
                        Q 22.66 37.82 24.05 39.44
                        C 26.34 42.09 27.54 45.21 29.79 47.81
                        C 30.64 48.79 36.74 55.42 32.50 55.79
                        L 11.00 41.21
                        Q 15.81 38.21 21.32 36.20
                        Z"></path>
                    <rect fill="#000000" x="43.75" y="36.77" width="5.00" height="9.74" rx="2.30"></rect>
                    <path fill="#000000" d="M 58.50 36.79
                        Q 62.43 36.88 62.46 40.67
                        L 61.94 44.74
                        Q 61.91 44.99 61.77 45.19
                        C 60.02 47.68 57.53 46.71 56.86 44.07
                        Q 55.85 40.04 58.50 36.79
                        Z"></path>
                    <path fill="#4dd1a0" d="M 9.75 40.96
                        L 11.00 41.21
                        L 32.50 55.79
                        Q 34.11 56.98 43.10 62.62
                        Q 44.74 63.65 52.39 69.30
                        A 1.00 1.00 0.0 0 1 52.34 70.94
                        Q 46.22 74.94 40.81 79.86
                        L 11.19 80.00
                        Q 12.51 79.61 11.57 78.67
                        Q 5.99 73.11 1.70 65.70
                        C 1.28 64.97 0.74 64.76 0.00 65.19
                        L 0.05 44.46
                        Q 5.15 43.50 9.75 40.96
                        Z"></path>
                    <path fill="#000000" d="M 46.91 54.39
                        C 50.72 56.87 54.90 57.18 58.63 54.41
                        A 1.00 1.00 0.0 0 1 59.41 54.23
                        C 62.47 54.80 62.54 57.43 60.15 58.94
                        Q 53.38 63.20 46.28 59.41
                        C 43.88 58.13 42.37 55.52 46.04 54.28
                        A 1.00 0.99 51.9 0 1 46.91 54.39
                        Z"></path>
                    <path fill="#43ce7c" d="M 11.19 80.00
                        L 0.00 80.00
                        L 0.00 65.19
                        C 0.74 64.76 1.28 64.97 1.70 65.70
                        Q 5.99 73.11 11.57 78.67
                        Q 12.51 79.61 11.19 80.00
                        Z"></path>
                  </svg>
                </div>
                <div class="textp">
                  <div class="text_m">CSS Theme Switch</div>
                  <div class="text_s">Praashoo7</div>
                </div>
              </div>
              <div class="btns">
                <div class="likes">
                  <svg class="likes_svg" viewBox="-2 0 105 92">
                    <path d="M85.24 2.67C72.29-3.08 55.75 2.67 50 14.9 44.25 2 27-3.8 14.76 2.67 1.1 9.14-5.37 25 5.42 44.38 13.33 58 27 68.11 50 86.81 73.73 68.11 87.39 58 94.58 44.38c10.79-18.7 4.32-35.24-9.34-41.71Z"></path>
                  </svg><span class="likes_text">22</span>
                </div>
                <div class="comments">
                  <svg class="comments_svg" viewBox="-405.9 238 56.3 54.8" title="Comment">
                    <path d="M-391 291.4c0 1.5 1.2 1.7 1.9 1.2 1.8-1.6 15.9-14.6 15.9-14.6h19.3c3.8 0 4.4-.8 4.4-4.5v-31.1c0-3.7-.8-4.5-4.4-4.5h-47.4c-3.6 0-4.4.9-4.4 4.5v31.1c0 3.7.7 4.4 4.4 4.4h10.4v13.5z"></path>
                  </svg><span class="comments_text">12</span>
                </div>
                <div class="views">
                  <svg class="views_svg" viewBox="0 0 30.5 16.5" title="Views">
                    <path d="M15.3 0C8.9 0 3.3 3.3 0 8.3c3.3 5 8.9 8.3 15.3 8.3s12-3.3 15.3-8.3C27.3 3.3 21.7 0 15.3 0zm0 14.5c-3.4 0-6.2-2.8-6.2-6.2C9 4.8 11.8 2 15.3 2c3.4 0 6.2 2.8 6.2 6.2 0 3.5-2.8 6.3-6.2 6.3z"></path>
                  </svg><span class="views_text">332</span>
                </div>
              </div>
            </div>
          </div>

        </div>
    </section>
  </div>

  <!-- projects end  -->

  <!-- contact  -->
  <div id="contact" class="h-full pt-[69px]">
    <section class="bg-gray-100 dark:bg-gray-900">
      <div class="max-w-screen-md px-4 py-8 mx-auto lg:py-16 delay-[300ms] duration-[600ms] taos:translate-y-[200px] taos:opacity-0" data-taos-offset="300">
        <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-center text-gray-900 dark:text-white">Contact Us</h2>
        <p class="mb-8 font-light text-center text-gray-500 lg:mb-16 dark:text-gray-400 sm:text-xl">Got a technical issue? Want to send feedback about my websites? Need details? Do you want to hire me Let us know.</p>
        <form action="#" class="space-y-8">
          <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
            <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="name@gmail.com" required>
          </div>
          <div>
            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
            <input type="text" id="subject" class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Let us know how we can help you" required>
          </div>
          <div class="sm:col-span-2">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
            <textarea id="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Leave a comment..."></textarea>
          </div>
          <button type="submit" class="px-5 py-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg sm:w-fit hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send message</button>
        </form>
      </div>
    </section>
  </div>

  <!-- contact end  -->

  <!-- gallery -->
  <div class="h-full py-6 bg-gray-100 dark:bg-gray-800 sm:py-8 lg:py-12">
    <div class="px-4 mx-auto max-w-screen-2xl md:px-8">
      <div class="flex items-center justify-between gap-8 mb-4 sm:mb-8 md:mb-12">
        <div class="flex items-center gap-12">
          <h2 class="text-2xl font-bold text-gray-800 lg:text-3xl dark:text-white">Gallery</h2>

          <p class="hidden max-w-screen-sm text-gray-500 dark:text-gray-300 md:block">
            Here, you can see all the items I'm selling in my shop. You can sign in to place an order.
          </p>
        </div>

        <a href="#" class="inline-block px-4 py-2 text-sm font-semibold text-center text-gray-500 transition duration-100 bg-white border rounded-lg outline-none dark:bg-gray-700 dark:border-none dark:text-gray-200 ring-indigo-300 hover:bg-gray-100 focus-visible:ring active:bg-gray-200 md:px-8 md:py-3 md:text-base">
          More
        </a>
      </div>

      <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:gap-6 xl:gap-8">
        <!-- image - start -->
        <a href="#" class="relative flex items-end h-48 overflow-hidden bg-gray-100 rounded-lg shadow-lg group md:h-80">
          <img src="https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&q=75&fit=crop&w=600" loading="lazy" alt="Photo by Minh Pham" class="absolute inset-0 object-cover object-center w-full h-full transition duration-200 group-hover:scale-110" />

          <div class="absolute inset-0 opacity-50 pointer-events-none bg-gradient-to-t from-gray-800 via-transparent to-transparent">
          </div>

          <span class="relative inline-block mb-3 ml-4 text-sm text-white md:ml-5 md:text-lg">VR</span>
        </a>
        <!-- image - end -->

        <!-- image - start -->
        <a href="#" class="relative flex items-end h-48 overflow-hidden bg-gray-100 rounded-lg shadow-lg group md:col-span-2 md:h-80">
          <img src="https://images.unsplash.com/photo-1542759564-7ccbb6ac450a?auto=format&q=75&fit=crop&w=1000" loading="lazy" alt="Photo by Magicle" class="absolute inset-0 object-cover object-center w-full h-full transition duration-200 group-hover:scale-110" />

          <div class="absolute inset-0 opacity-50 pointer-events-none bg-gradient-to-t from-gray-800 via-transparent to-transparent">
          </div>

          <span class="relative inline-block mb-3 ml-4 text-sm text-white md:ml-5 md:text-lg">Tech</span>
        </a>
        <!-- image - end -->

        <!-- image - start -->
        <a href="#" class="relative flex items-end h-48 overflow-hidden bg-gray-100 rounded-lg shadow-lg group md:col-span-2 md:h-80">
          <img src="https://images.unsplash.com/photo-1610465299996-30f240ac2b1c?auto=format&q=75&fit=crop&w=1000" loading="lazy" alt="Photo by Martin Sanchez" class="absolute inset-0 object-cover object-center w-full h-full transition duration-200 group-hover:scale-110" />

          <div class="absolute inset-0 opacity-50 pointer-events-none bg-gradient-to-t from-gray-800 via-transparent to-transparent">
          </div>

          <span class="relative inline-block mb-3 ml-4 text-sm text-white md:ml-5 md:text-lg">Dev</span>
        </a>
        <!-- image - end -->

        <!-- image - start -->
        <a href="#" class="relative flex items-end h-48 overflow-hidden bg-gray-100 rounded-lg shadow-lg group md:h-80">
          <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&q=75&fit=crop&w=600" loading="lazy" alt="Photo by Lorenzo Herrera" class="absolute inset-0 object-cover object-center w-full h-full transition duration-200 group-hover:scale-110" />

          <div class="absolute inset-0 opacity-50 pointer-events-none bg-gradient-to-t from-gray-800 via-transparent to-transparent">
          </div>

          <span class="relative inline-block mb-3 ml-4 text-sm text-white md:ml-5 md:text-lg">Retro</span>
        </a>
        <!-- image - end -->
      </div>
    </div>
  </div>
  <!-- gallery end -->


  <!-- ct -->
  <div class="h-full text-gray-800 bg-gray-100 dark:text-white">
    <div class="container px-4 py-8 mx-auto">
      <h2 class="mb-8 text-3xl font-semibold text-center text-gray-800 dark:text-gray-200">
        Certificate
      </h2>

      <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <div class="overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
          <img src="./dist/public/White Gold Elegant Modern Certificate of Participation (1).png" alt="Headless UI" class="object-cover w-full h-64">
          <div class="p-4 md:p-6">
            <h3 class="mb-2 text-xl font-semibold text-red-500 dark:text-red-300">Headless UI</h3>
            <p class="mb-4 text-gray-700 dark:text-gray-300 two-lines">
              Completely unstyled, fully accessible UI
              components,
              designed to integrate beautifully with Tailwind CSS.
            </p>
            <a href="#" class="inline-block px-4 py-2 text-white bg-red-500 rounded-full hover:bg-red-600">Learn
              More</a>
          </div>
        </div>

        <div class="overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
          <img src="./dist/public/White Gold Elegant Modern Certificate of Participation (2).png" alt="Heroicons" class="object-cover w-full h-64">
          <div class="p-4 md:p-6">
            <h3 class="mb-2 text-xl font-semibold text-red-500 dark:text-red-300">Heroicons</h3>
            <p class="mb-4 text-gray-700 dark:text-gray-300 two-lines">A set of 450+ free MIT-licensed SVG icons.
              Available
              as basic SVG icons and via first-party React and Vue libraries.</p>
            <a href="#" class="inline-block px-4 py-2 text-white bg-red-500 rounded-full hover:bg-red-600">Learn
              More</a>
          </div>
        </div>

        <div class="overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
          <img src="./dist/public/White Gold Elegant Modern Certificate of Participation.png" alt="Hero Patterns" class="object-cover w-full h-64">
          <div class="p-4 md:p-6">
            <h3 class="mb-2 text-xl font-semibold text-red-500 dark:text-red-300">Hero Patterns</h3>
            <p class="mb-4 text-gray-700 dark:text-gray-300 two-lines">A collection of over 100 free MIT-licensed
              high-quality
              SVG patterns for you to use in your web projects.</p>
            <a href="#" class="inline-block px-4 py-2 text-white bg-red-500 rounded-full hover:bg-red-600">Learn
              More</a>
          </div>
        </div>

        <!-- Add more items as needed, following the same structure -->

      </div>
    </div>
  </div>
  <!-- ct end -->

  <footer class="bg-gray-800">
    <div class="max-w-screen-xl px-4 py-5 mx-auto sm:px-6 lg:px-8">
      <div class="lg:flex lg:items-start lg:gap-8">
        <div>
          <img class="h-auto w-52" src="./dist/public/LOGO.png" alt="">
        </div>

        <div class="grid grid-cols-2 gap-8 mt-8 lg:mt-0 lg:grid-cols-5 lg:gap-y-16">
          <div class="col-span-2">
            <div>
              <h2 class="text-2xl font-bold text-gray-100">
                Get the latest news!
              </h2>

              <p class="mt-4 text-gray-100">
                You can Contact me!
              </p>
            </div>
          </div>

          <div class="col-span-2 lg:col-span-3 lg:flex lg:items-end">
          </div>

          <div class="col-span-2 sm:col-span-1">
            <p class="font-medium text-gray-100">Services</p>

            <ul class="mt-6 space-y-4 text-sm">
              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  1on1 Coaching
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Company Review
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Accounts Review
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  HR Consulting
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  SEO Optimisation
                </a>
              </li>
            </ul>
          </div>

          <div class="col-span-2 sm:col-span-1">
            <p class="font-medium text-gray-100">Company</p>

            <ul class="mt-6 space-y-4 text-sm">
              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  About
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Meet the Team
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Accounts Review
                </a>
              </li>
            </ul>
          </div>

          <div class="col-span-2 sm:col-span-1">
            <p class="font-medium text-gray-100">Helpful Links</p>

            <ul class="mt-6 space-y-4 text-sm">
              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Contact
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  FAQs
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Live Chat
                </a>
              </li>
            </ul>
          </div>

          <div class="col-span-2 sm:col-span-1">
            <p class="font-medium text-gray-100">Legal</p>

            <ul class="mt-6 space-y-4 text-sm">
              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Accessibility
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Returns Policy
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Refund Policy
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Hiring Statistics
                </a>
              </li>
            </ul>
          </div>

          <div class="col-span-2 sm:col-span-1">
            <p class="font-medium text-gray-100">Downloads</p>

            <ul class="mt-6 space-y-4 text-sm">
              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  Marketing Calendar
                </a>
              </li>

              <li>
                <a href="#" class="text-gray-100 transition hover:opacity-75">
                  SEO Infographics
                </a>
              </li>
            </ul>
          </div>

          <ul class="flex justify-start col-span-2 gap-6 lg:col-span-5 lg:justify-end">
            <li>
              <a href="/" rel="noreferrer" target="_blank" class="text-red-900 transition hover:opacity-75">
                <span class="sr-only">Facebook</span>

                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                </svg>
              </a>
            </li>

            <li>
              <a href="/" rel="noreferrer" target="_blank" class="text-red-900 transition hover:opacity-75">
                <span class="sr-only">Instagram</span>

                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                </svg>
              </a>
            </li>

            <li>
              <a href="/" rel="noreferrer" target="_blank" class="text-red-900 transition hover:opacity-75">
                <span class="sr-only">Twitter</span>

                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                </svg>
              </a>
            </li>

            <li>
              <a href="/" rel="noreferrer" target="_blank" class="text-red-900 transition hover:opacity-75">
                <span class="sr-only">GitHub</span>

                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                </svg>
              </a>
            </li>

            <li>
              <a href="/" rel="noreferrer" target="_blank" class="text-red-900 transition hover:opacity-75">
                <span class="sr-only">Dribbble</span>

                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" />
                </svg>
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="pt-8 mt-8 border-t border-gray-100">
        <div class="sm:flex sm:justify-between">
          <p class="text-xs text-gray-100">
            &copy; 2024. Devgil. All rights reserved.
          </p>

          <ul class="flex flex-wrap justify-start gap-4 mt-8 text-xs sm:mt-0 lg:justify-end">
            <li>
              <a href="#" class="text-gray-100 transition hover:opacity-75">
                Terms & Conditions
              </a>
            </li>

            <li>
              <a href="#" class="text-gray-100 transition hover:opacity-75">
                Privacy Policy
              </a>
            </li>

            <li>
              <a href="#" class="text-gray-100 transition hover:opacity-75">
                Cookies
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>


</body>
<script src="https://unpkg.com/taos@1.0.5/dist/taos.js"></script>

</html>