<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("functions.php"); ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>myAdvert - add Your offer</title>
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="styles/style.css" />
  </head>
  <body>
    <div class="wrap">
    <section class="create-offer">
     <header class="header-offer">
       <div class="top-content">
       <a href="index.php"><span>my</span>Advert</a>
        <p>we begin here...</p>
        <img src="imgs/banner.png" alt="baner logo">
        </div>
        <div class="bottom-content">
        <footer class="footer-offer">
            <p> made with <i class="fas fa-heart"></i> by
          <span class="author1">Maquintosh</span> && <span class="author2" >Fyrr</span></p>
        </footer>
        </div>
     </header>
     <section class="add-offer">
       <!--FORM ACTION-->
       <form method="POST" action="functions.php" enctype="multipart/form-data" class="offer-creation-form" id="offer-form">
      <p>title:</p>
        <input type="text" class="title-input" id="title" name="title">
        <p>choose category:</p>
        <div class="category-box">
        <label class="cat-label automotive" for="automotive"><input type="radio" name="cat" id="automotive" value="automotive"><i class="fas fa-car"></i></label>
        <label class="cat-label clothes" for="clothes"><input type="radio" name="cat" id="clothes" value="clothes"><i class="fas fa-tshirt"></i></label>
        <label class="cat-label electronics" for="electronics"><input type="radio" name="cat" id="electronics" value="electronics"><i class="fas fa-mobile-alt"></i></label>
        <label class="cat-label music-accessories" for="music-accessories"><input type="radio" name="cat" id="music-accessories" value="music-accessories"><i class="fas fa-music"></i></label>
        </div>
        <p>description:</p>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <p>add images:</p>
        <div class="imgs-wrapper">
        <input type="file" id="main-img" name='main-img'>
        <label for="main-img" class="img-label main"><i class="material-icons">
add_photo_alternate
</i>Choose main image</label>
<input type="file" id="main-img" name='img1'>
        <label for="main-img" class="img-label"><i class="material-icons">
add_photo_alternate
</i>Choose image</label>
<input type="file" id="img1" name='img2'>
        <label for="img1" class="img-label"><i class="material-icons">
add_photo_alternate
</i>Choose image</label>
<input type="file" id="img2" name='img3'>
        <label for="img2" class="img-label"><i class="material-icons">
add_photo_alternate
</i>Choose image</label>
<input type="file" id="img3" name='img4'>
        <label for="img3" class="img-label"><i class="material-icons">
add_photo_alternate
</i>Choose image</label>
<input type="file" id="img4" name='img5'>
        <label for="img4" class="img-label"><i class="material-icons">
add_photo_alternate
</i>Choose image</label>
</div>
        <p>price:</p>
        <input name='price' type="text" id="price">
        <input type="submit" name="addoffer" value="+" class="submit-btn" id="add-offer-btn">
        <aside class="automotive-tab">
        <img src="imgs/poster.png" alt="">
          <div class="automotive-form form">
          <div class="cat-logo">
          <i class="fas fa-car"></i>
          </div>
          <p class="form-p">vehicle brand: </p>
          <input name='brand' type="text" id="brand">
          <p class="form-p">vehicle model: </p>
          <input name='model' type="text" id="model">
          <p class="form-p">vehicle year: </p>
          <input name='year' type="number" id="year">
          <p class="form-p">vehicle mileage: </p>
          <input name='mileage' type="text" id="mileage">
          <p class="form-p">vehicle engine: </p>
          <input name='engine' type="text" id="engine">
          <p class="form-p">condition: </p>
          <div class="condition-box">
          <label for="new">new</label>
          <input name="condition" type="radio" id="new" value="1">
          <label for="used">used</label>
          <input name="condition" type="radio" id="used" value="2">
          <label for="damaged">damaged</label>
          <input name="condition" type="radio" id="damaged" value="3">
          </div>
          <button>
            next
          </button>
          </div>
        </aside>
        <aside class="clothes-tab">
        <img src="imgs/poster.png" alt="">
          <div class="clothes-form form">
          <div class="cat-logo">
          <i class="fas fa-tshirt"></i>
          </div>
          <p class="form-p">brand: </p>
          <input type="text" id="brand" name="brand">
          <p class="form-p">colour: </p>
          <input type="text" id="colour" name="color">
          <p class="form-p">size: </p>
          <input type="text" id="size" name="size">
          <p class="form-p">sex: </p>
          <input type="text" id="sex" name="sex">
          <p class="form-p">condition: </p>
          <div class="condition-box">
          <label for="new">new</label>
          <input name="condition" type="radio" id="new" value="1">
          <label for="used">used</label>
          <input name="condition" type="radio" id="used" value="2">
          <label for="damaged">damaged</label>
          <input name="condition" type="radio" id="damaged" value="3">
          </div>
          <button class="clothes-btn">
            next
          </button>
          </div>
        </aside>
        <aside class="electronics-tab">
        <img src="imgs/poster.png" alt="">
          <div class="electronics-form form">
          <div class="cat-logo">
          <i class="fas fa-mobile-alt"></i>
          </div>
          <p class="form-p">brand: </p>
          <input type="text" id="brand" name="brand">
          <p class="form-p">model: </p>
          <input type="text" id="model" name="model">
          <p class="form-p">condition: </p>
          <div class="condition-box">
          <label for="new">new</label>
          <input name="condition" type="radio" id="new" value="1">
          <label for="used">used</label>
          <input name="condition" type="radio" id="used" value="2">
          <label for="damaged">damaged</label>
          <input name="condition" type="radio" id="damaged" value="3">
          </div>
          <button class="electronics-btn">
            next
          </button>
          </div>
        </aside>
        <aside class="music-accessories-tab">
        <img src="imgs/poster.png" alt="">
          <div class="music-accessories-form form">
          <div class="cat-logo">
          <i class="fas fa-music"></i>
          </div>
          <p class="form-p">type: </p>
          <input type="text" id="type" name="type">
          <p class="form-p">brand: </p>
          <input type="text" id="brand" name="brand">
          <p class="form-p">model: </p>
          <input type="text" id="model" name="model">
          <p class="form-p">condition: </p>
          <div class="condition-box">
          <label for="new">new</label>
          <input name="condition" type="radio" id="new" value="1">
          <label for="used">used</label>
          <input name="condition" type="radio" id="used" value="2">
          <label for="damaged">damaged</label>
          <input name="condition" type="radio" id="damaged" value="3">
          </div>
          <button class="music-btn">
            next
          </button>
          </div>
        </aside>
</form>
     </section>
    </div>
    <script src="scripts/offer.js"></script>
  </body>
</html>
