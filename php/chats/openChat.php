<?php
require 'chatConnector.php';

if (isset($_POST['openChat'])) {

  // No need to perform an sql check as the data isn't inputted directly by the user
  $recipient = $_POST['recipient'];
  $sender = $_POST['sender'];
  $recName = $_POST['recipName'];

  $_SESSION['sender'] = $sender;
  $_SESSION['recipient'] = $recipient;
  $_SESSION['recName'] = $recName;

  ?>
    <script type="text/javascript">
      alert("Chat View loaded");
    </script>
  <?php


  // Here, we should pull the messages of all the available texts between rec and sender above
  $mesSql = "SELECT * FROM chats WHERE (sender=? AND recipient = ?) OR (sender=? AND recipient = ?)";
  $mesStmt = $chatConn->prepare($mesSql);
  $mesStmt->bind_param('ssss',$sender,$recipient,$recipient,$sender);
  $mesStmt->execute();
  $mesStRes = $mesStmt->get_result();
  $pullMessos = $mesStRes->fetch_assoc();
  // $pullMessos = mysqli_query($chatConn,"SELECT * FROM chats WHERE (sender= '$sender' AND recipient = '$recipient') OR (sender='$recipient' AND recipient = '$sender')");


  if ($pullMessos) {
    $messos = $pullMessos;
    ?>
      <script type="text/javascript">
        alert("Messages between ".$sender." and ".$recipient );
      </script>
    <?php

  }
  else {
    ?>
      <script type="text/javascript">
        alert("No messages between ".$sender." and ".$recipient );
      </script>
    <?php
  }

}
else {
  ?>
    <script type="text/javascript">
      alert("You need to click the start chat button");
    </script>
  <?php
}



 ?>
