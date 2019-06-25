<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("functions.php");?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>myAdvert - automotive adverts</title>
    <link
      href="https://fonts.googleapis.com/css?family=Heebo:300,400,700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
      integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="owlcarousel/dist/assets/owl.carousel.css">
     <link rel="stylesheet" href="owlcarousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="styles/style.css" />
  </head>
  <body>
    <div class="wrap">
      <header>
        <nav>
          <div class="nav-wrap">
            <a class="index" href="index.php"><h1><span>my</span>Advert</h1></a>
            <p class="account"><i class="fas fa-user-circle"></i><?php check_user("account") ?>
            <a class="add-offer" href="createadv.php">+ add advert</a>
          </div>
          <div class="bot-nav">
            <p>Place for Your advertises...</p>
            <img src="imgs/car.png" alt="car" class="car" />
            <img src="imgs/car1.png" alt="car" class="car1" />
            <img src="imgs/car2.png" alt="car" class="car2" />
            <img src="imgs/car3.png" alt="car" class="car3" />
          </div>
        </nav>
        <img src="imgs/billboard.png" alt="logo" class="header-logo" />
      </header>
      <main style="background: #ff8a65" class="infinite">
      <?php
      if(isset($_GET['action']) && isset($_SESSION['user_id'])){
         if (isset($_GET['action']) == 'delete') {
           $offerlink = "'functions.php?delete_offer=".$_GET['offer_id']."&category=music_accessories'";
           $offerlink2 = "'music.php'";
           echo('<p>Are you sure to delete this offer?</p>
             <button onclick="location.href='.$offerlink.'" type="button">YES</button>
             <button onclick="location.href='.$offerlink2.'" type="button">NO</button>');
         }
         show_offer_music_accessories($_GET['offer_id']);
     }
      if(isset($_GET['offer_id'])){
          show_offer_music_accessories($_GET['offer_id']);
      }
      else {
        if(isset($_GET['search'])) {
          show_music_accessories_all($_GET['search']);
        }
        elseif(!isset($_GET['search'])) {
          show_music_accessories_all(NULL);
        }
      } ?>
      </main>
      <script
         src="https://code.jquery.com/jquery-3.4.1.js"
         integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
         crossorigin="anonymous"></script>
        <script src="owlcarousel/dist/owl.carousel.min.js"></script>
        <script src="scripts/index.js"></script>
        <script src="scripts/slider.js"></script>
  </body>
</html>
