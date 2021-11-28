<?php
  if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  elseif(session_status() === PHP_SESSION_NONE) session_start();
  include 'serverConnector.php';

  // We then fetch the type of query as a variable
  $logIn = $_POST['logOn'];
  $signUp = $_POST['signUp'];
  $forgotPass = $_POST['resetReq'];

  // For each type, a different action is done

  // For log in function
  if (isset($logIn)) {
    // code...
  }


  // For account creation function
  elseif (isset($signUp)) {

    // We collect the form Data
    $uniInit = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniQuery']));
    $userNames =  mysqli_real_escape_string($serverConn, stripcslashes($_POST['userNames']));
    $userMail =  mysqli_real_escape_string($serverConn, stripcslashes($_POST['userMail']));
    $userTel =  mysqli_real_escape_string($serverConn, stripcslashes($_POST['userTel']));
    $userPass =  mysqli_real_escape_string($serverConn, stripcslashes($_POST['userPass']));

  }
  elseif (isset($resetReq)) {
    // code...
  }
  else{
    close();
    session_destroy();
    header("Location: ../index.html?WrongAccess");
  }








 ?>
