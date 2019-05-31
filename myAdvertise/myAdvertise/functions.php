<?php

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
  $conn = pg_connect($GLOBALS['connStr']) or die("Could not connect");
  $email = $_POST["user_email"];
  $passwd = $_POST["user_passwd"];
  if (!pg_connection_busy($conn)) {
    $query = pg_query($conn, "select login_user('$email', '$passwd');");
  }
  $result = pg_fetch_row($query);
  foreach($result as  $row){
      if (strpos($a, 'Witaj') !== false) {
        header('Location: logedin.php');
      }
      else {
        header('Location: register.php');
      }
  }
  pg_close($conn);
}

if (isset($_POST['register'])) {
  register();
}
if (isset($_POST['login'])) {
  login();
}
if (isset($_GET['logout'])) {
  header('Location: index.php');
}

?>
