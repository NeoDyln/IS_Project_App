<?php
// Establish a connection to the database by importing serverconnector
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();

// $currentURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
require 'php/serverConnector.php';

$userMail = $_GET['userMail'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reset Page</title>
  </head>
  <body>
    <h2>Reset Password</h2>
    <form class="resetForm" action="" method="post">
      <input type="text" name="uniDb" placeholder="Uni ID" required><br>
      <input type="text" name="token" placeholder="Token" required><br>
      <input type="text" placeholder="Token Password" name="tokenPass" required><br>
      <input type="password" name="newPass" placeholder="New Password" required><br>
      <input type="password" placeholder="Repeat Password" name="repPass" required><br>
      <input type="submit" name="tokenReset" value="Reset">
    </form>

    <a href="index.html"> Home</a>
  </body>
</html>

<?php
//  Add password fields ,zRetrieve inputted data and query if they exist on database afterwards

  if(isset($_POST['tokenReset'])){

    // echo $currentURL;




    $uniDb = $_POST['uniDb'];
    $token = $_POST['token'];
    echo $userMail;
    $tokenPass = $_POST['tokenPass'];

    $newPass = $_POST['newPass'];
    $repPass = $_POST['repPass'];

    if(isset($uniDb)){
      $passConn = new mysqli($serverName, $username, $password, $uniDb);
    }
    else{
      echo "FUCK";
    }


    while($newPass != $repPass){
      echo "Passwords Mismatch";
    }

    if ($newPass == $repPass) {
      // Hash the to- be password
      $finPass = password_hash($newPass, PASSWORD_DEFAULT);
      // Verify the tokens
      $verifyT = "SELECT * FROM tokenreset WHERE token = '$token'";
      $verifyTQuery = mysqli_query($passConn, $verifyT);

      if ($verifyTQuery) {


          // Here the token and its password are correct so we update the new password
          $update = "UPDATE auth_table SET userPass = '$finPass' WHERE userMail = '$userMail'";
          $updateQuery = mysqli_query($passConn, $update);

          if ($updateQuery) {
            // Here the password was changed
            echo "Password reset successful";
          }
          else{
            echo "Password Update Failed";

          }

      }


    }

  }
?>
