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
    $query = pg_query($conn, "select offer_music_acc.create_offer_electronics('"
    .$_POST['title']."', '".$_POST['description']."', '".$_POST['condition']."', '"
    .$_POST['brand']."', '".$_POST['model']."', ".$_POST['price'].", ".$_SESSION['user_id'].", '"
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
            $query = pg_query($conn, "select offer_electronics.add_picture(".$row.", '".$_FILES[$file]["name"]."');");
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
    echo($_SESSION['user_name']);
  }
  elseif($args == "logedin") {
    echo("...");
  }
  elseif($args == "account") {
    echo("account");
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

?>
