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
            <form method="POST" action="functions.php">
                <input type="password" name="current_passwd" placeholder="current password..." id="current-password">
                <input type="password" name="new_passwd" placeholder="new password..." id="new-password">
                <input type="password" name="repeat_new_passwd" placeholder="repeat new password..." id="r-new-password">
                <button type="submit" name="change_passwd">change password</button>
            </form>
            <?php if(isset($_GET['change_passwd'])) {
                if($_GET['change_passwd'] == 'true') {
                    echo('&nbsp&nbspPassword changed correctly');
                }
                if($_GET['change_passwd'] == 'false') {
                    echo('&nbsp&nbspPassword not changed!');
                }
                }?>
        </section>
        <section class="number">
            <p>Edit phone number:</p>
            <form method="POST" action="functions.php">
                <input type="text" name="current_phone" placeholder="current number..." id="current-number">
                <input type="text" name="new_phone" placeholder="new number..." id="new-number">
                <button type="submit" name="change_phone">change number</button>
            </form>
            <?php if(isset($_GET['change_phone'])) {
                if($_GET['change_phone'] == 'true') {
                    echo('&nbsp&nbspPhone number changed correctly');
                }
                if($_GET['change_phone'] == 'false') {
                    echo('&nbsp&nbspPhone number not changed!');
                }
                }?>
        </section>
        <section class="address">
            <p>Edit your address:</p>
            <form method="POST" action="functions.php">
                <input type="text" name="new_address" placeholder="new address..." id="new-address">
                <button type="submit" name="change_address">change address</button>
            </form>
            <?php if(isset($_GET['change_address'])) {
                if($_GET['change_address'] == 'true') {
                    echo('&nbsp&nbspAddress changed correctly');
                }
                if($_GET['change_address'] == 'false') {
                    echo('&nbsp&nbspAddress not changed!');
                }
                }?>
        </section>
        <p>My offers: </p>
            <?php get_user_offers($_SESSION['user_id']);?>
      </main>
      <script src="scripts/index.js"></script>
    </div>
  </body>
</html>
