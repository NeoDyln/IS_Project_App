<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();

if (isset($_POST['openChat']))
{
  require '../php/chats/openChat.php';
}
else {
  ?>
    <script type="text/javascript">
      alert("You need to click the start chat button");
    </script>
  <?php
}


// Messages imported
$messages = $messos;
// Other message specifics imported
$sender = $_SESSION['sender'];
$recipient = $_SESSION['recipient'];
$recName = $_SESSION['recName'];

// Exit chat Logic

if (isset($_POST['exitChat'])) {
  // Delete current session data
  $_SESSION['sender'] = '';
  $_SESSION['recipient'] = '';
  $_SESSION['recName'] = '';

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
        <p id="recName"> <?php echo $recName; ?> </p>
        <form class="exitChat" action="#" method="post">
          <button type="submit" id="exitChatBtn" name="exitChat">Exit</button>
        </form>

      </span>
      <span id="message">
        <?php
          while ($messages) {
            ?>
            <ul id="messagesList">
              <?php
                  foreach ($messages as $msg) {
                    if ($msg['sender'] == $sender && $msg['recipient'] == $recipient) {
                      echo $msg['message'];
                    }
                  }
                    

                ?>
                <li>
                  <div id="recBubble">
                    <p id="recMessage">Lorem ipsum</p>
                    <p id="recMessageTime">00/00/00</p>
                  </div>
                </li>
                <li>
                  <div id="senBubble">
                    <p id="senMessage">Lorem ipsum</p>
                    <p id="senMessageTime">00/00/00</p>
                  </div>
                </li>
            </ul>
            <?php
          }

        ?>

      </span>

      <form id="sendText" action="../php/chats/chatAlgo.php" method="post">
        <input type="text" id="messageBar" name="message" placeholder="Enter Text">
        <input type="submit" id="sendTxt" name="sendTxt" value="Send">
      </form>

    </div>
  </body>
</html>
