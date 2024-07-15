<?php
include '../dist/connection.php';
session_start();


// Initialize variables
$thumbnailImage = '';
$likenessTitle = '';
$description = '';

// Check if plot ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $likeness_id = $_GET['id']; // Sanitize $plot_id here if needed

    // Fetch plot details from database
    $query = "SELECT * FROM likeness WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $likeness_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch plot data
        $row = $result->fetch_assoc();
        $thumbnailImage = $row['thumbnail_image']; // Ensure this is the correct column name from your database
        $likenessTitle = $row['title'];
        $description = $row['description'];
    } else {
        die("Error: Plot not found for ID $likeness_id.");
    }

    $stmt->close();
}

// Check if form is submitted for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete']) && $_POST['delete'] == 'delete') {
        $likenessId = isset($_POST['id']) ? $_POST['id'] : '';

        // Delete plot from database
        $query = "DELETE FROM likeness WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $likenessId);
        $stmt->execute();
        $stmt->close();

        // Redirect to plot list or wherever appropriate
        header("Location: likeness.php"); // Replace with appropriate redirect
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Likeness</title>
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
     <a href="create_likeness.php">
     <div class="mb-5 button_slide slide_right">Create Likeness</div>
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



/* Cards */
.card {
  width: 100%;
  max-width: 340px;
  margin-left: auto;
  margin-right: auto;
  position: relative;
  background: #EB5160;
  color: #fff;
  cursor: pointer;
  margin-bottom: 60px;
}

.borderl {
  position: absolute;
  width: 100%;
  height: 100%;
  padding: 6px;
  border: 1px solid #fff;
  opacity: 0.5;
  left: -6px;
  top: -6px;
}

.card h1 {
  position: relative;
  padding: 190px 0px 100px 10px;
  width: 90%;
}

.card > img {
  width: 90%;
  position: absolute;
  top: -6%;
  left: -6%;
}

.card-color-0 {
  background-color: #000;
}

/* The cover (expanding background) */
.cover {
  position: fixed;
  background: #EB5160;
  z-index: 100;
  transform-origin: 50% 50%;
}

.open-content {
  z-index: 100;
  position: absolute;
  opacity: 0;
  pointer-events: none;
}

.open-content img {
  position: relative;
  width: 90%;
  margin-left: 5%;
  margin-top: -150px;
  z-index: 5;
}

.open-content .text {
  background: #fff;
  margin-top: -56%;
  padding: 60% 5% 5% 5%;
  width: 80%;
  margin-bottom: 5%;
}

.open-content .text h1, .open-content .text p {
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
}

.close-content {
  display: block;
  position: absolute;
  right: 12px;
  top: 12px;
  width: 30px;
  height: 30px;
  z-index: 100;
}

.close-content span {
  background: #222;
  width: 30px;
  height: 6px;
  display: block;
  position: absolute;
  top: 14px;
}

.x-1 {
  transform: rotate(45deg);
}

.x-2 {
  transform: rotate(-45deg);
}

/* 
** Transitions
*/

.card {
  transition: opacity 200ms linear 320ms, transform 200ms ease-out 320ms;
}

.borderl {
  transition: opacity 200ms linear, transform 200ms ease-out;
}

.card img {
  transition: opacity 200ms linear 0ms, transform 200ms ease-in 0ms;
}

.card h1 {
  transform: translate3d(20%, 0px, 0px);  
  transition: opacity 200ms linear 120ms, transform 200ms ease-in 120ms;
}

/* Clicked card */
.card.clicked img {
  transform: translate3d(0px, -40px, 0px);
  opacity: 0;
}

.card.clicked .borderl {
  opacity: 0;
  transform: scale(1.3);
}

.card.out, .card.out img {
  transform: translate3d(0px, -40px, 0px);
  opacity: 0;
}

.card.out h1, .card.clicked h1 {
  transform: translate3d(20%, -40px, 0px);
  opacity: 0;
}

.cover {
  transition: transform 300ms ease-in-out;
}

.open-content {
  transition: opacity 200ms linear 0ms;
}

.open-content.open {
  opacity: 1;
  pointer-events: all;
  transition-delay: 1000ms;
}

/* 
** Media Queries
*/

@media screen and (max-width: 600px) {
  .open-content img {
    margin-top: 40px;
  }
}

  </style>

<div class="grid w-full gap-6 sm:grid-rows-2 md:grid-cols-3 lg:grid-cols-2">

<?php
// Query to retrieve plot data
$query = "SELECT * FROM likeness";
$result = $conn->query($query);

// Display data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "
      <div class='card card-color-0'>
          <div class='borderl'></div>
          <img class='w-full bg-center bg-cover h-52' src='./uploads/" . htmlspecialchars($row['thumbnail_image']) . "' />
          <h1 class='font-serif text-2xl font-normal'>" . htmlspecialchars($row['title']) . "</h1>
          <a class='text-green-700 ' href='edit_likeness.php?id=" . $row['id'] . "'>Edit</a>
          <button type='button' class='text-green-700 delete-button' data-id='" . $row['id'] . "'>Delete</button>
          <p class='card-description' style='display:none;'>" . htmlspecialchars($row['description']) . "</p>
      </div>";
          
}
echo "
<div id='cover' class='cover'></div>
<div id='open-content' class='open-content'>
  <a href='#' id='close-content' class='close-content'>
      <span class='x-1'></span>
      <span class='x-2'></span>
  </a>
  <img id='open-content-image' src='' />
  <div class='text' id='open-content-text'></div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var cards, nCards, cover, openContent, openContentText, pageIsOpen = false,
      openContentImage, closeContent, windowWidth, windowHeight, currentCard;

  // initiate the process
  init();

  function init() {
      resize();
      selectElements();
      attachListeners();
  }

  // select all the elements in the DOM that are going to be used
  function selectElements() {
      cards = document.getElementsByClassName('card');
      nCards = cards.length;
      cover = document.getElementById('cover');
      openContent = document.getElementById('open-content');
      openContentText = document.getElementById('open-content-text');
      openContentImage = document.getElementById('open-content-image');
      closeContent = document.getElementById('close-content');
  }

  /* Attaching three event listeners here:
    - a click event listener for each card
    - a click event listener to the close button
    - a resize event listener on the window
  */
  function attachListeners() {
      for (var i = 0; i < nCards; i++) {
          attachListenerToCard(i);
      }
      if (closeContent) {
          closeContent.addEventListener('click', onCloseClick);
      }
      window.addEventListener('resize', resize);
  }

  function attachListenerToCard(i) {
      cards[i].addEventListener('click', function(e) {
          var card = getCardElement(e.target);
          onCardClick(card, i);
      });
  }

  /* When a card is clicked */
  function onCardClick(card, i) {
      // set the current card
      currentCard = card;
      // add the 'clicked' class to the card, so it animates out
      currentCard.className += ' clicked';
      // animate the card 'cover' after a 500ms delay
      setTimeout(function() { animateCoverUp(currentCard); }, 500);
      // animate out the other cards
      animateOtherCards(currentCard, true);
      // add the open class to the page content
      openContent.className += ' open';
  }

  /*
  * This effect is created by taking a separate 'cover' div, placing
  * it in the same position as the clicked card, and animating it to
  * become the background of the opened 'page'.
  * It looks like the card itself is animating in to the background,
  * but doing it this way is more performant (because the cover div is
  * absolutely positioned and has no children), and there's just less
  * having to deal with z-index and other elements in the card
  */
  function animateCoverUp(card) {
      // get the position of the clicked card
      var cardPosition = card.getBoundingClientRect();
      // get the style of the clicked card
      var cardStyle = getComputedStyle(card);
      setCoverPosition(cardPosition);
      setCoverColor(cardStyle);
      scaleCoverToFillWindow(cardPosition);
      // update the content of the opened page
      var description = card.querySelector('.card-description').textContent;
      openContentText.innerHTML = '<h1>' + card.children[2].textContent + '</h1><p>' + description + '</p>';
      openContentImage.src = card.children[1].src;
      setTimeout(function() {
          // update the scroll position to 0 (so it is at the top of the 'opened' page)
          window.scroll(0, 0);
          // set page to open
          pageIsOpen = true;
      }, 300);
  }

  function animateCoverBack(card) {
      var cardPosition = card.getBoundingClientRect();
      // the original card may be in a different position, because of scrolling, so the cover position needs to be reset before scaling back down
      setCoverPosition(cardPosition);
      scaleCoverToFillWindow(cardPosition);
      // animate scale back to the card size and position
      cover.style.transform = 'scaleX(' + 1 + ') scaleY(' + 1 + ') translate3d(' + (0) + 'px, ' + (0) + 'px, 0px)';
      setTimeout(function() {
          // set content back to empty
          openContentText.innerHTML = '';
          openContentImage.src = '';
          // style the cover to 0x0 so it is hidden
          cover.style.width = '0px';
          cover.style.height = '0px';
          pageIsOpen = false;
          // remove the clicked class so the card animates back in
          currentCard.className = currentCard.className.replace(' clicked', '');
      }, 301);
  }

  function setCoverPosition(cardPosition) {
      // style the cover so it is in exactly the same position as the card
      cover.style.left = cardPosition.left + 'px';
      cover.style.top = cardPosition.top + 'px';
      cover.style.width = cardPosition.width + 'px';
      cover.style.height = cardPosition.height + 'px';
  }

  function setCoverColor(cardStyle) {
      // style the cover to be the same color as the card
      cover.style.backgroundColor = cardStyle.backgroundColor;
  }

  function scaleCoverToFillWindow(cardPosition) {
      // calculate the scale and position for the card to fill the page,
      var scaleX = windowWidth / cardPosition.width;
      var scaleY = windowHeight / cardPosition.height;
      var offsetX = (windowWidth / 2 - cardPosition.width / 2 - cardPosition.left) / scaleX;
      var offsetY = (windowHeight / 2 - cardPosition.height / 2 - cardPosition.top) / scaleY;
      // set the transform on the cover - it will animate because of the transition set on it in the CSS
      cover.style.transform = 'scaleX(' + scaleX + ') scaleY(' + scaleY + ') translate3d(' + (offsetX) + 'px, ' + (offsetY) + 'px, 0px)';
  }

  /* When the close is clicked */
  function onCloseClick() {
      // remove the open class so the page content animates out
      openContent.className = openContent.className.replace(' open', '');
      // animate the cover back to the original position card and size
      animateCoverBack(currentCard);
      // animate in other cards
      animateOtherCards(currentCard, false);
  }

  function animateOtherCards(card, out) {
      var delay = 100;
      for (var i = 0; i < nCards; i++) {
          // animate cards on a stagger, 1 each 100ms
          if (cards[i] === card) continue;
          if (out) animateOutCard(cards[i], delay);
          else animateInCard(cards[i], delay);
          delay += 100;
      }
  }

  // animations on individual cards (by adding/removing card names)
  function animateOutCard(card, delay) {
      setTimeout(function() {
          card.className += ' out';
      }, delay);
  }

  function animateInCard(card, delay) {
      setTimeout(function() {
          card.className = card.className.replace(' out', '');
      }, delay);
  }

  // this function searches up the DOM tree until it reaches the card element that has been clicked
  function getCardElement(el) {
      if (el.className.indexOf('card ') > -1) return el;
      else return getCardElement(el.parentElement);
  }

  // resize function - records the window width and height
  function resize() {
      if (pageIsOpen) {
          // update position of cover
          var cardPosition = currentCard.getBoundingClientRect();
          setCoverPosition(cardPosition);
          scaleCoverToFillWindow(cardPosition);
      }
      windowWidth = window.innerWidth;
      windowHeight = window.innerHeight;
  }
});
</script>";
} else {
    echo "<div class='flex items-center justify-center text-xl font-normal text-black'>No Likeness Found!</div>";
}

$conn->close();
?>

</div>
<!-- Delete Modal -->
<div id="deleteModal" class="fixed top-0 left-0 flex items-center justify-center hidden w-full h-full bg-gray-200 bg-opacity-50">
    <div class="max-w-md p-8 bg-white rounded-md shadow-md">
        <p class="mb-4 text-lg font-bold">Are you sure you want to delete this Likeness?</p>
        <div class="flex justify-end">
            <form id="deleteForm" action="likeness.php" method="POST">
                <input type="hidden" name="id" id="likenessIdInput" value="">
                <input type="hidden" name="delete" value="delete">
                <button type="submit" class="px-4 py-2 mr-2 text-white bg-red-500 rounded-md">Yes, Delete</button>
                <button type="button" id="closeModal" class="px-4 py-2 text-gray-800 bg-gray-300 rounded-md">Cancel</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Modal script to show/hide delete confirmation
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button');
        const deleteModal = document.getElementById('deleteModal');
        const closeModal = document.getElementById('closeModal');
        const likenessIdInput = document.getElementById('likenessIdInput');
        const deleteForm = document.getElementById('deleteForm');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const likenessId = button.getAttribute('data-id');
                likenessIdInput.value = likenessId;
                deleteModal.classList.remove('hidden');
            });
        });

        closeModal.addEventListener('click', () => {
            deleteModal.classList.add('hidden');
        });
    });
</script>



   
      </div>

   </div>
</body>

</html>