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
  <link href="./dist/src/input.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
  <script src="https://kit.fontawesome.com/25c515add0.js" crossorigin="anonymous"></script>
</head>
<body>
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
            <a href="./portfolio.php">About</a>
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
          if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            echo '<a href="./admin_token/admin_dashboard.php">Dashboard</a>';
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
            echo '<p class="text-sm font-semibold text-gray-800">Login</p>';
          }
          ?>
        </button>
      </div>

      <!-- Login Modal -->
      <div id="loginModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-full h-full modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 modal-overlay"></div>

        <div class="modal-container bg-white rounded h-[480px] w-[1000px] shadow-lg z-50 ">
          <!-- Add your modal content here -->



          <div class="grid justify-center grid-cols-3 overflow-hidden">
            <div class="hidden w-full h-full bg-cover lg:block" style="background-image:url('./dist/public/login-side.png')">
            </div>

            <!-- sign in -->
            <div class="container col-span-2" id="container">
              <div class="form-container sign-up-container">
                <form class="slides" action="" method="post" enctype="multipart/form-data">

                <div class="mt-4">
                  <label for="profile_image">Profile Image:</label>
  <input type="file" id="profile_image" name="profile_image" accept="image/*" required>
</div>
                  <div class="relative z-0 w-full mt-5 group">
      <input id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-black appearance-none dark:text-black dark:border-black dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="email" name="email" required  />
      <label for="floating_email" class="left-0 peer-focus:font-medium absolute text-xs text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
  </div>

  <div class="relative z-0 w-full mt-5 group">
      <input id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-black appearance-none dark:text-black dark:border-black dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="password" name="password" required  onkeyup="checkPasswordStrength()"/>
      <label for="floating_password" class="left-0 peer-focus:font-medium absolute text-xs text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
    </div>

<div id="password-strength" class="text-xs text-gray-500 dark:text-gray-400"></div>

<div class="flex justify-start w-full">
        <div id="icon-length"></div>
        <span id="icon-length-text" class="ml-1"></span>
    </div>
    <div class="flex justify-start w-full">
        <div id="icon-uppercase"></div>
        <span id="icon-uppercase-text" class="ml-1"></span>
    </div>
    <div class="flex justify-start w-full">
        <div id="icon-lowercase"></div>
        <span id="icon-lowercase-text" class="ml-1"></span>
    </div>
    <div class="flex justify-start w-full">
        <div id="icon-number"></div>
        <span id="icon-number-text" class="ml-1"></span>
    </div>
    <div class="flex justify-start w-full">
        <div id="icon-special"></div>
        <span id="icon-special-text" class="ml-1"></span>
    </div>


  <div class="relative z-0 w-full mt-5 group">
      <input id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-black appearance-none dark:text-black dark:border-black dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="password" name="confirm_password" required  />
      <label for="floating_email" class="left-0 peer-focus:font-medium absolute text-xs text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm Password</label>
  </div>


                  <div class="flex items-start mt-3">
                    <div class="flex items-center h-5">
                      <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 bg-gray-100 border border-gray-900 rounded focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                    </div>
                    <div class="ml-3 text-xs">
                      <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                    </div>
                  </div>

                  <button type="submit" id="register-btn" value="sign up" name="signUp" class="w-full px-4 py-2 mt-2 font-bold text-white bg-gray-700 rounded hover:bg-red-600">Signup</button>
                </form>
              </div>


              <!-- login -->
              <div class="form-container sign-in-container">
                <form class="slides" action="" method="post">
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
                  
                  <div class="relative z-0 w-full mt-5 group">
      <input id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-black appearance-none dark:text-black dark:border-black dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="email" name="email" required  />
      <label for="floating_email" class="left-0 peer-focus:font-medium absolute text-xs text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
  </div>

                  <div class="relative z-0 w-full mt-5 group">
      <input id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-black appearance-none dark:text-black dark:border-black dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " type="password" name="password" required  />
      <label for="floating_email" class="left-0 peer-focus:font-medium absolute text-xs text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
  </div>


                  <div class="mt-4">
                    <a href="./dist/forgot_password.php" class="text-xs text-gray-500">Forget Password?</a>
                  </div>
                  <button type="submit" value="sign in" name="signIn" class="w-full px-4 py-2 mt-2 font-bold text-white bg-gray-700 rounded hover:bg-red-600">Login</button>
                </form>
              </div>
              <div class="overlay-container">
                <div class="overlay">
                  <div class="overlay-panel overlay-left">
                    <!-- <h1>Create Account</h1> -->
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
</body>
</html>