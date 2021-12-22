<?php
// Basically a file to add the needed tables

  require 'chatConnector.php';

  $chatsTable = "CREATE TABLE IF NOT EXISTS chats(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, sender VARCHAR(255), recipient VARCHAR(255), message VARCHAR(255), timeSent DateTime)";
  $chatQuery = mysqli_query($chatConn, $chatsTable);

  if ($chatQuery) {
    // code...
  }
  else{
    echo "Chat table not created";
  }

  $groupChatTable = "CREATE TABLE IF NOT EXISTS groupchats (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, groupName VARCHAR(255), sender VARCHAR(255), message VARCHAR(255), timeSent DateTime)";
  $groupChatQuery = mysqli_query($chatConn, $chatsTable);

  if ($groupChatQuery) {
    
  }
  else{
    echo "Groups Chat table not created";
  }

  $groupsList = "CREATE TABLE IF NOT EXISTS groups (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, groupname VARCHAR(255), creator VARCHAR(255), members VARCHAR(255))";
  $groupsList = mysqli_query($chatConn, $chatsTable);

  if ($groupsList) {
    $getName = "SELECT * FROM auth_table WHERE userMail = '$userMail'";
    $getNameQuery = mysqli_query($chatConn, $getName);

    if ($getNameQuery) {
      $row = mysqli_fetch_array($getNameQuery);
    }
    else {
      echo "Fail";
    }
  }
  else{
    echo "groups table not created";
  }







?>
