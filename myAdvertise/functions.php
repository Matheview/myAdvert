<?php
if (session_status() == PHP_SESSION_NONE) {
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
      exit();
    }
    else {
      header('Location: index.php');
      exit();
    }
  }
  pg_close($conn);
}

function login(){
  $conn = pg_connect($GLOBALS['connStr']) or die("Could not connect");
  $email = $_POST["user_email"];
  $passwd = $_POST["user_passwd"];
  if (!pg_connection_busy($conn)) {
    $query = pg_query($conn, "select login_user('$email', '$passwd');");
  }
  $result = pg_fetch_row($query);
  foreach($result as  $row){
    $row = str_replace("(", "", $row);
    $row = str_replace(")", "", $row);
    $pieces = explode(",", $row);
    if (($pieces[0] != '') == 1) {
      $_SESSION['sess_name'] = $pieces[0];
      $_SESSION['sess_code'] = $pieces[1];
      $_SESSION['sess_city'] = $pieces[2];
      $_SESSION['sess_phone'] = $pieces[3];
      header('Location: logedin.php?user_id='.$_SESSION['sess_code']);
      exit();
    }
    else {
      header('Location: register.php');
      exit();
    }
  }
  pg_close($conn);
}

function return_user_name() {
  if (isset($_SESSION['sess_name'])) {
    echo($_SESSION['sess_name']);
  }
  else {
    echo('...');
  }
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
  exit();
}

?>
