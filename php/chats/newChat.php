
<?php

// Establish a connection to the database by importing serverconnector
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();

require 'chatConnector.php';

if (isset($_POST['startNewChat']))   {
  // collect recepient and sender info as well as date
  $recMail = mysqli_real_escape_string($chatConn, stripcslashes($_POST['newChatMail']));
  $senderMail = $_SESSION['userMail'];
  $curDate = date('Y/m/d h:i:s');

  // We'll also add a default new chat message
  $defMess = 'New chat started by '.$senderMail;

  // check if an exisitng chat by this user is there

  $chatCheck = $chatConn->prepare("SELECT * FROM chats WHERE recipient = ?");
  $chatCheck->bind_param("s",$recMail);
  $chatCheck->execute();
  $checkRes = $chatCheck->get_result();
  $checkRow = $checkRes->fetch_assoc();


  if ($checkRow) {
    // User has chatted before
    ?>
      <script type="text/javascript">
        alert("Chat exists");
      </script>
    <?php
  }
  else if (!$checkRow){

    if ($recMail == $senderMail) {
      // This checks that a user is not trying to chat with themselves
      ?>
        <script type="text/javascript">
          alert("You cannot start a chat with yourself");
        </script>
      <?php
    }
    else{
      // We'll then insert all the data to the chats table

      $chatInsert = "INSERT INTO chats(sender,recipient,message,timeSent) VALUES(?,?,?,?)";
      $newChatStmt = $chatConn->prepare($chatInsert);
      $newChatStmt->bind_param("ssss",$senderMail,$recMail,$defMess,$curDate);
      $newChatStmt->execute();

      // Then rediect back to the main page.
      ?>
        <script type="text/javascript">
          alert("Chat added below");
        </script>
      <?php
    }


  }




}
else {
  ?>
  <script type="text/javascript">
    alert("You need to search for a user then click the start chat button");
  </script>
  <?php
}


?>
