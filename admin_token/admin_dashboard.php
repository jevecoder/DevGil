<?php
session_start();
include '../dist/connection.php';
// Initialize $role with a default value
$role = "Default Role";

// Check if session variable is set
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
}

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

<body class="">
<?php
include '../admin_token/navigation.php';
?>
  <div class="flex flex-row flex-wrap h-screen">
  <?php
  include '../admin_token/sidebar.php';
  ?>

  <!-- start content -->
   <div class="flex-1 p-6 bg-gray-100">


   <!-- grid 1 -->
   <div class="grid grid-cols-4 gap-6">

   <!-- card 1 -->
   <div class="report-card"><a href="./user_management.php">
    <div class="h-auto transition duration-300 ease-in-out delay-150 bg-white border border-gray-200 rounded-md cursor-pointer card w-60 hover:-translate-y-1 hover:scale-100 hover:shadow-xl">
      <div class="flex flex-col card-body">
        <!-- top -->
        <div class="flex flex-row items-center justify-between p-6">
          <div class="text-xl text-indigo-700 fa-solid fa-user"></div>
          <span class="rounded-full px-[7px] py-[2px] text-white badge h6 bg-teal-400">
            12%
            <i class="ml-1 fa fa-chevron-up"></i>
          </span>
        </div>
        <!-- end top -->

        <!-- bottom -->
        <div class="p-6">
          <h1 class="text-2xl font-bold"><?php echo $totalUsers; ?></h1>
          <p class="text-gray-400">Total Of Users</p>
        </div>
        <!-- end bottom -->
      </div>
    </div>
    <div class="p-1 mx-4 transition duration-300 ease-in-out delay-100 bg-white border border-t-0 rounded rounded-t-none footera hover:shadow-2xl"></div>
  </a>
</div>
  <style>
    .card:hover + .footera {
      transform: translateY(-13px);
    }
  </style>
      <!-- card 1-->

      <!-- card 1 -->
      <div class="report-card">
    <div class="h-auto transition duration-300 ease-in-out delay-150 bg-white border border-gray-200 rounded-md card w-60 hover:-translate-y-1 hover:scale-100 hover:shadow-xl">
      <div class="flex flex-col card-body">
        <!-- top -->
        <div class="flex flex-row items-center justify-between p-6">
          <div class="text-xl text-indigo-700 fa-solid fa-user"></div>
          <span class="rounded-full px-[7px] py-[2px] text-white badge h6 bg-teal-400">
            12%
            <i class="ml-1 fa fa-chevron-up"></i>
          </span>
        </div>
        <!-- end top -->

        <!-- bottom -->
        <div class="p-6">
          <h1 class="text-2xl font-bold">10233</h1>
          <p class="text-gray-400">Items Sales</p>
        </div>
        <!-- end bottom -->
      </div>
    </div>
    <div class="p-1 mx-4 transition duration-300 ease-in-out delay-100 bg-white border border-t-0 rounded rounded-t-none footera hover:shadow-2xl"></div>
  </div>
  <style>
    .card:hover + .footera {
      transform: translateY(-13px);
    }
  </style>
      <!-- card 1-->

      <!-- card 1 -->
      <div class="report-card">
    <div class="h-auto transition duration-300 ease-in-out delay-150 bg-white border border-gray-200 rounded-md card w-60 hover:-translate-y-1 hover:scale-100 hover:shadow-xl">
      <div class="flex flex-col card-body">
        <!-- top -->
        <div class="flex flex-row items-center justify-between p-6">
          <div class="text-xl text-indigo-700 fa-solid fa-user"></div>
          <span class="rounded-full px-[7px] py-[2px] text-white badge h6 bg-teal-400">
            12%
            <i class="ml-1 fa fa-chevron-up"></i>
          </span>
        </div>
        <!-- end top -->

        <!-- bottom -->
        <div class="p-6">
          <h1 class="text-2xl font-bold">10233</h1>
          <p class="text-gray-400">Items Sales</p>
        </div>
        <!-- end bottom -->
      </div>
    </div>
    <div class="p-1 mx-4 transition duration-300 ease-in-out delay-100 bg-white border border-t-0 rounded rounded-t-none footera hover:shadow-2xl"></div>
  </div>
  <style>
    .card:hover + .footera {
      transform: translateY(-13px);
    }
  </style>
      <!-- card 1-->

      <!-- card 1 -->
      <div class="report-card">
    <div class="h-auto transition duration-300 ease-in-out delay-150 bg-white border border-gray-200 rounded-md card w-60 hover:-translate-y-1 hover:scale-100 hover:shadow-xl">
      <div class="flex flex-col card-body">
        <!-- top -->
        <div class="flex flex-row items-center justify-between p-6">
          <div class="text-xl text-indigo-700 fa-solid fa-user"></div>
          <span class="rounded-full px-[7px] py-[2px] text-white badge h6 bg-teal-400">
            12%
            <i class="ml-1 fa fa-chevron-up"></i>
          </span>
        </div>
        <!-- end top -->

        <!-- bottom -->
        <div class="p-6">
          <h1 class="text-2xl font-bold">10233</h1>
          <p class="text-gray-400">Items Sales</p>
        </div>
        <!-- end bottom -->
      </div>
    </div>
    <div class="p-1 mx-4 transition duration-300 ease-in-out delay-100 bg-white border border-t-0 rounded rounded-t-none footera hover:shadow-2xl"></div>
  </div>
  <style>
    .card:hover + .footera {
      transform: translateY(-13px);
    }
  </style>
      <!-- card 1-->



      </div>
      <!-- grid 1 end -->

      
      </div>

   </div>
</body>

</html>