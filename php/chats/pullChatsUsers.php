<?php

// Establish a connection to the database by importing serverconnector
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();

require 'chatConnector.php';

// We select all existing chats where the logged in user has chatted

$sender = $_SESSION['userMail'];

  $select = "SELECT * FROM chats WHERE (sender='$sender') OR (recipient='$sender')";

  $selectQuery = $chatConn->query($select);
//
// $countStmt = $chatConn->prepare("SELECT COUNT(*) FROM chats WHERE (sender=?) OR (recipient=?)");
// $countStmt->bind_param('ss',$sender,$sender);
// $countStmt->execute();
// $countRes = $countStmt->get_result();
//
// if ($countRes) {
//   $selectStmt = $chatConn->prepare("SELECT * FROM chats WHERE (sender=?) OR (recipient=?)");
//   $selectStmt->bind_param('ss',$sender,$sender);
//   $selectStmt->execute();
//   $selectRes = $selectStmt->get_result();
//   $selectRecords = $selectRes->fetch_all(MYSQLI_ASSOC);
//
//   if ($selectRecords) {
//     $chatRows = $selectRecords;
//
//
//   }
//   else {
//     $chatRows = "No Chats";
//   }
// }
// else{

//   $chatRows = "No Chats";
// }
//









?>
