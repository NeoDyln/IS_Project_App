<?php

  if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  if(session_status() === PHP_SESSION_NONE) session_start();

  require 'chatConnector.php';



  $userSt = "SELECT * FROM auth_table";
  $userQuery = mysqli_query($chatConn, $userSt);

  if (mysqli_num_rows($userQuery) > 0) {
    // We'll use a for loop to pull information about the users present
    $rowUser =$userQuery;
  } else {
    // Thus should be unreachable
    echo "This should be unreachable. It simply means there are no other registered users";
  }

?>
