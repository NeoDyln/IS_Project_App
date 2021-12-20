<?php

// Establish a connection to the database by importing serverconnector
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();

require 'chatConnector.php';

// We select all existing chats where the logged in user has chatted

$sender = $_SESSION['userMail'];

$countStmt = $chatConn->prepare("SELECT COUNT(*) FROM chats WHERE sender= ? ");
$countStmt->bind_param('s',$sender);
$countStmt->execute();
$countRes = $countStmt->get_result();

if ($countRes) {
  $selectSql = "SELECT * FROM chats WHERE sender='$sender'";
  $selectStmt = mysqli_query($chatConn,$selectSql);

  if ($selectStmt) {
    $chatRow = $selectStmt;

    foreach ($chatRow as $key) {



    }
  }
  else {
    ?>
      <script type="text/javascript">
        alert("You have no chats");
      </script>
    <?php
  }
}
else{
  ?>
    <script type="text/javascript">
      alert("You have no chats");
    </script>
  <?php
}










?>
