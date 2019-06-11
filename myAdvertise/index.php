<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("functions.php");
    if(isset($_SESSION['user_name'])) {
      header('Location: logedin.php');
    }?>
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
            <p class="account"><i class="fas fa-user-circle"></i><?php check_user("account") ?></p>
            <div class="account-info">
              <form id="login_a" method="POST" action="functions.php">
              <input name="user_email" type="text" placeholder="login...">
              <input name="user_passwd" type="password" placeholder="password...">
              <input type="hidden" name="login" value="login" />
               <a href="#" class="account-a" onclick="document.getElementById('login_a').submit();">sign in</a>
             </form>
              </ul>
            </div>

            <a href="createadv.php?add_offer=true">+ add advert</a>
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
      <main>
      <h2>Check for newest adverts</h2>
      <img class="main-img" src="imgs/poster.png" alt="news logo">
        <div class="categories">
          <a class="category" href="automotive.php"><i class="fas fa-car"></i></a>
          <a class="category" href="clothes.php"><i class="fas fa-tshirt"></i></a>
          <a class="category" href="electronics.php"><i class="fas fa-mobile-alt"></i></a>
          <a class="category" href="music.php"><i class="fas fa-music"></i></a>
        </div>
        <div class="get-started-bar">
          <a href="register.php" class="get-started-btn">get started</a>
        </div>
      </main>
      <script src="scripts/index.js"></script>
    </div>
  </body>
</html>
