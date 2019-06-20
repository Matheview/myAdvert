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
      <div class="offer-filter">
        <p>Sort</p>
       <select name="sort-offers" id="sort" onchange="checkFilterValue()">
         <option selected value="newest" id="selected-option">newest offers</option>
         <option value="oldest" id="oldest-option">older offers</option>
         <option value="highprice" id="highprice-option">from the most expensive</option>
         <option value="lowprice" id="lowprice-option">from the cheapest</option>
       </select>
      </div>
       <div class="offers-wrap" style="display: inline-block;">
        <?php show_elctronics_all()?>
       </div>
      </main>
      <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
        <script src="scripts/index.js"></script>
        <script src="scripts/offersList.js"></script>
  </body>
</html>
