<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devgil</title>
  <link rel="icon" href="./dist/public/logo_profile1.png" type="image/icon type">

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
<body class="bg-black">
  <div id="home">
    <header class="relative bg-black w-full h-[613px]">

    <style>
.flashLightContainer {
  background-image:linear-gradient(to bottom, rgba(0, 0, 0, 0.5), transparent), url('./dist/public/content.jfif');
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  overflow: hidden;
}

.flashLightContainer::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 30px; /* Adjust height as needed */
    background: linear-gradient(to top, rgba(0, 0, 0, 2.9), transparent); /* Inner shadow gradient */
    pointer-events: none; /* Ensures the pseudo-element doesn't block interaction */
  }
.flashlight {
  position: absolute;
  width: 100%;
  height: 100%;
  background: #000;
}
    </style>
    
    <div class="w-full h-full bg-contain flashLightContainer">
    <nav class="absolute top-0 left-0 z-20 w-full h-40 text-xs text-gray-400 bg-transparent animate__animated animate__fadeInDown">
    <div class="grid grid-cols-4 gap-4 p-8">
      
    <div>  
    <a href="http://localhost/DevGil/portfolio.php" class="relative flex items-center gap-2">
        <img src="./dist/public/logo_profile1.png" class="h-10 w-9 " alt="Flowbite Logo">
        <span class="absolute mt-3 font-mono text-3xl font-semibold text-white ml-11">Gil{<i class="fa-solid fa-code"></i>}</span>
        <span class="absolute mt-24 font-sans text-sm font-semibold text-white">World's fastest Web Development.</span>
      </a>
    </div>

    <div class="flex flex-col items-start justify-between font-sans font-normal gap-9">
      <p>Services</p>
      <div class="flex flex-col">
      <a class="text-sm text-white transition duration-300 ease-out hover:ease-in hover:-translate-y-1 hover:scale-110" href="plot.php">Plot</a>
      <a class="text-sm text-white line-through transition duration-300 ease-out hover:ease-in hover:-translate-y-1 hover:scale-110" href="">Web Design</a>
      </div>
    </div>

    <div class="flex flex-col items-start justify-between font-sans font-normal gap-9">
      <p>Post-Production</p>
      <div class="flex flex-col">
      <a class="text-sm text-white transition duration-300 ease-out hover:ease-in hover:-translate-y-1 hover:scale-110" href="likeness.php">Likeness</a>
      <a class="text-sm text-white transition duration-300 ease-out hover:ease-in hover:-translate-y-1 hover:scale-110" href="banner.php">Banner</a>
      </div>
    </div>

    <div class="flex flex-col items-start justify-between font-sans font-normal gap-9">
      <p>Contact</p>
      <div class="flex flex-col">
      <a class="text-sm text-white transition duration-300 ease-out hover:ease-in hover:-translate-y-1 hover:scale-110" href="">Jerillabagnoy6@gmail.com</a>
      <a class="text-sm text-white transition duration-300 ease-out hover:ease-in hover:-translate-y-1 hover:scale-110" href="">+63 916-5298-478</a>
      </div>
    </div>
      <!-- Mobile Navigation Button -->
      <button id="mobileMenuButton" class="md:hidden" onclick="toggleMobileMenu()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
      


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
  <div class="flashlight"></div>
  
</div>
    <script>
const flashlight = document.querySelector(".flashlight");
        const container = document.querySelector(".flashLightContainer");
        const rect = container.getBoundingClientRect();

        container.addEventListener("mousemove", function (e) {
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            // Move flashlight effect
            flashlight.style.background = `radial-gradient(circle at ${x}px ${y}px, transparent 100px, #000 500px)`;

            // Parallax effect for background image
            const moveX = (x - rect.width / 2) * 0.02;
            const moveY = (y - rect.height / 2) * 0.02;
            container.style.backgroundPosition = `calc(50% + ${moveX}px) calc(50% + ${moveY}px)`;
        });
    </script>

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

<div class="grid justify-between w-full grid-flow-col grid-cols-3 pr-6 font-sans text-sm font-bold -mt-[317px] animate__animated animate__fadeInUp">
    <div class="z-10 grid items-start justify-start w-full col-span-3 grid-rows-1 pr-20 font-medium text-gray-200 pt- pl-7">
    <div class="text-6xl">
      <p class="text-sm text-[#1ff990]">Latest Design Course</p>
      <p>Promote your product</p>
      <p>straight to designers.</p>
      <p class="mt-6 font-sans text-sm">Devgil’s team will write and film your commercials <br> and share on Youtube You know, commercials for <br> designers by designers.</p>
     <div class="flex flex-row gap-5 shadow-2xl">
      <button class="w-[300px] flex item-center justify-center px-6 py-5 mt-7 font-semibold bg-transparent hover-slide1">
        <span class="text-sm font-medium">hey@Devgil.com</span>
    </button>
    <p class="flex items-center justify-center text-sm pt-7">Cost: ₱1,000 - ₱5,000</p>
  </div>
    </div>
    </div>
    
    <div></div>
    <div></div>

    <style>
      .hover-slide::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background-color: white; /* Tailwind's blue-500 */
  transition: left 0.3s ease;
  z-index: 0;
}

.hover-slide:hover::before {
  left: 0;
}

.hover-slide {
  position: relative;
  overflow: hidden;
  color: white;
  background-color: black;
}
.hover-slide:hover {
  color: black;
}

.hover-slide span {
  position: relative;
  z-index: 10;
}


/* button2 */
.hover-slide1::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background-color: #1ff990;
  transition: left 1.0s ease;
  z-index: 0;
}

.hover-slide1:hover::before {
  left: 0;
}

.hover-slide1 {
  position: relative;
  overflow: hidden;
  color: black;
  background-color: white;
}
.hover-slide1:hover {
  color: black;
}

.hover-slide1 span {
  position: relative;
  z-index: 10;
}
    </style>

    </div>

    </header>
  </div>
   <!-- projects  -->
   <div>
    <section class="delay-[300ms] duration-[600ms] taos:translate-y-[200px] taos:opacity-0" data-taos-offset="300">
      <div class="flex items-start justify-start max-w-screen-xl px-4 py-8 mx-auto lg:py-16 lg:px-6">
        <div class="max-w-screen-sm mx-auto mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl font-medium tracking-tight text-white">Video Promotion</h2>

          <!-- 3d animation image  -->
          <a href="https://www.mythrillfiction.com/the-dark-rider" alt="Mythrill" target="_blank">
  <div class="cardv">
    <div class="wrapper">
      <img src="https://ggayane.github.io/css-experiments/cards/dark_rider-cover.jpg" class="cover-image" />
    </div>
    <img src="https://ggayane.github.io/css-experiments/cards/dark_rider-title.png" class="title" />
    <img src="https://ggayane.github.io/css-experiments/cards/dark_rider-character.webp" class="character" />
  </div>
</a>

<a href="https://www.mythrillfiction.com/force-mage" alt="Mythrill" target="_blank">
  <div class="cardv">
    <div class="wrapper">
      <img src="https://ggayane.github.io/css-experiments/cards/force_mage-cover.jpg" class="cover-image" />
    </div>
    <img src="https://ggayane.github.io/css-experiments/cards/force_mage-title.png" class="title" />
    <img src="https://ggayane.github.io/css-experiments/cards/force_mage-character.webp" class="character" />
  </div>
</a>
<style>
    :root {
  --card-height: 300px;
  --card-width: calc(var(--card-height) / 1.5);
}
* {
  box-sizing: border-box;
}

.cardv {
  width: var(--card-width);
  height: var(--card-height);
  position: relative;
  display: flex;
  justify-content: center;
  align-items: flex-end;
  padding: 0 36px;
  perspective: 2500px;
  margin: 0 50px;
}

.cover-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.wrapper {
  transition: all 0.5s;
  position: absolute;
  width: 100%;
  z-index: -1;
}

.cardv:hover .wrapper {
  transform: perspective(900px) translateY(-5%) rotateX(25deg) translateZ(0);
  box-shadow: 2px 35px 32px -8px rgba(0, 0, 0, 0.75);
  -webkit-box-shadow: 2px 35px 32px -8px rgba(0, 0, 0, 0.75);
  -moz-box-shadow: 2px 35px 32px -8px rgba(0, 0, 0, 0.75);
}

.wrapper::before,
.wrapper::after {
  content: "";
  opacity: 0;
  width: 100%;
  height: 80px;
  transition: all 0.5s;
  position: absolute;
  left: 0;
}
.wrapper::before {
  top: 0;
  height: 100%;
  background-image: linear-gradient(
    to top,
    transparent 46%,
    rgba(12, 13, 19, 0.5) 68%,
    rgba(12, 13, 19) 97%
  );
}
.wrapper::after {
  bottom: 0;
  opacity: 1;
  background-image: linear-gradient(
    to bottom,
    transparent 46%,
    rgba(12, 13, 19, 0.5) 68%,
    rgba(12, 13, 19) 97%
  );
}

.cardv:hover .wrapper::before,
.wrapper::after {
  opacity: 1;
}

.cardv:hover .wrapper::after {
  height: 120px;
}
.title {
  width: 100%;
  transition: transform 0.5s;
}
.cardv:hover .title {
  transform: translate3d(0%, -50px, 100px);
}

.character {
  width: 100%;
  opacity: 0;
  transition: all 0.5s;
  position: absolute;
  z-index: -1;
}

.cardv:hover .character {
  opacity: 1;
  transform: translate3d(0%, -30%, 100px);
}

</style>
<!-- 3d animation image  -->
        </div>

        <div class="grid gap-8 lg:gap-16 sm:grid-rows-2 md:grid-cols-3 lg:grid-cols-3 sm:place-items-center">
        <a href="banner_watch.php">
          <div class="text-center text-white">
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
          </a>

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
      </div>
    </section>
  </div>

  <!-- projects end  -->









  
  <footer>
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
</html>