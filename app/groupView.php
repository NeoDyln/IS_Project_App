<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();



// Messages imported
// $messages = $messos;
// Other message specifics imported


// Open chat Logic

      require '../php/chats/chatConnector.php';

        $sender = $_SESSION['sender'];
      $groupName = $_SESSION['groupName'];

      if (isset($_POST['sendTxt'])) {
        // New message Logic


        $senderM = $_POST['senderMail'];

        $message = mysqli_real_escape_string($chatConn, stripcslashes($_POST['message']));
        $date = $_POST['dateNow'];

        //New messages should be hashed

        // Prepared statement to insert data
        $textSql = "INSERT INTO groupchats(groupName,sender,message,timeSent) VALUES('$groupName','$senderM','$message','$date')";
        $textStmt = $chatConn->query($textSql);

        if ($textStmt) {
          // code...
        }
        else{

            ?>
              <script type="text/javascript">
                alert("Chat Insertion Failed");
              </script>
            <?php
        }

      }



// Exit chat Logic

if (isset($_POST['exitGroup'])) {
  // Delete current session data
  $_SESSION['sender'] = '';
  $_SESSION['groupName'] = '';

  // Exit current chat
  header('Location: chat.php');
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Chat with</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Stylesheet: Currently only using #textview content -->
    <link rel="stylesheet" href="../style/chatView.css">
    <!-- Fonts in use -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div id="textView">
      <span id="head">
        <p id="recName"> <?php echo $_SESSION['groupName']; ?> </p>
        <form class="exitChat" action="#" method="post">
          <button type="submit" id="exitChatBtn" name="exitGroup">Exit</button>
        </form>

      </span>
      <span id="message">
        <ul id="messagesList">
        <?php
          //Show chats Logic



                  $sender = $_SESSION['sender'];

                  $groupName = $_SESSION['groupName'];

                  ?>
                    <script type="text/javascript">
                      alert("Chat View loaded");
                    </script>
                  <?php

                  // Here, we should pull the messages of all the available texts between rec and sender above
                  $mesSql = "SELECT * FROM groupchats";
                  $mesStmt = $chatConn->query($mesSql);



                  // $pullMessos = mysqli_query($chatConn,"SELECT * FROM chats WHERE (sender= '$sender' AND recipient = '$recipient') OR (sender='$recipient' AND recipient = '$sender')");

                  if ($mesStmt) {
                    while($curUserSender = $mesStmt->fetch_assoc()) {

                        if ($curUserSender['sender'] == $_SESSION['userMail']) {
                          ?>
                              <li id="senBubble">
                                <div>
                                  <p id="senMessage"><?php echo $curUserSender['message']; ?></p>
                                  <p id="senMessageTime"><?php echo $curUserSender['sender']; ?> at <?php echo $curUserSender['timeSent']; ?></p>
                                </div>
                              </li>
                          <?php
                        }
                        else{
                          ?>
                            <li id="recBubble">
                              <div >
                                <p id="recMessage"><?php echo $curUserSender['message'];?></p>
                                <p id="recMessageTime"><?php echo $curUserSender['sender']; ?> at <?php echo $curUserSender['timeSent']; ?></p>
                              </div>
                            </li>

                          <?php
                          }


                        }

                  }
                  else {
                    ?>
                      <script type="text/javascript">
                        alert("No messages ");
                      </script>
                    <?php
                  }


                ?>






            </ul>


      </span>

      <form id="sendText" action="#" method="post">
        <input type="hidden" name="groupName" value="<?php echo $_SESSION['groupName']; ?>">
        <input type="hidden" name="senderMail" value="<?php echo $_SESSION['sender'];  ?>">
        <input type="hidden" name="dateNow" value="<?php echo date('Y/m/d h:i:s');?>">
        <input type="text" id="messageBar" name="message" placeholder="Enter Text">
        <input type="submit" id="sendTxt" name="sendTxt" value="Send">
      </form>



    </div>
  </body>
</html>
