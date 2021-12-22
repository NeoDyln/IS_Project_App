

<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();
if (isset($_POST['openGroup'])) {
  //Loading view
  // No need to perform an sql check as the data isn't inputted directly by the user
$sender = $_POST['sender'];
$groupName = $_POST['groupName'];

echo $groupName;

$_SESSION['sender'] = $sender;
$_SESSION['groupName'] = $groupName;

header('Location: ../../app/groupView.php');

}
 ?>
