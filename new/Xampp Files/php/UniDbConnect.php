<?php

  session_start();

  $serverName = "localhost";
  $username = "username";
  $password = "password";
  $database = $_SESSION['NewDbID'];

  $newDbConnect = new mysqli($serverName,$username,$password,$database);

  if ($newDbConnect->connect_error) {
    die("Database Connection Failed. We are workig on it");
  }


?>
