

<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();
if (isset($_POST['openChat'])) {
  //Loading view
  // No need to perform an sql check as the data isn't inputted directly by the user
$recipient = $_POST['recipient'];
$sender = $_POST['sender'];
$recName = $_POST['recipName'];

$_SESSION['sender'] = $sender;
$_SESSION['recipient'] = $recipient;
$_SESSION['recName'] = $recName;

header('Location: ../../app/chatView.php');

}
 ?>
