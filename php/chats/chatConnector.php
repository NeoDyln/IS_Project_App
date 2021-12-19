<?php

    // Establish a connection to the database by importing serverconnector
    if(session_status() !== PHP_SESSION_ACTIVE) session_start();
    if(session_status() === PHP_SESSION_NONE) session_start();

    $serverName = "localhost";
    $username = "root";
    $password = "";

    $uniDb = $_SESSION['uniQuery'];

    if (isset($uniDb)) {
      $chatConn = new mysqli($serverName, $username, $password, $uniDb);

      if($chatConn){

      }
      else{
        header('Location: ../../index.html?TeamDbConnecterror');
      }
    }


?>
