<!--Strona z formularzem-->

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
      <header class="register-header">
        <div class="left-column">
          <a href="index.php"><span>my</span>Advert</a>
          <img src="imgs/pay-per-click.png" alt="" />
          <p>
            Register now. <br>
            Add your adverts for free. <br>
            Look for interesting offers anytime.
          </p>
        </div>
        <div class="right-column">
          <img src="imgs/billboard.png" alt="">
          <!--Formularz ma się "wysłać" po przejściu walidacji po stronie klienta (js) i po sprawdzeniu czy w bazie nie istnieje już inny użytkownik o podanym loginie czy e-mailu-->
          <form action="" method="POST">
            <input type="text" placeholder="Your login..." id="loginInput"/>
            <input type="password" placeholder="Your password..." id="passwordInput" />
            <input type="text" placeholder="Your e-mail..." id="emailInput"/>
            <input type="text" placeholder="Your phone number..." id="phoneNumberInput" />
            <input type="text" placeholder="Your city name..." id="cityInput" />
            <input type="submit" class ="submit-btn">
          </form>
        </div>
      </header>
      <footer>
        <p>
          <span>my</span><strong>Advert</strong> 2019 | all rights reserved | made with <i class="fas fa-heart"></i> by
          <span class="author1">Fyrr</span> && <span class="author2" >Maquintosh</span> 
        </p>
      </footer>
    </div>
    <script src="scripts/register.js"></script>
  </body>
</html>
