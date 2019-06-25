<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("functions.php"); ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>myAdvert</title>
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
            <a href="index.php" class="index"><h1><span>my</span>Advert</h1></a>
            <p class="account"><i class="fas fa-user-circle"></i><?php check_user("logedin") ?>
            <a class="account" href="account.php"><i class="fas fa-user-cog"></i></a>
            <a class="add-offer" href="createadv.php">+ add advert</a>
          </div>
          <div class="bot-nav">
            <p>place for Your advertisements</p>
            <img src="imgs/car.png" alt="car" class="car" />
            <img src="imgs/car1.png" alt="car" class="car1" />
            <img src="imgs/car2.png" alt="car" class="car2" />
            <img src="imgs/car3.png" alt="car" class="car3" />
          </div>
        </nav>
        <img src="imgs/billboard.png" alt="logo" class="header-logo" />
      </header>
      <main class="account-info">
        <section class="password">
            <p>Change password:</p>
            <form action="function.php">
                <input type="password" placeholder="current password..." id="current-password">
                <input type="password" placeholder="new password..." id="new-password">
                <input type="password" placeholder="repeat new password..." id="r-new-password"> 
                <button type="submit">change password</button>
            </form>
        </section>
        <section class="number">
            <p>Edit phone number:</p>
            <form action="function.php">
                <input type="text" placeholder="current number..." id="current-number">
                <input type="text" placeholder="new number..." id="new-number">
                <button type="submit">change number</button>
            </form>
        </section>
        <section class="address">
            <p>Edit your address:</p>
            <form action="function.php">
                <input type="text" placeholder="new address..." id="new-address">
                <button type="submit">change address</button>
            </form>
        </section>
        <section class="my-offers">
            <p>My offers: </p>
            <div class="unique-offer"></div>
            <div class="title">
                <h1>Sprzedam działkę</h1>
                </div>
                <img src="https://apollo-ireland.akamaized.net/v1/files/xkh4lyhlulzw-PL/image;s=1000x700" alt="">
                <a class="" href="function.php">edit offer<i class="fas fa-edit"></i></a>
                 <a class="" href="function.php">delete offer<i class="fas fa-trash-alt"></i></a>
            </div>
        </section>
      </main>
      <script src="scripts/index.js"></script>
    </div>
  </body>
</html>