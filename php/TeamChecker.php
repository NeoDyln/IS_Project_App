<?php

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();

if (isset($_SESSION)) {
  include 'serverConnector.php';

  $daB = "interappconn";

  $serverConn = new mysqli($serverName,$username,$password,$daB);
        // Two requests...Creation of Db and DB Select

    if ($serverConn) {
      $uniLister = $serverConn->query("SELECT uniInit,uniName FROM institutions");

      if ($uniLister->num_rows > 0) {
        $row = mysqli_fetch_array($uniLister);
        $_SESSION['row'] = $row;

      }
      else{
        header("Location: ../index.html?noRecords");
      }
    }
    elseif ($serverConn->connect_error) {
        header("Location: ../index.html?serverConnError");
    }

  }
  else{
    header("Location: ../index.html?sessionConnError");
  }


?>
