
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
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
            <h1><span>my</span>Advert</h1>
            <p class="account"><i class="fas fa-user-circle"></i>Hello <?php include('functions.php'); return_user_name() ?></p>
            <div class="account-info">
               <a class="account-a" href="functions.php?logout=true">log out</a>
              </ul>
            </div>

            <a href="#">+ add advert</a>
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
      <main>
        <div class="categories">
          <div class="category"><i class="fas fa-car"></i></div>
          <div class="category"><i class="fas fa-tshirt"></i></div>
          <div class="category"><i class="fas fa-mobile-alt"></i></div>
          <div class="category"><i class="fas fa-music"></i></div>
        </div>
        <div class="get-started-bar">
          <a href="register.php" class="get-started-btn">get started</a>
        </div>
      </main>
      <script src="scripts/index.js"></script>
    </div>
  </body>
</html>
