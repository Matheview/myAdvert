<?php
if(!isset($_SESSION)) {
  session_start();
}
$connStr = "host=78.46.51.229 port=5432 dbname=meteopi_myadvert user=meteopi_myadvert password=W86bn+OdGK";

function register() {
  $conn = pg_connect($GLOBALS['connStr']) or die("Could not connect");
  $name = $_POST["user_name"];
  $email = $_POST["user_email"];
  $passwd = $_POST["user_passwd"];
  $phone = $_POST["user_phone"];
  $city = $_POST["user_city"];
  if (!pg_connection_busy($conn)) {
    $query = pg_query($conn, "select register_user('$name', '$email', '$passwd', '$city', $phone);");
  }
  $result = pg_fetch_row($query);
  foreach($result as  $row){
    if (strpos($a, 'Witaj') !== false) {
      header('Location: logedin.php');
    }
    else {
      header('Location: index.php');
    }
  }
  pg_close($conn);
}

function login(){
  $conn = pg_connect($GLOBALS['connStr']) or die("Could not connect");;
  $email = $_POST["user_email"];
  $passwd = $_POST["user_passwd"];
  if (!pg_connection_busy($conn)) {
    $query = pg_query($conn, "select login_user('$email', '$passwd');");
  }
  $result = pg_fetch_assoc($query);
  $result = str_replace('(', '', $result['login_user']);
  $result = str_replace(')', '', $result);
  $row = explode(",", $result);
      if ($row[4] != '') {
        $_SESSION['user_name'] = $row[0];
        $_SESSION['user_id'] = $row[4];
        header('Location: logedin.php');
      }
      else {
        header('Location: register.php');
      }
  pg_close($conn);
}

function show_automotive_all($words) {
  $conn = pg_connect($GLOBALS['connStr']) or die("Could not connect");
  if($words == NULL) {
    $query = pg_query($conn, "SELECT * FROM offer_automotive.show_offers('')");
  }
  else if (!pg_connection_busy($conn)) {
    $query = pg_query($conn, "SELECT * FROM offer_automotive.show_offers('.$words.')");
  }
  $result = pg_fetch_all($query);
  echo('<div class="offer-filter">
        <p>Sort</p>
       <select name="sort-offers" id="sort" onchange="checkFilterValue()">
         <option selected value="newest" id="selected-option">newest offers</option>
         <option value="oldest" id="oldest-option">older offers</option>
         <option value="highprice" id="highprice-option">from the most expensive</option>
         <option value="lowprice" id="lowprice-option">from the cheapest</option>
       </select>
      </div>
      <div class="offers-wrap" id="just-check" style="display: inline-block;">');
  foreach($result as $row) {
    $offerlink = "'automotive.php?offer_id=".$row['tab_id']."';";
    echo('<div class="offer" data-offer="'.$row['tab_created_at'].'" price-offer='.$row['tab_price'].'>
        <div class="img-box">
          <img src="'.$row['tab_image'].'" alt="" />
        </div>
        <div class="offer-box">
          <div class="offer-title">
            <h1 class="title">'.$row['tab_desc_short'].'</h1>
          </div>
          <div class="offer-description">
            <p class="description">'.$row['tab_desc_long'].'</p>
          </div>
          <div class="offer-price">
            <p class="price">'.$row['tab_price'].'</p>
          </div>
          <div class="offer-localisation">
            <p class="localisation">'.$row['tab_city'].'</p>
          </div>
          <div class="offer-date">
            <p class="date">'.$row['tab_created_at'].'</p>
          </div>
          <button onclick="location.href='.$offerlink.'" type="button">Show</button>
        </div>
      </div>');
    }
    echo('</div>');
}

function show_clothes_all($words) {
  $conn = pg_connect($GLOBALS['connStr']) or die("Could not connect");
  if($words == NULL) {
    $query = pg_query($conn, "SELECT * FROM offer_clothes.show_offers('')");
  }
  else if (!pg_connection_busy($conn)) {
    $query = pg_query($conn, "SELECT * FROM offer_clothes.show_offers('.$words.')");
  }
  $result = pg_fetch_all($query);
  echo('<div class="offer-filter">
        <p>Sort</p>
       <select name="sort-offers" id="sort" onchange="checkFilterValue()">
         <option selected value="newest" id="selected-option">newest offers</option>
         <option value="oldest" id="oldest-option">older offers</option>
         <option value="highprice" id="highprice-option">from the most expensive</option>
         <option value="lowprice" id="lowprice-option">from the cheapest</option>
       </select>
      </div>
      <div class="offers-wrap" id="just-check" style="display: inline-block;">');
  foreach($result as $row) {
    $offerlink = "'clothes.php?offer_id=".$row['tab_id']."';";
    echo('<div class="offer" data-offer="'.$row['tab_created_at'].'" price-offer='.$row['tab_price'].'>
        <div class="img-box">
          <img src="'.$row['tab_image'].'" alt="" />
        </div>
        <div class="offer-box">
          <div class="offer-title">
            <h1 class="title">'.$row['tab_desc_short'].'</h1>
          </div>
          <div class="offer-description">
            <p class="description">'.$row['tab_desc_long'].'</p>
          </div>
          <div class="offer-price">
            <p class="price">'.$row['tab_price'].'</p>
          </div>
          <div class="offer-localisation">
            <p class="localisation">'.$row['tab_city'].'</p>
          </div>
          <div class="offer-date">
            <p class="date">'.$row['tab_created_at'].'</p>
          </div>
          <button onclick="location.href='.$offerlink.'" type="button">Show</button>
        </div>
      </div>');
    }
    echo('</div>');
}

function show_electronics_all($words) {
  $conn = pg_connect($GLOBALS['connStr']) or die("Could not connect");
  if($words == NULL) {
    $query = pg_query($conn, "SELECT * FROM offer_electronics.show_offers('')");
  }
  else if (!pg_connection_busy($conn)) {
    $query = pg_query($conn, "SELECT * FROM offer_electronics.show_offers('.$words.')");
  }
  $result = pg_fetch_all($query);
  echo('<div class="offer-filter">
        <p>Sort</p>
       <select name="sort-offers" id="sort" onchange="checkFilterValue()">
         <option selected value="newest" id="selected-option">newest offers</option>
         <option value="oldest" id="oldest-option">older offers</option>
         <option value="highprice" id="highprice-option">from the most expensive</option>
         <option value="lowprice" id="lowprice-option">from the cheapest</option>
       </select>
      </div>
      <div class="offers-wrap" id="just-check" style="display: inline-block;">');
  foreach($result as $row) {
    $offerlink = "'electronics.php?offer_id=".$row['tab_id']."';";
    echo('<div class="offer" data-offer="'.$row['tab_created_at'].'" price-offer='.$row['tab_price'].'>
        <div class="img-box">
          <img src="'.$row['tab_image'].'" alt="" />
        </div>
        <div class="offer-box">
          <div class="offer-title">
            <h1 class="title">'.$row['tab_desc_short'].'</h1>
          </div>
          <div class="offer-description">
            <p class="description">'.$row['tab_desc_long'].'</p>
          </div>
          <div class="offer-price">
            <p class="price">'.$row['tab_price'].'</p>
          </div>
          <div class="offer-localisation">
            <p class="localisation">'.$row['tab_city'].'</p>
          </div>
          <div class="offer-date">
            <p class="date">'.$row['tab_created_at'].'</p>
          </div>
          <button onclick="location.href='.$offerlink.'" type="button">Show</button>
        </div>
      </div>');
    }
    echo('</div>');
}

function show_music_accessories_all($words) {
  $conn = pg_connect($GLOBALS['connStr']) or die("Could not connect");
  if($words == NULL) {
    $query = pg_query($conn, "SELECT * FROM offer_music_accessories.show_offers('')");
  }
  else if (!pg_connection_busy($conn)) {
    $query = pg_query($conn, "SELECT * FROM offer_music_accessories.show_offers('.$words.')");
  }
  $result = pg_fetch_all($query);
  echo('<div class="offer-filter">
        <p>Sort</p>
       <select name="sort-offers" id="sort" onchange="checkFilterValue()">
         <option selected value="newest" id="selected-option">newest offers</option>
         <option value="oldest" id="oldest-option">older offers</option>
         <option value="highprice" id="highprice-option">from the most expensive</option>
         <option value="lowprice" id="lowprice-option">from the cheapest</option>
       </select>
      </div>
      <div class="offers-wrap" id="just-check" style="display: inline-block;">');
  foreach($result as $row) {
    $offerlink = "'music.php?offer_id=".$row['tab_id']."';";
    echo('<div class="offer" data-offer="'.$row['tab_created_at'].'" price-offer='.$row['tab_price'].'>
        <div class="img-box">
          <img src="'.$row['tab_image'].'" alt="" />
        </div>
        <div class="offer-box">
          <div class="offer-title">
            <h1 class="title">'.$row['tab_desc_short'].'</h1>
          </div>
          <div class="offer-description">
            <p class="description">'.$row['tab_desc_long'].'</p>
          </div>
          <div class="offer-price">
            <p class="price">'.$row['tab_price'].'</p>
          </div>
          <div class="offer-localisation">
            <p class="localisation">'.$row['tab_city'].'</p>
          </div>
          <div class="offer-date">
            <p class="date">'.$row['tab_created_at'].'</p>
          </div>
          <button onclick="location.href='.$offerlink.'" type="button">Show</button>
        </div>
      </div>');
    }
    echo('</div>');
}

function show_offer_automotive($offer_id) {

}
function show_offer_clothes($offer_id) {

}
function show_offer_electronics($offer_id) {

}
function show_offer_music_accessories($offer_id) {

}

function add_offer() {
  $conn = pg_connect($GLOBALS['connStr']) or die("Could not connect");
  $files = ['main-img', 'img1', 'img2', 'img3', 'img4'];

  if($_POST['cat'] == "automotive"){
    $query = pg_query($conn, "select offer_automotive.create_offer_automotive('"
    .$_POST['title']."', '".$_POST['description']."', '".$_POST['condition']."', '"
    .$_POST['brand']."', '".$_POST['model']."', ".$_POST['price'].", ".$_SESSION['user_id'].", "
    .$_POST['mileage'].", ".$_POST['engine'].", ".$_POST['year'].");");
    $result = pg_fetch_row($query);
    foreach($result as $row){
      if($row == 0) {
        echo(';error');
      }
      else {
        $target_dir = 'offers_picture/'.$_POST['cat']."/".$row;
        if (!file_exists($target_dir)) {
          mkdir($target_dir, 0777, true);
        }
        foreach($files as $file){
          if($_FILES[$file]["name"] !== '') {
              $query = pg_query($conn, "select offer_automotive.add_picture(".$row.", '".$_FILES[$file]["name"]."');");
              $target_file = $target_dir.'/' . basename($_FILES[$file]["name"]);
              move_uploaded_file($_FILES[$file]["tmp_name"], $target_file);
              pg_fetch_row($query);
          }
        }
      }
    }
    header('Location: index.php');
  }

  elseif($_POST['cat'] == "clothes"){
    $query = pg_query($conn, "select offer_clothes.create_offer_clothes('"
    .$_POST['title']."', '".$_POST['description']."', '".$_POST['condition']."', '"
    .$_POST['brand']."', '".$_POST['color']."', ".$_POST['price'].", ".$_SESSION['user_id'].", '"
    .$_POST['size']."', '".$_POST['sex']."');");
    $result = pg_fetch_row($query);
    foreach($result as $row){
      $target_dir = 'offers_picture/'.$_POST['cat']."/".$row;
      if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
      }
      foreach($files as $file){
        if($_FILES[$file]["name"] !== '') {
            echo($_FILES[$file]["name"]);
            $query = pg_query($conn, "select offer_clothes.add_picture(".$row.", '".$_FILES[$file]["name"]."');");
            $target_file = $target_dir.'/' . basename($_FILES[$file]["name"]);
            move_uploaded_file($_FILES[$file]["tmp_name"], $target_file);
            pg_fetch_row($query);
        }
      }
    }
    header('Location: index.php');
  }

  elseif($_POST['cat'] == "electronics"){
    $query = pg_query($conn, "select offer_electronics.create_offer_electronics('"
    .$_POST['title']."', '".$_POST['description']."', '".$_POST['condition']."', '"
    .$_POST['brand']."', '".$_POST['color']."', ".$_POST['price'].", ".$_SESSION['user_id'].");");
    $result = pg_fetch_row($query);
    foreach($result as $row){
      $target_dir = 'offers_picture/'.$_POST['cat']."/".$row;
      if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
      }
      foreach($files as $file){
        if($_FILES[$file]["name"] !== '') {
            echo($_FILES[$file]["name"]);
            $query = pg_query($conn, "select offer_electronics.add_picture(".$row.", '".$_FILES[$file]["name"]."');");
            $target_file = $target_dir.'/' . basename($_FILES[$file]["name"]);
            move_uploaded_file($_FILES[$file]["tmp_name"], $target_file);
            pg_fetch_row($query);
        }
      }
    }
      header('Location: index.php');
  }

  elseif($_POST['cat'] == "music-accessories"){
    $query = pg_query($conn, "select offer_music_accessories.create_offer_music_acc('"
    .$_POST['title']."', '".$_POST['description']."', '".$_POST['condition']."', '"
    .$_POST['brand']."', '".$_POST['model']."', ".$_POST['price'].", ".$_SESSION['user_id'].", '".$_POST['type']."');");
    $result = pg_fetch_row($query);
    foreach($result as $row){
      $target_dir = 'offers_picture/'.$_POST['cat']."/".$row;
      if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
      }
      foreach($files as $file){
        if($_FILES[$file]["name"] !== '') {
            echo($_FILES[$file]["name"]);
            $query = pg_query($conn, "select offer_music_accessories.add_picture(".$row.", '".$_FILES[$file]["name"]."');");
            $target_file = $target_dir.'/' . basename($_FILES[$file]["name"]);
            move_uploaded_file($_FILES[$file]["tmp_name"], $target_file);
            pg_fetch_row($query);
        }
      }
    }
    header('Location: index.php');
  }

  else {
    header('Location: createadv.php?category=false');
  }
  pg_close($conn);
}

function check_user($args) {
  if(isset($_SESSION['user_name'])) {
    echo('Hello '.$_SESSION['user_name'].'</p>
    <div class="account-info">
       <a class="account-a" href="functions.php?logout=true">log out</a>
      </ul>
    </div>');
  }
  elseif($args == "logedin") {
    echo('Hello ...</p>
    <div class="account-info">
       <a class="account-a" href="functions.php?logout=true">log out</a>
      </ul>
    </div>');
  }
  elseif($args == "account") {
    $js = "document.getElementById('login_a').submit();";
    echo('account</p>
      <div class="account-info">
      <form id="login_a" method="POST" action="functions.php">
      <input name="user_email" type="text" placeholder="login...">
      <input name="user_passwd" type="password" placeholder="password...">
      <input type="hidden" name="login" value="login" />
       <a href="#" class="account-a" onclick="'.$js.'">sign in</a>
     </form>
      </ul>
    </div>');
  }
}

if(isset($_POST['addoffer'])) {
  add_offer();
}

if (isset($_POST['register'])) {
  register();
}
if (isset($_POST['login'])) {
  login();
}
if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  header('Location: index.php');
}
if (isset($_GET['add_offer'])){
  if(isset($_SESSION['user_name'])){
    header('Location: createadv.php');
  }
  else {
    header('Location: register.php');
  }
}
echo(isset($_POST['addoffer']));

?>
